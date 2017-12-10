<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2016, Alex Tselegidis
 * @license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        http://easyappointments.org
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Backend API Controller
 *
 * Contains all the backend AJAX callbacks.
 *
 * @package Controllers
 */
class Backend_api extends CI_Controller {
    private $privileges;

    public function __construct() {
        parent::__construct();

        // All the methods in this class must be accessible through a POST request.
        if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
            $this->security->csrf_show_error();
        }

        $this->load->library('session');
        $this->load->model('roles_model');
        $this->privileges = $this->roles_model->get_privileges($this->session->userdata('role_slug'));

        // Set user's selected language.
        if ($this->session->userdata('language')) {
        	$this->config->set_item('language', $this->session->userdata('language'));
        	$this->lang->load('translations', $this->session->userdata('language'));
        } else {
        	$this->lang->load('translations', $this->config->item('language')); // default
        }
    }

    /**
     * [AJAX] Get the registered appointments for the given date period and record.
     *
     * This method returns the database appointments and unavailable periods for the
     * user selected date period and record type (provider or service).
     *
     * @param numeric $_POST['record_id'] Selected record id.
     * @param string $_POST['filter_type'] Could be either FILTER_TYPE_PROVIDER or FILTER_TYPE_SERVICE.
     * @param string $_POST['start_date'] The user selected start date.
     * @param string $_POST['end_date'] The user selected end date.
     */
    public function ajax_get_calendar_appointments() {
        try {
            if ($this->privileges[PRIV_APPOINTMENTS]['view'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            if (!isset($_POST['filter_type'])) {
                echo json_encode(array( 'appointments' => array()));
                return;
            }

            $this->load->model('appointments_model');
            $this->load->model('providers_model');
            $this->load->model('services_model');
            $this->load->model('customers_model');

            if ($_POST['filter_type'] == FILTER_TYPE_PROVIDER) {
                $where_id = 'id_users_provider';
            } else {
                $where_id = 'id_services';
            }

            // Get appointments
            $where_clause = array(
                $where_id => $_POST['record_id'],
                //'start_datetime >=' => $_POST['start_date'],
                //'end_datetime <=' => $_POST['end_date'],
                'is_unavailable' => FALSE
            );

            $response['appointments'] = $this->appointments_model->get_batch($where_clause);

            foreach($response['appointments'] as &$appointment) {
                $appointment['provider'] = $this->providers_model->get_row($appointment['id_users_provider']);
                $appointment['service'] = $this->services_model->get_row($appointment['id_services']);
                $appointment['customer'] = $this->customers_model->get_row($appointment['id_users_customer']);
            }

            // Get unavailable periods (only for provider).
            if ($_POST['filter_type'] == FILTER_TYPE_PROVIDER) {
                $where_clause = array(
                    $where_id => $_POST['record_id'],
                    //'start_datetime >=' => $_POST['start_date'],
                    //'end_datetime <=' => $_POST['end_date'],
                    'is_unavailable' => TRUE
                );

                $response['unavailables'] = $this->appointments_model->get_batch($where_clause);
            }

            echo json_encode($response);

        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Save appointment changes that are made from the backend calendar page.
     *
     * @param array $_POST['appointment_data'] (OPTIONAL) Array with the appointment data.
     * @param array $_POST['customer_data'] (OPTIONAL) Array with the customer data.
     */
    public function ajax_save_appointment() {
        try {
        	$this->load->model('appointments_model');
        	$this->load->model('providers_model');
        	$this->load->model('services_model');
        	$this->load->model('customers_model');
        	$this->load->model('settings_model');

            // :: SAVE CUSTOMER CHANGES TO DATABASE
            if (isset($_POST['customer_data'])) {
                $customer = json_decode(stripcslashes($_POST['customer_data']), true);

                $REQUIRED_PRIV = (!isset($customer['id']))
                        ? $this->privileges[PRIV_CUSTOMERS]['add']
                        : $this->privileges[PRIV_CUSTOMERS]['edit'];
                if ($REQUIRED_PRIV == FALSE) {
                    throw new Exception('You do not have the required privileges for this task.');
                }

                $customer['id'] = $this->customers_model->add($customer);
            }

        	// :: SAVE APPOINTMENT CHANGES TO DATABASE
            if (isset($_POST['appointment_data'])) {
                $appointment = json_decode($_POST['appointment_data'], true);

                $REQUIRED_PRIV = (!isset($appointment['id']))
                        ? $this->privileges[PRIV_APPOINTMENTS]['add']
                        : $this->privileges[PRIV_APPOINTMENTS]['edit'];
                if ($REQUIRED_PRIV == FALSE) {
                    throw new Exception('You do not have the required privileges for this task.');
                }

                // If the appointment does not contain the customer record id, then it
                // means that is is going to be inserted. Get the customer's record id.
                if (!isset($appointment['id_users_customer'])) {
                    $appointment['id_users_customer'] = $customer['id'];
                }

                $appointment['id'] = $this->appointments_model->add($appointment);
            }

            $appointment = $this->appointments_model->get_row($appointment['id']);
            $provider = $this->providers_model->get_row($appointment['id_users_provider']);
            $customer = $this->customers_model->get_row($appointment['id_users_customer']);
            $service = $this->services_model->get_row($appointment['id_services']);

            $company_settings = array(
            	'company_name' => $this->settings_model->get_setting('company_name'),
            	'company_link' => $this->settings_model->get_setting('company_link'),
            	'company_email' => $this->settings_model->get_setting('company_email')
            );

            // :: SEND EMAIL NOTIFICATIONS TO PROVIDER AND CUSTOMER
            try {
                $this->load->library('Notifications');

                $send_provider = $this->providers_model
                            ->get_setting('notifications', $provider['id']);

                $customer_title = $this->lang->line('appointment_booked');
                $customer_message = $this->lang->line('thank_you_for_appointment');
                $customer_link = $this->config->item('base_url') . '/index.php/booking/index/'
                        . $appointment['hash'];

                $provider_title = $this->lang->line('appointment_added_to_your_plan');
                $provider_message = $this->lang->line('appointment_link_description');
                $provider_link = $this->config->item('base_url') . '/index.php/backend/index/'
                        . $appointment['hash'];


                $send_customer = $this->settings_model->get_setting('customer_notifications');

				if ((bool)$send_customer === TRUE) {
                    $this->notifications->send_appointment_details($appointment, $provider,
                            $service, $customer, $company_settings, $customer_title,
                            $customer_title, $customer_message, '', '', $customer_link,
                            $customer['email']);
                }

                if ($send_provider == TRUE) {
                    $this->notifications->send_appointment_details($appointment, $provider,
                            $service, $customer, $company_settings, $provider_title,
                            $provider_title, $provider_message, '', '', $provider_link,
                            $provider['email']);
                }

            } catch(Exception $exc) {
                $warnings[] = exceptionToJavaScript($exc);
            }

            if (!isset($warnings)) {
                echo json_encode(AJAX_SUCCESS);
            } else {
                echo json_encode(array(
                    'warnings' => $warnings
                ));
            }
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Delete appointment from the database.
     *
     * This method deletes an existing appointment from the database. Once this
     * action is finished it cannot be undone. Notification emails are send to both
     * provider and customer
     *
     * @param int $_POST['appointment_id'] The appointment id to be deleted.
     */
    public function ajax_delete_appointment() {
        try {
            if ($this->privileges[PRIV_APPOINTMENTS]['delete'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            if (!isset($_POST['appointment_id'])) {
                throw new Exception('No appointment id provided.');
            }

            // :: STORE APPOINTMENT DATA FOR LATER USE IN THIS METHOD
            $this->load->model('appointments_model');
            $this->load->model('providers_model');
            $this->load->model('customers_model');
            $this->load->model('services_model');
            $this->load->model('settings_model');

            $appointment = $this->appointments_model->get_row($_POST['appointment_id']);
            $provider = $this->providers_model->get_row($appointment['id_users_provider']);
            $customer = $this->customers_model->get_row($appointment['id_users_customer']);
            $service = $this->services_model->get_row($appointment['id_services']);

            $company_settings = array(
                'company_name' => $this->settings_model->get_setting('company_name'),
                'company_email' => $this->settings_model->get_setting('company_email'),
                'company_link' => $this->settings_model->get_setting('company_link')
            );

            // :: DELETE APPOINTMENT RECORD FROM DATABASE
            $this->appointments_model->delete($_POST['appointment_id']);

            // :: SEND NOTIFICATION EMAILS TO PROVIDER AND CUSTOMER
            try {
                $this->load->library('Notifications');

                $send_provider = $this->providers_model
                            ->get_setting('notifications', $provider['id']);

                if ($send_provider == TRUE) {
                    $this->notifications->send_delete_appointment($appointment, $provider,
                            $service, $customer, $company_settings, $provider['email'],
                            $_POST['delete_reason']);
                }

                $send_customer = $this->settings_model->get_setting('customer_notifications');

				if ((bool)$send_customer === TRUE) {
                    $this->notifications->send_delete_appointment($appointment, $provider,
                            $service, $customer, $company_settings, $customer['email'],
                            $_POST['delete_reason']);
                }
            } catch(Exception $exc) {
                $warnings[] = exceptionToJavaScript($exc);
            }

            // :: SEND RESPONSE TO CLIENT BROWSER
            if (!isset($warnings)) {
                echo json_encode(AJAX_SUCCESS); // Everything executed successfully.
            } else {
                echo json_encode(array(
                    'warnings' => $warnings // There were warnings during the operation.
                ));
            }
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Filter the customer records with the given key string.
     *
     * @param string $_POST['key'] The filter key string.
     *
     * @return array Returns the search results.
     */
    public function ajax_filter_customers() {
    	try {
            if ($this->privileges[PRIV_CUSTOMERS]['view'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $this->load->model('appointments_model');
            $this->load->model('services_model');
            $this->load->model('providers_model');
	    	$this->load->model('customers_model');

	    	$key = $this->db->escape_str($_POST['key']);

	    	$where_clause =
	    			'(first_name LIKE "%' . $key . '%" OR ' .
	    			'last_name LIKE "%' . $key . '%" OR ' .
	    			'email LIKE "%' . $key . '%" OR ' .
	    			'phone_number LIKE "%' . $key . '%")';

            $customers = $this->customers_model->get_batch($where_clause);

            foreach($customers as &$customer) {
                $appointments = $this->appointments_model
                        ->get_batch(array('id_users_customer' => $customer['id']));

                foreach($appointments as &$appointment) {
                    $appointment['service'] = $this->services_model
                            ->get_row($appointment['id_services']);
                    $appointment['provider'] = $this->providers_model
                            ->get_row($appointment['id_users_provider']);
                }

                $customer['appointments'] = $appointments;
            }

	    	echo json_encode($customers);

    	} catch(Exception $exc) {
    		echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
    	}
    }

    /**
     * [AJAX] Insert of update unavailable time period to database.
     *
     * @param array $_POST['unavailable'] JSON encoded array that contains the unavailable
     * period data.
     */
    public function ajax_save_unavailable() {
        try {
            // Check privileges
            $unavailable = json_decode($_POST['unavailable'], true);

            $REQUIRED_PRIV = (!isset($unavailable['id']))
                    ? $this->privileges[PRIV_APPOINTMENTS]['add']
                    : $this->privileges[PRIV_APPOINTMENTS]['edit'];
            if ($REQUIRED_PRIV == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $this->load->model('appointments_model');
            $this->load->model('providers_model');

            $provider = $this->providers_model->get_row($unavailable['id_users_provider']);

            // Add appointment
            $unavailable['id'] = $this->appointments_model->add_unavailable($unavailable);
            $unavailable = $this->appointments_model->get_row($unavailable['id']); // fetch all inserted data

            if (isset($warnings)) {
                echo json_encode(array(
                    'warnings' => $warnings
                ));
            } else {
                echo json_encode(AJAX_SUCCESS);
            }

        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Delete an unavailable time period from database.
     *
     * @param numeric $_POST['unavailable_id'] Record id to be deleted.
     */
    public function ajax_delete_unavailable() {
        try {
            if ($this->privileges[PRIV_APPOINTMENTS]['delete'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $this->load->model('appointments_model');
            $this->load->model('providers_model');

            $unavailable = $this->appointments_model->get_row($_POST['unavailable_id']);
            $provider = $this->providers_model->get_row($unavailable['id_users_provider']);

            // Delete unavailable
            $this->appointments_model->delete_unavailable($unavailable['id']);

            if (isset($warnings)) {
                echo json_encode(array(
                    'warnings' => $warnings
                ));
            } else {
                echo json_encode(AJAX_SUCCESS);
            }

        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Save (insert or update) a customer record.
     *
     * @param array $_POST['customer'] JSON encoded array that contains the customer's data.
     */
    public function ajax_save_customer() {
        try {
            $this->load->model('customers_model');
            $customer = json_decode($_POST['customer'], true);

            $REQUIRED_PRIV = (!isset($customer['id']))
                    ? $this->privileges[PRIV_CUSTOMERS]['add']
                    : $this->privileges[PRIV_CUSTOMERS]['edit'];
            if ($REQUIRED_PRIV == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $customer_id = $this->customers_model->add($customer);
            echo json_encode(array(
                'status' => AJAX_SUCCESS,
                'id' => $customer_id
            ));
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Delete customer from database.
     *
     * @param numeric $_POST['customer_id'] Customer record id to be deleted.
     */
    public function ajax_delete_customer() {
        try {
            if ($this->privileges[PRIV_CUSTOMERS]['delete'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $this->load->model('customers_model');
            $this->customers_model->delete($_POST['customer_id']);
            echo json_encode(AJAX_SUCCESS);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Save (insert or update) service record.
     *
     * @param array $_POST['service'] Contains the service data (json encoded).
     */
    public function ajax_save_service() {
        try {
            $this->load->model('services_model');
            $service = json_decode($_POST['service'], true);

            $REQUIRED_PRIV = (!isset($service['id']))
                    ? $this->privileges[PRIV_SERVICES]['add']
                    : $this->privileges[PRIV_SERVICES]['edit'];
            if ($REQUIRED_PRIV == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $service_id =$this->services_model->add($service);
            echo json_encode(array(
                'status' => AJAX_SUCCESS,
                'id' => $service_id
            ));
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Delete service record from database.
     *
     * @param numeric $_POST['service_id'] Record id to be deleted.
     */
    public function ajax_delete_service() {
        try {
            if ($this->privileges[PRIV_SERVICES]['delete'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $this->load->model('services_model');
            $result = $this->services_model->delete($_POST['service_id']);
            echo ($result) ? json_encode(AJAX_SUCCESS) : json_encode(AJAX_FAILURE);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Filter service records by given key string.
     *
     * @param string $_POST['key'] Key string used to filter the records.
     *
     * @return array Returns a json encoded array back to client.
     */
    public function ajax_filter_services() {
        try {
            if ($this->privileges[PRIV_SERVICES]['view'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $this->load->model('services_model');
            $key = $this->db->escape_str($_POST['key']);
            $where =
                    '(name LIKE "%' . $key . '%" OR duration LIKE "%' . $key . '%" OR ' .
                    'price_week LIKE "%' . $key . '%" OR price_week_end LIKE "%' . $key .
                    '%" OR currency LIKE "%' . $key . '%" OR ' . 'description LIKE "%' .
                    $key . '%")';
            $services = $this->services_model->get_batch($where);
            echo json_encode($services);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Save (insert or update) category record.
     *
     * @param array $_POST['category'] Json encoded array with the category data. If an id
     * value is provided then the category is going to be udpated instead of inserted.
     */
    public function ajax_save_service_category() {
        try {
            $this->load->model('services_model');
            $category = json_decode($_POST['category'], true);

            $REQUIRED_PRIV = (!isset($category['id']))
                    ? $this->privileges[PRIV_SERVICES]['add']
                    : $this->privileges[PRIV_SERVICES]['edit'];
            if ($REQUIRED_PRIV == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $category_id = $this->services_model->add_category($category);
            echo json_encode(array(
                'status' => AJAX_SUCCESS,
                'id' => $category_id
            ));
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Delete category record from database.
     *
     * @param numeric $_POST['category_id'] Record id to be deleted.
     */
    public function ajax_delete_service_category() {
        try {
            if ($this->privileges[PRIV_SERVICES]['delete'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $this->load->model('services_model');
            $result = $this->services_model->delete_category($_POST['category_id']);
            echo ($result) ? json_encode(AJAX_SUCCESS) : json_encode(AJAX_FAILURE);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Filter services categories with key string.
     *
     * @param string $_POST['key'] The key string used to filter the records.
     *
     * @return array Returns a json encoded array back to client with the category records.
     */
    public function ajax_filter_service_categories() {
        try {
            if ($this->privileges[PRIV_SERVICES]['view'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $this->load->model('services_model');
            $key = $this->db->escape_str($_POST['key']);
            $where = '(name LIKE "%' . $key . '%" OR description LIKE "%' . $key . '%")';
            $categories = $this->services_model->get_all_categories($where);
            echo json_encode($categories);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Filter admin records with string key.
     *
     * @param string $_POST['key'] The key string used to filter the records.
     *
     * @return array Returns a json encoded array back to client with the admin records.
     */
    public function ajax_filter_admins() {
        try {
            if ($this->privileges[PRIV_USERS]['view'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $this->load->model('admins_model');
            $key = $this->db->escape_str($_POST['key']);
            $where =
                '(first_name LIKE "%' . $key . '%" OR last_name LIKE "%' . $key . '%" ' .
                'OR email LIKE "%' . $key . '%" OR mobile_number LIKE "%' . $key . '%" ' .
                'OR phone_number LIKE "%' . $key . '%" OR notes LIKE "%' . $key . '%")';
            $admins = $this->admins_model->get_batch($where);
            echo json_encode($admins);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Save (insert or update) admin record into database.
     *
     * @param array $_POST['admin'] A json encoded array that contains the admin data. If an 'id'
     * value is provided then the record is going to be updated.
     *
     * @return array Returns an array with the operation status and the record id that was
     * saved into the database.
     */
    public function ajax_save_admin() {
        try {
            $this->load->model('admins_model');
            $admin = json_decode($_POST['admin'], true);

            $REQUIRED_PRIV = (!isset($admin['id']))
                    ? $this->privileges[PRIV_USERS]['add']
                    : $this->privileges[PRIV_USERS]['edit'];
            if ($REQUIRED_PRIV == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $admin_id = $this->admins_model->add($admin);

            $response = array(
                'status' => AJAX_SUCCESS,
                'id' => $admin_id
            );

            echo json_encode($response);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Delete an admin record from the database.
     *
     * @param numeric $_POST['admin_id'] The id of the record to be deleted.
     *
     * @return string Returns the operation result constant (AJAX_SUCESS or AJAX_FAILURE).
     */
    public function ajax_delete_admin() {
        try {
            if ($this->privileges[PRIV_USERS]['delete'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $this->load->model('admins_model');
            $result = $this->admins_model->delete($_POST['admin_id']);
            echo ($result) ? json_encode(AJAX_SUCCESS) : json_encode(AJAX_FAILURE);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Filter provider records with string key.
     *
     * @param string $_POST['key'] The key string used to filter the records.
     *
     * @return array Returns a json encoded array back to client with the provider records.
     */
    public function ajax_filter_providers() {
        try {
            if ($this->privileges[PRIV_USERS]['view'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $this->load->model('providers_model');
            $key = $this->db->escape_str($_POST['key']);
            $where =
                '(first_name LIKE "%' . $key . '%" OR last_name LIKE "%' . $key . '%" ' .
                'OR email LIKE "%' . $key . '%" OR mobile_number LIKE "%' . $key . '%" ' .
                'OR phone_number LIKE "%' . $key . '%" OR notes LIKE "%' . $key . '%")';
            $providers = $this->providers_model->get_batch($where);
            echo json_encode($providers);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Save (insert or update) a provider record into database.
     *
     * @param array $_POST['provider'] A json encoded array that contains the provider data. If an 'id'
     * value is provided then the record is going to be updated.
     *
     * @return string Returns the success contant 'AJAX_SUCCESS' so javascript knows that
     * everything completed successfully.
     */
    public function ajax_save_provider() {
        try {
            $this->load->model('providers_model');
            $provider = json_decode($_POST['provider'], true);

            $REQUIRED_PRIV = (!isset($provider['id']))
                    ? $this->privileges[PRIV_USERS]['add']
                    : $this->privileges[PRIV_USERS]['edit'];
            if ($REQUIRED_PRIV == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            if (!isset($provider['settings']['working_plan'])) {
                $this->load->model('settings_model');
                $provider['settings']['working_plan'] = $this->settings_model
                        ->get_setting('company_working_plan');
            }

            $provider_id = $this->providers_model->add($provider);

            echo json_encode(array(
                'status' => AJAX_SUCCESS,
                'id' => $provider_id
            ));

        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Delete a provider record from the database.
     *
     * @param numeric $_POST['provider_id'] The id of the record to be deleted.
     *
     * @return string Returns the operation result constant (AJAX_SUCESS or AJAX_FAILURE).
     */
    public function ajax_delete_provider() {
        try {
            if ($this->privileges[PRIV_USERS]['delete'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }

            $this->load->model('providers_model');
            $result = $this->providers_model->delete($_POST['provider_id']);
            echo ($result) ? json_encode(AJAX_SUCCESS) : json_encode(AJAX_FAILURE);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Save a setting or multiple settings in the database.
     *
     * This method is used to store settings in the database. It can be either system
     * or user settings, one or many. Use the $_POST variables accordingly.
     *
     * @param array $_POST['settings'] Contains an array with settings.
     * @param bool $_POST['type'] Determines the settings type, can be either SETTINGS_SYSTEM
     * or SETTINGS_USER.
     */
    public function ajax_save_settings() {
        try {
            if ($_POST['type'] == SETTINGS_SYSTEM) {
                if ($this->privileges[PRIV_SYSTEM_SETTINGS]['edit'] == FALSE) {
                    throw new Exception('You do not have the required privileges for this task.');
                }
                $this->load->model('settings_model');
                $settings = json_decode($_POST['settings'], true);
                $this->settings_model->save_settings($settings);
            } else if ($_POST['type'] == SETTINGS_USER) {
                if ($this->privileges[PRIV_USER_SETTINGS]['edit'] == FALSE) {
                    throw new Exception('You do not have the required privileges for this task.');
                }
                $this->load->model('user_model');
                $this->user_model->save_settings(json_decode($_POST['settings'], true));
            }

            echo json_encode(AJAX_SUCCESS);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] This method checks whether the username already exists in the database.
     *
     * @param string $_POST['username'] Record's username to validate.
     * @param bool $_POST['record_exists'] Whether the record already exists in database.
     */
    public function ajax_validate_username() {
        try {
            // We will only use the function in the admins_model because it is sufficient
            // for the rest user types for now (providers).
            $this->load->model('admins_model');
            $is_valid = $this->admins_model->validate_username($_POST['username'], $_POST['user_id']);
            echo json_encode($is_valid);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Change system language for current user.
     *
     * The language setting is stored in session data and retrieved every time the user
     * visits any of the system pages.
     *
     * @param string $_POST['language'] Selected language name.
     */
    public function ajax_change_language() {
    	try {
            // Check if language exists in the available languages.
            $found = false;
            foreach($this->config->item('available_languages') as $lang) {
                if ($lang == $_POST['language']) {
                    $found = true;
                    break;
                }
            }

            if (!$found)
                throw new Exception('Translations for the given language does not exist (' . $_POST['language'] . ').');

            $this->session->set_userdata('language', $_POST['language']);
            $this->config->set_item('language', $_POST['language']);

            echo json_encode(AJAX_SUCCESS);

    	} catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
    	}
    }
}

/* End of file backend_api.php */
/* Location: ./application/controllers/backend_api.php */

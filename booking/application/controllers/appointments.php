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
 * Appointments Controller
 *
 * @package Controllers
 */
class Appointments extends CI_Controller {
    /**
     * Class Constructor
     */
	public function __construct() {
		parent::__construct();

		$this->load->library('session');
        $this->load->helper('installation');

        // Set user's selected language.
		if ($this->session->userdata('language')) {
			$this->config->set_item('language', $this->session->userdata('language'));
			$this->lang->load('translations', $this->session->userdata('language'));
		} else {
			$this->lang->load('translations', $this->config->item('language')); // default
		}
	}

    /**
     * Default callback method of the application.
     *
     * This method creates the appointment book wizard. If an appointment hash
     * is provided then it means that the customer followed the appointment
     * manage link that was send with the book success email.
     *
     */
    public function index() {
        if (!is_ea_installed()) {
            redirect('installation/index');
            return;
        }

        $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $this->load->model('customers_model');
        $this->load->model('settings_model');

        try {
            $available_services  = $this->services_model->get_available_services();
            $available_providers = $this->providers_model->get_available_providers();
            $company_name        = $this->settings_model->get_setting('company_name');
            $date_format         = $this->settings_model->get_setting('date_format');

			// Remove the data that are not needed inside the $available_providers array.
			foreach ($available_providers as $index=>$provider) {
				$stripped_data = array(
					'id' => $provider['id'],
					'first_name' => $provider['first_name'],
					'last_name' => $provider['last_name'],
					'services' => $provider['services']
				);
				$available_providers[$index] = $stripped_data;
			}

            $appointment = array();
            $provider = array();
            $customer = array();

            // Load the book appointment view.
            $view = array (
                'available_services'    => $available_services,
                'available_providers'   => $available_providers,
                'company_name'          => $company_name,
				'date_format'           => $date_format,
                'appointment_data'      => $appointment,
                'provider_data'         => $provider,
                'customer_data'         => $customer
            );
        } catch(Exception $exc) {
            $view['exceptions'][] = $exc;
        }

        $this->load->view('appointments/book', $view);
    }

    /**
     * Cancel an existing appointment.
     *
     * This method removes an appointment from the company's schedule.
     * In order for the appointment to be deleted, the hash string must
     * be provided. The customer can only cancel the appointment if the
     * edit time period is not over yet.
     *
     * @param string $appointment_hash This is used to distinguish the
     * appointment record.
     * @param string $_POST['cancel_reason'] The text that describes why
     * the customer cancelled the appointment.
     */
    public function cancel($appointment_hash) {
        try {
            $this->load->model('appointments_model');
            $this->load->model('providers_model');
            $this->load->model('customers_model');
            $this->load->model('services_model');
            $this->load->model('settings_model');

            // Check whether the appointment hash exists in the database.
            $records = $this->appointments_model->get_batch(array('hash' => $appointment_hash));
            if (count($records) == 0) {
                throw new Exception('No record matches the provided hash.');
            }

            $appointment = $records[0];
            $provider = $this->providers_model->get_row($appointment['id_users_provider']);
            $customer = $this->customers_model->get_row($appointment['id_users_customer']);
            $service = $this->services_model->get_row($appointment['id_services']);

            $company_settings = array(
                'company_name' => $this->settings_model->get_setting('company_name'),
                'company_email' => $this->settings_model->get_setting('company_email'),
                'company_link' => $this->settings_model->get_setting('company_link')
            );

            // :: DELETE APPOINTMENT RECORD FROM THE DATABASE.
            if (!$this->appointments_model->delete($appointment['id'])) {
                throw new Exception('Appointment could not be deleted from the database.');
            }

            // :: SEND NOTIFICATION EMAILS TO CUSTOMER AND PROVIDER
            try {
                $this->load->library('Notifications');

                $send_provider = filter_var($this->providers_model
                            ->get_setting('notifications', $provider['id']), FILTER_VALIDATE_BOOLEAN);

                if ($send_provider == TRUE) {
                    $this->notifications->send_delete_appointment($appointment, $provider,
                            $service, $customer, $company_settings, $provider['email'],
                            $_POST['cancel_reason']);
                }

				$send_customer = filter_var($this->settings_model->get_setting('customer_notifications'),
						FILTER_VALIDATE_BOOLEAN);

				if ($send_customer === TRUE) {
					$this->notifications->send_delete_appointment($appointment, $provider,
							$service, $customer, $company_settings, $customer['email'],
							$_POST['cancel_reason']);
				}

            } catch(Exception $exc) {
                $exceptions[] = $exc;
            }
        } catch(Exception $exc) {
            // Display the error message to the customer.
            $exceptions[] = $exc;
        }

        $view = array(
            'message_title' => $this->lang->line('appointment_cancelled_title'),
            'message_text' => $this->lang->line('appointment_cancelled'),
            'message_icon' => $this->config->item('base_url') . '/assets/img/success.png'
        );

        if (isset($exceptions)) {
            $view['exceptions'] = $exceptions;
        }

        $this->load->view('appointments/message', $view);
    }

	/**
     * GET an specific appointment book and redirect to the payement screen.
     *
     * @param int $appointment_id Contains the id of the appointment to retrieve.
     */
    public function payment($appointment_id) {
        //if the appointment id doesn't exist or zero redirect to index
        if(!$appointment_id){
            redirect('appointments');
        }
        $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $this->load->model('settings_model');
        //retrieve the data needed in the view
        $appointment =  $this->appointments_model->get_row($appointment_id);
        $provider = $this->providers_model->get_row($appointment['id_users_provider']);
        $service = $this->services_model->get_row($appointment['id_services']);
        $company_name = $this->settings_model->get_setting('company_name');

        $payment_data = array(
            'pspid'         => $this->config->item('pspid'),
            'orderid'       => $appointment_id,
            'amount'        => 0,
            'currency'      => $service['currency'],
            'language'      => '',
            'successurl'    => $this->config->item('base_url')
                . "/index.php/appointments/post_payment/"
                . $appointment_id,
            'failurl'       => $this->config->item('base_url')
                . "/index.php/appointments/post_payment/"
                . $appointment_id,
            'shasign'       => "",
            'post_link' 	=> $this->config->item('post_link'),
        );

        // Calulate price
        $appointment_date = $appointment['start_datetime'];
        if(date('N', strtotime($appointment_date)) >= 6){
            $payment_data['amount'] = $service['price_week_end'];
        } else {
            $payment_data['amount'] = $service['price_week'];
        }
        $payment_data['amount'] = str_replace('.', '', $payment_data['amount']);

        // Select language
        $payment_data['language'] = "fr_CH";

        // Compute SHASIGN
        $sha_in = $this->config->item('sha_in');
		$string_to_sha = "ACCEPTURL=" . $payment_data['successurl'] . $sha_in
			. "AMOUNT=" . $payment_data['amount'] . $sha_in
			. "CANCELURL=" . $payment_data['failurl'] . $sha_in
			. "CURRENCY=" . $payment_data['currency'] . $sha_in
			. "DECLINEURL=" . $payment_data['failurl'] . $sha_in
			. "EXCEPTIONURL=" . $payment_data['failurl'] . $sha_in
			. "LANGUAGE=" . $payment_data['language'] . $sha_in
			. "ORDERID=" . $payment_data['orderid'] . $sha_in
			. "PSPID=" . $payment_data['pspid'] . $sha_in;
		$payment_data['shasign'] = sha1($string_to_sha);

        //get the exceptions
        $exceptions = $this->session->flashdata('payment');
         // :: LOAD THE BOOK SUCCESS VIEW
        $view = array(
            'appointment_id'    => $appointment_id,
            'appointment_data'  => $appointment,
            'provider_data'     => $provider,
            'service_data'      => $service,
            'company_name'      => $company_name,
            'payment_data'      => $payment_data,
        );
        if($exceptions){
            $view['exceptions'] = $exceptions;
        }
        $this->load->view('appointments/payment', $view);
    }

	/**
     * GET an specific appointment book and redirect to the success screen.
     *
     * @param int $appointment_id Contains the id of the appointment to retrieve.
     */
    public function post_payment($appointment_id) {
        //if the appointment id doesn't exist or zero redirect to index
        if(!$appointment_id){
            redirect('appointments');
        }

        $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $this->load->model('customers_model');
        $this->load->model('settings_model');

        //retrieve the data needed in the view
        $appointment =  $this->appointments_model->get_row($appointment_id);
        $customer = $this->customers_model->get_row($appointment['id_users_customer']);
        $provider = $this->providers_model->get_row($appointment['id_users_provider']);
        $service = $this->services_model->get_row($appointment['id_services']);
        $company_name = $this->settings_model->get_setting('company_name');
        $company_link = $this->settings_model->get_setting('company_link');
        $company_settings = array(
            'company_name'  => $this->settings_model->get_setting('company_name'),
            'company_link'  => $this->settings_model->get_setting('company_link'),
            'company_email'  => $this->settings_model->get_setting('company_email')
        );

        // Check the SHA-OUT of the server response
        $sha_out = $this->config->item('sha_out');
        $string_to_sha = "NCERROR=" . $_GET['NCERROR'] . $sha_out
            . "ORDERID=" . $_GET['orderID'] . $sha_out
            . "PAYID=" . $_GET['PAYID'] . $sha_out
            . "STATUS=" . $_GET['STATUS'] . $sha_out;

        $sha_sign = strtoupper(sha1($string_to_sha));

        if($sha_sign != $_GET['SHASIGN'] || ($_GET['STATUS'] != 9 && $_GET['STATUS'] != 2)){
            //get the exceptions
            $exceptions = $this->session->flashdata('appointments/book_success');

            // :: LOAD THE PAYMENT FAIL VIEW
            $view = array(
                'appointment_id'    => $appointment_id,
                'appointment_data'  => $appointment,
                'provider_data'     => $provider,
                'service_data'      => $service,
                'company_name'      => $company_name,
                'company_link'      => $company_link,
            );

            if($exceptions){
                $view['exceptions'] = $exceptions;
            }

            $this->load->view('appointments/payment_error', $view);
        } elseif ($_GET['STATUS'] == 2) { // refused
            //get the exceptions
            $exceptions = $this->session->flashdata('appointments/book_success');

            // :: LOAD THE PAYMENT FAIL VIEW
            $view = array(
                'appointment_id'    => $appointment_id,
                'appointment_data'  => $appointment,
                'provider_data'     => $provider,
                'service_data'      => $service,
                'company_name'      => $company_name,
                'company_link'      => $company_link,
            );

            if($exceptions){
                $view['exceptions'] = $exceptions;
            }

            $this->load->view('appointments/payment_fail', $view);
        } else { // STATUS == 9 : accepted

            // Register the appointment as paid
            $appointment['is_paid'] = true;
            $this->appointments_model->add($appointment);

            // :: SEND NOTIFICATION EMAILS TO BOTH CUSTOMER AND PROVIDER
            try {
                $this->load->library('Notifications');

                $customer_title = $this->lang->line('appointment_booked');
                $customer_title_message = $this->lang->line('appointment_payment_confirmed');
                $customer_message = $this->lang->line('thank_you_trust');
                $customer_message_2 = $this->lang->line('please_hour');
                $customer_message_3 = $this->lang->line('cant_wait');
                $customer_link = $this->config->item('base_url')
                    . '/index.php/appointments/index/'
                    . $appointment['hash'];

                $provider_title = $this->lang->line('appointment_added_to_your_plan');
                $provider_message = $this->lang->line('appointment_link_description');
                $provider_link = $this->config->item('base_url') 
                    . '/index.php/backend/index/'
                    . $appointment['hash'];

                $this->notifications->send_appointment_details($appointment, $provider,
                        $service, $customer,$company_settings, $customer_title,
                        $customer_title_message, $customer_message, $customer_message_2, 
                        $customer_message_3, $customer_link, $customer['email']);

                $this->notifications->send_appointment_details($appointment, $provider,
                        $service, $customer, $company_settings, $provider_title,
                        $provider_title, $provider_message, '', '',  $provider_link,
                        $provider['email']);
            } catch(Exception $exc) {
                log_message('error', $exc->getMessage());
                log_message('error', $exc->getTraceAsString());
            }

            //get the exceptions
            $exceptions = $this->session->flashdata('appointments/book_success');

            // :: LOAD THE BOOK SUCCESS VIEW
            $view = array(
                'appointment_id'    => $appointment_id,
                'appointment_data'  => $appointment,
                'provider_data'     => $provider,
                'service_data'      => $service,
                'company_name'      => $company_name,
                'company_link'      => $company_link,
            );
            if($exceptions){
                $view['exceptions'] = $exceptions;
            }
            $this->load->view('appointments/payment_success', $view);
        }
    }

    /**
     * [AJAX] Get the available dates for the given month.
     *
     * This method answers to an AJAX request. It calculates the available dates
     * for thegiven service, provider and month.
     *
     * @param numeric $_POST['service_id'] The selected service's record id.
     * @param numeric|string $_POST['provider_id'] The selected provider's record id, can also be 'any-provider'.
     * @param string $_POST['date'] A date of the month of which the available dates we want to see.
     * @param numeric $_POST['service_duration'] The selected service duration in minutes.
     * @return Returns a json object with the available dates.
     */
    public function ajax_get_available_dates() {
        $date = strtotime($_POST['date']);
        $available_dates = [];

        for($i = 1; $i <= date('t', $date); $i++)
        {
            $_POST['selected_date'] = date($i . '-' . date('m-Y', $date));
            ob_start();
            $this->ajax_get_available_hours();
            $available_hours = ob_get_clean();
            if (strlen($available_hours) >= 3)
            {
                $available_dates[] = $i;
            }
        }
        echo (json_encode($available_dates));
    }

    /**
     * [AJAX] Get the available appointment hours for the given date.
     *
     * This method answers to an AJAX request. It calculates the available hours
     * for thegiven service, provider and date.
     *
     * @param numeric $_POST['service_id'] The selected service's record id.
     * @param numeric|string $_POST['provider_id'] The selected provider's record id, can also be 'any-provider'.
     * @param string $_POST['selected_date'] The selected date of which the available hours we want to see.
     * @param numeric $_POST['service_duration'] The selected service duration in minutes.
     * @return Returns a json object with the available hours.
     */
    public function ajax_get_available_hours() {
        $this->load->model('providers_model');
        $this->load->model('appointments_model');
        $this->load->model('settings_model');

        try {
			// Do not continue if there was no provider selected (more likely there is no provider in the system).
			if (empty($_POST['provider_id'])) {
				echo json_encode(array());
				return;
			}

			// If the user has selected the "any-provider" option then we will need to search
			// for an available provider that will provide the requested service.
			if ($_POST['provider_id'] === ANY_PROVIDER) {
				$_POST['provider_id'] = $this->search_any_provider($_POST['service_id'], $_POST['selected_date']);
				if ($_POST['provider_id'] === NULL) {
					echo json_encode(array());
					return;
				}
			}

			$empty_periods = $this->get_provider_available_time_periods($_POST['provider_id'],
					$_POST['selected_date'], []);

            $available_hours = $this->calculate_available_hours($empty_periods,
                    $_POST['selected_date'],
					$_POST['service_duration']);

            echo json_encode($available_hours);

        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Register the appointment to the database.
     *
     * @return string Returns a JSON string with the appointment database ID.
     */
    public function ajax_register_appointment() {
        try {
            $post_data = $_POST['post_data']; // alias

			$this->load->model('appointments_model');
            $this->load->model('providers_model');
            $this->load->model('services_model');
            $this->load->model('customers_model');
            $this->load->model('settings_model');

            // Check appointment availability.
            if (!$this->check_datetime_availability()) {
                throw new Exception($this->lang->line('requested_hour_is_unavailable'));
            }

            $appointment = $_POST['post_data']['appointment'];
            // Initially, is_paid must be 0.
            $appointment['is_paid'] = 0;
            $customer = $_POST['post_data']['customer'];

            if ($this->customers_model->exists($customer)) {
                $customer['id'] = $this->customers_model->find_record_id($customer);
			}

            $customer_id = $this->customers_model->add($customer);
            $appointment['id_users_customer'] = $customer_id;
			$appointment['is_unavailable'] = (int)$appointment['is_unavailable']; // needs to be type casted
            $appointment['id'] = $this->appointments_model->add($appointment);
            $appointment['hash'] = $this->appointments_model->get_value('hash', $appointment['id']);

            $provider = $this->providers_model->get_row($appointment['id_users_provider']);
            $service = $this->services_model->get_row($appointment['id_services']);

            $company_settings = array(
                'company_name'  => $this->settings_model->get_setting('company_name'),
                'company_link'  => $this->settings_model->get_setting('company_link'),
                'company_email' => $this->settings_model->get_setting('company_email')
            );

            echo json_encode(array(
                    'appointment_id' => $appointment['id']
                ));

        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

	/**
	 * Check whether the provider is still available in the selected appointment date.
	 *
	 * It might be times where two or more customers select the same appointment date and time.
	 * This shouldn't be allowed to happen, so one of the two customers will eventually get the
	 * prefered date and the other one will have to choose for another date. Use this method
	 * just before the customer confirms the appointment details. If the selected date was taken
	 * in the mean time, the customer must be prompted to select another time for his appointment.
	 *
	 * @return bool Returns whether the selected datetime is still available.
	 */
	private function check_datetime_availability() {
		$this->load->model('services_model');

		$appointment  = $_POST['post_data']['appointment'];

		$service_duration = $this->services_model->get_value('duration', $appointment['id_services']);

		$exclude_appointments = (isset($appointment['id'])) ? array($appointment['id']) : array();

		if ($appointment['id_users_provider'] === ANY_PROVIDER) {
			$appointment['id_users_provider'] = $this->search_any_provider($appointment['id_services'],
				date('Y-m-d', strtotime($appointment['start_datetime'])));
			$_POST['post_data']['appointment']['id_users_provider'] = $appointment['id_users_provider'];
			return TRUE; // The selected provider is always available.
		}

		$available_periods = $this->get_provider_available_time_periods(
				$appointment['id_users_provider'], date('Y-m-d', strtotime($appointment['start_datetime'])),
				$exclude_appointments);

		$is_still_available = FALSE;

		foreach($available_periods as $period) {
			$appt_start = new DateTime($appointment['start_datetime']);
			$appt_start = $appt_start->format('H:i');

			$appt_end = new DateTime($appointment['start_datetime']);
			$appt_end->add(new DateInterval('PT' . $service_duration . 'M'));
			$appt_end = $appt_end->format('H:i');

			$period_start = date('H:i', strtotime($period['start']));
			$period_end = date('H:i', strtotime($period['end']));

			if ($period_start <= $appt_start && $period_end >= $appt_end) {
				$is_still_available = TRUE;
				break;
			}
		}

		return $is_still_available;
	}

	/**
	 * Get an array containing the free time periods (start - end) of a selected date.
	 *
	 * This method is very important because there are many cases where the system needs to
	 * know when a provider is avaible for an appointment. This method will return an array
	 * that belongs to the selected date and contains values that have the start and the end
	 * time of an available time period.
	 *
	 * @param numeric $provider_id The provider's record id.
	 * @param string $selected_date The date to be checked (MySQL formatted string).
	 * @param array $exclude_appointments This array contains the ids of the appointments that
	 * will not be taken into consideration when the available time periods are calculated.
	 *
	 * @return array Returns an array with the available time periods of the provider.
	 */
	private function get_provider_available_time_periods($provider_id, $selected_date,
			$exclude_appointments = array()) {
		$this->load->model('appointments_model');
	    $this->load->model('providers_model');

	    // Get the provider's working plan and reserved appointments.
	    $working_plan = json_decode($this->providers_model->get_setting('working_plan', $provider_id), TRUE);

	    $where_clause = array(
	        'id_users_provider' => $provider_id
	    );

	    $reserved_appointments = $this->appointments_model->get_batch($where_clause);

	    // Sometimes it might be necessary to not take into account some appointment records
	    // in order to display what the providers' available time periods would be without them.
	    foreach ($exclude_appointments as $excluded_id) {
	        foreach ($reserved_appointments as $index => $reserved) {
	            if ($reserved['id'] == $excluded_id) {
	                unset($reserved_appointments[$index]);
	            }
	        }
	    }

	    // Find the empty spaces on the plan. The first split between the plan is due to
	    // a break (if exist). After that every reserved appointment is considered to be
	    // a taken space in the plan.
	    $selected_date_working_plan = $working_plan[strtolower(date('l', strtotime($selected_date)))];
	    $available_periods_with_breaks = array();

	    if (isset($selected_date_working_plan['breaks'])) {
	        $start = new DateTime($selected_date_working_plan['start']);
	        $end = new DateTime($selected_date_working_plan['end']);
	        $available_periods_with_breaks[] = array(
	            'start' => $selected_date_working_plan['start'],
	            'end' => $selected_date_working_plan['end']
	        );

	        // Split the working plan to available time periods that do not contain the breaks in them.
	        foreach ($selected_date_working_plan['breaks'] as $index => $break) {
	            $break_start = new DateTime($break['start']);
	            $break_end = new DateTime($break['end']);

				if ($break_start < $start) {
	                $break_start = $start;
				}

	            if ($break_end > $end) {
	                $break_end = $end;
 				}

	            if ($break_start >= $break_end) {
					continue;
				}

	            foreach ($available_periods_with_breaks as $key => $open_period) {
	                $s = new DateTime($open_period['start']);
	                $e = new DateTime($open_period['end']);

	                if ($s < $break_end && $break_start < $e) { // check for overlap
	                    $changed = FALSE;
	                    if ($s < $break_start) {
	                        $open_start = $s;
	                        $open_end = $break_start;
	                        $available_periods_with_breaks[] = array(
	                            'start' => $open_start->format("H:i"),
	                            'end' => $open_end->format("H:i")
	                        );
	                        $changed = TRUE;
	                    }

	                    if ($break_end < $e) {
	                        $open_start = $break_end;
	                        $open_end = $e;
	                        $available_periods_with_breaks[] = array(
	                            'start' => $open_start->format("H:i"),
	                            'end' => $open_end->format("H:i")
	                        );
	                        $changed = TRUE;
	                    }

						if ($changed) {
	                        unset($available_periods_with_breaks[$key]);
	                    }
	                }
	            }
	        }
	    }

	    // Break the empty periods with the reserved appointments.
	    $available_periods_with_appointments = $available_periods_with_breaks;

	    foreach($reserved_appointments as $appointment) {
	        foreach($available_periods_with_appointments as $index => &$period) {
	            $a_start = strtotime($appointment['start_datetime']);
	            $a_end =  strtotime($appointment['end_datetime']);
	            $p_start = strtotime($selected_date .  ' ' . $period['start']);
	            $p_end = strtotime($selected_date .  ' ' .$period['end']);

				if ($a_start <= $p_start && $a_end <= $p_end && $a_end <= $p_start) {
	                // The appointment does not belong in this time period, so we
	                // will not change anything.
	            } else if ($a_start <= $p_start && $a_end <= $p_end && $a_end >= $p_start) {
	                // The appointment starts before the period and finishes somewhere inside.
	                // We will need to break this period and leave the available part.
	                $period['start'] = date('H:i', $a_end);
	            } else if ($a_start >= $p_start && $a_end <= $p_end) {
	                // The appointment is inside the time period, so we will split the period
	                // into two new others.
	                unset($available_periods_with_appointments[$index]);
	                $available_periods_with_appointments[] = array(
	                    'start' => date('H:i', $p_start),
	                    'end' => date('H:i', $a_start)
	                );
	                $available_periods_with_appointments[] = array(
	                    'start' => date('H:i', $a_end),
	                    'end' => date('H:i', $p_end)
	                );
	            } else if ($a_start >= $p_start && $a_end >= $p_start && $a_start <= $p_end) {
	                // The appointment starts in the period and finishes out of it. We will
	                // need to remove the time that is taken from the appointment.
	                $period['end'] = date('H:i', $a_start);
	            } else if ($a_start >= $p_start && $a_end >= $p_end && $a_start >= $p_end) {
	                // The appointment does not belong in the period so do not change anything.
	            } else if ($a_start <= $p_start && $a_end >= $p_end && $a_start <= $p_end) {
	                // The appointment is bigger than the period, so this period needs to be removed.
	                unset($available_periods_with_appointments[$index]);
	            }
	        }
	    }

	    return array_values($available_periods_with_appointments);
	}

	/**
	 * Search for any provider that can handle the requested service.
	 *
	 * This method will return the database ID of the provider with the most available periods.
	 *
	 * @param numeric $service_id The requested service ID.
	 * @param string $selected_date The date to be searched.
	 *
	 * @return int Returns the ID of the provider that can provide the service at the selected date.
	 */
	private function search_any_provider($service_id, $selected_date) {
		$this->load->model('providers_model');
		$this->load->model('services_model');
		$available_providers = $this->providers_model->get_available_providers();
		$service = $this->services_model->get_row($service_id);
		$provider_id = NULL;
		$max_hours_count = 0;

		foreach($available_providers as $provider) {
			foreach($provider['services'] as $provider_service_id) {
				if ($provider_service_id == $service_id) { // Check if the provider is available for the requested date.
					$empty_periods = $this->get_provider_available_time_periods($provider['id'], $selected_date);
					$available_hours = $this->calculate_available_hours($empty_periods, $selected_date, $service['duration']);
					if (count($available_hours) > $max_hours_count) {
						$provider_id = $provider['id'];
						$max_hours_count = count($available_hours);
					}
				}
			}
		}

		return $provider_id;
	}

	/**
	 * Calculate the avaialble appointment hours.
	 *
	 * Calculate the available appointment hours for the given date. The empty spaces
	 * are broken down to 15 min and if the service fit in each quarter then a new
	 * available hour is added to the "$available_hours" array.
	 *
	 * @param array $empty_periods Contains the empty periods as generated by the
	 * "get_provider_available_time_periods" method.
	 * @param string $selected_date The selected date to be search (format )
	 * @param numeric $service_duration The service duration is required for the hour calculation.
	 *
	 * @return array Returns an array with the available hours for the appointment.
	 */
	private function calculate_available_hours(array $empty_periods, $selected_date, $service_duration) {
		$this->load->model('settings_model');

		$available_hours = array();

		foreach ($empty_periods as $period) {
			$start_hour = new DateTime($selected_date . ' ' . $period['start']);
			$end_hour = new DateTime($selected_date . ' ' . $period['end']);

            /*
			$minutes = $start_hour->format('i');

			if ($minutes % 15 != 0) {
				// Change the start hour of the current space in order to be
				// on of the following: 00, 15, 30, 45.
				if ($minutes < 15) {
					$start_hour->setTime($start_hour->format('H'), 15);
				} else if ($minutes < 30) {
					$start_hour->setTime($start_hour->format('H'), 30);
				} else if ($minutes < 45) {
					$start_hour->setTime($start_hour->format('H'), 45);
				} else {
					$start_hour->setTime($start_hour->format('H') + 1, 00);
				}
			}
             */

			$current_hour = $start_hour;
			$diff = $current_hour->diff($end_hour);

			while (($diff->h * 60 + $diff->i) >= intval($service_duration)) {
				$available_hours[] = $current_hour->format('H:i');
                $service_duration_str = "PT" . strval($service_duration) . "M";
				$current_hour->add(new DateInterval($service_duration_str));
				$diff = $current_hour->diff($end_hour);
			}
		}

		// If the selected date is today, remove past hours. It is important  include the timeout before
		// booking that is set in the backoffice the system. Normally we might want the customer to book
		// an appointment that is at least half or one hour from now. The setting is stored in minutes.
		if (date('m/d/Y', strtotime($selected_date)) === date('m/d/Y')) {
			$book_advance_timeout = $this->settings_model->get_setting('book_advance_timeout');

			foreach($available_hours as $index => $value) {
				$available_hour = strtotime($value);
				$current_hour = strtotime('+' . $book_advance_timeout . ' minutes', strtotime('now'));
				if ($available_hour <= $current_hour) {
					unset($available_hours[$index]);
				}
			}
		}

		$available_hours = array_values($available_hours);
		sort($available_hours, SORT_STRING );
		$available_hours = array_values($available_hours);

		return $available_hours;
	}
}

/* End of file appointments.php */
/* Location: ./application/controllers/appointments.php */

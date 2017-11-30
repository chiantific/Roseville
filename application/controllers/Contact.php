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
class Contact extends CI_Controller {
    /**
     * Class Constructor
     */
	public function __construct() {
		parent::__construct();

		$this->load->library('session');
        $this->load->helper('installation');

        // Set user's selected language.
        if (!empty($_GET["lang"])) {
            if ($_GET["lang"] == "en") {
                $this->session->set_userdata('language', 'english');
            } else {
                $this->session->set_userdata('language', 'french');
            }
        }
		if ($this->session->userdata('language')) {
			$this->config->set_item('language', $this->session->userdata('language'));
			$this->lang->load('translations', $this->session->userdata('language'));
		} else {
			$this->lang->load('translations', $this->config->item('language')); // default
		}
	}

    /**
     * [AJAX] Send a message to the admins.
     *
     * This method sends a message to the users registered as admins and returns the success
     * status of the action.
     *
     * @param string $_POST['name'] Name of the user who wrote the message.
     * @param string $_POST['email'] Email of the user who wrote the message.
     * @param string $_POST['message'] Message to send to the admins.
     */
    public function index() {
        // :: SEND EMAIL NOTIFICATION TO COMPANY EMAIL
        try {
            $this->load->model('settings_model');
            $this->load->library('Notifications');

            $company_settings = array(
                'company_name' => $this->settings_model->get_setting('company_name'),
                'company_link' => $this->settings_model->get_setting('company_link'),
                'company_email' => $this->settings_model->get_setting('company_email')
            );
            $this->notifications->send_contact_message($_POST['name'], $_POST['email'], $_POST['message'], $company_settings);

            echo json_encode(AJAX_SUCCESS);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavascript($exc))
            ));
        }
    }
}

/* End of file appointments.php */
/* Location: ./application/controllers/appointments.php */

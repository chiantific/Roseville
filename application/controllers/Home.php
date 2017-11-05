<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home Controller
 *
 * @package Controllers
 */
class Home extends CI_Controller {
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

    public function index() {
        if (!is_ea_installed()) {
            redirect('installation/index');
            return;
        }

        $view['base_url'] = $this->config->item('base_url');
        $this->load->view('home', $view);
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */

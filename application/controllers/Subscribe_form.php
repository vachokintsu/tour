<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribe_form extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model(array('Front_model', 'Front_subscribe_model'));
	}

	public function index()
	{
		return false;
	}

	public function subscribe()
	{
		if(!empty($this->input->post())) {
			if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
				print_r(json_encode('email_false'));
			} else {
				$config = array(
					array(
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'trim|is_unique[subscribers.email]'
					)
				);
				$this->load->library('form_validation');
				$this->form_validation->set_rules($config);
				if($this->form_validation->run() == false) {
					print_r('email_exists');
				} else {
					$response = $this->Front_subscribe_model->subscribe();
					print_r('success');
				}
			}
		}
	}

}
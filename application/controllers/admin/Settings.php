<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model('Settings_ad_model');
	}

	public function index()
	{
		$data['pageTitle'] = 'პარამეტრები';
		$data['error'] = 0;

		if(isset($_POST['change_password'])) {
			$oldpassword = $this->Settings_ad_model->check_old_password();

			$config = array(
				array(
					'field' => 'oldpassword',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[5]'
				),
				array(
					'field' => 'newpassword',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[5]'
				),
				array(
					'field' => 'newpassword2',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[5]|matches[newpassword]'
				)
			);
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == TRUE && $oldpassword) {
				$this->Settings_ad_model->update_password();
				$data['error'] = 2;
				redirect(site_url('admin/login/logout'));
			} else {
				$data['error'] = 1;
			}
		} else if(isset($_POST['change_email'])) {
			$oldpassword = $this->Settings_ad_model->check_old_password();

			$config = array(
				array(
					'field' => 'new_email',
					'label' => 'Email',
					'rules' => 'trim|required|valid_email'
				)
			);
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == TRUE && $oldpassword) {
				$this->Settings_ad_model->update_email();
				$data['error'] = 2;
				redirect(site_url('admin/login/logout'));
			} else {
				$data['error'] = 1;
			}
		}

		$this->load->view('admin/settings', $data);
	}

}
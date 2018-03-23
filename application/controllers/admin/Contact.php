<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Contact_ad_model'));
		$this->pageTitle = 'კონტაქტი';
	}

	public function index($start = 0)
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['contact'] = $this->Contact_ad_model->read();
		if($this->input->post()) {
			$this->Contact_ad_model->update();
			redirect(base_url().'admin/contact');
		}

		$this->load->view('admin/contact/main', $data);
	}

}
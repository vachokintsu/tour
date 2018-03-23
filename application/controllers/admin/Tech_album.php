<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tech_album extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Tech_album_ad_model'));
		$this->pageTitle = 'ტექნიკის ალბომი';
	}

	public function index()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['tech_album'] = $this->Tech_album_ad_model->read();
		if($this->input->post()) {
			$this->Tech_album_ad_model->update();
			redirect(base_url().'admin/tech_album');
		}

		$this->load->view('admin/tech_album', $data);
	}

}
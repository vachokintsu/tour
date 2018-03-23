<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'News_ad_model', 'Subscribers_ad_model', 'Announces_ad_model'));
		$this->pageTitle = 'მთავარი';
	}

	public function index()
	{
		$data['pageTitle'] = $this->pageTitle;

		$data['news_count'] = $this->News_ad_model->data_count('');
		$data['news'] = $this->News_ad_model->read_all('', 5, 0);

		$data['announces_count'] = $this->Announces_ad_model->data_count('');
		$data['announces'] = $this->Announces_ad_model->read_all('', 5, 0);

		$data['subscribers_count'] = $this->Subscribers_ad_model->data_count('');
		$data['subscribers'] = $this->Subscribers_ad_model->read_all('', 5, 0);

		$this->load->view('admin/dashboard', $data);
	}

}
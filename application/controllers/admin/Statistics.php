<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Statistics_ad_model'));
		$this->pageTitle = 'სტატისტიკა';
	}

	public function index()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['parents'] = $this->Statistics_ad_model->read_parents();
		$this->load->view('admin/statistics/manage', $data);
	}

	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();

		$this->load->view('admin/statistics/create', $data);

		if($this->input->post()) {
			$this->Statistics_ad_model->create($data['langs']);
			redirect(base_url().'admin/statistics');
		}
	}

	public function update()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['item'] = $this->Statistics_ad_model->read();

		$this->load->view('admin/statistics/update', $data);

		if($this->input->post()) {
			$this->Statistics_ad_model->update();
			redirect(base_url().'admin/statistics');
		}
	}

	public function update_sorting()
	{
		$data['statistics'] = $this->Statistics_ad_model->update_sorting();
	}

	public function delete()
	{
		$this->Statistics_ad_model->delete();
		redirect(base_url().'admin/statistics');
	}

}
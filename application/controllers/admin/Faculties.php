<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Faculties extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Faculties_ad_model'));
		$this->pageTitle = 'ფაკულტეტები';
	}

	public function index()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['parents'] = $this->Faculties_ad_model->read_parents();
		$this->load->view('admin/faculties/manage', $data);
	}

	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();

		$this->load->view('admin/faculties/create', $data);

		if($this->input->post()) {
			$this->Faculties_ad_model->create($data['langs']);
			redirect(base_url().'admin/faculties');
		}
	}

	public function update()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['item'] = $this->Faculties_ad_model->read();

		$this->load->view('admin/faculties/update', $data);

		if($this->input->post()) {
			$this->Faculties_ad_model->update();
			redirect(base_url().'admin/faculties');
		}
	}

	public function update_sorting()
	{
		$data['news_cats'] = $this->Faculties_ad_model->update_sorting();
	}

	public function delete()
	{
		$this->Faculties_ad_model->delete();
		redirect(base_url().'admin/faculties');
	}

}
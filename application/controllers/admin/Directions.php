<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Directions extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Directions_ad_model'));
		$this->pageTitle = 'მიმართულებები';
	}

	public function index()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['parents'] = $this->Directions_ad_model->read_parents();
		$this->load->view('admin/directions/manage', $data);
	}

	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();

		$this->load->view('admin/directions/create', $data);

		if($this->input->post()) {
			$this->Directions_ad_model->create($data['langs']);
			redirect(base_url().'admin/Directions');
		}
	}

	public function update()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['item'] = $this->Directions_ad_model->read();

		$this->load->view('admin/directions/update', $data);

		if($this->input->post()) {
			$this->Directions_ad_model->update();
			redirect(base_url().'admin/Directions');
		}
	}

	public function update_sorting()
	{
		$data['news_cats'] = $this->Directions_ad_model->update_sorting();
	}

	public function delete()
	{
		$this->Directions_ad_model->delete();
		redirect(base_url().'admin/Directions');
	}

}
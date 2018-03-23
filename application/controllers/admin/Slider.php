<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Slider_ad_model'));
		$this->pageTitle = 'სლაიდერი';
	}

	public function index()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['parents'] = $this->Slider_ad_model->read_parents();
		$this->load->view('admin/slider/manage', $data);
	}

	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();

		$this->load->view('admin/slider/create', $data);

		if($this->input->post()) {
			$this->Slider_ad_model->create($data['langs']);
			redirect(base_url().'admin/slider');
		}
	}

	public function update()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['item'] = $this->Slider_ad_model->read();

		$this->load->view('admin/slider/update', $data);

		if($this->input->post()) {
			$this->Slider_ad_model->update();
			redirect(base_url().'admin/slider');
		}
	}

	public function update_sorting()
	{
		$data['slider'] = $this->Slider_ad_model->update_sorting();
	}

	public function delete()
	{
		$this->Slider_ad_model->delete();
		redirect(base_url().'admin/slider');
	}

}
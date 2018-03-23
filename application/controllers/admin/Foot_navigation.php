<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Foot_navigation extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Foot_navigation_ad_model'));
		$this->pageTitle = 'ქვედა მენიუ';
	}

	public function index()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['parents'] = $this->Foot_navigation_ad_model->read_parents();
		$this->load->view('admin/foot_navigation/manage', $data);
	}

	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();

		$this->load->view('admin/foot_navigation/create', $data);

		if($this->input->post()) {
			$this->Foot_navigation_ad_model->create($data['langs']);
			redirect(base_url().'admin/foot_navigation');
		}
	}

	public function update()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['item'] = $this->Foot_navigation_ad_model->read();

		$this->load->view('admin/foot_navigation/update', $data);

		if($this->input->post()) {
			$this->Foot_navigation_ad_model->update_slugs($data['langs']);
			$this->Foot_navigation_ad_model->update();
			redirect(base_url().'admin/foot_navigation');
		}
	}

	public function update_sorting()
	{
		$data['foot_navigation'] = $this->Foot_navigation_ad_model->update_sorting();
	}

	public function delete()
	{
		$this->Foot_navigation_ad_model->delete();
		redirect(base_url().'admin/foot_navigation');
	}

}
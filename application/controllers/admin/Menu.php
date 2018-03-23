<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Menu_ad_model'));
		$this->pageTitle = 'მენიუ';
	}

	public function index()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['parents'] = $this->Menu_ad_model->read_parents();
		$data['childs'] = $this->Menu_ad_model->read_childs();
		$this->load->view('admin/menu/manage', $data);
	}

	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();

		$this->load->view('admin/menu/create', $data);

		if($this->input->post()) {
			$this->Menu_ad_model->create($data['langs']);
			redirect(base_url().'admin/menu');
		}
	}

	public function update()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['item'] = $this->Menu_ad_model->read();

		$this->load->view('admin/menu/update', $data);

		if($this->input->post()) {
			$this->Menu_ad_model->update_slugs($data['langs']);
			$this->Menu_ad_model->update();
			redirect(base_url().'admin/menu');
		}
	}

	public function update_sorting()
	{
		$data['menu'] = $this->Menu_ad_model->update_sorting();
	}

	public function delete()
	{
		$this->Menu_ad_model->delete();
		redirect(base_url().'admin/menu');
	}

}
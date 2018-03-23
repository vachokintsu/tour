<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Products_ad_model'));
		$this->pageTitle = 'პროდუქცია';
	}

	public function index()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['parents'] = $this->Products_ad_model->read_parents();
		$this->load->view('admin/products/manage', $data);
	}

	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();

		$this->load->view('admin/products/create', $data);

		if($this->input->post()) {
			$this->Products_ad_model->create($data['langs']);
			redirect(base_url().'admin/products');
		}
	}

	public function update()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['item'] = $this->Products_ad_model->read();

		$this->load->view('admin/products/update', $data);

		if($this->input->post()) {
			$this->Products_ad_model->update_slugs($data['langs']);
			$this->Products_ad_model->update();
			redirect(base_url().'admin/products');
		}
	}

	public function update_sorting()
	{
		$data['products'] = $this->Products_ad_model->update_sorting();
	}

	public function delete()
	{
		$this->Products_ad_model->delete();
		redirect(base_url().'admin/products');
	}

}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Fast_links extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Fast_links_ad_model'));
		$this->pageTitle = 'სწრაფი ბმულები';
	}

	public function index($start = 0)
	{
		$data['pageTitle'] = $this->pageTitle;

		$data['fast_links'] = $this->Fast_links_ad_model->read_all();
		$this->load->view('admin/fast_links/manage', $data);
	}

	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();

		$this->load->view('admin/fast_links/create', $data);

		if($this->input->post()) {
			$this->Fast_links_ad_model->create();
			redirect(base_url().'admin/fast_links');
		}
	}

	public function update()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['item'] = $this->Fast_links_ad_model->read();

		$this->load->view('admin/fast_links/update', $data);

		if($this->input->post()) {
			$this->Fast_links_ad_model->update();
			redirect(base_url().'admin/fast_links');
		}
	}

	public function delete()
	{
		$this->Fast_links_ad_model->delete();
		redirect(base_url().'admin/fast_links');
	}

	public function update_sorting()
	{
		$data['fast_links'] = $this->Fast_links_ad_model->update_sorting();
	}

}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Schools extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Schools_ad_model'));
		$this->pageTitle = 'სკოლები და პროგრამები';
	}

	public function index()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['parents'] = $this->Schools_ad_model->read_parents();
		$this->load->view('admin/schools/manage', $data);
	}

	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();

		$this->load->view('admin/schools/create', $data);

		if($this->input->post()) {
			$this->Schools_ad_model->create($data['langs']);
			redirect(base_url().'admin/schools');
		}
	}

	public function update()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['item'] = $this->Schools_ad_model->read();

		$this->load->view('admin/schools/update', $data);

		if($this->input->post()) {
			$this->Schools_ad_model->update_slugs($data['langs']);
			$this->Schools_ad_model->update();
			redirect(base_url().'admin/schools');
		}
	}

	public function update_sorting()
	{
		$data['schools'] = $this->Schools_ad_model->update_sorting();
	}

	public function delete()
	{
		$this->Schools_ad_model->delete();
		redirect(base_url().'admin/schools');
	}

}
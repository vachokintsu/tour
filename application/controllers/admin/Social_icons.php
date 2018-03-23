<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Social_icons extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Social_icons_ad_model'));
		$this->pageTitle = 'სოციალური ქსელები';
	}

	public function index($start = 0)
	{
		$data['pageTitle'] = $this->pageTitle;

		$data['social_icons'] = $this->Social_icons_ad_model->read_all();
		$this->load->view('admin/social_icons/manage', $data);
	}

	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;

		$this->load->view('admin/social_icons/create', $data);

		if($this->input->post()) {
			$this->Social_icons_ad_model->create();
			redirect(base_url().'admin/social_icons');
		}
	}

	public function update()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['item'] = $this->Social_icons_ad_model->read();

		$this->load->view('admin/social_icons/update', $data);

		if($this->input->post()) {
			$this->Social_icons_ad_model->update();
			redirect(base_url().'admin/social_icons');
		}
	}

	public function delete()
	{
		$this->Social_icons_ad_model->delete();
		redirect(base_url().'admin/social_icons');
	}

	public function read_icons()
	{
		$data['icons'] = $this->Social_icons_ad_model->read_icons();
		$this->output->set_content_type('application/json')->set_output(json_encode($data['icons']));
	}

	public function update_sorting()
	{
		$data['social_icons'] = $this->Social_icons_ad_model->update_sorting();
	}

}
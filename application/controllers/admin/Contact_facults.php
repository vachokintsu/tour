<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_facults extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Contact_facults_model'));
		$this->pageTitle = 'კონტაქტი ფაკულტეტებისთვის/დეპრტამენტებისთვის';
	}

	public function index()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['parents'] = $this->Contact_facults_model->read_parents();
		$this->load->view('admin/contact/manage_facult', $data);
	}

	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['facults'] = $this->Contact_facults_model->getFacults();

		$this->load->view('admin/contact/create_facult', $data);

		if($this->input->post()) {
			$this->Contact_facults_model->create($data['langs']);
			redirect(base_url().'admin/contact_facults');
		}
	}

	public function update($id)
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['item'] = $this->Contact_facults_model->read();

		$this->load->view('admin/contact/update_facult', $data);

		if($this->input->post()) {
			$this->Contact_facults_model->update();
			redirect(base_url().'admin/contact_facults/update/'.$id);
		}
	}

	public function update_sorting()
	{
		$data['news_cats'] = $this->Contact_facults_model->update_sorting();
	}

	public function delete()
	{
		$this->Contact_facults_model->delete();
		redirect(base_url().'admin/contact_facults');
	}

}
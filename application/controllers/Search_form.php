<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search_form extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model(array('Front_model', 'Front_search_model'));
	}
	public function index()
	{
		return false;
	}
	public function search()
	{
		if(!empty($this->input->post())) {
			$config = array(
				array(
					'field' => 'search',
					'label' => 'Search',
					'rules' => 'trim|required|min_length[3]|max_length[255]'
				)
			);
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == false) {
				print_r('error');
			} else {
				$data['news'] = $this->Front_search_model->search_news();
				$data['publications'] = $this->Front_search_model->search_publications();
				print_r(json_encode($data));
			}
		}
	}
}
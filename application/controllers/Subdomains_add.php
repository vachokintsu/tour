<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->input->post('domain') == 'science.ciu.ge') { exit(); }
		$this->load->model(array('Configs_ad_model', 'News_ad_model', 'Announces_ad_model'));
	}

	public function news()
	{
		$data['langs'] = $this->Configs_ad_model->langs();

		if($this->input->post()) {
			$this->News_ad_model->create_sub($data['langs']);
		}
	}

	public function announce()
	{
		$data['langs'] = $this->Configs_ad_model->langs();

		if($this->input->post()) {
			$this->Announces_ad_model->create_sub($data['langs']);
		}
	}

}
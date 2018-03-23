<?php defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model(array('Front_model', 'Front_school_model'));
	}

	public function index($slug = null)
	{
		if($slug === null) redirect(base_url());
		$data['data'] = $this->Front_school_model->getBySlug(urldecode($slug));

		if($data['data']['active_'.LANG] != 1)
			redirect($_SERVER['HTTP_REFERER']);
		
		/* STATIC WORDS TRANSLATIONS */
		$data['translate'] = $this->Front_model->translations();
		$data['socials'] = $this->Front_model->socials();
		$data['contact'] = $this->Front_model->contact();
		$data['fast_links'] = $this->Front_model->fast_links();

		/* GOOGLE FORMS */
		$data['google_forms_link'] = $this->Front_model->google_forms_link();

		/* MENU */
		$data['unordered_menu'] = $this->Front_model->menu();

		$data['menu'] = array();

		foreach ($data['unordered_menu'] as $key => $value):
            if ($data['unordered_menu'][$key]['parent'] === '0'):
            	$data['unordered_menu'][$key]['submenu'] = array();
                array_push($data['menu'], $data['unordered_menu'][$key]);
        	endif;
        endforeach;

        foreach ($data['menu'] as $key => $value):
	        foreach ($data['unordered_menu'] as $skey => $svalue):
				if ($data['menu'][$key]['id'] == $data['unordered_menu'][$skey]['parent']):
					array_push($data['menu'][$key]['submenu'], $data['unordered_menu'][$skey]);
				endif;
			endforeach;
		endforeach;

		/* POLL */
		$this->load->helper('cookie');
		$data['poll'] = $this->Front_model->getPoll();
		if(isset($data['poll']['id']) && $data['poll']['id'] == get_cookie('poll'))
			$data['poll'] = [];
			
		$this->load->view('front/school', $data);
	}

}
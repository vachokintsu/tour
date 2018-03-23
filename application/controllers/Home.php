<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model(array('Front_model', 'Front_home_model', 'Front_news_model', 'Front_announcements_model', 'Front_school_model'));
	}

	public function index()
	{
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

		/* SLIDER */
		$data['slider'] = $this->Front_home_model->slider();

		/* NEWS */
		$data['news'] = $this->Front_news_model->home_news(4);
		foreach ($data['news'] as $key => $value):
			$category = $this->Front_news_model->read_cat_by_id($value['category']);
			$data['news'][$key]['categories'] = $category;
		endforeach;
		$data['news_categories'] = $this->Front_news_model->news_categories();
		
		/* SCHOOLS */
		$data['schools'] = $this->Front_school_model->schools();

		/* BANNERS */
		$data['banners'] = $this->Front_home_model->banners();

		/* POLL */
		$this->load->helper('cookie');
		$data['poll'] = $this->Front_model->getPoll();
		if(isset($data['poll']['id']) && $data['poll']['id'] == get_cookie('poll')){
			$data['poll']['answered'] = 1;
		}

		$data['announcements'] = $this->Front_announcements_model->getAnnouncementsLimit(5);
		$this->load->view('front/home', $data);
	}

	public function poll($id,$poll_id = null)
	{
		if(isset($id) && $id != ''){
				$this->Front_model->incrementResponseCount($id);

				$cookie= array(
		           'name'   => 'poll',
		           'value'  => $poll_id,
		           'expire' => 3600 * 24 * 3,
		       );
	 
		       $this->input->set_cookie($cookie);
					echo 1;
		}
		else
			echo 0;
	}

}
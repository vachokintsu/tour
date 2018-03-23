<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Announcements extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model(array('Front_model', 'Front_home_model', 'Front_announcements_model', 'Front_news_model'));
	}

	public function index($slug = null)
	{
		if($slug !== null)
			$data['data'] = $this->Front_announcements_model->getBySlug(urldecode($slug));
		else
			$data['data'] = $this->Front_announcements_model->getLast();


		if($data['data']['slug_'.LANG] != urldecode($slug)) {
			redirect(site_url('/announcements/index/'.$data['data']['slug_'.LANG].'?lang='.LANG));
		}


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

		/* NEWS */
		$data['latest_news'] = $this->Front_news_model->home_news(4);
		foreach ($data['latest_news'] as $key => $value):
			$category = $this->Front_news_model->read_cat_by_id($value['category']);
			$data['latest_news'][$key]['categories'] = $category;
		endforeach;

		/* POLL */
		$this->load->helper('cookie');
		$data['poll'] = $this->Front_model->getPoll();
		if(isset($data['poll']['id']) && $data['poll']['id'] == get_cookie('poll'))
			$data['poll'] = [];
		
		$data['announcements'] = $this->Front_announcements_model->getAnnouncements();

		$this->load->view('front/announcements', $data);
	}

	public function data()
	{		
			$result = $this->Front_announcements_model->getAnnouncements();

			foreach ($result as $value) {
				$sr["date"] = date("Y-m-d", strtotime($value["start_date"]));
				$sr["title"] = $value["title_".LANG];
				$sr["url"] = 'announcements/index/'.$value["slug_".LANG];
				$data[0][] = $sr;
			}

			$data[1] = LANG;
			echo json_encode($data);
	}



}
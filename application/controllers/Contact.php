<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('Front_model','Front_contact_model'));
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

		$data['error'] = 0;
		if(isset($_POST['sendMail'])) {
			if($this->recaptcha($this->input->post('g-recaptcha-response')) === true) {
				$this->load->helper("security");
				$this->load->library('email');
				$email = $this->security->xss_clean($this->input->POST('email'));
				$subject = $this->security->xss_clean($this->input->POST('subject'));
				$message = $this->security->xss_clean($this->input->POST('message'));
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$data['error'] = 1;

					$config = array(
					    'mailtype'  => 'html',
					    'charset'   => 'utf-8'
					);
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from($email);
					$this->email->to('info@stunet.ge');
					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->send();
				} else {
					$data['error'] = 2;
				}
			} else {
				$data['error'] = 2;
			}
		}

		$data['contact'] = $this->Front_contact_model->getInfo(); 

		/* POLL */
		$this->load->helper('cookie');
		$data['poll'] = $this->Front_model->getPoll();
		if(isset($data['poll']['id']) && $data['poll']['id'] == get_cookie('poll'))
			$data['poll'] = [];

		$this->load->view('front/contact', $data);
	}

	public function recaptcha($str = '')
	{
		$google_url = "https://www.google.com/recaptcha/api/siteverify";
		$secret = '6LdkLA8UAAAAAAzQ_AEJel9m1kR7HlLH48SdSEut';
		$ip = $_SERVER['REMOTE_ADDR'];
		$url = $google_url."?secret=".$secret."&response=".$str."&remoteip=".$ip;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
		$res = curl_exec($curl);
		curl_close($curl);
		$res = json_decode($res, true);
		//reCaptcha success check
		if($res['success']) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
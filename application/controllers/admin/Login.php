<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Login_ad_model');
	}

	public function index()
	{
		if($this->session->userdata('email')){redirect(base_url('admin/dashboard'));}

		$data['error'] = 0;
		if($this->input->post()) {
			$config = array(
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'trim|required|valid_email'
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[5]'
				)
			);
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == false) {
				$data['error'] = 1;
			} else {
				$user = $this->Login_ad_model->login();
				if (!$user) {
					$data['error'] = 1;
				} else {
					$email = $user['email'];
					$this->session->set_userdata('email', $email);
					redirect(base_url().'admin/dashboard');
				}
			}
		}
		if($this->session->userdata('email')){
			redirect(base_url('admin/login/redirect_user'));
		} else {
			$this->load->view('admin/login', $data);
		}
	}

	public function redirect_user()
	{
		redirect(base_url().'admin/main');
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->sess_destroy();
		redirect(base_url().'admin/login');
	}

	public function password_reset()
	{
		$data['error'] = 0;
		$data['success'] = 0;

		$checkResetHash = $this->Login_ad_model->check_reset_hash();
		if(!$checkResetHash) {
			redirect(base_url().'admin/login');
		}

		$password_reset_hash_url = $this->uri->segment(4);
		if (strlen($password_reset_hash_url) == 10) {
			$data['success'] = 1;
			$data['password_reset_hash_url'] = $password_reset_hash_url;
		}

		if (isset($_POST['resetPassword'])) {
			$email = $this->input->post("email");
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailExist = $this->Login_ad_model->check_email();

				if ($emailExist) {
					$password_reset_hash = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

					$this->load->library('email');
					$config = array(
					   	'protocol' => 'smtp',
					    'smtp_host' => 'mx1.hostinger.com',
					    'smtp_port' => '587',
						'smtp_crypto' => 'tls',
					    'smtp_user' => 'info@seradmin.indygo.ge',
					    'smtp_pass' => 'Seradmin123;',
					    'mailtype'  => 'html',
					    'charset'   => 'utf-8'
					);
					$this->email->initialize($config);

					$this->email->from("info@seradmin.indygo.ge");
					$this->email->to($email);
					$this->email->set_newline("\r\n");
					$this->email->subject("Password reset");
					$this->email->message("გამარჯობა, თქვენ მოითხოვეთ პაროლის აღდგენა. <a href='".base_url()."admin/login/password_reset/".$password_reset_hash."'>მიყევით ბმულს</a>");
					$this->email->send();

					$this->Login_ad_model->password_reset_hash($email, $password_reset_hash);

					$data['error'] = 2;
				} else {
					$data['error'] = 1;
				}
			} else {
				$data['error'] = 1;
			}
		} else if(isset($_POST['resetNewPassword'])) {
			$config = array(
				array(
					'field' => 'newpassword',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[5]'
				),
				array(
					'field' => 'newpassword2',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[5]|matches[newpassword]'
				)
			);
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == TRUE) {
				$this->Login_ad_model->reset_password();
				$data['error'] = 2;
			} else {
				$data['error'] = 1;
			}
		}

		$this->load->view('admin/password_reset', $data);
	}

}
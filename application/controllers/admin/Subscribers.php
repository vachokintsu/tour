<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Subscribers_ad_model');
		$this->pageTitle = 'გამომწერები';
	}

	public function index($start = 0)
	{
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$data['pageTitle'] = $this->pageTitle;
		$this->load->library('pagination');
		// search
		if(isset($_GET['search'])) {
			$search = trim($this->input->get('search'));
		} else {
			$search = '';
		}
		$config['base_url'] = base_url().'admin/subscribers/index/';
		$config['reuse_query_string'] = TRUE;
		$config['total_rows'] = $this->Subscribers_ad_model->data_count($search);
		$config['uri_segment'] = 4;
		$config['per_page'] = 10;
		$config['num_links'] = 2;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="paginate_button active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['first_link'] = 'პირველი';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'ბოლო';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'შემდეგი';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = 'წინა';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		$data['pages'] = $this->pagination->create_links();
		$data['subscribers'] = $this->Subscribers_ad_model->read_all($search, 10, $start);
		$data['all_subscribers'] = $this->Subscribers_ad_model->read_all_nolimit();
		$data['cats'] = $this->Subscribers_ad_model->read_cats();

		$data['template'] = $this->Subscribers_ad_model->read_template();
		if(isset($_POST['send'])) {
			$this->Subscribers_ad_model->update_template();

			$message = $this->input->post('template');

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
			
			foreach ($data['all_subscribers'] as $row) {
				$category = json_decode($this->input->post('category'), True);
				if($category === null || $row['category'] == $category['id']) {
					$this->email->clear();

					$this->email->to($row['email']);
					$this->email->from($this->config->item('smtp_host'));
					$this->email->subject("სიახლე");
					$this->email->set_newline("\r\n");
					$this->email->message($message.
						"<div style='margin-top: 20px;'>
		                    <p>აღარ გსურთ ჩვენგან შეტყობინებების მიღება?
		                        <a href='".site_url('unsubscribe/'.$row['email_hash'])."'>
		                            <u><unsubscribe>გამოწერის გაუქმება</unsubscribe></u>
		                        </a>
		                    </p>
		                </div>"
					);
					$this->email->send();
				}
			}
			redirect(current_url());
		}
		$this->load->view('admin/subscribers', $data);
	}

	public function delete()
	{
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->Subscribers_ad_model->delete();
		redirect(base_url().'admin/subscribers');
	}

	public function unsubscribe()
	{
		$response = $this->Subscribers_ad_model->unsubscribe();
		echo "სიახლეების მიღება გაუქმებულია!";
		header("refresh:2; url=http://ciu.edu.ge");
	}

}
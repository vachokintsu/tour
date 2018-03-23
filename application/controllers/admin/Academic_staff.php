 <?php defined('BASEPATH') OR exit('No direct script access allowed');

class Academic_staff extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Academic_staff_ad_model', 'Subscribers_ad_model'));
		$this->pageTitle = 'აკადემიური პერსონალი';
	}

	public function index($start = 0)
	{
		$data['pageTitle'] = $this->pageTitle;
		$this->load->library('pagination');
		// search
		if(isset($_GET['search'])) {
			$search = trim($this->input->get('search'));
		} else {
			$search = '';
		}
		$config['base_url'] = base_url().'admin/academic_staff/index/';
		$config['reuse_query_string'] = TRUE;
		$config['total_rows'] = $this->Academic_staff_ad_model->data_count($search);
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
		$data['news'] = $this->Academic_staff_ad_model->read_all($search, 10, $start);

		$this->load->view('admin/academic_staff/manage', $data);
	}

	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		
		$data['faculties'] = $this->Academic_staff_ad_model->getFaculties();
		$data['directions'] = $this->Academic_staff_ad_model->getDirections();


		$this->load->view('admin/academic_staff/create', $data);

		if($this->input->post()) {
			$this->Academic_staff_ad_model->create($data['langs']);

			redirect(base_url().'admin/academic_staff');
		}
	}

	public function update($id)
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();

		$data['faculties'] = $this->Academic_staff_ad_model->getFaculties();
		$data['directions'] = $this->Academic_staff_ad_model->getDirections();

		$data['item'] = $this->Academic_staff_ad_model->read();

		$this->load->view('admin/academic_staff/update', $data);

		if($this->input->post()) {
			$this->Academic_staff_ad_model->update();
			redirect(base_url().'admin/academic_staff/update/'.$id);
		}
	}

	public function delete()
	{
		$this->Academic_staff_ad_model->delete();
		redirect(base_url().'admin/academic_staff');
	}

}
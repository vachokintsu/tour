<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Poll extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model(array('Configs_ad_model', 'Poll_model' , 'Export_ad_model'));
		$this->pageTitle = 'გამოკითხვა';
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
		$config['base_url'] = base_url().'admin/poll/index/';
		$config['reuse_query_string'] = TRUE;
		$config['total_rows'] = $this->Poll_model->data_count($search);
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
		$data['news'] = $this->Poll_model->read_all($search, 10, $start);
		$this->load->view('admin/poll/read', $data);
	}

	public function answers($id)
	{
		$poll = $this->Poll_model->pollById($id);

		$data['pageTitle'] = $this->pageTitle . ' - ' . $poll['title_ge'];
		$data['poll_id'] = $id;
		$data['parents'] = $this->Poll_model->read_parents($id);

		//$data['langs'] = $this->Configs_ad_model->langs();

		$this->load->view('admin/poll/answers', $data);

	}


	public function create()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();

		$this->load->view('admin/poll/create', $data);

		if($this->input->post()) {
			$this->Poll_model->create($data['langs']);
			redirect(base_url().'admin/poll');
		}
	}

	public function create_item($poll_id)
	{
		$poll = $this->Poll_model->pollById($poll_id);

		$data['pageTitle'] = $this->pageTitle . ' - ' . $poll['title_ge'];

		$data['langs'] = $this->Configs_ad_model->langs();

		$this->load->view('admin/poll/create_item', $data);

		if($this->input->post()) {
			$this->Poll_model->create_item($data['langs'], $poll_id);
			redirect(base_url().'admin/poll/answers/'.$poll_id);
		}
	}

	public function update()
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['item'] = $this->Poll_model->read();

		$this->load->view('admin/poll/update', $data);

		if($this->input->post()) {
			$this->Poll_model->update();
			redirect(base_url().'admin/poll');
		}
	}

	public function update_item($poll_id)
	{
		$data['pageTitle'] = $this->pageTitle;
		$data['langs'] = $this->Configs_ad_model->langs();
		$data['item'] = $this->Poll_model->pollItemById();

		$this->load->view('admin/poll/update_item', $data);

		if($this->input->post()) {
			$this->Poll_model->update_item();
			redirect(base_url().'admin/poll/answers/'.$poll_id);
		}
	}

	public function delete()
	{
		$this->Poll_model->delete();
		redirect(base_url().'admin/poll');
	}

	public function delete_item($poll_id)
	{
		$this->Poll_model->delete_item();
		redirect(base_url().'admin/poll/answers/'.$poll_id);
	}

	public function update_sorting()
	{
		$data['answers'] = $this->Poll_model->update_sorting();
	}

	public function export($poll_id)
	{

		$data = $this->Poll_model->getData();

		$fields = $this->Poll_model->listFields();

		$question = $this->Poll_model->pollById($poll_id);

		$fields_ge = ['პასუხები', 'ხმები'];
			$this->load->library('Excel');
			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
			$objPHPExcel->setActiveSheetIndex(0);

	        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, $question['title_ge']);
			
			$col = 0;
	        foreach ($fields_ge as $field):
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 2, $field);
	            $col++;
	        endforeach;

			$i = 3; 
			foreach($data as $row):

				$col = 0;
				foreach($fields as $field):
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $i, strip_tags($row[$field]));
					$col++;
				endforeach;

				$i++;
			endforeach;

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="asd.xlsx"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');

	}

}
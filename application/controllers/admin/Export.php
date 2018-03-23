<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('email')) {redirect(base_url('admin/login'));}
		$this->load->model('Export_ad_model');
		$this->pageTitle = 'ექსპორტი';
	}

	public function index()
	{
		$data['pageTitle'] = $this->pageTitle;

		$this->load->view('admin/export', $data);
	}

	public function listFields()
	{
		$data['fields'] = $this->Export_ad_model->listFields();
		print_r(json_encode($data['fields']));
	}

	public function getData()
	{
		$data = $this->Export_ad_model->getData();

		if(count($this->input->post('fields[]')) > 0) {
			$fields = $this->input->post('fields[]');
		} else {
			$fields = $this->Export_ad_model->listFields();
		}

		if(isset($_POST['excel'])) {
			$this->load->library('Excel');
			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
			$objPHPExcel->setActiveSheetIndex(0);

			$col = 0;
	        foreach ($fields as $field):
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
	            $col++;
	        endforeach;

			$i = 2; 
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
			header('Content-Disposition: attachment;filename="'.$this->input->post('table').'.xlsx"');
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
			exit;
		}

		redirect(site_url('admin/export'));
	}

}
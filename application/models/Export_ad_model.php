<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Export_ad_model extends CI_Model {

	public function getData() {
		$table = $this->input->post('table');
		if(count($this->input->post('fields[]')) > 0) {
			$fields = implode(',', $this->input->post('fields[]'));
		} else {
			$fields = '*';
		}
		$limit = $this->input->post('limit');

		$this->db->select($fields);
		$this->db->from($table);
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function listFields() {
		$table = $this->input->post('table');
		return $this->db->list_fields($table);
	}

}
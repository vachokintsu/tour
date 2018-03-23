<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Translations_model extends CI_Model {

	public function read_all($search, $num, $start) {
		$this->db->select('id, word_ge');
		$this->db->from('translations');
		$this->db->like('word_ge', $search);
		$this->db->order_by('id', 'desc');
		$this->db->limit($num, $start);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function data_count($search) {
		$this->db->from('translations');
		$this->db->like('word_ge', $search);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function read() {
		$id = $this->uri->segment(4);

		$this->db->select('*');
		$this->db->from('translations');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function create($langs) {


		$this->db->insert('translations',
			array(
				'word_ge' => $this->input->post('word_ge'),
				'word_en' => $this->input->post('word_en'),
				'word_ru' => $this->input->post('word_ru'),
				'word_fa' => $this->input->post('word_fa')
			)
		);
		return $this->db->insert_id();
	}


	public function update() {
		$id = $this->uri->segment(4);
		if(strlen($this->input->post('date')) > 0) {
			$date = $this->input->post('date');
		} else {
			$date = date('Y-m-d');
		}

        $this->db->where(array('id' => $id));
		$this->db->update('translations',
			array(
				'word_ge' => $this->input->post('word_ge'),
				'word_en' => $this->input->post('word_en'),
				'word_ru' => $this->input->post('word_ru'),
				'word_fa' => $this->input->post('word_fa')
			)
		);
	}

	public function delete() {
		$id = $this->uri->segment(4);

		$this->db->where('id', $id);
		$this->db->delete('translations');
	}

}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Poll_model extends CI_Model {

	public function read_all($search, $num, $start) {
		$this->db->select('id, title_ge, start_date, end_date, max_responses');
		$this->db->from('poll');
		$this->db->like('title_ge', $search);
		$this->db->order_by('id', 'desc');
		$this->db->limit($num, $start);
		$query = $this->db->get();
		$data = $query->result_array();
		foreach ($data as $key => $value) {
			$data[$key]['response_count'] = $this->response_count($value['id']);
		}
		return $data;
	}

	public function data_count($search) {
		$this->db->from('poll');
		$this->db->like('title_ge', $search);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function response_count($poll_id){
		$this->db->select_sum('response_count');
		$this->db->from('poll_items');
		$this->db->where('poll_id', $poll_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['response_count'];
	}

	public function pollById($poll_id) {
		$this->db->select('*');
		$this->db->from('poll');
		$this->db->where('id', $poll_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function pollItemById() {
		$id = $this->uri->segment(5);

		$this->db->select('*');
		$this->db->from('poll_items');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function read() {
		$id = $this->uri->segment(4);

		$this->db->select('*');
		$this->db->from('poll');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function read_parents($poll_id) {
		$this->db->select('id, title_ge, response_count, sort');
		$this->db->from('poll_items');
		$this->db->where('poll_id', $poll_id);
		$this->db->order_by('sort', 'ASC');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function create($langs) {

		if(strlen($this->input->post('start_date')) > 0) {
			$start_date = $this->input->post('start_date');
		} else {
			$start_date = date('Y-m-d');
		}

		$this->db->insert('poll',
			array(

				'title_ge' => $this->input->post('title_ge'),
				'title_en' => $this->input->post('title_en'),
				'title_ru' => $this->input->post('title_ru'),

				'active_ge' => $this->input->post('active_ge'),
				'active_en' => $this->input->post('active_en'),
				'active_ru' => $this->input->post('active_ru'),

				'start_date' => $start_date,
				'end_date' => ( ($this->input->post('end_date') > 0) ? $this->input->post('end_date') : Null ),
				'max_responses' => $this->input->post('max_responses')
			)
		);
		return $this->db->insert_id();
	}

	public function create_item($langs, $poll_id) {

		$this->db->insert('poll_items',
			array(

				'title_ge' => $this->input->post('title_ge'),
				'title_en' => $this->input->post('title_en'),
				'title_ru' => $this->input->post('title_ru'),
				'poll_id' => $poll_id
			)
		);
		return $this->db->insert_id();
	}


	public function update() {
		$id = $this->uri->segment(4);
		if(strlen($this->input->post('date')) > 0) {
			$start_date = $this->input->post('date');
		} else {
			$start_date = date('Y-m-d');
		}

        $this->db->where(array('id' => $id));
		$this->db->update('poll',
			array(
				'title_ge' => $this->input->post('title_ge'),
				'title_en' => $this->input->post('title_en'),
				'title_ru' => $this->input->post('title_ru'),

				'active_ge' => $this->input->post('active_ge'),
				'active_en' => $this->input->post('active_en'),
				'active_ru' => $this->input->post('active_ru'),

				'start_date' => $start_date,
				'end_date' => ( (strlen($this->input->post('end_date')) > 0) ? $this->input->post('end_date') : Null ),
				'max_responses' => $this->input->post('max_responses')
			)
		);
	}

	public function update_item() {
		$id = $this->uri->segment(5);

        $this->db->where(array('id' => $id));
		$this->db->update('poll_items',
			array(
				'title_ge' => $this->input->post('title_ge'),
				'title_en' => $this->input->post('title_en'),
				'title_ru' => $this->input->post('title_ru')
			)
		);
	}

	public function delete() {
		$id = $this->uri->segment(4);

		$this->db->where('id', $id);
		$this->db->delete('poll');
	}

	public function delete_item() {
		$id = $this->uri->segment(5);

		$this->db->where('id', $id);
		$this->db->delete('poll_items');
	}



	public function update_sorting() {
		$answers_data = $this->input->get('answers');

		foreach ($answers_data as $key) {
			$this->db->where(array('id' => $key['id']));
			$this->db->update('poll_items',
				array(
					'sort' => $key['number']
				)
			);
		}
	}

	public function getData() {
		$table = 'poll_items';

		$limit = 10;

		$this->db->select('title_ge, response_count');
		$this->db->from($table);
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function listFields() {
		$table = 'poll_items';
		$fields = $this->db->list_fields($table);
		$fields = ['title_ge','response_count'];
		return $fields;
	}

}
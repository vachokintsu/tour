<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Directions_ad_model extends CI_Model {

	public function read_parents() {
		$this->db->select('id, title_ge, sort');
		$this->db->from('directions');
		$this->db->order_by('sort', 'ASC');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function read() {
		$id = $this->uri->segment(4);

		$this->db->select('*');
		$this->db->from('directions');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function create() {

		$this->db->insert('directions',
			array(
				'title_ge' => $this->input->post('title_ge'),
				'title_en' => $this->input->post('title_en'),
				'title_ru' => $this->input->post('title_ru'),
				'title_fa' => $this->input->post('title_fa'),

				'active_ge' => $this->input->post('active_ge'),
				'active_en' => $this->input->post('active_en'),
				'active_ru' => $this->input->post('active_ru'),
				'active_fa' => $this->input->post('active_fa')
			)
		);
		return $this->db->insert_id();
	}

	public function update() {
		$id = $this->uri->segment(4);
        $this->db->where(array('id' => $id));
		$this->db->update('directions',
			array(
				'title_ge' => $this->input->post('title_ge'),
				'title_en' => $this->input->post('title_en'),
				'title_ru' => $this->input->post('title_ru'),
				'title_fa' => $this->input->post('title_fa'),

				'active_ge' => $this->input->post('active_ge'),
				'active_en' => $this->input->post('active_en'),
				'active_ru' => $this->input->post('active_ru'),
				'active_fa' => $this->input->post('active_fa')
			)
		);
	}

	public function update_sorting() {
		$directions_data = $this->input->get('directions');

		foreach ($directions_data as $key) {
			$this->db->where(array('id' => $key['id']));
			$this->db->update('directions',
				array(
					'sort' => $key['number']
				)
			);
		}
	}

	public function delete() {
		$id = $this->uri->segment(4);

		$this->db->where('id', $id);
		$this->db->delete('directions');
	}

}
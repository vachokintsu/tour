<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Fast_links_ad_model extends CI_Model {

	public function read_all() {
		$this->db->select('id, title_ge, active_ge');
		$this->db->from('fast_links');
		$this->db->order_by('sort', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function read() {
		$id = $this->uri->segment(4);

		$this->db->select('*');
		$this->db->from('fast_links');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function create() {
		$this->db->insert('fast_links',
			array(
				'title_ru' => $this->input->post('title_ru'),
				'title_en' => $this->input->post('title_en'),
				'title_ge' => $this->input->post('title_ge'),
				'title_fa' => $this->input->post('title_fa'),
				'target_ru' => $this->input->post('target_ru'),
				'target_en' => $this->input->post('target_en'),
				'target_fa' => $this->input->post('target_fa'),
				'target_ge' => $this->input->post('target_ge'),
				'active_ru' => $this->input->post('active_ru'),
				'active_en' => $this->input->post('active_en'),
				'active_fa' => $this->input->post('active_fa'),
				'active_ge' => $this->input->post('active_ge'),
				'link_ru' => $this->input->post('link_ru'),
				'link_en' => $this->input->post('link_en'),
				'link_fa' => $this->input->post('link_fa'),
				'link_ge' => $this->input->post('link_ge')
			)
		);
		return $this->db->insert_id();
	}

	public function update() {
		$id = $this->uri->segment(4);

		$this->db->where( array('id' => $id ));
		$this->db->update('fast_links',
			array(
				'title_ru' => $this->input->post('title_ru'),
				'title_en' => $this->input->post('title_en'),
				'title_ge' => $this->input->post('title_ge'),
				'title_fa' => $this->input->post('title_fa'),
				'target_ru' => $this->input->post('target_ru'),
				'target_en' => $this->input->post('target_en'),
				'target_fa' => $this->input->post('target_fa'),
				'target_ge' => $this->input->post('target_ge'),
				'active_ru' => $this->input->post('active_ru'),
				'active_en' => $this->input->post('active_en'),
				'active_fa' => $this->input->post('active_fa'),
				'active_ge' => $this->input->post('active_ge'),
				'link_ru' => $this->input->post('link_ru'),
				'link_en' => $this->input->post('link_en'),
				'link_fa' => $this->input->post('link_fa'),
				'link_ge' => $this->input->post('link_ge')
			)
		);
	}

	public function delete() {
		$id = $this->uri->segment(4);

		$this->db->where('id', $id);
		$this->db->delete('fast_links');
	}

	public function update_sorting() {
		$fast_links_data = $this->input->get('fast_links');

		foreach ($fast_links_data as $key) {
			$this->db->where(array('id' => $key['id']));
			$this->db->update('fast_links',
				array(
					'sort' => $key['number']
				)
			);
		}
	}

}
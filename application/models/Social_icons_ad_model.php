<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Social_icons_ad_model extends CI_Model {

	public function read_all() {
		$this->db->select('id, title, icon, active');
		$this->db->from('social_icons');
		$this->db->order_by('sort', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function read() {
		$id = $this->uri->segment(4);

		$this->db->select('*');
		$this->db->from('social_icons');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function create() {
		$this->db->insert('social_icons',
			array(
				'title' => $this->input->post('title'),
				'link' => $this->input->post('link'),
				'icon' => $this->input->post('icon'),
				'target' => $this->input->post('target'),
				'active' => $this->input->post('active')
			)
		);
		return $this->db->insert_id();
	}

	public function update() {
		$id = $this->uri->segment(4);

		$this->db->where( array('id' => $id ));
		$this->db->update('social_icons',
			array(
				'title' => $this->input->post('title'),
				'link' => $this->input->post('link'),
				'icon' => $this->input->post('icon'),
				'target' => $this->input->post('target'),
				'active' => $this->input->post('active')
			)
		);
	}

	public function delete() {
		$id = $this->uri->segment(4);

		$this->db->where('id', $id);
		$this->db->delete('social_icons');
	}

	public function read_icons() {
		$this->db->select('data');
		$this->db->from('font_awesome_icons');
		$this->db->where('id', 1);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_sorting() {
		$social_icons_data = $this->input->get('social_icons');

		foreach ($social_icons_data as $key) {
			$this->db->where(array('id' => $key['id']));
			$this->db->update('social_icons',
				array(
					'sort' => $key['number']
				)
			);
		}
	}

}
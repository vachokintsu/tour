<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers_ad_model extends CI_Model {

	public function read_all($search, $num, $start) {
		$this->db->select('id, fullname, email, email_hash, category');
		$this->db->from('subscribers');
		$this->db->like('fullname', $search);
		$this->db->or_like('email', $search);
		$this->db->order_by('id', 'desc');
		$this->db->limit($num, $start);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function data_count($search) {
		$this->db->from('subscribers');
		$this->db->like('fullname', $search);
		$this->db->or_like('email', $search);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function read_all_nolimit() {
		$this->db->select('id, fullname, email, email_hash, category');
		$this->db->from('subscribers');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function delete() {
		$id = $this->uri->segment(4);

		$this->db->where('id', $id);
		$this->db->delete('subscribers');
	}

	public function unsubscribe() {
		$email_hash = $this->uri->segment(2);

		$this->db->where('email_hash', $email_hash);
		$this->db->delete('subscribers');
	}

	public function read_template() {
		$this->db->select('id, template');
		$this->db->from('subscribe_template');
		$this->db->where('id', 1);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_template() {
		$this->db->where(array('id' => 1));
		$this->db->update('subscribe_template',
			array(
				'template' => $this->input->post('template')
			)
		);
	}

	public function read_cats() {
		$this->db->select('id, title_ge, sort');
		$this->db->from('news_cats');
		$this->db->order_by('sort', 'ASC');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

}
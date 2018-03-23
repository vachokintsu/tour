<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_search_model extends CI_Model {
	public function search_news() {
		$this->db->select(
						'slug_'.$this->input->post('lang').
						', title_'.$this->input->post('lang'));
		$this->db->like('title_'.$this->input->post('lang'), trim($this->input->post('search')), 'both');
		$this->db->from('news');
		$this->db->order_by('date', 'DESC');
		$this->db->where('active_'.$this->input->post('lang'), 1);
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function search_publications() {
		$this->db->select(
						'slug_'.$this->input->post('lang').
						', title_'.$this->input->post('lang'));
		$this->db->like('title_'.$this->input->post('lang'), trim($this->input->post('search')), 'both');
		$this->db->from('publications');
		$this->db->order_by('date', 'DESC');
		$this->db->where('active_'.$this->input->post('lang'), 1);
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array();
	}
}
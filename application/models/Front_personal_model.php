<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_personal_model extends CI_Model {

	public function filter() {
		$this->db->select('id, title_'.$this->input->post('lang').', fname_'.$this->input->post('lang').', rank_'.$this->input->post('lang').', image');
		$this->db->from('academic_staff');
		$this->db->where('active_'.$this->input->post('lang'), 1);

		if(!empty($this->input->post('personalFilterRank'))):
			$this->db->where('direction_id', $this->input->post('personalFilterRank'));
		endif;

		if(!empty($this->input->post('personalFilterFaculty'))):
			$this->db->where('facult_id', $this->input->post('personalFilterFaculty'));
		endif;
		
		if(!empty($this->input->post('personalSearchFilter'))):
			$this->db->like('title_'.$this->input->post('lang'), $this->input->post('personalSearchFilter'));
			$this->db->or_like('fname_'.$this->input->post('lang'), $this->input->post('personalSearchFilter'));
		endif;

		$this->db->order_by('id', 'DESC');
		$this->db->limit(15, $this->input->post('personalOffset'));
		$query = $this->db->get();
		return $query->result_array();
	}

	public function faculties() {
		$this->db->select('*');
		$this->db->from('faculties');
		$this->db->where('active_'.LANG, 1);
		$this->db->order_by('sort', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function directions() {
		$this->db->select('*');
		$this->db->from('directions');
		$this->db->where('active_'.LANG, 1);
		$this->db->order_by('sort', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getById() {
		$this->db->select(
				'active_'.LANG.
				', title_'.LANG.
				', fname_'.LANG.
				', rank_'.LANG.
				', cabinet_'.LANG.
				', cv_'.LANG.
				', id, image, email, phone, facebook, linkedin, facult_id, 	direction_id'
			);
		$this->db->from('academic_staff');
		$this->db->where('active_'.LANG, 1);
		$this->db->where('id', $this->uri->segment(3));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getPubsById() {
		$this->db->select('*');
		$this->db->from('publications');
		$this->db->where('active_'.LANG, 1);
		$this->db->like('lector', $this->uri->segment(3), 'both');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getLectorsByPubsId($id) {
		$this->db->select('title_'.LANG.', fname_'.LANG);
		$this->db->from('academic_staff');
		$this->db->where('active_'.LANG, 1);
		$this->db->like('id', $id, 'both');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getFacultiesByPubsId($id) {
		$this->db->select('title_'.LANG);
		$this->db->from('faculties');
		$this->db->where('active_'.LANG, 1);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getNewsById() {
		$this->db->select('slug_'.LANG.', title_'.LANG.', category, date');
		$this->db->from('news');
		$this->db->like('lector', $this->uri->segment(3), 'both');
		$this->db->where('active_'.LANG, 1);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function read_cat_by_id($ids) {
		if($this->input->post('lang')) {
			$language = $this->input->post('lang');
		} else {
			$language = LANG;
		}
		$this->db->select('id, color, title_'.$language.', active_'.$language);
		$this->db->from('news_cats');
		$ids = explode(',', $ids);
		foreach($ids as $id):
			$this->db->or_where('id', $id);
		endforeach;
		$query = $this->db->get();
		return $query->result_array();
	}

}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_school_model extends CI_Model {

	/* PAGE DATA */
	public function schools() {
		$this->db->select('*');
		$this->db->from('schools');
		$this->db->where('active_'.LANG, 1);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getBySlug($slug){
		$this->db->select('*');
		$this->db->from('schools');
		$this->db->where('id',$slug);
		$query = $this->db->get();
		return $query->row_array();;
	}

}
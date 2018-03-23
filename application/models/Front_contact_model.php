<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_contact_model extends CI_Model {

	public function getInfo() {
		$this->db->select('*');
		$this->db->from('contact');
		$this->db->where('id',1);
		$query = $this->db->get();
		$data =  $query->row_array();
		return $data;
	}

}
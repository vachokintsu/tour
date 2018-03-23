<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Configs_ad_model extends CI_Model {

	public function langs() {
		$this->db->select('id, title, code');
		$this->db->from('languages');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

}
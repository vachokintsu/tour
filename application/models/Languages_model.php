<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Languages_model extends CI_Model {

	public function checkLang($code) {
		$this->db->select('*');
		$this->db->from('languages');
		$this->db->where("code",$code);
		$query = $this->db->get();
		$result = $query->result_array();
		if(empty($result))
			return false;
		return true;
	}

}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_professor_model extends CI_Model {

	public function get_professor($langs) {
		$this->db->select('*');
		$this->db->from('menu');
		/*foreach($langs as $lang):
			$this->db->or_where('slug_'.$lang['code'], urldecode($this->uri->segment(3)));
		endforeach;*/
		$query = $this->db->get();
		return $query->row_array();
	}

}
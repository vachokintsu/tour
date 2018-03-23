<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_page_model extends CI_Model {

	/* PAGE DATA */
	public function get_page_data($langs) {
		$this->db->select('*');
		$this->db->from('menu');
		/*foreach($langs as $lang):
			$this->db->or_where('slug_'.$lang['code'], urldecode($this->uri->segment(3)));
		endforeach;*/
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getBySlug($slug){
		$this->db->select('*');
		$this->db->from('menu');
		$this->db->where('slug_ge',$slug);
		$this->db->or_where('slug_en',$slug);
		$this->db->or_where('slug_ru',$slug);
		$this->db->or_where('slug_fa',$slug);
		$query = $this->db->get();
		return $query->row_array();;
	}

}
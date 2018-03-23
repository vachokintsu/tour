<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_home_model extends CI_Model {

	/* SLIDER */
	public function slider() {
		$this->db->select(
						'title_'.LANG.
						', link_'.LANG.
						', target_'.LANG.
						', active_'.LANG.
						', image, video, sort');
		$this->db->from('slider');
		$this->db->order_by('sort', 'ASC');
		$this->db->where('active_'.LANG, 1);
		$this->db->limit('5');
		$query = $this->db->get();
		return $query->result_array();
	}

	/* PARTNERS */
	public function banners() {
		$this->db->select(
						'title_'.LANG.
						', active_'.LANG.
						', link, image, target');
		$this->db->from('banners');
		$this->db->order_by('id', 'DESC');
		$this->db->where('active_'.LANG, 1);
		$query = $this->db->get();
		return $query->result_array();
	}

}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_announcements_model extends CI_Model {

	public function getAnnouncements() {
		$this->db->select("*");
		$this->db->from('announces');
		$this->db->order_by('start_date', 'DESC');
		$this->db->where('active_'.LANG, 1);
		$this->db->where('end_date >', date('Y-m-d H:i:s'));
		$this->db->or_where('start_date >', date('Y-m-d H:i:s'));
		$query = $this->db->get();
		return $query->result_array();
	}


	public function getLast()
	{
		$this->db->select("*");
		$this->db->from('announces');
		$this->db->order_by('start_date', 'DESC');
		$this->db->where('active_'.LANG, 1);
		$this->db->where('end_date >', date('Y-m-d H:i:s'));
		$this->db->or_where('start_date >', date('Y-m-d H:i:s'));
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getAnnouncementsLimit($limit) {
		$this->db->select("*");
		$this->db->from('announces');
		$this->db->order_by('start_date', 'DESC');
		$this->db->where('active_'.LANG, 1);
		$this->db->where('end_date >', date('Y-m-d H:i:s'));
		$this->db->or_where('start_date >', date('Y-m-d H:i:s'));
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result_array();
	}


	public function getBySlug($slug){
		$this->db->select('*');
		$this->db->from('announces');
		$this->db->where('slug_ge',$slug);
		$this->db->or_where('slug_en',$slug);
		$this->db->or_where('slug_ru',$slug);
		$this->db->or_where('slug_fa',$slug);
		$query = $this->db->get();
		$data = $query->row_array();

		return $data;
	}

}
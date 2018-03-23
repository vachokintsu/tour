<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_model extends CI_Model {

	/* LANGUAGES */
	public function langs() {
		$this->db->select('*');
		$this->db->from('languages');
		$query = $this->db->get();
		return $query->result_array();
	}

	/* STATIC WORDS TRANSLATIONS */
	public function translations() {
		$this->db->select('*');
		$this->db->from('translations');
		$query = $this->db->get();
		$query = $query->result_array();
		$query = array_column($query, 'word_'.LANG, 'name');
		return $query;
	}

	/* GOOGLE FORMS LINK */
	public function google_forms_link() {
		$this->db->select('*');
		$this->db->from('google_forms');
		$this->db->where('active_'.LANG, 1);
		$this->db->where('show_in_header', 1);
		$query = $this->db->get();
		return $query->row_array();
	}

	/* MAIN MENU */
	public function menu() {
		$this->db->select(
						'slug_'.LANG.
						', title_'.LANG.
						', type_'.LANG.
						', link_'.LANG.
						', target_'.LANG.
						', active_'.LANG.
						', id, sort, parent');
		$this->db->from('menu');
		$this->db->order_by('sort', 'ASC');
		$this->db->where('active_'.LANG, 1);
		$query = $this->db->get();
		return $query->result_array();
	}

	/* CONTACT */
	public function contact() {
		$this->db->select('*');
		$this->db->from('contact');
		$this->db->where('id', 1);
		$query = $this->db->get();
		return $query->row_array();
	}

	/* SOCIALS */
	public function socials() {
		$this->db->select('*');
		$this->db->from('social_icons');
		$this->db->where('active', 1);
		$this->db->order_by('sort', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	/* FAST LINKS */
	public function fast_links() {
		$this->db->select('*');
		$this->db->from('fast_links');
		$this->db->where('active_'.LANG, 1);
		$this->db->order_by('sort', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	/* POLL */
	public function getPoll()
	{
		$this->db->select("*");
		$this->db->from("poll");
		$this->db->where("active_".LANG,1);
		$this->db->limit(1);
		$this->db->order_by("start_date","DESC");
		$query = $this->db->get();
		$data = $query->row_array();
		$data["items"] = $this->getPollItems($data["id"]);
		$response_sum = 0;
		foreach ($data["items"] as $value) {
			$response_sum += $value["response_count"];
		}
		$data["response_sum"] = $response_sum;
		return $data;
	}

	public function getPollItems($poll_id)
	{
		$this->db->select("*");
		$this->db->from("poll_items");
		$this->db->where("poll_id",$poll_id);
		$this->db->order_by("sort");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function incrementResponseCount($id)
	{
		$this->db->where('id', $id);
		$this->db->set('response_count', 'response_count+1', FALSE);
		$this->db->update('poll_items');
	}

}
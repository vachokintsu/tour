<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Academic_staff_ad_model extends CI_Model {

	public function read_all($search, $num, $start) {
		$this->db->select('*');
		$this->db->from('academic_staff');
		$this->db->like('title_ge', $search);
		$this->db->or_like('fname_ge', $search);
		$this->db->order_by('id', 'desc');
		$this->db->limit($num, $start);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function data_count($search) {
		$this->db->from('academic_staff');
		$this->db->like('title_ge', $search);
		$this->db->or_like('fname_ge', $search);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function read() {
		$id = $this->uri->segment(4);

		$this->db->select('*');
		$this->db->from('academic_staff');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function create($langs) {
		$email = implode(',', $this->input->post('email[]'));
		$phone = implode(',', $this->input->post('phone[]'));

		$this->db->insert('academic_staff',
			array(
				'title_ge' => $this->input->post('title_ge'),
				'title_en' => $this->input->post('title_en'),
				'title_ru' => $this->input->post('title_ru'),
				'title_fa' => $this->input->post('title_fa'),

				'fname_ge' => $this->input->post('fname_ge'),
				'fname_en' => $this->input->post('fname_en'),
				'fname_ru' => $this->input->post('fname_ru'),
				'fname_fa' => $this->input->post('fname_fa'),
				
				'rank_ge' => $this->input->post('rank_ge'),
				'rank_en' => $this->input->post('rank_en'),
				'rank_ru' => $this->input->post('rank_ru'),
				'rank_fa' => $this->input->post('rank_fa'),
				
				'cabinet_ge' => $this->input->post('cabinet_ge'),
				'cabinet_en' => $this->input->post('cabinet_en'),
				'cabinet_ru' => $this->input->post('cabinet_ru'),
				'cabinet_fa' => $this->input->post('cabinet_fa'),
				
				'cv_ge' => $this->input->post('cv_ge'),
				'cv_en' => $this->input->post('cv_en'),
				'cv_ru' => $this->input->post('cv_ru'),
				'cv_fa' => $this->input->post('cv_fa'),

				'active_ge' => $this->input->post('active_ge'),
				'active_en' => $this->input->post('active_en'),
				'active_ru' => $this->input->post('active_ru'),
				'active_fa' => $this->input->post('active_fa'),

				'facult_id' => $this->input->post('facult'),
				'direction_id' => $this->input->post('direction'),
				'facebook' => $this->input->post('facebook'),
				'linkedin' => $this->input->post('linkedin'),
				'image' => $this->input->post('image'),
				'email' => $email,
				'phone' => $phone
			)
		);
		return $this->db->insert_id();
	}


	public function update() {
		$id = $this->uri->segment(4);
		$email = implode(',', $this->input->post('email[]'));
		$phone = implode(',', $this->input->post('phone[]'));

        $this->db->where(array('id' => $id));
		$this->db->update('academic_staff',
			array(
				'title_ge' => $this->input->post('title_ge'),
				'title_en' => $this->input->post('title_en'),
				'title_ru' => $this->input->post('title_ru'),
				'title_fa' => $this->input->post('title_fa'),

				'fname_ge' => $this->input->post('fname_ge'),
				'fname_en' => $this->input->post('fname_en'),
				'fname_ru' => $this->input->post('fname_ru'),
				'fname_fa' => $this->input->post('fname_fa'),
				
				'rank_ge' => $this->input->post('rank_ge'),
				'rank_en' => $this->input->post('rank_en'),
				'rank_ru' => $this->input->post('rank_ru'),
				'rank_fa' => $this->input->post('rank_fa'),
				
				'cabinet_ge' => $this->input->post('cabinet_ge'),
				'cabinet_en' => $this->input->post('cabinet_en'),
				'cabinet_ru' => $this->input->post('cabinet_ru'),
				'cabinet_fa' => $this->input->post('cabinet_fa'),
				
				'cv_ge' => $this->input->post('cv_ge'),
				'cv_en' => $this->input->post('cv_en'),
				'cv_ru' => $this->input->post('cv_ru'),
				'cv_fa' => $this->input->post('cv_fa'),

				'active_ge' => $this->input->post('active_ge'),
				'active_en' => $this->input->post('active_en'),
				'active_ru' => $this->input->post('active_ru'),
				'active_fa' => $this->input->post('active_fa'),

				'facult_id' => $this->input->post('facult'),
				'direction_id' => $this->input->post('direction'),
				'facebook' => $this->input->post('facebook'),
				'linkedin' => $this->input->post('linkedin'),
				'image' => $this->input->post('image'),
				'email' => $email,
				'phone' => $phone
			)
		);
	}

	public function getFaculties()
	{		
		$this->db->select('*');
		$this->db->from('faculties');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getDirections()
	{
		$this->db->select('*');
		$this->db->from('directions');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function delete() {
		$id = $this->uri->segment(4);

		$this->db->where('id', $id);
		$this->db->delete('academic_staff');
	}

}
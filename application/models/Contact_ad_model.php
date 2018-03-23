<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_ad_model extends CI_Model {

	public function read() {
		$this->db->select('*');
		$this->db->from('contact');
		$this->db->where('id', 1);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update() {
		$email = implode(',', $this->input->post('email[]'));
		$phone = implode(',', $this->input->post('phone[]'));

		$this->db->where('id', 1);
		$this->db->update('contact',
			array(
				'address_ge' => $this->input->post('address_ge'),
				'address_en' => $this->input->post('address_en'),
				'address_ru' => $this->input->post('address_ru'),
				'address_fa' => $this->input->post('address_fa'),
				'email' => $email,
				'phone' => $phone
			)
		);
	}

}
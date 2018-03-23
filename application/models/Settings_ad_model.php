<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_ad_model extends CI_Model {

	public function update_email() {
		$current_email = $this->session->userdata('email');
		$new_email = $this->input->post('new_email');

		$this->db->where('email', $current_email);
		$this->db->set('email', $new_email);
		$this->db->update('users');
	}

	public function update_password() {
		$email = $this->session->userdata('email');
		$password = hash('sha256', $this->input->post("newpassword") . SALT);

		$this->db->where('email', $email);
		$this->db->set('password', $password);
		$this->db->update('users');
	}

	public function check_old_password() {
		$email = $this->session->userdata('email');
		$oldpassword = hash('sha256', $this->input->post("oldpassword") . SALT);

		$this->db->where('email', $email);
		$this->db->where('password', $oldpassword);
		$query = $this->db->get('users');
		if($query->num_rows() > 0) {
        	return true;
		} else {
        	return false;
		}
	}

}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_ad_model extends CI_Model {

	public function login() {
		$email = $this->input->post('email');
		$password = hash('sha256', $this->input->post('password') . SALT);

		$this->db->select('email');
		$this->db->from('users');
		$this->db->where(array('email' => $email, 'password' => $password));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function check_email() {
		$email = $this->input->post('email');

		$this->db->where('email', $email);
		$query = $this->db->get('users');
		if($query->num_rows() > 0) {
        	return true;
		} else {
        	return false;
		}
	}

	public function password_reset_hash($email, $password_reset_hash) {
		$this->db->set('password_reset_hash', $password_reset_hash);
		$this->db->where('email', $email);
		$this->db->update('users');
	}

	public function check_reset_hash() {
		$password_reset_hash_url = $this->uri->segment(4);

		$this->db->where('password_reset_hash', $password_reset_hash_url);
		$query = $this->db->get('users');
		if($query->num_rows() > 0) {
        	return true;
		} else {
        	return false;
		}
	}

	public function reset_password() {
		$password_reset_hash_url = $this->uri->segment(4);
		$password = hash('sha256', $this->input->post("newpassword") . SALT);

		$this->db->set('password', $password);
		$this->db->set('password_reset_hash', null);
		$this->db->where('password_reset_hash', $password_reset_hash_url);
		$this->db->update('users');
	}

}
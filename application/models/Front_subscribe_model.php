<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_subscribe_model extends CI_Model {

	public function subscribe() {
		$this->db->insert('subscribers',
			array(
				'email' => $this->input->post('email'),
				'category' => implode(',', $this->input->post('categories')),
				'email_hash' => hash('sha256', $this->input->post('email') . SALT)
			)
		);
	}

}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_facults_model extends CI_Model {

	public function read_parents() {
		$this->db->select('*');
		$this->db->from('contact_facults');
		$this->db->order_by('sort', 'ASC');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		$data = $query->result_array();
		foreach ($data as $key => $value) {
			$data[$key]['facult'] = $this->getFacult($value['facult_id']);
		}
		
		return $data;
	}

	public function getFacults(){
		$this->db->from('menu');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function getFacult($id){
		$this->db->from('menu');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result_array();
		if( empty($result) ) return 'wrong';
		return $result[0]['title_ge'];
	}

	public function read() {
		$id = $this->uri->segment(4);

		$this->db->select('*');
		$this->db->from('contact_facults');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function create() {
		$email = implode(',', $this->input->post('email[]'));
		$phone = implode(',', $this->input->post('phone[]'));

		$this->db->insert('contact_facults',
			array(

				'address_ge' => $this->input->post('address_ge'),
				'address_en' => $this->input->post('address_en'),
				'address_ru' => $this->input->post('address_ru'),

				'email' => $email,
				'fax' => $this->input->post('fax'),
				'phone' => $phone,
				'facult_id' => $this->input->post('facult')

			)
		);
		return $this->db->insert_id();
	}


	public function update() {
		$email = implode(',', $this->input->post('email[]'));
		$phone = implode(',', $this->input->post('phone[]'));

		$id = $this->uri->segment(4);
        $this->db->where(array('id' => $id));
		$this->db->update('contact_facults',
			array(
				'address_ge' => $this->input->post('address_ge'),
				'address_en' => $this->input->post('address_en'),
				'address_ru' => $this->input->post('address_ru'),

				'active_ge' => $this->input->post('active_ge'),
				'active_en' => $this->input->post('active_en'),
				'active_ru' => $this->input->post('active_ru'),

				'email' => $email,
				'fax' => $this->input->post('fax'),
				'phone' => $phone,
			)
		);
	}

	public function update_sorting() {
		$contact_facults_data = $this->input->get('contact_facults');

		foreach ($contact_facults_data as $key) {
			$this->db->where(array('id' => $key['id']));
			$this->db->update('contact_facults',
				array(
					'sort' => $key['number']
				)
			);
		}
	}

	public function delete() {
		$id = $this->uri->segment(4);

		$this->db->where('id', $id);
		$this->db->delete('contact_facults');
	}

}
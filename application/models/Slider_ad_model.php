<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_ad_model extends CI_Model {

	public function read_parents() {
		$this->db->select('id, title_ge, image, sort');
		$this->db->from('slider');
		$this->db->order_by('sort', 'ASC');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function read() {
		$id = $this->uri->segment(4);

		$this->db->select('*');
		$this->db->from('slider');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function create() {
		$this->db->insert('slider',
			array(
				'title_ge' => $this->input->post('title_ge'),
				'title_en' => $this->input->post('title_en'),
				'title_ru' => $this->input->post('title_ru'),
				'title_fa' => $this->input->post('title_fa'),
				
				'link_ge' => $this->input->post('link_ge'),
				'link_en' => $this->input->post('link_en'),
				'link_ru' => $this->input->post('link_ru'),
				'link_fa' => $this->input->post('link_fa'),

				'target_ge' => $this->input->post('target_ge'),
				'target_en' => $this->input->post('target_en'),
				'target_ru' => $this->input->post('target_ru'),
				'target_fa' => $this->input->post('target_fa'),

				'descr_en' => $this->input->post('descr_en'),
				'descr_ge' => $this->input->post('descr_ge'),
				'descr_ru' => $this->input->post('descr_ru'),
				'descr_fa' => $this->input->post('descr_fa'),

				'active_ge' => $this->input->post('active_ge'),
				'active_en' => $this->input->post('active_en'),
				'active_ru' => $this->input->post('active_ru'),
				'active_fa' => $this->input->post('active_fa'),

				'image' => $this->input->post('image'),
				'video' => $this->input->post('video')
			)
		);
		return $this->db->insert_id();
	}

	public function update() {
		$id = $this->uri->segment(4);
        $this->db->where(array('id' => $id));
		$this->db->update('slider',
			array(
				'title_ge' => $this->input->post('title_ge'),
				'title_en' => $this->input->post('title_en'),
				'title_ru' => $this->input->post('title_ru'),
				'title_fa' => $this->input->post('title_fa'),
				
				'link_ge' => $this->input->post('link_ge'),
				'link_en' => $this->input->post('link_en'),
				'link_ru' => $this->input->post('link_ru'),
				'link_fa' => $this->input->post('link_fa'),

				'target_ge' => $this->input->post('target_ge'),
				'target_en' => $this->input->post('target_en'),
				'target_ru' => $this->input->post('target_ru'),
				'target_fa' => $this->input->post('target_fa'),

				'descr_en' => $this->input->post('descr_en'),
				'descr_ge' => $this->input->post('descr_ge'),
				'descr_ru' => $this->input->post('descr_ru'),
				'descr_fa' => $this->input->post('descr_fa'),

				'active_ge' => $this->input->post('active_ge'),
				'active_en' => $this->input->post('active_en'),
				'active_ru' => $this->input->post('active_ru'),
				'active_fa' => $this->input->post('active_fa'),

				'image' => $this->input->post('image'),
				'video' => $this->input->post('video')
			)
		);
	}

	public function update_sorting() {
		$slider_data = $this->input->get('slider');

		foreach ($slider_data as $key) {
			$this->db->where(array('id' => $key['id']));
			$this->db->update('slider',
				array(
					'sort' => $key['number']
				)
			);
		}
	}

	public function delete() {
		$id = $this->uri->segment(4);

		$this->db->where('id', $id);
		$this->db->delete('slider');
	}

}
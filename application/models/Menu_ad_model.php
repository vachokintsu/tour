<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_ad_model extends CI_Model {

	public function read_parents() {
		$this->db->select('id, title_ge, sort, parent');
		$this->db->from('menu');
		$this->db->order_by('sort', 'ASC');
		$this->db->where('parent', 0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function read_childs() {
		$this->db->select('id, title_ge, parent');
		$this->db->from('menu');
		$this->db->order_by('sort', 'ASC');
		$this->db->where('parent !=', 0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function read() {
		$id = $this->uri->segment(4);

		$this->db->select('*');
		$this->db->from('menu');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function create($langs) {
		$slug_ge = url_title($this->input->post('title_ge'), 'dash');
		$slug_en = url_title($this->input->post('title_en'), 'dash');
		$slug_ru = url_title($this->input->post('title_ru'), 'dash');
		$slug_fa = url_title($this->input->post('title_fa'), 'dash');

        foreach ($langs as $lang) {
			$unique = true;
        	$i = 1;
        	while ($unique) {
            	$this->db->select('slug_'.$lang['code']);
	            $this->db->from('menu');
	            $this->db->where('slug_'.$lang['code'], ${'slug_'.$lang['code']});
	            $query = $this->db->get();
	            if($query->num_rows() == 0) {
	                $unique = false;
	            } else {
	                ${'slug_'.$lang['code']} = ${'slug_'.$lang['code']}.'-'.$i;
	            }
	            $i++;
	        }
        }

		$this->db->insert('menu',
			array(
				'slug_ge' => $slug_ge,
				'slug_en' => $slug_en,
				'slug_ru' => $slug_ru,
				'slug_fa' => $slug_fa,

				'title_ge' => $this->input->post('title_ge'),
				'title_en' => $this->input->post('title_en'),
				'title_ru' => $this->input->post('title_ru'),
				'title_fa' => $this->input->post('title_fa'),

				'type_ge' => $this->input->post('type_ge'),
				'type_en' => $this->input->post('type_en'),
				'type_ru' => $this->input->post('type_ru'),
				'type_fa' => $this->input->post('type_fa'),

				'link_ge' => $this->input->post('link_ge'),
				'link_en' => $this->input->post('link_en'),
				'link_ru' => $this->input->post('link_ru'),
				'link_fa' => $this->input->post('link_fa'),

				'target_ge' => $this->input->post('target_ge'),
				'target_en' => $this->input->post('target_en'),
				'target_ru' => $this->input->post('target_ru'),
				'target_fa' => $this->input->post('target_fa'),

				'descr_ge' => $this->input->post('descr_ge'),
				'descr_en' => $this->input->post('descr_en'),
				'descr_ru' => $this->input->post('descr_ru'),
				'descr_fa' => $this->input->post('descr_fa'),
				
				'text_ge' => $this->input->post('text_ge'),
				'text_en' => $this->input->post('text_en'),
				'text_ru' => $this->input->post('text_ru'),
				'text_fa' => $this->input->post('text_fa'),

				'active_ge' => $this->input->post('active_ge'),
				'active_en' => $this->input->post('active_en'),
				'active_ru' => $this->input->post('active_ru'),
				'active_fa' => $this->input->post('active_fa')
			)
		);
		return $this->db->insert_id();
	}

	public function update_slugs($langs) {
		$old_slugs = $this->read();
		$old_slug_ge = $old_slugs['slug_ge'];
		$old_slug_en = $old_slugs['slug_en'];
		$old_slug_ru = $old_slugs['slug_ru'];
		$old_slug_fa = $old_slugs['slug_fa'];

		$slug_ge = url_title($this->input->post('title_ge'), 'dash');
		$slug_en = url_title($this->input->post('title_en'), 'dash');
		$slug_ru = url_title($this->input->post('title_ru'), 'dash');
		$slug_fa = url_title($this->input->post('title_fa'), 'dash');

		foreach ($langs as $lang) {
			$unique = true;
        	$i = 1;
        	while ($unique) {
        		if(${'old_slug_'.$lang['code']} != ${'slug_'.$lang['code']}) {
	            	$this->db->select('slug_'.$lang['code']);
		            $this->db->from('menu');
		            $this->db->where('slug_'.$lang['code'], ${'slug_'.$lang['code']});
		            $query = $this->db->get();
		            if($query->num_rows() == 0) {
		                $unique = false;
		            } else {
		                ${'slug_'.$lang['code']} = ${'slug_'.$lang['code']}.'-'.$i;
		            }
		        } else {
		        	$unique = false;
		        }
	            $i++;
	        }
        }

		$id = $this->uri->segment(4);
		$this->db->where(array('id' => $id));
        $this->db->update('menu',
			array(
				'slug_ge' => $slug_ge,
				'slug_en' => $slug_en,
				'slug_ru' => $slug_ru,
				'slug_fa' => $slug_fa
			)
		);
	}

	public function update() {
		$id = $this->uri->segment(4);
        $this->db->where(array('id' => $id));
		$this->db->update('menu',
			array(
				'title_ge' => $this->input->post('title_ge'),
				'title_en' => $this->input->post('title_en'),
				'title_ru' => $this->input->post('title_ru'),
				'title_fa' => $this->input->post('title_fa'),

				'type_ge' => $this->input->post('type_ge'),
				'type_en' => $this->input->post('type_en'),
				'type_ru' => $this->input->post('type_ru'),
				'type_fa' => $this->input->post('type_fa'),

				'link_ge' => $this->input->post('link_ge'),
				'link_en' => $this->input->post('link_en'),
				'link_ru' => $this->input->post('link_ru'),
				'link_fa' => $this->input->post('link_fa'),

				'target_ge' => $this->input->post('target_ge'),
				'target_en' => $this->input->post('target_en'),
				'target_ru' => $this->input->post('target_ru'),
				'target_fa' => $this->input->post('target_fa'),

				'descr_ge' => $this->input->post('descr_ge'),
				'descr_en' => $this->input->post('descr_en'),
				'descr_ru' => $this->input->post('descr_ru'),
				'descr_fa' => $this->input->post('descr_fa'),
				
				'text_ge' => $this->input->post('text_ge'),
				'text_en' => $this->input->post('text_en'),
				'text_ru' => $this->input->post('text_ru'),
				'text_fa' => $this->input->post('text_fa'),

				'active_ge' => $this->input->post('active_ge'),
				'active_en' => $this->input->post('active_en'),
				'active_ru' => $this->input->post('active_ru'),
				'active_fa' => $this->input->post('active_fa')
			)
		);
	}

	public function update_sorting() {
		$menu_data = $this->input->get('menu');

		foreach ($menu_data as $key) {
			$this->db->where(array('id' => $key['id']));
			$this->db->update('menu',
				array(
					'sort' => $key['number'],
					'parent' => $key['parent']
				)
			);
		}
	}

	public function delete() {
		$id = $this->uri->segment(4);

		$this->db->where('id', $id);
		$this->db->delete('menu');
	}

}
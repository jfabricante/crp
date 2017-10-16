<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function browse(array $params = array('type' => 'object'))
	{
		$query = $this->db->get('positions_tbl');

		if ($params['type'] == 'object')
		{
			return $query->result();
		}

		return $query->result_array();
	}

	public function store($params)
	{
		$id = $this->input->post('id') ? $this->input->post('id') : 0;

		if ($id > 0)
		{
			$this->db->update('positions_tbl', $params, array('id' => $id));
		}
		else
		{
			$this->db->insert('positions_tbl', $params);
		}

		return $this;	
	}

	public function read(array $params = array('type' => 'object'))
	{
		if ($params['id'] > 0)
		{
			$query = $this->db->get_where('positions_tbl', array('id' => $params['id']));

			if ($params['type'] == 'object')
			{
				return $query->row();
			}
			
			return $query->row_array();
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');

		$this->db->delete('positions_tbl', array('id' => $id));

		return $this;
	}

}
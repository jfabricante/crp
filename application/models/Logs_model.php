<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function browse(array $params = array('type' => 'object'))
	{
		$fields = array(
				'a.id',
				'a.login',
				'a.logout',
				'b.fullname',
				'c.user_type',
				'd.name AS branch',
			);

		$query = $this->db->select($fields)
				->from('logs_tbl AS a')
				->join('users_tbl AS b', 'a.user_id = b.id', 'INNER')
				->join('roles_tbl AS c', 'b.role_id = c.id', 'INNER')
				->join('branches_tbl AS d', 'b.branch_id = d.id', 'LEFT')
				->where('a.logout IS NOT NULL')
				->get();

		if ($params['type'] == 'object')
		{
			return $query->result();
		}

		return $query->result_array();
	}

	// Return logs id
	public function store($params)
	{
		$id = $this->session->userdata('logs_id') ? $this->session->userdata('logs_id') : 0;

		if ($id > 0)
		{
			$this->db->update('logs_tbl', $params, array('id' => $id));
		}
		else
		{
			$this->db->insert('logs_tbl', $params);
			$id = $this->db->insert_id();
		}

		return $id;	
	}

	public function read(array $params = array('type' => 'object'))
	{
		if ($params['id'] > 0)
		{
			$query = $this->db->get_where('logs_tbl', array('id' => $params['id']));

			if ($params['type'] == 'object')
			{
				return $query->row();
			}
			
			return $query->row_array();
		}
	}

}
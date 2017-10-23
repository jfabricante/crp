<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function browse(array $params = array('type' => 'object'))
	{
		$fields = array(
				'a.id',
				'a.purpose',
				'a.justification',
				'a.permission',
				'a.datetime',
				'b.doc_name',
				'c.fullname',
			);

		// Build query
		if ($this->session->userdata('user_type') == 'Administrator')
		{
			$query = $this->db->select($fields)
					->from('requests_tbl AS a')
					->join('docs_tbl AS b', 'a.doc_id = b.id', 'INNER')
					->join('users_tbl AS c', 'a.user_id = c.id', 'INNER')
					->join('approved_requests_tbl AS d', 'a.id = d.request_id', 'LEFT')
					->where('request_id IS NULL')
					->get();
		}
		else
		{
			$query = $this->db->select($fields)
					->from('requests_tbl AS a')
					->join('docs_tbl AS b', 'a.doc_id = b.id', 'INNER')
					->join('users_tbl AS c', 'a.user_id = c.id', 'INNER')
					->join('approved_requests_tbl AS d', 'a.id = d.request_id', 'LEFT')
					->where('request_id IS NULL')
					->where('a.user_id', $this->session->userdata('id'))
					->get();
		}

		if ($params['type'] == 'object')
		{
			return $query->result();
		}

		return $query->result_array();
	}

	public function fetchApprovedList(array $params = array('type' => 'object'))
	{
		$fields = array(
				'a.id',
				'a.purpose',
				'a.justification',
				'a.permission',
				'b.doc_name',
				'c.fullname',
				'd.datetime',
				'd.id AS a_id',
				'e.fullname AS approver',
			);

		// Build query
		if ($this->session->userdata('user_type') == 'Administrator')
		{
			$query = $this->db->select($fields)
					->from('requests_tbl AS a')
					->join('docs_tbl AS b', 'a.doc_id = b.id', 'INNER')
					->join('users_tbl AS c', 'a.user_id = c.id', 'INNER')
					->join('approved_requests_tbl AS d', 'a.id = d.request_id', 'INNER')
					->join('users_tbl AS e', 'd.approver_id = e.id', 'INNER')
					->get();
		}
		else
		{
			$query = $this->db->select($fields)
					->from('requests_tbl AS a')
					->join('docs_tbl AS b', 'a.doc_id = b.id', 'INNER')
					->join('users_tbl AS c', 'a.user_id = c.id', 'INNER')
					->join('approved_requests_tbl AS d', 'a.id = d.request_id', 'INNER')
					->join('users_tbl AS e', 'd.approver_id = e.id', 'INNER')
					->where('a.user_id', $this->session->userdata('id'))
					->get();
		}

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
			$this->db->update('requests_tbl', $params, array('id' => $id));
		}
		else
		{
			$this->db->insert('requests_tbl', $params);
		}

		return $this;	
	}

	public function read(array $params = array('type' => 'object'))
	{
		if ($params['id'] > 0)
		{
			$query = $this->db->get_where('requests_tbl', array('id' => $params['id']));

			if ($params['type'] == 'object')
			{
				return $query->row();
			}
			
			return $query->row_array();
		}
	}

	public function hasPermission($params)
	{
		$config = array(
				'doc_id'  => $params['doc_id'],
				'user_id' => $params['user_id']
			);

		$query = $this->db->where($config)
				->get('permission_tbl');

		return $query->num_rows() ? $query->row_array() : 0;
	}

	public function storePermission($params)
	{
		$perm = $this->hasPermission($params);

		// Create dynamic key for inserting and updating permission
		$p_col = $params['permission'] . '_doc';

		$config = array(
				'doc_id'  => $params['doc_id'],
				'user_id' => $params['user_id'],
				$p_col    => true
			);

		if (is_array($perm))
		{
			$this->db->update('permission_tbl', $config, array('id' => $perm['id']));
		}
		else
		{
			$this->db->insert('permission_tbl', $config);
		}

		return $this;
	}

	public function storeApproval($params)
	{
		$this->db->insert('approved_requests_tbl', $params);

		return $this->db->insert_id();
	}

	public function delete()
	{
		$id = $this->input->post('id');

		$this->db->delete('requests_tbl', array('id' => $id));

		return $this;
	}

	public function fetchExpired()
	{
		$fields = array(
				'a.*',
				'b.doc_id'
			);

		$query = $this->db->select($fields)
				->from('approved_requests_tbl AS a')
				->join('requests_tbl AS b', 'a.request_id = b.id', 'INNER')
				->where('a.datetime < DATE_SUB(NOW(), INTERVAL 6 HOUR)')
				->get();

		return $query->result();
	}

}
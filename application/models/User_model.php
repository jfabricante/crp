<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	// Return user credentials
	public function exist($username, $password)
	{
		$config = array(
				'username' => $username,
				'password' => $password
			);

		$fields = array(
				'a.id',
				'a.username',
				'a.fullname',
				'a.emp_no',
				'a.email',
				'b.user_type',
				'c.name AS branch',
				'd.name AS position',
				'e.login'
			);

		$query = $this->db->select($fields)
				->from('users_tbl AS a')
				->join('roles_tbl AS b', 'a.role_id = b.id', 'INNER')
				->join('branches_tbl AS c', 'a.branch_id = c.id', 'LEFT')
				->join('positions_tbl AS d', 'a.position_id = d.id', 'LEFT')
				->join('logs_tbl AS e', 'a.id = e.user_id', 'LEFT')
				->order_by('e.id', 'DESC')
				->where($config)
				->get();

		if ($query->num_rows())
		{
			return $query->row_array();	
		}

		return false;
	}

	/**
	 * @param
	 * id int
	 * status int
	 */
	public function setState($id, $status)
	{
		$query = $this->db->get_where('login_status_tbl', array('user_id' => $id));

		if ($query->num_rows())
		{
			$config = array(
					'state' => $status
				);

			$this->db->update('login_status_tbl', $config, array('user_id' => $id));
		}
		else
		{
			$config = array(
					'user_id' => $id,
					'state'   => $status
				);

			$this->db->insert('login_status_tbl', $config);
		}
	}

	// Return true if the user state is active otherwise false
	public function checkState($id)
	{
		return $this->db->get_where('login_status_tbl', array('user_id' => $id, 'state' => 1))->num_rows();
	}

	public function store_batch(array $data)
	{
		$this->db->insert_batch('users_tbl', $data);

		return $this;
	}

	public function assign_batch_role(array $ids)
	{
		foreach ($ids as $id)
		{
			$config = array(
					'user_id' => $id,
					'role_id' => 3
				);

			$exist = $this->db->select('*')
					->from('users_role_tbl')
					->where($config)
					->get();

			if (!$exist->num_rows())
			{
				$this->db->insert('users_role_tbl', $config);
			}	
		}

		return $this;
	}

	public function store($params)
	{
		$id = $this->input->post('id') ? $this->input->post('id') : 0;

		if ($id > 0)
		{
			$this->db->update('users_tbl', $params, array('id' => $id));
		}
		else
		{
			$this->db->insert('users_tbl', $params);
		}

		return $this;	
	}

	public function fetch($type = 'object')
	{
		$fields = array(
				'a.id',
				'a.username',
				'a.fullname',
				'a.emp_no',
				'a.datetime',
				'a.email',
				'b.user_type',
				'c.name AS branch',
				'd.name AS position'
			);

		$data = $this->db->select($fields)
				->from('users_tbl AS a')
				->join('roles_tbl AS b', 'a.role_id = b.id', 'LEFT')
				->join('branches_tbl AS c', 'a.branch_id = c.id', 'LEFT')
				->join('positions_tbl AS d', 'a.position_id = d.id', 'LEFT')
				->get();

		if ($type == 'object')
		{
			return $data->result();
		}

		return $data->result_array();
	}

	public function read($id)
	{
		$query = $this->db->get_where('users_tbl', array('id' => $id));

		return $query->row();		
	}

	public function delete()
	{
		$id = $this->input->post('id');

		$this->db->delete('users_tbl', array('id' => $id));

		return $this;
	}

	public function fetch_roles($type = 'object')
	{
		if ($type == 'object')
		{
			return $this->db->get('roles_tbl')->result();
		}
		
		return $this->db->get('roles_tbl')->result_array();
	}

	public function assign_role(array $params = array())
	{
		if ($params['user_id'] > 0)
		{
			$this->db->insert('users_role_tbl', $params);
		}

		return 0;
	}

	public function users_count()
	{
		return $this->db->get('users_tbl')->num_rows();
	}

	public function users_role_count()
	{
		return $this->db->get('users_role_tbl')->num_rows();
	}

	public function truncate_tbl()
	{
		$this->db->truncate('users_tbl');
		$this->db->truncate('users_role_tbl');
	}

	public function updatePassword($params)
	{
		$this->db->update('users_tbl', array('password' => $params['password']), array('username' => $params['username'], 'password' => $params['old_password']));
	}
}
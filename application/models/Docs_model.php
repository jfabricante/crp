<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docs_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function browse(array $params = array('type' => 'object'))
	{
		$fields = array(
				'a.id',
				'a.doc_name',
				'a.full_path',
				'a.file_name',
				'b.name AS category'
			);
		$query = $this->db->select($fields)
				->from('docs_tbl AS a')
				->join('category_tbl AS b', 'a.category_id = b.id', 'LEFT')
				->get();

		if ($params['type'] == 'object')
		{
			return $query->result();
		}

		return $query->result_array();
	}

	public function fetchRecentDocs(array $params = array('type' => 'object'))
	{
		$fields = array(
				'a.id',
				'a.doc_name',
				'a.datetime',
				'b.name AS category'
			);

		$query = $this->db->select($fields)
				->from('docs_tbl AS a')
				->join('category_tbl AS b', 'a.category_id = b.id', 'LEFT')
				->order_by('a.id', 'DESC')
				->limit(3)
				->get();

		if ($params['type'] == 'object')
		{
			return $query->result();
		}

		return $query->result_array();
	}

	public function browsePermission(array $params = array('type' => 'object'))
	{
		$fields = array(
				'a.id',
				'a.doc_name',
				'a.full_path',
				'a.file_name',
				'b.name AS category',
				'c.view_doc',
				'c.download_doc',
				'c.print_doc',
				'c.archive_doc',
				'c.edit_doc',
				'c.delete_doc',
				'c.user_id'
			);

		$query = $this->db->select($fields)
				->from('docs_tbl AS a')
				->join('category_tbl AS b', 'a.category_id = b.id', 'LEFT')
				->join('permission_tbl AS c', 'a.id = c.doc_id', 'LEFT')
				->get();

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
			$this->db->update('docs_tbl', $params, array('id' => $id));
		}
		else
		{
			$this->db->insert('docs_tbl', $params);
		}

		return $this;	
	}

	public function read(array $params = array('type' => 'object'))
	{
		if ($params['id'] > 0)
		{
			$query = $this->db->get_where('docs_tbl', array('id' => $params['id']));

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

		$this->db->delete('docs_tbl', array('id' => $id));

		return $this;
	}

	public function showVars($var)
	{
		echo '<pre>';
		print_r($var);
		echo '</pre>'; die;
	}
}
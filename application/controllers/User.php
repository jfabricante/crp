<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->_redirectUnauthorized();

		date_default_timezone_set('Asia/Manila');

		$models = array('user_model', 'branch_model', 'position_model', 'logs_model', 'category_model');

		$this->load->model($models);
	}

	public function list_()
	{
		$data = array(
				'title'     => 'List of Users',
				'content'   => 'users/list_view',
				'entities'  => $this->user_model->fetch(),
				'sub_menus' => $this->category_model->browse(array('type' => 'array'))
			);

		$this->load->view('include/template', $data);
	}

	public function form()
	{
		$id = $this->uri->segment(3) ? $this->uri->segment(3) : '';

		$data = array(
				'title'     => $id ? 'Update Details' : 'Add Users',
				'entity'    => $id ? $this->user_model->read($id) : '',
				'roles'     => $this->user_model->fetch_roles(),
				'branches'  => $this->branch_model->browse(),
				'positions' => $this->position_model->browse()
			);

		$this->load->view('users/form_view', $data);
	}

	public function store()
	{
		$id = $this->input->post('id') ? $this->input->post('id') : 0;

		// Trim the post data
		$config = array_map('trim', $this->input->post());

		$config['datetime'] = date('Y-m-d H:i:s');
		$config['fullname'] = ucwords(strtolower($config['fullname']));

		$this->user_model->store($config);

		if ($id > 0)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success">User has been updated!</div>');
		}
		else
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success">User has been added!</div>');
		}

		redirect($this->agent->referrer());
	}

	public function notice()
	{
		$data['id'] = $this->uri->segment(3);

		$this->load->view('users/delete_view', $data);
	}

	public function delete()
	{
		$this->user_model->delete();

		$this->session->set_flashdata('message', '<div class="alert alert-success">User has been deleted!</div>');

		redirect($this->agent->referrer());
	}

	public function logs()
	{
		$data = array(
				'title'     => 'User\'s log',
				'content'   => 'users/logs_view',
				'entities'  => $this->logs_model->browse(),
				'sub_menus' => $this->category_model->browse(array('type' => 'array'))
			);

		$this->load->view('include/template', $data);
	}

	protected function _redirectUnauthorized()
	{
		if (count($this->session->userdata()) < 3)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-warning">Login first!</div>');

			redirect(base_url());
		}
	}

	public function change_password_form()
	{
		$data = array(
				'title'     => 'Change Password',
				'content'   => 'users/change_password_view',
				'sub_menus' => $this->category_model->browse(array('type' => 'array'))
			);

		$this->load->view('include/template', $data);
	}

	public function showVars($var)
	{
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->_redirectUnauthorized();

		$this->load->model('branch_model');
	}

	public function list_()
	{
		$data = array(
				'title'    => 'List of Branches',
				'content'  => 'branches/list_view',
				'entities' => $this->branch_model->browse()
			);

		$this->load->view('include/template', $data);
	}

	public function form()
	{
		$id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		$config = array(
				'id'   => $id,
				'type' => 'object'
			);

		$data = array(
				'title'  => $id ? 'Update Details' : 'Branch form',
				'entity' => $id ? $this->branch_model->read($config) : '',
			);

		$this->load->view('branches/form_view', $data);
	}

	public function notice()
	{
		$data['id'] = $this->uri->segment(3);

		$this->load->view('branches/delete_view', $data);
	}

	public function store()
	{
		$id = $this->input->post('id') ? $this->input->post('id') : 0;

		// Trim the post data
		$config = array_map('trim', $this->input->post());

		$this->branch_model->store($config);

		if ($id > 0)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Branch has been updated!</div>');
		}
		else
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Branch has been added!</div>');
		}

		redirect($this->agent->referrer());
	}

	public function delete()
	{
		$this->branch_model->delete();

		$this->session->set_flashdata('message', '<div class="alert alert-success">Branch has been deleted!</div>');

		redirect($this->agent->referrer());
	}

	protected function _redirectUnauthorized()
	{
		if (count($this->session->userdata()) < 3)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-warning">Login first!</div>');

			redirect(base_url());
		}
	}
}

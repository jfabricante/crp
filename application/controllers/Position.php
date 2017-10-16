<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('position_model');
	}

	public function list_()
	{
		$data = array(
				'title'    => 'List of Positions',
				'content'  => 'positions/list_view',
				'entities' => $this->position_model->browse()
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
				'title'  => $id ? 'Update Details' : 'Position form',
				'entity' => $id ? $this->position_model->read($config) : '',
			);

		$this->load->view('positions/form_view', $data);
	}

	public function notice()
	{
		$data['id'] = $this->uri->segment(3);

		$this->load->view('positions/delete_view', $data);
	}

	public function store()
	{
		$id = $this->input->post('id') ? $this->input->post('id') : 0;

		// Trim the post data
		$config = array_map('trim', $this->input->post());

		$this->position_model->store($config);

		if ($id > 0)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Position has been updated!</div>');
		}
		else
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Position has been added!</div>');
		}

		redirect($this->agent->referrer());
	}

	public function delete()
	{
		$this->position_model->delete();

		$this->session->set_flashdata('message', '<div class="alert alert-success">Position has been deleted!</div>');

		redirect($this->agent->referrer());
	}
}

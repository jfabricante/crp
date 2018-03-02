<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->_redirectUnauthorized();

		$this->load->model('category_model');
	}

	public function list_()
	{
		$data = array(
				'title'     => 'List of Categories',
				'content'   => 'category/list_view',
				'entities'  => $this->category_model->browse(),
				'sub_menus' => $this->category_model->browse(array('type' => 'array'))
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
				'title'  => $id ? 'Update Details' : 'Category form',
				'entity' => $id ? $this->category_model->read($config) : '',
			);

		$this->load->view('category/form_view', $data);
	}

	public function notice()
	{
		$data['id'] = $this->uri->segment(3);

		$this->load->view('category/delete_view', $data);
	}

	public function store()
	{
		$id = $this->input->post('id') ? $this->input->post('id') : 0;

		// Trim the post data
		$config = array_map('trim', $this->input->post());

		$this->category_model->store($config);

		if ($id > 0)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Category has been updated!</div>');
		}
		else
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Category has been added!</div>');
		}

		redirect($this->agent->referrer());
	}

	public function delete()
	{
		$this->category_model->delete();

		$this->session->set_flashdata('message', '<div class="alert alert-success">Category has been deleted!</div>');

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

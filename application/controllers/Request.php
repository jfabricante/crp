<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->_redirectUnauthorized();

		// Set the default timezone
		date_default_timezone_set('Asia/Manila');

		// List of models
		$models = array('request_model', 'docs_model');

		// Load models
		$this->load->model($models);
	}

	public function list_()
	{
		$data = array(
				'title'    => 'List of Requests',
				'content'  => 'requests/list_view',
				'entities' => $this->request_model->browse()
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

		$permissions = array('view', 'print');

		$data = array(
				'title'       => $id ? 'Update Details' : 'Request for Approval Form',
				'entity'      => $id ? $this->request_model->read($config) : '',
				'documents'   => $this->docs_model->browse(),
				'permissions' => $permissions
			);

		$this->load->view('requests/form_view', $data);
	}

	public function notice()
	{
		$data['id'] = $this->uri->segment(3);

		$this->load->view('requests/delete_view', $data);
	}

	public function store()
	{
		$id = $this->input->post('id') ? $this->input->post('id') : 0;

		// Trim the post data
		$config = array_map('trim', $this->input->post());

		$config['datetime'] = date('Y-m-d H:i:s');
		$config['user_id']  = $this->session->userdata('id');

		$this->request_model->store($config);

		if ($id > 0)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Request has been updated!</div>');
		}
		else
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Request has been filed!</div>');
		}

		redirect($this->agent->referrer());
	}

	public function delete()
	{
		$this->request_model->delete();

		$this->session->set_flashdata('message', '<div class="alert alert-success">Request has been deleted!</div>');

		redirect($this->agent->referrer());
	}

	public function approved_list()
	{
		$data = array(
				'title'    => 'List of Approved Requests',
				'content'  => 'requests/approved_view',
				'entities' => $this->request_model->fetchApprovedList()
			);

		$this->load->view('include/template', $data);
	}

	public function approve()
	{
		$id = $this->uri->segment(3);

		$config = array(
				'id'   => $id,
				'type' => 'array'
			);

		$entity = $this->request_model->read($config);

		$data = array(
				'request_id'  => $id,
				'datetime'    => date('Y-m-d H:i:s'),
				'approver_id' => $this->session->userdata('id')
			);

		$this->request_model->storeApproval($data);

		$this->request_model->storePermission($entity);

		$this->session->set_flashdata('message', '<div class="alert alert-success">Request has been approved!</div>');
		
		redirect($this->agent->referrer());
	}

	public function lapsed_permission()
	{
		$approved = $this->request_model->fetchApprovedList();

		foreach ($approved as $entity)
		{
			$time_lapsed = time() - strtotime($entity->datetime);

			if ($time_lapsed >= DAY)
			{
				$this->showVars($entity);
			}
		}
	}

	protected function _redirectUnauthorized()
	{
		if (count($this->session->userdata()) < 3)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-warning">Login first!</div>');

			redirect(base_url());
		}
	}

	public function expired()
	{
		$this->showVars($this->request_model->fetchExpired());
	}

/*	public function humanTiming ($time)
	{
	    $time = time() - $time; // to get the time since that moment
	    $time = ($time<1)? 1 : $time;

	    $tokens = array (
	        31536000 => 'year',
	        2592000 => 'month',
	        604800 => 'week',
	        86400 => 'day',
	        3600 => 'hour',
	        60 => 'minute',
	        1 => 'second'
	    );

	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
	    }

	}*/

	public function showVars($vars)
	{
		echo '<pre>';
		print_r($vars);
		echo '</pre>';
	}
}

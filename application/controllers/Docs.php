<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docs extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->_redirectUnauthorized();

		date_default_timezone_set('Asia/Manila');
		
		$models = array('docs_model', 'category_model', 'request_model');

		$this->load->model($models);
	}

	public function list_()
	{
		$entities = $this->_docsPermission();

		$data = array(
				'title'    => 'List of Documents',
				'content'  => 'docs/list_view',
				'entities' => $this->session->userdata('user_type') == 'Administrator' ? $this->docs_model->browse(array('type' => 'array')) : $entities
			);

		$this->load->view('include/template', $data);
	}

	protected function _docsPermission()
	{
		$docs = $this->docs_model->browse(array('type' => 'array'));

		$entities = array();

		foreach ($docs as $doc)
		{
			// Permission attributes
			$config = array(
					'doc_id'  => $doc['id'],
					'user_id' => $this->session->userdata('id') 
				);

			$perm = $this->request_model->hasPermission($config);

			if (is_array($perm))
			{
				$entities[] = array(
						'id'           => $doc['id'],
						'doc_name'     => $doc['doc_name'],
						'full_path'    => $doc['full_path'],
						'file_name'    => $doc['file_name'],
						'category'     => $doc['category'],
						'view_doc'     => $perm['view_doc'],
						'print_doc'    => $perm['print_doc'],
						'download_doc' => $perm['download_doc'],
						'archive_doc'  => $perm['archive_doc'],
						'edit_doc'     => $perm['edit_doc'],
						'delete_doc'   => $perm['delete_doc'],
						'has_menu'     => true
					);
			}
			else
			{
				$entities[] = array(
						'id'           => $doc['id'],
						'doc_name'     => $doc['doc_name'],
						'full_path'    => $doc['full_path'],
						'file_name'    => $doc['file_name'],
						'category'     => $doc['category'],
						'view_doc'     => 0,
						'print_doc'    => 0,
						'download_doc' => 0,
						'archive_doc'  => 0,
						'edit_doc'     => 0,
						'delete_doc'   => 0,
						'has_menu'     => false
					);
			}
		}

		return $entities;
	}

	public function form()
	{
		$id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		$config = array(
				'id'   => $id,
				'type' => 'object'
			);

		$data = array(
				'title'      => $id ? 'Update Details' : 'Document form',
				'categories' => $this->category_model->browse(),
				'entity'     => $id ? $this->docs_model->read($config) : '',
			);

		$this->load->view('docs/form_view', $data);
	}

	public function modal_content()
	{
		$id = $this->uri->segment(3);

		$config = array(
				'id'   => $id,
				'type' => 'object'
			);

		$entity = $this->docs_model->read($config);

		$data =  array(
				'title'    => $entity->doc_name,
				'filename' => $entity->file_name
			);

		$this->load->view('docs/doc_content_view', $data);
	}

	public function notice()
	{
		$data['id'] = $this->uri->segment(3);

		$this->load->view('docs/delete_view', $data);
	}

	public function store()
	{
		$id = $this->input->post('id') ? $this->input->post('id') : 0;

		// Trim the post data
		$data = array_map('trim', $this->input->post());

		$upload_object = $this->_handleUpload();

		
		if (is_array($upload_object))
		{
			$config = array(
					'file_name'   => $upload_object['file_name'],
					'doc_name'    => $data['doc_name'],
					'file_size'   => $data['file_size'],
					'file_type'   => $data['file_type'],
					'full_path'   => base_url('/resources/docs/' . $upload_object['file_name']),
					'category_id' => $data['category_id'],
					'datetime'    => date('Y-m-d H:i:s'),
					'user_id'     => $this->session->userdata('id')
				);

			$this->docs_model->store($config);

			if ($id > 0)
			{
				$this->session->set_flashdata('message', '<div class="alert alert-success">Document has been updated!</div>');
			}
			else
			{
				$this->session->set_flashdata('message', '<div class="alert alert-success">Document has been added!</div>');
			}
		}
		else 
		{
			$this->session->set_flashdata('message', '<div class="alert alert-error">' . $upload_object . '</div>');
		}
		

		redirect($this->agent->referrer());
	}

	protected function _handleUpload()
	{
		// Configuration
		$config = array(
				'upload_path'   => './resources/docs',
				'allowed_types' => 'pdf|pptx|ppt|png|xlsx|xls|odp', // Allow only define types to be uploaded
				'max_size'      => 100000 // Set the maximum file size to 10mb
			);

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file_name'))
		{
			$error = array('error' => $this->upload->display_errors());

			return $this->upload->display_errors();
		}

		return $this->upload->data();

	}

	public function delete()
	{
		$this->docs_model->delete();

		$this->session->set_flashdata('message', '<div class="alert alert-success">Document has been deleted!</div>');

		redirect($this->agent->referrer());
	}

	public function archive()
	{
		$id = $this->uri->segment(3);

		$config = array(
				'id'   => $id,
				'type' => 'object'
			);

		$entity = $this->docs_model->read($config);

		$this->load->library('zip');

		$file_path = FCPATH . '/resources/docs/' . $entity->file_name;
		// Verify if the file exist
		if (file_exists($file_path))
		{
			$this->zip->add_data($file_path);
			$this->zip->archive(FCPATH .'/archive/docs/test.zip');
			$this->zip->download('test.zip');

			redirect($this->agent->referrer());
		}
		//var_dump(); die;
		//$this->showVars(file_exists($entity->full_path)); die;
	}

	protected function _redirectUnauthorized()
	{
		if (count($this->session->userdata) < 3)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-warning">Login first!</div>');

			redirect(base_url());
		}
	}

	public function showVars($vars)
	{
		echo '<pre>';
		print_r($vars);
		echo '</pre>';
	}
}

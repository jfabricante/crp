<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Manila');

		$helpers = array('form');

		$this->load->helper($helpers);

		// Load logs model
		$this->load->model('logs_model');
		$this->load->model('category_model');
	}

	public function index()
	{
		$this->load->view('login_view');
	}

	public function authenticate()
	{
		$user_data = $this->_user_exist();

		if ($this->_validate_input() && is_array($user_data))
		{

			$config = array(
					'user_id' => $user_data['id'],
					'login'   => date('Y-m-d H:i:s')
				);

			$logs_id = $this->logs_model->store($config);

			$user_data['logs_id'] = $logs_id;

			$this->session->set_userdata($user_data);

			redirect('/login/home');
		}

		$data['message'] = '<span class="col-sm-12 alert alert-warning">You have no rights to access this system.</span>';

		$this->load->view('login_view', $data);

	}

	public function home()
	{
		$this->load->model('docs_model');

		$data = array();

		if (in_array($this->session->userdata('user_type'), array('Administrator', 'Dealer')))
		{
			$data = array(
				'title'     => 'Home',
				'content'   => 'home_view',
				'entities'  => $this->docs_model->fetchRecentDocs(),
				'sub_menus' => $this->category_model->browse(array('type' => 'array'))
			);
		}
		else
		{
			$data = array(
				'title'     => '',
				'content'   => 'home2_view',
				'sub_menus' => $this->category_model->browse(array('type' => 'array'))
			);
		}

		$this->load->view('include/template', $data);
	}

	public function logout()
	{
		$config = array(
				'user_id' => $this->session->userdata('id'),
				'logout'  => date('Y-m-d H:i:s')
			);

		$this->logs_model->store($config);

		$this->session->sess_destroy();

		redirect('login/index');
	}

	protected function _validate_input()
	{
		$this->load->library('form_validation');

		$config = array(
		        array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required|trim',
		                'errors' => array(
		                	'required' => 'You must provide a %s.',
		                ),
		        ),
		        array(
		                'field' => 'password',
		                'label' => 'Password',
		                'rules' => 'required|trim',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                ),
		        ),
			);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == false)
		{
			return false;
		}

		return true;
	}

	protected function _user_exist()
	{
		$this->load->model('user_model', 'user');

		return is_array($this->user->exist()) ? $this->user->exist() : false;
	}
}

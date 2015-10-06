<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

Class Login extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->library('form_validation');
		$this->load->model('Login_model', 'login');
	}
	
	function index() {
		$this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('template/login');
		}
		else {
			$user = $this->input->post('username');
			$pass = md5($this->input->post('password'));			
			$data = $this->login->get_user($user, $pass);
			
			if ($data === FALSE) {
				$this->load->view('template/gagal_login');
			}
			else {
				$this->session->set_userdata($data);	
				$_SESSION['id_client'] = $data->id_client;
				redirect('home');
			}
		}
	}
}
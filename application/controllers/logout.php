<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

Class Logout extends MY_Controller {

	function __construct() {
		parent::MY_Controller();
	}
	
	function index() {
		$this->session->sess_destroy();
		redirect('');
	}
}
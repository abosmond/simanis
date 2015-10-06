<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

Class Home extends MY_Controller {

	var $data;
	
	function __construct() {
		parent::__construct();
		
	}
	
	function index() {		
		$this->data = array();		
		$this->LoadView('home/view', $this->data);
	}
}
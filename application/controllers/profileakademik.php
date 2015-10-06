<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profileakademik extends MY_Controller {

	var $data;
	
	function __construct() {
		parent::MY_Controller();
		$this->load->model('profile_model', 'profile');
	}
	
	function index() {
		$this->view();
	}
	
	function view() {
		$this->form_validation->set_rules('db_nama_sekolah', 'Nama Sekolah', 'required');
		$this->form_validation->set_rules('db_alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('db_telp', 'No. Telp', 'required');
				
		if ($this->form_validation->run() === FALSE) {
			$this->data['row'] = $this->profile->get_data_profile();
			$this->LoadView('profile/view', $this->data);
		}
		else {
			$d = parseForm($_POST);
			$this->db->update('profilakademik', $d);			
			$this->LoadView('profile/view', $this->data);
		}
	}
}
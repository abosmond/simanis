<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Broadcastsms extends MY_Controller {

	var $data;
	
	function __construct() {
		parent::Controller();
		$this->load->model('Kelas_model', 'k');
		$this->load->model('Sms_model', 'sms');
	}
	
	function index() {
		$this->view();		
	}
	
	function view() {
		$this->data['tingkat'] = array('0' => '-- Silakan Pilih --', '1' => '1', '2' => '2', '3' => '3');
		$this->data['group']	= array('0' => '-- Silakan Pilih --', '1' => 'Siswa', '2' => 'Orang Tua');		
		$this->LoadView('broadcastsms/view', $this->data);
	}
	
	function perkelas() {
		$this->form_validation->set_rules('isisms', 'Isi SMS', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->data['kls']	= $this->k->get_data_kelas();
			$this->LoadView('broadcastsms/perkelas', $this->data);
		}
		else {
			if (isset($_POST['j_action']) && $_POST['j_action'] == 'add_param') {
				$ret = $this->sms->get_nohp_by_kelas($_POST['kelas']);
				
				foreach ($ret->result() as $q) {
					$f['DestinationNumber']	= $q->TELP;
					$f['TextDecoded']		= $_POST['isisms'];
					
					$this->db->insert('outbox', $f);
					$this->data['msg'] = setMessage('insert', 'broadcastsms/perkelas');
					$this->LoadView('template/msg', $this->data);
				}
			}
		}
	}
	
	function pertingkat() {
		$this->form_validation->set_rules('isisms', 'Isi SMS', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->data['kls']	= $this->sms->get_data_tingkat();
			$this->LoadView('broadcastsms/pertingkat', $this->data);
		}
		else {
			if (isset($_POST['j_action']) && $_POST['j_action'] == 'add_param') {
				$ret = $this->sms->get_nohp_by_tingkat($_POST['kelas']);
				
				foreach ($ret->result() as $q) {
					$f['DestinationNumber']	= $q->TELP;
					$f['TextDecoded']		= $_POST['isisms'];
					
					$this->db->insert('outbox', $f);
					$this->data['msg'] = setMessage('insert', 'broadcastsms/pertingkat');
					$this->LoadView('template/msg', $this->data);
				}
			}
		}
	}
}
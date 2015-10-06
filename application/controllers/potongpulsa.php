<?php if ( ! defined('BASEPATH')) exit('No direct access allowed');

class potongpulsa extends MY_Controller {

	var $data;
	
	function __construct() {
		parent::MY_Controller();
	}
	
	function index() {
		$this->_view();
	}
	
	function _view() {
		$this->form_validation->set_rules('db_biayapotong', 'Biaya Potongan', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			$a = $this->db->get_where('potonganpulsa', array('id' => '1'));
			$this->data['row'] = $a->row();			
			$this->LoadView('profile/potongpulsa', $this->data);
		}
		else {						
			$d = parseForm($_POST);
			
			if (!isset($_POST['db_stat_potong_pulsa'])) $d['stat_potong_pulsa'] = '0';
			else $d['stat_potong_pulsa'] = '1';
			
			$this->db->update('potonganpulsa', $d, array('id' => '1'));
			redirect('potongpulsa');
		}
	}
}
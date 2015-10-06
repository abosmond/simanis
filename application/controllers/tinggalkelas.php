<?php
class Tinggalkelas extends MY_Controller {

	var $data;
	
    function __construct() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('tinggalkelas_model', 'tinggalkelas');		
    }

    function index() {
        $this->tambahtinggalkelas();
    }
		
	function tambahtinggalkelas() {
		$this->form_validation->set_rules('tahunajaranakhir', 'Tahun Ajaran', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->data['tinggalkelas'] = $this->tinggalkelas->get_data_tinggalkelas();						
			$this->data['thnsebelum'] 	= $this->tinggalkelas->get_ta();
			$this->data['thnsesudah'] 	= $this->tinggalkelas->get_ta('aktif');
			$this->data['tahunaktif'] 	= $this->tinggalkelas->tahunajaran_aktif();
			
			$this->LoadView('tinggalkelas/addkelas', $this->data);
		}
		else {
			
			if (isset($_POST['j_action']) && $_POST['j_action'] == 'add_param') {			
				for ($i = 0; $i < sizeof($_POST['firstList']); $i++) {
					$d['idkelas'] = $_POST['db_idkelas'];
					$d['idtahun'] = $this->tinggalkelas->tahunajaran_aktif();
					$d['nis']	  = $_POST['firstList'][$i];
					
					$this->db->insert('kelas', $d);								
				}
				redirect('tinggalkelas');
			}			
		}
	}
	
	function loadkelas($idkelas, $idtahun) {
		$this->data['result']	= $this->tinggalkelas->list_siswa_perkelas($idkelas, $idtahun);	
		$this->LoadSingleView('tinggalkelas/kelasawal', $this->data);		
	}
}
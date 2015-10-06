<?php
class Kenaikankelas extends MY_Controller {

	var $data;
	
    function __construct() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('kenaikankelas_model', 'kenaikankelas');		
    }

    function index() {
        $this->tambahkenaikankelas();
    }
			
	function savekenaikankelas() {
		$arr = explode(',', $_POST['NIS']);
		$thn = $this->kenaikankelas->get_tahun_ajaran();
		
		foreach ($arr as $v => $value) {
			$d['nis'] = $value;
			$d['idtahun'] = $thn->id;
			$d['idkenaikankelas'] = $_POST['idkenaikankelas'];
			
			$arr = $this->db->get_where('');
			$this->db->insert('kenaikankelas', $d);
		}
		echo 'OK';
	}
	
	function tambahkenaikankelas() {
		if (isset($_POST['j_action']) && $_POST['j_action'] == 'add_param') {
			for ($i = 0; $i < sizeof($_POST['secondList']); $i++) {
				$d['idkelas'] = $_POST['kelasakhir'];
				$d['idtahun'] = $this->kenaikankelas->tahunajaran_aktif();
				$d['nis']	  = $_POST['secondList'][$i];
				
				$arr = $this->db->get_where('kelas', array('idkelas' => $_POST['kelasakhir'], 'idtahun' => $this->kenaikankelas->tahunajaran_aktif(), 'nis' => $_POST['secondList'][$i]));
				if ($arr->num_rows() > 0) {
				}
				else {
					$this->db->insert('kelas', $d);				
				}
			}
			redirect('kenaikankelas');
		}		
		else {
			
			$this->data['kenaikankelas'] = $this->kenaikankelas->get_data_kenaikankelas();			
			//$this->data['tahunajaran'] = $this->kenaikankelas->get_tahun_ajaran();	
			$this->data['thnsebelum'] 	= $this->kenaikankelas->get_ta();
			$this->data['thnsesudah'] 	= $this->kenaikankelas->get_ta('aktif');
			$this->data['tahunaktif'] 	= $this->kenaikankelas->tahunajaran_aktif();
			
			$this->LoadView('kenaikankelas/addkelas', $this->data);
		}
	}
	
	function loadkelas($idkelas, $idtahun) {
		$this->data['result']	= $this->kenaikankelas->list_siswa_perkelas($idkelas, $idtahun);	
		$this->LoadSingleView('kenaikankelas/kelasawal', $this->data);		
	}
	
	function loadkelasakhir($idkelas, $idtahun) {
		$this->data['result']	= $this->kenaikankelas->list_siswa_sudah_naik_kelas($idkelas, $idtahun);	
		$this->LoadSingleView('kenaikankelas/kelasakhir', $this->data);		
	}
	
	function pilihkelas() {
		$this->data['result'] = $this->kenaikankelas->list_kelas_tujuan($_POST['mp']);
		$this->LoadSingleView('kenaikankelas/kelastujuan', $this->data);
	}
}
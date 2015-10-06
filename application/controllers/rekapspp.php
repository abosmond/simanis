<?php
class Rekapspp extends MY_Controller {

	var $data;
	
    function __construct() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));
        $this->load->model('rekapspp_model', 'rekapspp');	
		$this->load->model('spp_model', 'spp');			
    }

    function index() {
		$bln = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		for ($i=1;$i<=12;$i++){
			$aBln= (strlen($i)==1 ? '0'.$i : $i);
			$dBln[$aBln] = $bln[$i]; 
		}
		
		$this->data['bln']	= $dBln;
		$this->data['default'] = date('m');        
		$this->data['kelas'] = $this->rekapspp->get_kelas();
		$this->LoadView('rekapspp/view', $this->data);        
    }

	function lists() {		
		
		$this->data['status'] = array('belum' => 'Belum Bayar', 'sudah' => 'Sudah Bayar');
		
		if ($_POST['nis'] > 0) {
			$this->data['result'] = $this->rekapspp->get_rekap_spp_persiswa($_POST);
			$this->LoadSingleView('rekapspp/listpersiswa', $this->data);
		}
		else {
			$this->data['absen'] = $this->spp->get_data_siswa_perkelas($_POST['kelas']);
			$this->data['post']	= $_POST;
			$this->LoadSingleView('rekapspp/list', $this->data);
		}
    }
			
	function ekspor($param1, $param2, $param3) {
		$d = array('bulan' => $param1, 'tahun' => $param2, 'kelas' => $param3);
		$this->data['absen'] = $this->spp->get_data_siswa_perkelas($param3);
		$this->data['post']	= $d;
		$this->LoadSingleView('rekapspp/excel', $this->data);
	}
}
<?php
class spp extends MY_Controller {

	var $data;
	
    function __construct() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('spp_model', 'spp');	
		$this->load->model('nilai_model', 'nilai');
    }

    function index() {
		$bln = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		for ($i=1;$i<=12;$i++){
			$aBln= (strlen($i)==1 ? '0'.$i : $i);
			$dBln[$aBln] = $bln[$i]; 
		}
		
		$this->data['bln']	= $dBln;
		$this->data['default'] = date('m');
        $this->data['kelas'] = $this->nilai->get_kelas();
		$this->LoadView('spp/viewkelas', $this->data);
    }

    function lists() {				
		$this->data['status'] = array('belum' => 'Belum Bayar', 'sudah' => 'Sudah Bayar');
		$this->data['absen'] = $this->spp->get_data_siswa_perkelas($_POST['kelas']);
		$this->data['post']	= $_POST;
		$this->LoadSingleView('spp/list', $this->data);
    }

    function add() {
		
		if (isset($_POST['j_action']) && $_POST['j_action'] == 'add_absen') {
			$f['bulan']		= $_POST['bulan'];
			$f['tahun']		= $_POST['tahun'];
			$f['idtahun']	= $this->spp->get_ta_aktif();
			$f['idsem']		= $this->spp->get_sem_aktif();
			$f['idkelas']	= $_POST['kelas'];
			
			for ($i = 0; $i < sizeof($_POST['nis']); $i++) {
				if ($_POST['status'][$i] == 'sudah') {
					$f['nilai']		= $_POST['nilai'][$i];
					$f['nis']		= $_POST['nis'][$i];				
					$f['tglbayar'] 	= $_POST['tglbayar'][$i];
					$this->db->insert('spp', $f);
				}
			}
		}		
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {			
			if ($param == 'hapus') {
				if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
					if ($_POST['j_action'] == 'delete_spp' AND trim($id) !== '') {
						$this->db->delete('spp', array('id' => $id));
						$this->data['msg'] = setMessage('delete', 'spp');
						$this->LoadView('template/msg', $this->data);
					}
				}
				else {
					if (isset($id) AND trim($id) !== '') {
						$this->data['row'] = $this->spp->get_detail_spp($id);
						$this->LoadView('spp/hapus', $this->data);
					}
				}		
			}
			else
				redirect('spp');
		}
		else {
			redirect('spp');
		}		
	}
	
	function data($id = '') {		
				
		$this->form_validation->set_rules('db_tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('db_NIS', 'NIS', 'required');
				
		if ($this->form_validation->run() === FALSE) {	
			$this->load->model('referensi_model', 'ref');
			
			$this->data['ta'] = $this->ref->get_ta_aktif();
			$this->data['sem'] = $this->ref->get_sem_aktif();
			$this->LoadView('spp/form', $this->data);
		}
		else {
			
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'add_param') {
					$d = parseForm($_POST);
					
					$this->db->insert('spp', $d);
					$this->data['msg'] = setMessage('insert', 'spp');
					$this->LoadView('template/msg', $this->data);
				}
			} 
			else
				redirect('spp');
		}	
	}
	
	function lookup() {
		
		$keyword = strtolower($_POST['q']);  		
        $query = $this->spp->lookup($keyword); //Search DB
        if( ! empty($query) ) {
            foreach( $query as $row ) {
				if (strpos(strtolower($row->NIS), $keyword) !== false) {
					$key = $row->NIS;
					$value = $row->NAMA;
					$nohp1 = $row->kelas;
					$nohp2 = $row->TELP;
					
					echo "$key|$value|$nohp1|$nohp2\n";
				}				
            }
        }       
    }
	
}
<?php
class absensi extends MY_Controller {

	var $data;
	
    function absensi() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('absensi_model', 'absensi');	
		$this->load->model('nilai_model', 'nilai');
    }

    function index() {
        $this->data['kelas'] = $this->nilai->get_kelas();
		$this->LoadView('absensi/viewkelas', $this->data);
    }

    function lists() {			
		$this->data['status'] = array('belum' => 'Belum Absen', 'hadir' => 'Hadir', 'sakit' => 'Sakit', 'izin' => 'Izin', 'alfa' => 'Alfa');
		$this->data['absen'] = $this->absensi->get_data_siswa_perkelas($_POST['kelas']);
		$this->data['tgl'] = parseFormTgl('tanggal');
		$this->LoadSingleView('absensi/list', $this->data);
    }

    function add() {
		if (isset($_POST['j_action']) && $_POST['j_action'] == 'add_absen') {
			$f['tanggal']	= parseFormTgl('tanggal');
			$f['tahun']		= $this->absensi->get_ta_aktif();
			$f['smt']		= $this->absensi->get_sem_aktif();
			
			for ($i = 0; $i < sizeof($_POST['nis']); $i++) {
				$f['nis']	= $_POST['nis'][$i];
				$f['absen']	= $_POST['status'][$i];
				
				$this->db->insert('absensi', $f);
			}
		}		
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {			
			if ($param == 'hapus') {
				if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
					if ($_POST['j_action'] == 'delete_absensi' AND trim($id) !== '') {
						$this->db->delete('absensi', array('id' => $id));
						$this->data['msg'] = setMessage('delete', 'absensi');
						$this->LoadView('template/msg', $this->data);
					}
				}
				else {
					if (isset($id) AND trim($id) !== '') {
						$this->data['row'] = $this->absensi->get_detail_absensi($id);
						$this->LoadView('absensi/hapus', $this->data);
					}
				}		
			}
			else
				redirect('absensi');
		}
		else {
			redirect('absensi');
		}		
	}
	
	function data($id = '') {		
				
		$this->form_validation->set_rules('db_tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('db_NIS', 'NIS', 'required');
				
		if ($this->form_validation->run() === FALSE) {	
			$this->load->model('referensi_model', 'ref');
			
			$this->data['ta'] = $this->ref->get_ta_aktif();
			$this->data['sem'] = $this->ref->get_sem_aktif();
			$this->LoadView('absensi/form', $this->data);
		}
		else {
			
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'add_param') {
					$d = parseForm($_POST);
					
					$this->db->insert('absensi', $d);
					$this->data['msg'] = setMessage('insert', 'absensi');
					$this->LoadView('template/msg', $this->data);
				}
			} 
			else
				redirect('absensi');
		}	
	}
	
	function lookup() {
		
		$keyword = strtolower($_POST['q']);  		
        $query = $this->absensi->lookup($keyword); //Search DB
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
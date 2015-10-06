<?php
class kelas extends MY_Controller {

	var $data;
	
    function kelas() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('kelas_model', 'kelas');		
		$this->load->model('kenaikankelas_model', 'kenaikankelas');
    }

    function index() {
        $this->lists();
    }

    function lists() {
        $colModel['nis'] = array('NIS',80,TRUE,'left',2);
		$colModel['nama'] = array('Nama',180,TRUE,'left',2);
		$colModel['Tingkat'] = array('Tingkat',40,TRUE,'center',2);
		$colModel['program'] = array('Program',80, TRUE,'left',2);
		$colModel['kelas'] = array('Kelas',180,TRUE,'center',2);
		$colModel['walikls'] = array('Wali Kelas',120,TRUE,'center',2);
		$colModel['tahun'] = array('Tahun Ajaran',120, TRUE,'center',2);
		$colModel['action'] = array('Aksi',80,FALSE,'right',0);

        $gridParams = array(
            'width' => 'auto',
            'height' => 'auto',
            'rp' => 10,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Menampilkan: {from} sampai {to} dari {total} data.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
		);

		$this->load->model('referensi_model', 'ref');
		
        $grid_js = build_grid_js('flex1',site_url("kelas/load_data"),$colModel,'nis','asc',$gridParams);
		$this->data['js_grid'] = $grid_js;
		$this->data['ta'] = $this->ref->get_ta_aktif();
				
        $this->LoadView('kelas/view', $this->data);
    }

    function load_data() {
        $this->load->library('flexigrid');     

		$valid_fields = array('nis', 'nama', 'r.kelas', 'tahun');
		$this->flexigrid->validate_post('nis', 'ASC', $valid_fields);
		$records = $this->kelas->get_kelas_flexigrid();

		$this->output->set_header($this->config->item('json_header'));

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
				$row->id,
                $row->nis,
                $row->nama,
                $row->tingkat,
				$row->program,
				$row->kelas,
				$row->walikls,
				$row->tahun,								
                "<a href='".base_url()."kelas/detail/hapus/".$row->id."'>Hapus</a>&nbsp;&nbsp;&nbsp;"             
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {			
			if ($param == 'hapus') {
				if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
					if ($_POST['j_action'] == 'delete_kelas' AND trim($id) !== '') {
						$this->db->delete('kelas', array('id' => $id));
						$this->data['msg'] = setMessage('delete', 'kelas');
						$this->LoadView('template/msg', $this->data);
					}
				}
				else {
					if (isset($id) AND trim($id) !== '') {
						$this->data['row'] = $this->kelas->get_detail_kelas($id);
						$this->LoadView('kelas/hapus', $this->data);
					}
				}		
			}
			else
				redirect('kelas');
		}
		else {
			redirect('kelas');
		}		
	}
	
	function data($id = '') {		
				
		$this->form_validation->set_rules('db_nis', 'NIS', 'required');
		$this->form_validation->set_rules('db_kelas', 'Kelas', 'callback_cek_kelas');
				
		if ($this->form_validation->run() === FALSE) {
			
			if (isset($id) && trim($id) !== '') {				
				$this->data['q'] = $this->kelas->get_detail_kelas($id);								
			}
								
			$this->LoadView('kelas/form', $this->data);
		}
		else {
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'update_param' AND trim($id) !== '') {
					$d = parseForm($_POST);
										
					$this->db->update('kelas', $d, array('id' => $_POST['id_param']));						
					$this->data['msg'] = setMessage('update', 'kelas');
					$this->LoadView('template/msg', $this->data);
				}
				else {											
					$d = parseForm($_POST);					
					
					$this->db->insert('kelas', $d);
					$this->data['msg'] = setMessage('insert', 'kelas');
					$this->LoadView('template/msg', $this->data);
				}
			} 
		}	
	}
	
	function get_kelas() {		
		$r = $this->kelas->get_referensi_kelas($_POST['select']);
		
		echo($r->tingkat.'|'.$r->program.'|'.$r->walikls.'|'.$r->tahun);
	}
	
	function cek_kelas($kelas) {
		$q = $this->kelas->cek_kelas($_POST['db_nis'], $kelas);
		
		if ($q == TRUE) {
			$this->form_validation->set_message('cek_kelas', 'NIS '.$nis.' sudah terdaftar di kelas '.$kelas);
			return FALSE;
		}
		else
			return TRUE;
	}
	
	function cek_kelas_by_nis($nis) {
		
		$q = $this->kelas->get_kelas_by_nis($nis);
		
		if ($q == TRUE) {
			$this->form_validation->run();			
		}
		else
			return FALSE;
	}
	
	function lookup() {		
		$keyword = strtolower($_POST['q']);  		
        $query = $this->kelas->lookup($keyword);
        if( ! empty($query) ) {
            foreach( $query as $row ) {
				if (strpos(strtolower($row->NIS), $keyword) !== false) {
					$key = $row->NIS;
					$value = $row->NAMA;
					$nohp1 = $row->NOHP1;
					$nohp2 = $row->TELP;
					
					echo "$key|$value|$nohp1|$nohp2\n";
				}				
            }
        }       
    }	
	
	function savekelas() {
		
		echo 'OK';
	}
	
	function tambahkelas() {
		if (isset($_POST['j_action']) && $_POST['j_action'] == 'add_param') {
			for ($i = 0; $i < sizeof($_POST['secondList']); $i++) {
				$d['nis']	  = $_POST['secondList'][$i];
				$d['idkelas'] = $_POST['kelasakhir'];
				$d['idtahun'] = $this->kenaikankelas->tahunajaran_aktif();
				$this->db->insert('kelas', $d);				
			}
			redirect('kelas');
		}
		else {
			$this->data['result'] = $this->kelas->get_siswa_no_class();
			$this->data['kelas'] = $this->kelas->get_data_kelas();
			$this->data['row'] = $this->kelas->get_data_kelas();			
			
			$this->LoadView('kelas/addkelas', $this->data);
		}
		
	}
}
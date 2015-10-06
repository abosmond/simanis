<?php
class refkelas extends MY_Controller {

	var $data;
	
    function refkelas() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('refkelas_model', 'refkelas');		
    }

    function index() {
        $this->lists();
    }

    function lists() {
		$this->load->model('referensi_model', 'ref');
		
        $colModel['tingkat'] = array('Tingkat',80,TRUE,'center',2);
		$colModel['program'] = array('Program',180,TRUE,'center',2);
		$colModel['kelas'] = array('Kelas',120,TRUE,'center',2);
		$colModel['walikls'] = array('Wali Kelas',120, TRUE,'center',2);
		$colModel['tahun'] = array('Tahun Ajaran',180,TRUE,'center',2);		
		$colModel['action'] = array('Aksi',60,FALSE,'right',0);

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

        $grid_js = build_grid_js('flex1',site_url("refkelas/load_data"),$colModel,'tingkat','asc',$gridParams);
		$this->data['js_grid'] = $grid_js;
		$this->data['tahun'] = $this->ref->get_ta_aktif();
        $this->LoadView('refkelas/view', $this->data);
    }

    function load_data() {
        $this->load->library('flexigrid');     

		$valid_fields = array('tingkat', 'program', 'kelas', 'walikls');
		$this->flexigrid->validate_post('tingkat', 'ASC', $valid_fields);
		$records = $this->refkelas->get_refkelas_flexigrid();

		$this->output->set_header($this->config->item('json_header'));

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
				$row->id,
                $row->tingkat,
                $row->program,
                $row->kelas,
				$row->walikls,
				$row->tahun,				
                "<a href='".base_url()."refkelas/detail/hapus/".$row->id."'>Hapus</a>&nbsp;&nbsp;&nbsp;"             
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {			
			if ($param == 'hapus') {
				if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
					if ($_POST['j_action'] == 'delete_refkelas' AND trim($id) !== '') {
						$this->db->delete('refkelas', array('id' => $id));
						$this->data['msg'] = setMessage('delete', 'refkelas');
						$this->LoadView('template/msg', $this->data);
					}
				}
				else {
					if (isset($id) AND trim($id) !== '') {
						$this->data['row'] = $this->refkelas->get_detail_refkelas($id);
						$this->LoadView('refkelas/hapus', $this->data);
					}
				}		
			}
			else
				redirect('refkelas');
		}
		else {
			redirect('refkelas');
		}		
	}
	
	function data($id = '') {		
		$this->load->model('referensi_model', 'ref');
		
		$this->form_validation->set_rules('db_kelas', 'Kelas', 'required');
		$this->form_validation->set_rules('db_walikls', 'Wali Kelas', 'required|callback_cek_walikelas');
				
		if ($this->form_validation->run() === FALSE) {		
			$this->data['sem'] = $this->ref->get_sem_aktif();
			$this->data['tahunajaran'] = $this->refkelas->get_tahun_ajaran();
			$this->data['tingkat'] = array('0' => '-- Silakan Pilih --', '1' => '1', '2' => '2', '3' => '3');
			$this->data['program'] = array('0' => '-- Silakan Pilih --', '-' => '-', 'IPA' => 'IPA', 'IPS' => 'IPS');
			$this->LoadView('refkelas/form', $this->data);
		}
		else {
			
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'add_param') {
					$d = parseForm($_POST);
					
					$this->db->insert('refkelas', $d);
					$this->data['msg'] = setMessage('insert', 'refkelas');
					$this->LoadView('template/msg', $this->data);
				}
			} 
			else
				redirect('refkelas');
		}	
	}
	
	function cek_walikls($nama) {
		$q = $this->refkelas->cek_deposit($nis);
		
		if ($q == TRUE) {
			$this->form_validation->set_message('cek_deposit', 'NIS '.$nis.' sudah melakukan deposit');
			return FALSE;
		}
		else
			return TRUE;
	}
	
	function lookup() {
		
		$keyword = strtolower($_POST['q']);  		
        $query = $this->refkelas->lookup($keyword); //Search DB
        if( ! empty($query) ) {
            foreach( $query as $row ) {
				if (strpos(strtolower($row->NAMA), $keyword) !== false) {
					$key = $row->NAMA;
										
					echo "$key\n";
				}				
            }
        }       
    }
	
}
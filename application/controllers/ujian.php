<?php
class ujian extends MY_Controller {

	var $data;
	
    function ujian() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('ujian_model', 'ujian');		
		$this->load->model('referensi_model', 'ref');
    }

    function index() {
        $this->lists();
    }

    function lists() {
		$countUjian = $this->ujian->count_ujian();
					
		$this->data['ta'] = $this->ref->get_ta_aktif();
		$this->data['sem'] = $this->ref->get_sem_aktif();
		
		if ($countUjian !== '0') {
			$colModel['TANGGAL'] = array('Tanggal',80,TRUE,'center',2);
			$colModel['HARI'] = array('Hari',80,TRUE,'center',2);
			$colModel['ALIASHARI'] = array('Kode Hari',60,TRUE,'center',2);
			$colModel['JAM'] = array('Jam',80, TRUE,'center',2);
			$colModel['MP'] = array('Mata Pelajaran',280,TRUE,'center',2);
			$colModel['ALIAS'] = array('Kode MP',60,TRUE,'center',2);		
			$colModel['TINGKAT'] = array('Tingkat',60,TRUE,'center',2);		
			$colModel['PROGRAM'] = array('Program',60,TRUE,'center',2);		
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

			$grid_js = build_grid_js('flex1',site_url("ujian/load_data"),$colModel,'nis','asc',$gridParams);
			$this->data['js_grid'] = $grid_js;		
		}		
		else {
			$this->data['js_grid'] = '<table class="table-common" width="760px">
					<tr>
						<th>Tanggal</th>
						<th>Hari</th>
						<th>Kode Hari</th>
						<th>Jam</th>						
						<th>Mata Pelajaran</th>						
						<th>Kode MP</th>
						<th>Tingkat</th>
						<th>Program</th>
						<th>Aksir</th>							
					</tr>
					<tr>
						<td colspan="9"><center>Data tidak ditemukan</center></td>
					</tr>';
		}
		$this->LoadView('ujian/view', $this->data);		
    }

    function load_data() {
        $this->load->library('flexigrid');     

		$valid_fields = array('HARI', 'MP');
		$this->flexigrid->validate_post('HARI', 'ASC', $valid_fields);
		$records = $this->ujian->get_ujian_flexigrid();

		$this->output->set_header($this->config->item('json_header'));

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
				$row->ID,
                date('d-m-Y', strtotime($row->TANGGAL)),
                $row->HARI,
                $row->ALIASHARI,
				$row->JAM,
				$row->MP,
				$row->ALIAS,				
				$row->TINGKAT,				
				$row->PROGRAM,				
                "<a href='".base_url()."ujian/detail/hapus/".$row->ID."'>Hapus</a>&nbsp;&nbsp;&nbsp;"             
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {			
			if ($param == 'hapus') {
				if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
					if ($_POST['j_action'] == 'delete_ujian' AND trim($id) !== '') {
						$this->db->delete('ujian', array('id' => $id));
						$this->data['msg'] = setMessage('delete', 'ujian');
						$this->LoadView('template/msg', $this->data);
					}
				}
				else {
					if (isset($id) AND trim($id) !== '') {
						$this->data['row'] = $this->ujian->get_detail_ujian($id);
						$this->LoadView('ujian/hapus', $this->data);
					}
				}		
			}
			else
				redirect('ujian');
		}
		else {
			redirect('ujian');
		}		
	}
	
	function data($id = '') {		
				
		$this->form_validation->set_rules('db_TANGGAL', 'Tanggal', 'required');
		$this->form_validation->set_rules('db_JAM', 'Waktu', 'required|callback_cek_jadwal');
						
		if ($this->form_validation->run() === FALSE) {	
			$this->data['ta'] = $this->ref->get_ta_aktif();
			$this->data['sem'] = $this->ref->get_sem_aktif();
			$this->data['tingkat'] = array('0' => '-- Silakan Pilih --', '1' => 'I', '2' => 'II', '3' => 'III');
			$this->data['hari'] = array('SENIN' => 'SENIN', 'SELASA' => 'SELASA', 'RABU' => 'RABU', 'KAMIS' => 'KAMIS', 'JUMAT' => 'JUMAT', 'SABTU' => 'SABTU', 'MINGGU' => 'MINGGU');
			$this->LoadView('ujian/form', $this->data);
		}
		else {
			
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'add_param') {					
					$d = parseForm($_POST);	
					$d['ALIASHARI'] = substr($_POST['db_HARI'], 0, 3);
					
					$this->db->insert('ujian', $d);
					$this->data['msg'] = setMessage('insert', 'ujian');
					$this->LoadView('template/msg', $this->data);
				}
			} 
			else
				redirect('ujian');
		}	
	}
	
	function cek_jadwal() {
	
		$q = $this->ujian->cek_jadwal($_POST['db_TANGGAL'], $_POST['db_JAM'], $_POST['db_TINGKAT']);
		if ($q == TRUE) {
			$this->form_validation->set_message('cek_jadwal', 'Jadwal untuk tingkat '.$_POST['db_TINGKAT'].' tanggal '.$_POST['db_TANGGAL'].' pukul '.$_POST['db_JAM'].' sudah terisi');
			return FALSE;
		}
		else
			return TRUE;
	}
	
	function pilihmapel() {
		if('IS_AJAX') {			
        	$this->data['mapel'] = $this->ujian->pilihmapel($_POST['mp']);		
			$this->LoadSingleView('ujian/listmapel', $this->data); 
        }
	}
	
}
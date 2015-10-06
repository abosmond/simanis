<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Pengampu extends MY_Controller {

	var $data;
	
    function __construct() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('pengampu_model', 'pengampu');		
		$this->load->model('referensi_model', 'ref');
    }

    function index() {
        $this->lists();
    }

    function lists() {
		$countUjian = $this->pengampu->count_pengampu();
					
		$this->data['ta'] = $this->ref->get_ta_aktif();
		$this->data['sem'] = $this->ref->get_sem_aktif();
		
		if ($countUjian !== '0') {
			$colModel['nip'] = array('NIP',80,TRUE,'center',2);
			$colModel['nama'] = array('Nama',80,TRUE,'center',2);
			$colModel['mapel'] = array('Mata Pelajaran',180,TRUE,'center',2);
			$colModel['kelas'] = array('Kelas',80, TRUE,'center',2);					
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

			$grid_js = build_grid_js('flex1',site_url("pengampu/load_data"),$colModel,'nis','asc',$gridParams);
			$this->data['js_grid'] = $grid_js;		
		}		
		else {
			$this->data['js_grid'] = '<table class="table-common" width="760px">
					<tr>
						<th>NIP</th>
						<th>Nama</th>
						<th>Mata Pelajaran</th>
						<th>Kelas</th>						
						<th>Aksi</th>																		
					</tr>
					<tr>
						<td colspan="5"><center>Data tidak ditemukan</center></td>
					</tr>';
		}
		$this->LoadView('pengampu/view', $this->data);		
    }

    function load_data() {
        $this->load->library('flexigrid');     

		$valid_fields = array('nip', 'nama');
		$this->flexigrid->validate_post('r.kelas', 'ASC', $valid_fields);
		$records = $this->pengampu->get_pengampu_flexigrid();

		$this->output->set_header($this->config->item('json_header'));

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
				$row->id,               
                $row->nip,
                $row->nama,
				$row->mapel,
				$row->kelas,							
                "<a href='".base_url()."pengampu/detail/hapus/".$row->id."'>Hapus</a>&nbsp;&nbsp;&nbsp;"             
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {			
			if ($param == 'hapus') {
				if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
					if ($_POST['j_action'] == 'delete_pengampu' AND trim($id) !== '') {
						$this->db->delete('pengampu', array('id' => $id));
						$this->data['msg'] = setMessage('delete', 'pengampu');
						$this->LoadView('template/msg', $this->data);
					}
				}
				else {
					if (isset($id) AND trim($id) !== '') {
						$this->data['row'] = $this->pengampu->get_detail_pengampu($id);
						$this->LoadView('pengampu/hapus', $this->data);
					}
				}		
			}
			else
				redirect('pengampu');
		}
		else {
			redirect('pengampu');
		}		
	}
	
	function data($id = '') {		
				
		$this->form_validation->set_rules('nama', 'Guru', 'required|callback_cek_ketersediaan_guru');
								
		if ($this->form_validation->run() === FALSE) {	
			$this->data['ta'] = $this->ref->get_ta_aktif();
			$this->data['sem'] = $this->ref->get_sem_aktif();
			$this->data['tingkat'] = array('0' => '-- Silakan Pilih --', '1' => 'I', '2' => 'II', '3' => 'III');			
			$this->LoadView('pengampu/form', $this->data);
		}
		else {
			
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'add_param') {										
					$d = parseForm($_POST);								
					
					$this->db->insert('pengampu', $d);					
					$this->data['msg'] = setMessage('insert', 'pengampu');
					$this->LoadView('template/msg', $this->data);
				}
			} 
			else
				redirect('pengampu');
		}	
	}
	
	function lookup() {
		
		$keyword = strtolower($_POST['q']);  		
        $query = $this->pengampu->lookup($keyword); //Search DB
        if( ! empty($query) ) {
            foreach( $query as $row ) {
				if (strpos(strtolower($row->NAMA), $keyword) !== false) {
					$key = $row->NAMA;
					$nip = $row->NIP;
										
					echo "$key|$nip\n";
				}				
            }
        }       
    }
	
	function cek_ketersediaan_guru() {
		return TRUE;
	}
	
	function pilihmapel() {
		if('IS_AJAX') {			
        	$this->data['mapel'] = $this->pengampu->pilihmapel($_POST['mp']);		
			$this->LoadSingleView('pengampu/listmapel', $this->data); 
        }
	}
	
	function pilihkelas() {
		if('IS_AJAX') {			
        	$this->data['kelas'] = $this->pengampu->pilihkelas($_POST['mp']);		
			$this->LoadSingleView('pengampu/listkelas', $this->data); 
        }
	}
}
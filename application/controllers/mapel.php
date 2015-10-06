<?php
class mapel extends MY_Controller {

	var $data;
	
    function mapel() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));
        $this->load->model('Mapel_referensi', 'mapel');
		$this->load->model('referensi_model');		
    }

    function index() {
        $this->lists();
    }

    function lists() {
		if ($this->db->count_all('mp') !== '0') {
			$colModel['KDMP'] = array('Kode MP',80,TRUE,'center',2);
			$colModel['MP'] = array('Mata Pelajaran',180,TRUE,'left',2);
			$colModel['ALIAS'] = array('Alias',120,TRUE,'left',2);
			$colModel['TINGKAT'] = array('Tingkat',120,TRUE,'center',2);
			$colModel['PROG'] = array('Program',120, TRUE,'center',2);			
			$colModel['action'] = array('Aksi',60,FALSE,'center',0);

			$gridParams = array(
				'width' => 'auto',
				'height' => 'auto',
				'rp' => 10,
				'rpOptions' => '[10,20,30,40,50,60]',
				'pagestat' => 'Menampilkan: {from} sampai {to} dari {total} data.',
				'blockOpacity' => 0.5,
				'title' => '',
				'showTableToggleBtn' => false
			);

			$grid_js = build_grid_js('flex1',site_url("mapel/load_data"),$colModel,'KODEMP','asc',$gridParams);
			$this->data['js_grid'] = $grid_js;
		}
		else {
			$this->data['js_grid'] = '<table class="table-common" width="760px">
					<tr>
						<th>Kode MP</th>
						<th>Mata Pelajaran</th>
						<th>Alias</th>
						<th>Tingkat</th>
						<th>Program</th>
						<th>Aksi</th>						
					</tr>
					<tr>
						<td colspan="6"><center>Data tidak ditemukan</center></td>
					</tr>';
		}
        $this->LoadView('mapel/view', $this->data);
    }

    function load_data() {
        $this->load->library('flexigrid');     

		$valid_fields = array('KDMP', 'MP', 'PROG', 'ALIAS', 'NIP');
		$this->flexigrid->validate_post('KDMP', 'ASC', $valid_fields);
		$records = $this->mapel->get_mapel_flexigrid();

		$this->output->set_header($this->config->item('json_header'));
		$i = 1;
        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
				$row->ID,
				$row->KDMP,
                $row->MP,                
                $row->ALIAS,
				$row->TINGKAT,
				$row->PROG,				
				"<a href='".base_url()."mapel/data/".$row->ID."'>Edit</a>&nbsp;&nbsp;&nbsp;".
                "<a href='".base_url()."mapel/detail/hapus/".$row->ID."'>Hapus</a>&nbsp;&nbsp;&nbsp;"             
			);
			$i++;
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {
			if ($param == 'view') {
				if (isset($id) AND trim($id) !== '') {
					$this->data['row'] = $this->gurmod->get_detail_mapel($id);
					$this->LoadView('mapel/detail', $this->data);
				}
				else
					redirect('mapel');
			}
			else {
				if ($param == 'hapus') {
					if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
						if ($_POST['j_action'] == 'delete_mapel' AND trim($id) !== '') {
							$row = $this->mapel->get_detail_mapel($id);
							
							$this->db->delete('mp', array('ID' => $id));
							$this->data['msg'] = setMessage('delete', 'mapel');
							$this->LoadView('template/msg', $this->data);
						}
					}
					else {
						if (isset($id) AND trim($id) !== '') {
							$this->data['row'] = $this->mapel->get_detail_mapel($id);
							$this->LoadView('mapel/hapus', $this->data);
						}
					}		
				}
				else
					redirect('mapel');
			}
		}
		else {
			redirect('mapel');
		}		
	}
	
	function data($id = '') {		
		$tingkat = array('0' => '-- Silakan Pilih --', '1' => '1', '2' => '2', '3' => '3');		
		$program = array('0' => '-- Silakan Pilih --', '-' => '-', 'IPA' => 'IPA', 'IPS' => 'IPS', 'BAHASA' => 'BAHASA');
		
		$this->form_validation->set_rules('db_KDMP', 'Kode Mata Pelajaran', 'required');
		$this->form_validation->set_rules('db_MP', 'Mata Pelajaran', 'required');
		$this->form_validation->set_rules('db_ALIAS', 'Tempat Lahir', 'required');
				
		if ($this->form_validation->run() === FALSE) {
			
			if (isset($id) && trim($id) !== '') {				
				$this->data['row'] = $this->mapel->get_detail_mapel($id);								
			}
			$this->data['tingkat'] = $tingkat;
			$this->data['program'] = $program;
			$this->data['nip'] = $this->mapel->get_guru_mp();
			$this->LoadView('mapel/form', $this->data);
		}
		else {
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'update_param' AND trim($id) !== '') {
					$d = parseForm($_POST);					
					$this->db->update('mp', $d, array('ID' => $_POST['id_param']));
					$this->data['msg'] = setMessage('update', 'mapel');
					$this->LoadView('template/msg', $this->data);
				}
				else {															
					$d = parseForm($_POST);										
					$this->db->insert('mp', $d);
					$this->data['msg'] = setMessage('insert', 'mapel');
					$this->LoadView('template/msg', $this->data);
				}
			} 
		}	
	}
		
	function cek_kodemp() {
		$arr = $this->mapel->get_kode_mp($_POST['kdmp']);
		echo $arr;		
	}
}
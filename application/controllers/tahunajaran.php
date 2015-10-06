<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Tahunajaran extends MY_Controller {

	var $data;
	
    function __construct() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('tahunajaran_model', 'tahunajaran');		
    }

    function index() {
        $this->lists();
    }

    function lists() {
		$countTahunajaran = $this->tahunajaran->count_tahunajaran();
		
		if ($countTahunajaran) {
			$colModel['tahun'] = array('Tahun Ajaran',80,TRUE,'center',2);
			$colModel['mulai'] = array('Periode Awal',180,TRUE,'center',2);
			$colModel['akhir'] = array('Periode Akhir',120,TRUE,'center',2);
			$colModel['semester'] = array('Semester',120, TRUE,'center',2);
			$colModel['statusnya'] = array('Status',180,TRUE,'center',2);		
			$colModel['action'] = array('Aksi',120,FALSE,'center',0);

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

			$grid_js = build_grid_js('flex1',site_url("tahunajaran/load_data"),$colModel,'tingkat','asc',$gridParams);
			$this->data['js_grid'] = $grid_js;
		}
		else {
			$this->data['js_grid'] = '<table class="table-common" width="760px">
					<tr>
						<th>Tahun Ajaran</th>
						<th>Periode Awal</th>
						<th>Periode Akhir</th>
						<th>Semester</th>						
						<th>Status</th>						
						<th>Aksi</th>						
					</tr>
					<tr>
						<td colspan="6"><center>Data tidak ditemukan</center></td>
					</tr>';
		}
        $this->LoadView('tahunajaran/view', $this->data);
    }

    function load_data() {
        $this->load->library('flexigrid');     
		$valid_fields = array('tahun');
		$this->flexigrid->validate_post('id', 'ASC', $valid_fields);
		$records = $this->tahunajaran->get_tahunajaran_flexigrid();

		$this->output->set_header($this->config->item('json_header'));

        foreach ($records['records']->result() as $row) {
			if ($row->statusnya == 'tidak aktif') $aktifkan = "<a href='".base_url()."tahunajaran/aktifkan/".$row->id."'>Aktifkan</a>";
			else $aktifkan = '';
            $record_items[] = array(
				$row->id,
                $row->tahun,
                date('d-m-Y', strtotime($row->mulai)),
                date('d-m-Y', strtotime($row->akhir)),
				$row->semester,
				$row->statusnya,							
                "<a href='".base_url()."tahunajaran/detail/hapus/".$row->id."'>Hapus</a>&nbsp;&nbsp;&nbsp;".@$aktifkan   
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {			
			if ($param == 'hapus') {
				if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
					if ($_POST['j_action'] == 'delete_tahunajaran' AND trim($id) !== '') {
						$this->db->delete('tahunajaran', array('id' => $id));
						$this->data['msg'] = setMessage('delete', 'tahunajaran');
						$this->LoadView('template/msg', $this->data);
					}
				}
				else {
					if (isset($id) AND trim($id) !== '') {
						$this->data['row'] = $this->tahunajaran->get_detail_tahunajaran($id);
						$this->LoadView('tahunajaran/hapus', $this->data);
					}
				}		
			}
			else
				redirect('tahunajaran');
		}
		else {
			redirect('tahunajaran');
		}		
	}
	
	function data($id = '') {		
		
		$this->form_validation->set_rules('db_tahun', 'Tahun', 'required');
		$this->form_validation->set_rules('db_mulai', 'Periode Awal', 'required');
		$this->form_validation->set_rules('db_akhir', 'Periode Akhir', 'required');
				
		if ($this->form_validation->run() === FALSE) {		
			$this->data['sem'] = array('0' => '-- Silakan Pilih --', '1' => 'Ganjil', '2' => 'Genap');			
			$this->LoadView('tahunajaran/form', $this->data);
		}
		else {
			
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'add_param') {
					$d = parseForm($_POST);
					
					$this->db->insert('tahunajaran', $d);
					$this->data['msg'] = setMessage('insert', 'tahunajaran');
					$this->LoadView('template/msg', $this->data);
				}
			} 
			else
				redirect('tahunajaran');
		}	
	}
	
	function aktifkan($id) {
		if (isset($id) && trim($id) !== '') {
			$this->db->update('tahunajaran', array('statusnya' => 'tidak aktif'));
			$this->db->update('tahunajaran', array('statusnya' => 'aktif'), array('id' => $id));
			
			redirect('tahunajaran');
		}
	}
}
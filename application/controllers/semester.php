<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Semester extends MY_Controller {

	var $data;
	
    function __construct() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('semester_model', 'semester');		
    }

    function index() {
        $this->lists();
    }

    function lists() {
		$countsemester = $this->semester->count_semester();
		
		if ($countsemester) {			
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

			$grid_js = build_grid_js('flex1',site_url("semester/load_data"),$colModel,'tingkat','asc',$gridParams);
			$this->data['js_grid'] = $grid_js;
		}
		else {
			$this->data['js_grid'] = '<table class="table-common" width="760px">
					<tr>						
						<th>Semester</th>						
						<th>Status</th>						
						<th>Aksi</th>						
					</tr>
					<tr>
						<td colspan="3"><center>Data tidak ditemukan</center></td>
					</tr>';
		}
        $this->LoadView('semester/view', $this->data);
    }

    function load_data() {
        $this->load->library('flexigrid');     
		$valid_fields = array('tahun');
		$this->flexigrid->validate_post('id', 'ASC', $valid_fields);
		$records = $this->semester->get_semester_flexigrid();

		$this->output->set_header($this->config->item('json_header'));

        foreach ($records['records']->result() as $row) {
			if ($row->status_semester == 'tidak aktif') $aktifkan = "<a href='".base_url()."semester/aktifkan/".$row->id."'>Aktifkan</a>";
			else $aktifkan = '';
            $record_items[] = array(
				$row->id,                
				$row->nama_semester,
				$row->status_semester,							
                "<a href='".base_url()."semester/detail/hapus/".$row->id."'>Hapus</a>&nbsp;&nbsp;&nbsp;".@$aktifkan   
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {			
			if ($param == 'hapus') {
				if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
					if ($_POST['j_action'] == 'delete_semester' AND trim($id) !== '') {
						$this->db->delete('semester', array('id' => $id));
						$this->data['msg'] = setMessage('delete', 'semester');
						$this->LoadView('template/msg', $this->data);
					}
				}
				else {
					if (isset($id) AND trim($id) !== '') {
						$this->data['row'] = $this->semester->get_detail_semester($id);
						$this->LoadView('semester/hapus', $this->data);
					}
				}		
			}
			else
				redirect('semester');
		}
		else {
			redirect('semester');
		}		
	}
	
	function data($id = '') {		
		
		$this->form_validation->set_rules('db_nama_semester', 'Nama Semester', 'required');		
				
		if ($this->form_validation->run() === FALSE) {					
			$this->LoadView('semester/form', $this->data);
		}
		else {
			
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'add_param') {
					$d = parseForm($_POST);
					
					$this->db->insert('semester', $d);
					$this->data['msg'] = setMessage('insert', 'semester');
					$this->LoadView('template/msg', $this->data);
				}
			} 
			else
				redirect('semester');
		}	
	}
	
	function aktifkan($id) {
		if (isset($id) && trim($id) !== '') {
			$this->db->update('semester', array('status_semester' => 'tidak aktif'));
			$this->db->update('semester', array('status_semester' => 'aktif'), array('id' => $id));
			
			redirect('semester');
		}
	}
}
<?php
class absensi extends MY_Controller {

	var $data;
	
    function absensi() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('absensi_model', 'absensi');		
    }

    function index() {
        $this->lists();
    }

    function lists() {
        $colModel['nis'] = array('NIS',80,TRUE,'center',2);
		$colModel['nama'] = array('Nama',180,TRUE,'center',2);
		$colModel['tanggal'] = array('Tanggal',120,TRUE,'center',2);		
		$colModel['absen'] = array('Status',120,TRUE,'center',2);		
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

		$this->load->model('referensi_model', 'ref');
		$this->data['ta'] = $this->ref->get_ta_aktif();
		$this->data['sem'] = $this->ref->get_sem_aktif();
		
        $grid_js = build_grid_js('flex1',site_url("absensi/load_data"),$colModel,'nis','asc',$gridParams);
		$this->data['js_grid'] = $grid_js;
        $this->LoadView('absensi/view', $this->data);
    }

    function load_data() {
        $this->load->library('flexigrid');     

		$valid_fields = array('a.nis', 's.nama');
		$this->flexigrid->validate_post('a.nis', 'ASC', $valid_fields);
		$records = $this->absensi->get_absensi_flexigrid();

		$this->output->set_header($this->config->item('json_header'));

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
				$row->id,
                $row->nis,
                $row->nama,
                $row->tanggal,				
				$row->absen,				
                "<a href='".base_url()."absensi/detail/hapus/".$row->id."'>Hapus</a>&nbsp;&nbsp;&nbsp;"             
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
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
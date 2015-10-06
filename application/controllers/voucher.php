<?php
class voucher extends MY_Controller {

	var $data;
	
    function voucher() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('voucher_model', 'voucher');		
    }

    function index() {
        $this->lists();
    }

    function lists() {
        $colModel['NIS'] = array('NIS',80,TRUE,'center',2);
		$colModel['NAMA'] = array('Nama',180,TRUE,'center',2);
		$colModel['NOHP1'] = array('No. HP I',120,TRUE,'center',2);
		$colModel['NOHP2'] = array('No. HP II',120, TRUE,'center',2);
		$colModel['TGLAWAL'] = array('Tanggal Awal',180,TRUE,'center',2);
		$colModel['PULSA'] = array('Pulsa',120,TRUE,'center',2);
		$colModel['SISAPULSA'] = array('Sisa Pulsa',120, TRUE,'center',2);
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

        $grid_js = build_grid_js('flex1',site_url("voucher/load_data"),$colModel,'NIS','asc',$gridParams);
		$this->data['js_grid'] = $grid_js;
        $this->LoadView('voucher/view', $this->data);
    }

    function load_data() {
        $this->load->library('flexigrid');     

		$valid_fields = array('NIS', 'NAMA');
		$this->flexigrid->validate_post('NIS', 'ASC', $valid_fields);
		$records = $this->voucher->get_voucher_flexigrid();

		$this->output->set_header($this->config->item('json_header'));

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
				$row->id,
                $row->NIS,
                $row->NAMA,
                $row->NOHP1,
				$row->NOHP2,
				$row->TGLAWAL,
				$row->PULSA,
				$row->SISAPULSA,				
                "<a href='".base_url()."voucher/detail/hapus/".$row->id."'>Hapus</a>&nbsp;&nbsp;&nbsp;"             
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {			
			if ($param == 'hapus') {
				if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
					if ($_POST['j_action'] == 'delete_voucher' AND trim($id) !== '') {
						$this->db->delete('pulsa', array('id' => $id));
						$this->data['msg'] = setMessage('delete', 'voucher');
						$this->LoadView('template/msg', $this->data);
					}
				}
				else {
					if (isset($id) AND trim($id) !== '') {
						$this->data['row'] = $this->voucher->get_detail_voucher($id);
						$this->LoadView('voucher/hapus', $this->data);
					}
				}		
			}
			else
				redirect('voucher');
		}
		else {
			redirect('voucher');
		}		
	}
	
	function data($id = '') {		
				
		$this->form_validation->set_rules('db_NIS', 'NIS', 'required|callback_cek_deposit');
				
		if ($this->form_validation->run() === FALSE) {			
			$this->LoadView('voucher/form', $this->data);
		}
		else {
			
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'add_param') {
					$d = parseForm($_POST);
					$d['TGLAWAL'] = date('Y-m-d');
					$d['SISAPULSA'] = $_POST['db_PULSA'];
					
					$this->db->insert('pulsa', $d);
					$this->data['msg'] = setMessage('insert', 'voucher');
					$this->LoadView('template/msg', $this->data);
				}
			} 
			else
				redirect('voucher');
		}	
	}
	
	function cek_deposit($nis) {
		$q = $this->voucher->cek_deposit($nis);
		
		if ($q == TRUE) {
			$this->form_validation->set_message('cek_deposit', 'NIS '.$nis.' sudah melakukan deposit');
			return FALSE;
		}
		else
			return TRUE;
	}
	
	function lookup() {
		
		$keyword = strtolower($_POST['q']);  		
        $query = $this->voucher->lookup($keyword); //Search DB
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
	
}
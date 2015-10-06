<?php
class Kasus extends MY_Controller {

	var $data;
	
    function __construct() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));        
		$this->load->model('kasus_model', 'kasus');		
		$this->load->model('referensi_model', 'ref');
    }

    function index() {
        $this->lists();
    }

    function lists() {
		$this->data['ta'] = $this->ref->get_ta_aktif();
		$this->data['sem'] = $this->ref->get_sem_aktif();
		
        $colModel['tanggal'] = array('Tanggal',80,TRUE,'center',2);
		$colModel['NAMA'] = array('Nama',180,TRUE,'center',2);
		$colModel['kasus'] = array('Kasus',120,TRUE,'center',2);
		$colModel['tahun'] = array('Tahun',120, TRUE,'center',2);
		$colModel['keterangan'] = array('Keterangan',180,TRUE,'center',2);
		$colModel['kirimsms'] = array('Status',120,TRUE,'center',2);		
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

        $grid_js = build_grid_js('flex1',site_url("kasus/load_data"),$colModel,'nis','asc',$gridParams);
		$this->data['js_grid'] = $grid_js;
        $this->LoadView('kasus/view', $this->data);
    }

    function load_data() {
        $this->load->library('flexigrid');     
		$idtahun = $this->ref->get_id_tahunajaran();
		
		$valid_fields = array('kasus.nis', 'siswa.nama');
		$this->flexigrid->validate_post('kasus.nis', 'ASC', $valid_fields);
		$records = $this->kasus->get_kasus_flexigrid($idtahun);

		$this->output->set_header($this->config->item('json_header'));

        foreach ($records['records']->result() as $row) {
			if ($row->kirimsms == '0') $msg = 'Tidak Kirim SMS'; else $msg = 'Kirim SMS';
            $record_items[] = array(
				$row->id,
                date('d-m-Y', strtotime($row->tanggal)),
                $row->NAMA,
                $row->kasus,
				$row->tahun,
				$row->keterangan,
				$msg,				
                "<a href='".base_url()."kasus/detail/hapus/".$row->id."'>Hapus</a>&nbsp;&nbsp;&nbsp;"             
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {			
			if ($param == 'hapus') {
				if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
					if ($_POST['j_action'] == 'delete_kasus' AND trim($id) !== '') {
						$this->db->delete('kasus', array('id' => $id));
						$this->data['msg'] = setMessage('delete', 'kasus');
						$this->LoadView('template/msg', $this->data);
					}
					else 
						redirect('kasus');
				}
				else {
					if (isset($id) AND trim($id) !== '') {
						$idtahun = $this->ref->get_id_tahunajaran();
						$this->data['row'] = $this->kasus->get_detail_kasus($id, $idtahun);
						$this->LoadView('kasus/hapus', $this->data);
					}
				}		
			}
			else
				redirect('kasus');
		}
		else {
			redirect('kasus');
		}		
	}
	
	function data($id = '') {		
				
		$this->form_validation->set_rules('db_tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('db_NIS', 'NIS', 'required');
		$this->form_validation->set_rules('db_kasus', 'Kasus', 'required');
		$this->form_validation->set_rules('db_keterangan', 'Keterangan', 'required');
				
		if ($this->form_validation->run() === FALSE) {	
			$this->data['sem'] = $this->ref->get_sem_aktif();
			$this->data['tahun'] = $this->ref->get_id_tahunajaran();
			$this->LoadView('kasus/form', $this->data);
		}
		else {
			
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'add_param') {
					$d = parseForm($_POST);					
					$this->db->insert('kasus', $d);
										
					if ($_POST['db_kirimsms'] == '1') {
						/* cek apakah ada biaya potong pulsa */
						$pot = $this->kasus->cek_potongan_aktif();
						
						if ($pot->stat_potong_pulsa == '1') {
							$this->db->query("UPDATE pulsa SET SISAPULSA = SISAPULSA - ".$pot->biayapotong." WHERE NIS='".$_POST['db_NIS']."'");														
						}
						
						//$dep = $this->kasus->cek_deposit($_POST['db_NIS']);					
						$f['DestinationNumber'] = $_POST['hportu'];
						$f['TextDecoded'] = $_POST['sms'];
						
						//$this->db->insert('outbox', $f);
					}
					$this->data['msg'] = setMessage('insert', 'kasus');
					$this->LoadView('template/msg', $this->data);
				}
			} 
			else
				redirect('kasus');
		}	
	}
	
	function lookup() {
		
		$keyword = strtolower($_POST['q']);  		
        $query = $this->kasus->lookup($keyword); //Search DB
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
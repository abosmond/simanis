<?php
class siswa extends MY_Controller {

	var $data;
	
    function siswa() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));
        $this->load->model('siswa_model', 'siswa');		
		$this->load->model('referensi_model');
    }

    function index() {
        $this->lists();
    }

    function lists() {		
		$records = $this->siswa->count_siswa();
		
		if ($records['record_count'] !== '0') {
			$colModel['NIS'] = array('NIS',80,TRUE,'left',2);
			$colModel['NAMA'] = array('Nama',180,TRUE,'left',2);
			$colModel['ALAMAT'] = array('Alamat',120,TRUE,'left',2);
			$colModel['tahun'] = array('Tahun Masuk',120,TRUE,'left',2);
			$colModel['NOHP1'] = array('No. HP Siswa',120, TRUE,'left',2);
			$colModel['TELP'] = array('Telp. Orang Tua',120, TRUE,'left',2);		
			$colModel['action'] = array('Aksi',60,FALSE,'center',0);

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

			$grid_js = build_grid_js('flex1',site_url("siswa/load_data"),$colModel,'NIP','asc',$gridParams);
			$this->data['js_grid'] = $grid_js;
			
		}
		else {
			$this->data['js_grid'] = '<table class="table-common" width="760px">
					<tr>
						<th>NIS</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Tahun Masuk</th>						
						<th>No. HP Siswa</th>
						<th>Telp. Orang Tua</th>
						<th>Aksi</th>						
					</tr>
					<tr>
						<td colspan="7"><center>Data tidak ditemukan</center></td>
					</tr>';			
		}
		$this->LoadView('siswa/view', $this->data);
    }

    function load_data() {
        $this->load->library('flexigrid');     

		$valid_fields = array('NIS', 'NAMA', 'NOHP1', 'tahun');
		$this->flexigrid->validate_post('NIS', 'ASC', $valid_fields);
		$records = $this->siswa->get_siswa_flexigrid();

		$this->output->set_header($this->config->item('json_header'));

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
				$row->NIS,
				$row->NIS,
                 "<a href='".base_url()."siswa/detail/view/".$row->NIS."'>".$row->NAMA."</a>&nbsp;&nbsp;&nbsp;",
				$row->ALAMAT,				
				$row->tahun,
				$row->NOHP1,
				$row->TELP,								
				"<a href='".base_url()."siswa/data/".$row->NIS."'>Edit</a>&nbsp;&nbsp;&nbsp;".
                "<a href='".base_url()."siswa/detail/hapus/".$row->NIS."'>Hapus</a>&nbsp;&nbsp;&nbsp;"             
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {
			if ($param == 'view') {
				if (isset($id) AND trim($id) !== '') {
					$this->data['row'] = $this->siswa->get_detail_siswa($id);
					$this->LoadView('siswa/detail', $this->data);
				}
				else
					redirect('siswa');
			}
			else {
				if ($param == 'hapus') {
					if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
						if ($_POST['j_action'] == 'delete_siswa' AND trim($id) !== '') {
							$row = $this->siswa->get_detail_siswa($id);
							
							if ($row->FOTO !== '') {
								@unlink($_SERVER['DOCUMENT_ROOT'].'tests/uploadpic/'.trim($row->FOTO));
							}
							$this->db->delete('siswa', array('ID' => $id));
							$this->data['msg'] = setMessage('delete', 'siswa');
							$this->LoadView('template/msg', $this->data);
						}
					}
					else {
						if (isset($id) AND trim($id) !== '') {
							$this->data['row'] = $this->siswa->get_detail_siswa($id);
							$this->LoadView('siswa/hapus', $this->data);
						}
					}		
				}
				else
					redirect('siswa');
			}
		}
		else {
			redirect('siswa');
		}		
	}
	
	function data($id = '') {		
				
		$this->form_validation->set_rules('db_NAMA', 'Nama', 'required');
		$this->form_validation->set_rules('db_NIS', 'NIS', 'required');
		$this->form_validation->set_rules('db_TMPLHR', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('db_ALAMAT', 'Alamat', 'required');
		$this->form_validation->set_rules('db_NOHP1', 'No. Telp', 'required');		
		
		if ($this->form_validation->run() === FALSE) {
			
			if (isset($id) && trim($id) !== '') {				
				$this->data['row'] = $this->siswa->get_detail_siswa($id);								
			}
			$this->data['agama'] = $this->referensi_model->get_data_ref('agama');
			$this->data['jabatan'] = $this->referensi_model->get_data_ref('jabatan');
			$this->data['jk'] = $this->referensi_model->get_data_ref('jk');
			$this->LoadView('siswa/form', $this->data);
		}
		else {
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'update_param' AND trim($id) !== '') {
					$d = parseForm($_POST);
					$d['TGLLHR'] = parseFormTgl('tgllhr');
					
					$this->db->update('siswa', $d, array('NIS' => $_POST['id_param']));					
					$this->data['msg'] = setMessage('update', 'siswa');
					$this->LoadView('template/msg', $this->data);
				}
				else {															
					$d = parseForm($_POST);
					$d['TGLLHR'] = parseFormTgl('tgllhr');
					
					$this->db->insert('siswa', $d);
					$this->data['msg'] = setMessage('insert', 'siswa');
					$this->LoadView('template/msg', $this->data);
				}
			} 
		}	
	}
		
	function cek_nis() {
		$arr = $this->siswa->get_nip_siswa($_POST['NIP']);
		echo $arr;		
	}
	
	function upload($id='') {
		$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'tests/uploadpic';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite']	= TRUE;
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['remove_spaces']  = TRUE;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload()) {
			echo 'wakawaka';
		}
		else {
			$a = $this->upload->data();
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $_SERVER['DOCUMENT_ROOT'].'tests/uploadpic/'.trim($a['file_name']);
			$config2['create_thumb'] = FALSE;
			$config2['maintain_ratio'] = TRUE;
			$config2['width'] = 300;
			$config2['height'] = 125;

			$this->load->library('image_lib', $config2);
			$this->image_lib->resize();
			
			if ($id) {
				$row = $this->siswa->get_detail_siswa($id);
				@unlink($_SERVER['DOCUMENT_ROOT'].'tests/uploadpic/'.trim($row->Photo));
				$this->db->update('siswa', array('Photo' => trim($a['file_name'])), array('NIS' => $id));
			}
			echo 'success'.$a['file_name'];
		}
	}
	
	function excel() {
		if (isset($_POST['j_action']) && $_POST['j_action'] == 'add_siswa') {
			$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/simanis/excel/';
			$config['allowed_types'] = 'xls';
			$config['overwrite']	= TRUE;
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['remove_spaces']  = TRUE;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload()) {
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			}
			else {
				$a = $this->upload->data();				
				$this->load->library('excel_reader');
				
				$this->excel_reader->setOutputEncoding('CP1251');
				$this->excel_reader->read($a['full_path']);
				
				error_reporting(E_ALL ^ E_NOTICE);
			
				$data = $this->excel_reader->sheets[0] ;
								
				for ($i = 2; $i <= $data['numRows']; $i++) {
					
					$arr = $this->db->get_where('siswa', array('NIS' => $data['cells'][$i][1]));
					
					if ($arr->num_rows() > 0) {					
						$false[] = 'NIS '.$data['cells'][$i][1].' untuk siswa '.$data['cells'][$i][2].' sudah digunakan';
					}
					else {
						for ($j = 2; $j <= $data['numCols']; $j++) {						
												
						$d = explode('/', $data['cells'][$i][5]);
						$date = $d[2].'-'.$d[1].'-'.$d[0];
						
						$f['NIS'] 			= $data['cells'][$i][1];
						$f['NAMA']			= $data['cells'][$i][2];
						$f['ALAMAT']		= $data['cells'][$i][3];
						$f['TMPLHR']		= $data['cells'][$i][4];
						$f['TGLLHR']		= $date;
						$f['tahun']			= $data['cells'][$i][6];			
						$f['AGAMA']			= $data['cells'][$i][7];
						$f['JK']			= $data['cells'][$i][8];
						$f['NOHP1']			= $data['cells'][$i][9];
						$f['NAMAAYAH']		= $data['cells'][$i][10];
						$f['PEKERJAANAYAH']	= $data['cells'][$i][11];
						$f['NAMAIBU']		= $data['cells'][$i][12];
						$f['PEKERJAANIBU']	= $data['cells'][$i][13];
						$f['ALAMAT2']		= $data['cells'][$i][14];
						$f['TELP']			= $data['cells'][$i][15];					
						}						
						$this->db->insert('siswa', $f);						
						$true[] = 'NIS '.$data['cells'][$i][1].' untuk siswa '.$data['cells'][$i][2].' sukses ditambahkan';
					}						
				}	
				$this->data['false'] = $false;
				$this->data['true']	 = $true;
				$this->LoadView('siswa/excel', $this->data);
			}
		}
		else {
			$this->data['false'] = FALSE;
			$this->data['true']	 = FALSE;
			$this->LoadView('siswa/excel', $this->data);
		}
	}
	
	function template() {
		$this->load->helper('download');
		$data = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/simanis/excel/template.xls');
		$filename = 'template_siswa_'.date('d-m-Y').'.xls';
		
		force_download($filename, $data);
	}
}
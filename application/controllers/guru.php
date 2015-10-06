<?php
class guru extends MY_Controller {

	var $data;
	
    function guru() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));
        $this->load->model('gurmod');
		$this->load->model('referensi_model');		
    }

    function index() {
        $this->lists();
    }

    function lists() {
		$colModel['NIP'] = array('NIP',80,TRUE,'center',2);
		$colModel['NAMA'] = array('Nama',180,TRUE,'left',2);
		$colModel['JABATAN'] = array('Jabatan',120,TRUE,'center',2);
		$colModel['JK'] = array('Jenis Kelamin',80, TRUE,'center',2);
		$colModel['action'] = array('Aksi',100,FALSE,'center',0);
		
		$gridParams = array(
		'width' => 630,
		'height' => 400,
		'rp' => 15,
		'rpOptions' => '[10,15,20,25,40]',
		'pagestat' => 'Menampilkan: {from} sampai {to} dari {total} data.',
		'blockOpacity' => 0.5,
		'title' => '',
		'showTableToggleBtn' => FALSE
		);
		
		$grid_js = build_grid_js('flex1',site_url("guru/load_data"),$colModel,'NIP','asc',$gridParams);
		$this->data['js_grid'] = $grid_js;
        $this->LoadView('guru/view', $this->data);
       
    }

    function load_data() {
        $this->load->library('flexigrid');     

		$valid_fields = array('NIP', 'NAMA', 'JABATAN', 'JK');
		$this->flexigrid->validate_post('NIP', 'ASC', $valid_fields);
		$records = $this->gurmod->get_merk_flexigrid();

		$this->output->set_header($this->config->item('json_header'));

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
				$row->ID,
                $row->NIP,
                "<a href='".base_url()."guru/detail/view/".$row->ID."'>".$row->NAMA."</a>&nbsp;&nbsp;&nbsp;",
                $row->JABATAN,
				$row->JK,
				"<a href='".base_url()."guru/data/".$row->ID."'>Edit</a>&nbsp;&nbsp;&nbsp;".
                "<a href='".base_url()."guru/detail/hapus/".$row->ID."'>Hapus</a>&nbsp;&nbsp;&nbsp;"             
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items)); 
		
    }
	
	function detail($param, $id = '') {
		if (isset($param) AND $param !== '') {
			if ($param == 'view') {
				if (isset($id) AND trim($id) !== '') {
					$this->data['row'] = $this->gurmod->get_detail_guru($id);
					if (!$this->data['row']) {
						redirect('guru');
					}
					else 
						$this->LoadView('guru/detail', $this->data);
				}
				else
					redirect('guru');
			}
			else {
				if ($param == 'hapus') {
					if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
						if ($_POST['j_action'] == 'delete_guru' AND trim($id) !== '') {
							$row = $this->gurmod->get_detail_guru($id);
							
							if ($row->FOTO !== '') {
								@unlink($_SERVER['DOCUMENT_ROOT'].'tests/uploadpic/'.trim($row->FOTO));
							}
							$this->db->delete('guru', array('ID' => $id));
							$this->data['msg'] = setMessage('delete', 'guru');
							$this->LoadView('template/msg', $this->data);
						}
					}
					else {
						if (isset($id) AND trim($id) !== '') {
							$this->data['row'] = $this->gurmod->get_detail_guru($id);
							if (!$this->data['row']) {
								redirect('guru');
							}
							else 
								$this->LoadView('guru/hapus', $this->data);
						}
					}		
				}
				else
					redirect('guru');
			}
		}
		else {
			redirect('guru');
		}		
	}
	
	function data($id = '') {		
				
		$this->form_validation->set_rules('db_NAMA', 'Nama', 'required');
		$this->form_validation->set_rules('db_NIP', 'NIP', 'required');
		$this->form_validation->set_rules('db_TMPLHR', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('db_ALAMAT', 'Alamat', 'required');
		$this->form_validation->set_rules('db_NOTLP', 'No. Telp', 'required');		
		
		if ($this->form_validation->run() === FALSE) {
			
			if (isset($id) && trim($id) !== '') {				
				$this->data['row'] = $this->gurmod->get_detail_guru($id);								
			}
			$this->data['agama'] = $this->referensi_model->get_data_ref('agama');
			$this->data['jabatan'] = $this->referensi_model->get_data_ref('jabatan');
			$this->data['jk'] = $this->referensi_model->get_data_ref('jk');
			$this->LoadView('guru/form', $this->data);
		}
		else {
			if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {
				if ($_POST['j_action'] == 'update_param' AND trim($id) !== '') {
					$d = parseForm($_POST);
					$d['TGLLHR'] = parseFormTgl('tgllhr');
					$this->db->update('guru', $d, array('ID' => $_POST['id_param']));
					$this->data['msg'] = setMessage('update', 'guru');
					$this->LoadView('template/msg', $this->data);
				}
				else {															
					$d = parseForm($_POST);
					$d['TGLLHR'] = parseFormTgl('tgllhr');
					
					$this->db->insert('guru', $d);
					$this->data['msg'] = setMessage('insert', 'guru');
					$this->LoadView('template/msg', $this->data);
				}
			} 
		}	
	}
		
	function cek_nip() {
		$arr = $this->gurmod->get_nip_guru($_POST['NIP']);
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
			echo 'error';
		}
		else {
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $_SERVER['DOCUMENT_ROOT'].'tests/uploadpic/'.trim($_FILES['userfile']['name']);
			$config2['create_thumb'] = FALSE;
			$config2['maintain_ratio'] = TRUE;
			$config2['width'] = 300;
			$config2['height'] = 125;

			$this->load->library('image_lib', $config2);
			$this->image_lib->resize();
			
			if ($id) {
				$row = $this->gurmod->get_detail_guru($id);
				$this->db->update('guru', array('FOTO' => trim($_FILES['userfile']['name'])), array('ID' => $id));
			}
			echo 'success'.trim($_FILES['userfile']['name']);
		}
	}
	
	function delete_file($file='', $id='') {
		
		if ($id) {
			$row = $this->gurmod->get_detail_guru($id);
			$this->db->update('guru', array('FOTO' => NULL), array('ID' => $id));
		}
		unlink($_SERVER['DOCUMENT_ROOT'].'tests/uploadpic/'.trim($file));
			echo 'ok';
				
	}
}
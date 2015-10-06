<?php
class Rekapabsensi extends MY_Controller {

	var $data;
	
    function __construct() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));
        $this->load->model('rekapabsensi_model', 'rekapabsensi');		
		$this->load->model('referensi_model');
    }

    function index() {
		$this->form_validation->set_rules('tglawal', 'Periode Awal', 'required');
		$this->form_validation->set_rules('tglakhir', 'Periode Akhir', 'required');
		$this->form_validation->set_rules('nis', 'NIS', 'required');
		
		if ($this->form_validation->run() === FALSE) {		
			$this->data['kelas'] = $this->rekapabsensi->get_kelas();
			$this->LoadView('rekapabsensi/view', $this->data);
        }
		else {
			
		}
    }

    function lists() {
		if ($_POST['j_action'] == 'add_rekap') {
			$colModel['nis'] = array('NIS',80,TRUE,'center',2);
			$colModel['nama'] = array('Nama',180,TRUE,'center',2);
			$colModel['tanggal'] = array('Tanggal',120,TRUE,'center',2);		
			$colModel['absen'] = array('Status',120,TRUE,'center',2);							

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
			
			$grid_js = build_grid_js('flex1',site_url("rekapabsensi/load_data/".$_POST['tglawal'].'/'.$_POST['tglakhir'].'/'.$_POST['nis'].'/'.$_POST['kelas']),$colModel,'k.nis','asc',$gridParams);
			$this->data['js_grid'] = $grid_js;
			$this->data['url'] = $_POST;
			$this->LoadSingleView('rekapabsensi/list', $this->data);
		}
		else {
			echo '<table class="table-common" width="760px">
					<tr>
						<th>NIS</th>
						<th>Nama</th>
						<th>Jumlah</th>						
					</tr>
					<tr>
						<td colspan="4"><center>Data tidak ditemukan</center></td>
					</tr>';
		}
    }

    function load_data($id1, $id2, $id3, $id4) {
        $this->load->library('flexigrid');     

		$valid_fields = array('a.nis', 's.nama');
		$this->flexigrid->validate_post('a.nis', 'ASC', $valid_fields);
		
		$d = array($id1, $id2, $id3, $id4);
		$records = $this->rekapabsensi->get_rekapabsensi_flexigrid($d);
		
		$this->output->set_header($this->config->item('json_header'));

		foreach ($records['records']->result() as $row) {
            $record_items[] = array(
				$row->id,
                $row->nis,
                $row->nama,
                $row->tanggal,				
				$row->absen               
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));		
    }
		
	function data($nis = '', $idtingkat = '') {	
		if ($nis !== '' && $idtingkat !== '') {		
			if (!$_POST) {	
				$this->data['siswa'] = $this->rekapabsensi->get_nama_siswa($this->uri->segment(3));
				$this->data['tahunajaran'] = $this->rekapabsensi->get_tahun_ajaran();
				$this->data['mapel'] = $this->rekapabsensi->get_mapel_for_score($idtingkat);
				$this->data['rekapabsensisiswa'] = $this->rekapabsensi->get_rekapabsensi_siswa($nis);
				$this->LoadView('rekapabsensi/form', $this->data);
			}		
			else {
				if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {				
					if ($_POST['j_action'] == 'add_rekapabsensi') {
						$arr = $this->db->get_where('semester', array('status_semester' => 'aktif'));
						$q = $arr->row();
						
						for ($i = 0; $i < sizeof($_POST['db_kdmp']); $i++) {
							$esx = $this->rekapabsensi->cek_rekapabsensi_siswa($_POST['nis'], $_POST['db_kdmp'][$i], $_POST['tahunajaran']);
							if ($esx) {
								if ($_POST['db_rekapabsensi'][$i] !== '') {
									$this->db->update('rekapabsensi', array('rekapabsensi' => $_POST['db_rekapabsensi'][$i]), array('nis' => $_POST['nis'], 'kdmp' => $_POST['db_kdmp'][$i], 'idtahun' => $_POST['tahunajaran']));
								}
							}
							else {
								if ($_POST['db_rekapabsensi'][$i] !== '') {
									$d['nis']		= $_POST['nis'];
									$d['kdmp']		= $_POST['db_kdmp'][$i];
									$d['rekapabsensi']		= $_POST['db_rekapabsensi'][$i];
									$d['nip']		= $_POST['db_nip'][$i];
									$d['idtahun']	= $_POST['tahunajaran'];
									$d['sem']		= $q->id;
									$this->db->insert('rekapabsensi', $d);
								}
							}
						}
						$this->data['msg'] = setMessage('insert', 'rekapabsensi');
						$this->LoadView('template/msg', $this->data);
					}
				}
			}
		}
		else
			redirect('rekapabsensi');		
	}	
	
	function kirimsms($nis = '', $kelas = '') {
		if ($nis !== '' && $kelas !== '') {
			if (isset($_POST['j_action']) && $_POST['j_action'] == 'kirim_sms') {
				
				$rekapabsensi = $this->rekapabsensi->get_report_rekapabsensi($nis);
				$msg = 'rekapabsensi '.$_POST['namasiswa'].' Sem:'.$_POST['semester'].'. ';
				$nl = '';$i = 1;
				foreach ($rekapabsensi->result() as $key) {
					if ($i == 1) 
						$nl = $key->ALIAS.':'.$key->rekapabsensi;
					else 
						$nl .= ','.$key->ALIAS.':'.$key->rekapabsensi;
					$i++;
				}
				$msg .= $nl;
				
				$siswa = $this->rekapabsensi->get_telp_ortu($nis);
				
				if ($siswa) {
					$f['DestinationNumber']	= $siswa->TELP;
					$f['TextDecoded']		= $msg;
					
					$this->db->insert('outbox_multipart', $f);
					$this->data['msg'] = setMessage('insert', 'rekapabsensi');
					$this->LoadView('template/msg', $this->data);
				}
			}
			else {
				$this->data['sem']	 = $this->rekapabsensi->get_sem_aktif();
				$this->data['siswa'] = $this->rekapabsensi->get_nama_siswa($nis);
				$this->data['rekapabsensi'] = $this->rekapabsensi->get_report_rekapabsensi($nis);
				$this->LoadView('rekapabsensi/smsrekapabsensi', $this->data);
			}
		}
		else {
			redirect('rekapabsensi');
		}
	}
	
	function ekspor($param1, $param2, $param3, $param4) {
		$d = array($param1, $param2, $param3, $param4);
		$this->load->library('flexigrid');     

		$valid_fields = array('a.nis', 's.nama');
		$this->flexigrid->validate_post('a.nis', 'ASC', $valid_fields);
		$this->data['records'] = $this->rekapabsensi->get_rekapabsensi_flexigrid($d);
		$this->data['tgl'] = $d;
		
		$this->LoadSingleView('rekapabsensi/excel', $this->data);
	}
}
<?php
class Nilai extends MY_Controller {

	var $data;
	
    function __construct() {
		parent::Controller();        
        $this->load->helper(array('flexigrid', 'string'));
        $this->load->model('nilai_model', 'nilai');		
		$this->load->model('referensi_model');
    }

    function index() {
		$this->data['kelas'] = $this->nilai->get_kelas();
		$this->LoadView('nilai/view', $this->data);
        
    }

    function lists($id) {
		$this->load->library('flexigrid');     

		$valid_fields = array('k.nis', 's.NAMA');
		$this->flexigrid->validate_post('k.nis', 'ASC', $valid_fields);
		$records = $this->nilai->get_nilai_flexigrid($id);
		
		if ($records['record_count'] !== '0') {
			$colModel['nis'] = array('NIS',80,TRUE,'left',2);
			$colModel['NAMA'] = array('Nama',180,TRUE,'left',2);				
			$colModel['total'] = array('Jumlah / Total Mata Pelajaran',180,TRUE,'left',2);				
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
			
			$grid_js = build_grid_js('flex1',site_url("nilai/load_data/$id"),$colModel,'k.nis','asc',$gridParams);
			$this->data['js_grid'] = $grid_js;
			$this->LoadSingleView('nilai/list', $this->data);
		}
		else {
			echo '<table class="table-common" width="760px">
					<tr>
						<th>NIS</th>
						<th>Nama</th>
						<th>Jumlah</th>
						<th>Aksi</th>						
					</tr>
					<tr>
						<td colspan="4"><center>Data tidak ditemukan</center></td>
					</tr>';
		}
    }

    function load_data($id) {
        $this->load->library('flexigrid');     

		$valid_fields = array('k.nis', 's.NAMA');
		$this->flexigrid->validate_post('k.nis', 'ASC', $valid_fields);
		$records = $this->nilai->get_nilai_flexigrid($id);
		
		$this->output->set_header($this->config->item('json_header'));

		foreach ($records['records']->result() as $row) {
			$tot = $this->nilai->get_total_mapel($row->id);
			$jml = $this->nilai->get_jumlah_mapel($row->nis);
			$record_items[] = array(
				$row->id,
				$row->nis,
				$row->NAMA,            
				$jml->jumlah.' / '.$tot->total,
				"<a href='".base_url()."nilai/data/".$row->nis."/".$row->id."'>Lihat</a>&nbsp;&nbsp;&nbsp;"                
			);
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));		
    }
		
	function data($nis = '', $idtingkat = '') {	
		if ($nis !== '' && $idtingkat !== '') {		
			if (!$_POST) {	
				$this->data['siswa'] = $this->nilai->get_nama_siswa($this->uri->segment(3));
				$this->data['tahunajaran'] = $this->nilai->get_tahun_ajaran();
				$this->data['mapel'] = $this->nilai->get_mapel_for_score($idtingkat);
				$this->data['nilaisiswa'] = $this->nilai->get_nilai_siswa($nis);
				$this->LoadView('nilai/form', $this->data);
			}		
			else {
				if (isset($_POST['j_action']) AND $_POST['j_action'] !== '') {				
					if ($_POST['j_action'] == 'add_nilai') {
						$arr = $this->db->get_where('semester', array('status_semester' => 'aktif'));
						$q = $arr->row();
						
						for ($i = 0; $i < sizeof($_POST['db_kdmp']); $i++) {
							$esx = $this->nilai->cek_nilai_siswa($_POST['nis'], $_POST['db_kdmp'][$i], $_POST['tahunajaran']);
							if ($esx) {
								if ($_POST['db_nilai'][$i] !== '') {
									$this->db->update('nilai', array('nilai' => $_POST['db_nilai'][$i]), array('nis' => $_POST['nis'], 'kdmp' => $_POST['db_kdmp'][$i], 'idtahun' => $_POST['tahunajaran']));
								}
							}
							else {
								if ($_POST['db_nilai'][$i] !== '') {
									$d['nis']		= $_POST['nis'];
									$d['kdmp']		= $_POST['db_kdmp'][$i];
									$d['nilai']		= $_POST['db_nilai'][$i];
									$d['nip']		= $_POST['db_nip'][$i];
									$d['idtahun']	= $_POST['tahunajaran'];
									$d['sem']		= $q->id;
									$this->db->insert('nilai', $d);
								}
							}
						}
						redirect('nilai/data/'.$nis.'/'.$idtingkat);
						// $this->data['msg'] = setMessage('insert', 'nilai');
						// $this->LoadView('template/msg', $this->data);
					}
				}
			}
		}
		else
			redirect('nilai');		
	}	
	
	function kirimsms($nis = '', $kelas = '') {
		if ($nis !== '' && $kelas !== '') {
			if (isset($_POST['j_action']) && $_POST['j_action'] == 'kirim_sms') {
				
				$nilai = $this->nilai->get_report_nilai($nis);
				$msg = 'Nilai '.$_POST['namasiswa'].' Sem:'.$_POST['semester'].'. ';
				$nl = '';$i = 1;
				foreach ($nilai->result() as $key) {
					if ($i == 1) 
						$nl = $key->ALIAS.':'.$key->nilai;
					else 
						$nl .= ','.$key->ALIAS.':'.$key->nilai;
					$i++;
				}
				$msg .= $nl;
				
				$siswa = $this->nilai->get_telp_ortu($nis);
				
				if ($siswa) {
					$f['DestinationNumber']	= $siswa->TELP;
					$f['TextDecoded']		= $msg;
					
					$this->db->insert('outbox_multipart', $f);
					$this->data['msg'] = setMessage('insert', 'nilai');
					$this->LoadView('template/msg', $this->data);
				}
			}
			else {
				$this->data['sem']	 = $this->nilai->get_sem_aktif();
				$this->data['siswa'] = $this->nilai->get_nama_siswa($nis);
				$this->data['nilai'] = $this->nilai->get_report_nilai($nis);
				$this->loadView('nilai/smsnilai', $this->data);
			}
		}
		else {
			redirect('nilai');
		}
	}
}
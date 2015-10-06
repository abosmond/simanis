<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Kenaikankelas_model extends Model {

	function __construct() {
		parent::Model();
		$this->CI = & get_instance();
	}
	
	function list_siswa_perkelas($idkelas, $idtahun) {
		$idnow = $idtahun + 1;
		$arr = $this->db->query("SELECT `kelas`.`id`, `siswa`.`NIS`, `NAMA` FROM (`kelas`) JOIN `siswa` ON `siswa`.`NIS`=`kelas`.`nis` WHERE `idkelas` = '".$idkelas."' AND `idtahun` = '".$idtahun."' AND `kelas`.`nis` NOT IN (SELECT `nis` FROM kelas WHERE idtahun='".$idnow."')");
		
		if ($arr->num_rows() > 0) {						
			foreach ($arr->result() as $q) {
				$d[$q->NIS] = $q->NAMA;			
			}				
			return $d;
		}
		else
			return FALSE;
	}
	
	function list_siswa_sudah_naik_kelas($idkelas, $idtahun) {
		$this->db->select('kelas.id, siswa.NIS, NAMA')->from('kelas')->join('siswa', 'siswa.NIS=kelas.nis')->where(array('idkelas' => $idkelas, 'idtahun' => $idtahun));
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) {					
			foreach ($arr->result() as $q) {
				$d[$q->NIS] = $q->NAMA;						
			}			
			return $d;
		}
		else
			return FALSE;
	}
	
	function list_kelas_tujuan($kelas) {
		$tingkat = $this->get_tingkat_from_kelas($kelas);
		$arr = $this->db->query("SELECT * FROM refkelas WHERE tahun=(SELECT id FROM tahunajaran WHERE statusnya='aktif') AND tingkat='".$tingkat."' + 1");
		
		if ($arr->num_rows() > 0) {
			$f[0] = '-- Silakan Pilih --';
			foreach ($arr->result() as $q) {
				$f[$q->id] = $q->kelas;
			}
			return $f;
		}
		else
			return FALSE;
	}
	
	function get_tingkat_from_kelas($kelas) {
		$arr = $this->db->get_where('refkelas', array('id' => $kelas));
		$q = $arr->row();
		
		return $q->tingkat;
	}
	
	function get_data_kenaikankelas() {
		$arr = $this->db->query("SELECT * FROM refkelas WHERE tahun=((SELECT id FROM tahunajaran WHERE statusnya='aktif') - 1) AND (tingkat='1' OR tingkat='2')");
		
		$data = array();
		$data[0] = '-- Silakan Pilih --';
		
		foreach ($arr->result() as $q) {
			$data[$q->id] = $q->kelas;
		}
		
		return $data;
	}
	
	function get_tahun_ajaran() {
	
		$arr = $this->db->query("SELECT * FROM tahunajaran WHERE id=((SELECT id FROM tahunajaran WHERE statusnya='aktif') - 1) AND statusnya='tidak aktif'");
		
		foreach ($arr->result() as $key) {
			$d[0] = '-- Silakan Pilih --';
			$d[$key->id] = $key->tahun;
		}
		return $d;
	}
	
	function get_ta($status = 'tidak aktif') {
		if ($status == 'aktif') {
			$arr = $this->db->get_where('tahunajaran', array('statusnya' => 'aktif'));
		}
		else {
			$arr = $this->db->query("SELECT * FROM tahunajaran WHERE id=((SELECT id FROM tahunajaran WHERE statusnya='aktif') - 1) AND statusnya='tidak aktif'");
		}
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
	
	function tahunajaran_aktif() {
		$arr = $this->db->get_where('tahunajaran', array('statusnya' => 'aktif'));
		$b = $arr->row();
		
		return $b->id;
	}
}
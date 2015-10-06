<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Kelas_model extends Model {

	function __construct() {
		parent::Model();
		$this->CI = & get_instance();
	}
	
	function get_kelas_flexigrid() {
		$idtahun = $this->get_tahun_ajaran();
		
		$this->db->select('k.id, k.nis, s.NAMA as nama, r.tingkat, r.program, r.kelas, r.walikls, t.tahun')->from('kelas k')->join('siswa s', 'k.nis=s.NIS')->join('refkelas r', 'k.idkelas=r.id')->join('tahunajaran t', 't.id=k.idtahun')->where('idtahun', $idtahun->id);
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
				
		$this->db->select("count(id) as record_count")->from('kelas');
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function get_siswa_no_class() {
		$arr = $this->db->query('SELECT `s`.`NIS`, `s`.`NAMA` FROM (`siswa` s) LEFT JOIN `kelas` k ON `k`.`nis`=`s`.`NIS` WHERE `k`.`idkelas` IS NULL');
		
		if ($arr->num_rows() > 0) {
			foreach ($arr->result() as $q) {
				$d[$q->NIS] = $q->NAMA;
			}
			return $d;
		}
		return FALSE;
	}
	
	function get_detail_kelas($id) {
		$this->db->select('k.id, k.nis, s.NAMA as nama, r.tingkat, r.program, r.kelas, r.walikls, t.tahun')->from('kelas k')->join('siswa s', 'k.nis=s.NIS')->join('refkelas r', 'k.idkelas=r.id')->join('tahunajaran t', 't.id=k.idtahun')->where('k.id', $id);
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
	
	function lookup($key) {
		$this->db->select('NIS, NAMA,NOHP1,TELP')->from('siswa')->like('NAMA', $key, 'after')->or_like('NIS', $key, 'after');
		$arr = $this->db->get();
		return $arr->result();
	}
	
	function get_data_kelas() {
		$arr = $this->db->query("SELECT * FROM refkelas WHERE tahun=(SELECT id FROM tahunajaran WHERE statusnya='aktif')");
				
		$data = array();
		$data[0] = '-- Silakan Pilih --';
		
		foreach ($arr->result() as $q) {
			$data[$q->id] = $q->kelas;
		}
		
		return $data;
	}
	
	function get_tahun_ajaran() {
		$arr = $this->db->get_where('tahunajaran', array('statusnya' => 'aktif'));
		return $arr->row();
	}
	
	function get_referensi_kelas($kelas) {		
		$arr = $this->db->get_where('refkelas', array('kelas' => $kelas));
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
	
	function cek_kelas($nis, $kelas) {
		$arr = $this->db->query("SELECT nis FROM kelas WHERE nis='".$nis."' AND kelas='".$kelas."' AND tahun=(SELECT tahun FROM tahunakademik)");
		
		if ($arr->num_rows() > 0) return TRUE;
		return FALSE;
	}
	
	function get_kelas_by_nis($nis) {
		$arr = $this->db->get_where('kelas', array('nis' => $nis));
		
		if ($arr->num_rows() > 0) return TRUE;
		return FALSE;
	}
}
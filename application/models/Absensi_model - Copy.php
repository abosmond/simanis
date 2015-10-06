<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Absensi_model extends Model {

	function __construct() {
		parent::Model();
		$this->CI = & get_instance();
	}
	
	function get_absensi_flexigrid() {
		$ta = $this->get_ta_aktif();
		$sem = $this->get_sem_aktif();
		
		$this->db->select('a.id, a.nis, s.nama, a.tanggal, a.absen')->from('absensi a')->join('siswa s', 'a.nis=s.NIS')->join('tahunajaran t', 'a.tahun=t.id')->join('semester m', 'a.smt=m.id')->where(array('a.tahun' => $ta, 'a.smt' => $sem));		
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select("count(a.id) as record_count")->from('absensi a')->join('siswa s', 'a.nis=s.NIS')->join('tahunajaran t', 'a.tahun=t.id')->join('semester m', 'a.smt=m.id')->where(array('a.tahun' => $ta, 'a.smt' => $sem));
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		
		$row = $record_count->row();
		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function get_detail_absensi($id) {
		$arr = $this->db->get_where('absensi', array('id' => $id));
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
	
	function lookup($key) {
		$tahun = $this->get_ta_aktif();
		
		$this->db->select('s.NIS, s.NAMA, r.kelas, s.TELP')->from('siswa s')->join('kelas k', 's.NIS=k.nis')->join('refkelas r', 'k.idkelas=r.id')->where('k.idtahun', $tahun)->like('s.NIS', $key, 'after');
		$arr = $this->db->get();
		return $arr->result();
	}
	
	function cek_deposit($nis) {
		$arr = $this->db->get_where('pulsa', array('NIS' => $nis));
		
		if ($arr->num_rows() > 0) return TRUE;
		return FALSE;
	}
	
	function get_ta_aktif() {
		$arr = $this->db->get_where('tahunajaran', array('statusnya' => 'aktif'));
		$ta = $arr->row();
		
		return $ta->id;
	}
	
	function get_sem_aktif() {
		$arr = $this->db->get_where('semester', array('status_semester' => 'aktif'));
		$sem = $arr->row();
		
		return $sem->id;
	}
}
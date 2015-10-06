<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Spp_model extends Model {

	function __construct() {
		parent::Model();
		$this->CI = & get_instance();
	}
	
	function get_data_siswa_perkelas($id) {	
		$this->db->select('r.id, k.nis, s.NAMA')->from('kelas k')->join('siswa s', 'k.nis=s.NIS')->join('refkelas r', 'k.idkelas=r.id')->where('r.id', $id);;
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) return $arr;
		return FALSE;		
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
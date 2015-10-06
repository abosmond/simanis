<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Ujian_model extends Model {

	function __construct() {
		parent::Model();
		$this->CI = & get_instance();
	}
	
	function get_ujian_flexigrid() {
		$this->db->select('*')->from('ujian');		
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select("count(id) as record_count")->from('ujian');
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function count_ujian() {
		$this->db->select('COUNT(id) as record_count')->from('ujian');
		$arr = $this->db->get();
		$r = $arr->row();
		
		return $r->record_count;
	}
	
	function cek_jadwal($hari, $waktu, $tingkat) {
		$arr = $this->db->get_where('ujian', array('TANGGAL' => $hari, 'JAM' => $waktu, 'TINGKAT' => $tingkat));
		
		if ($arr->num_rows() > 0) return TRUE;
		return FALSE;
	}
	
	function pilihmapel($id) {
		$this->db->select('KDMP, MP, ALIAS, TINGKAT, PROG')->from('mp')->where(array('TINGKAT' => $id));
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) {
			return $arr;			
		}
	}
	
	function get_detail_ujian($id) {
		$arr = $this->db->get_where('ujian', array('ID' => $id));
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
}
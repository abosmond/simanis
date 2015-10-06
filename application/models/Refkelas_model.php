<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Refkelas_model extends Model {

	function __construct() {
		parent::Model();
		$this->CI = & get_instance();
	}
	
	function get_refkelas_flexigrid() {
		$thn = $this->get_tahun_ajaran();
		
		$this->db->select('r.id, r.tingkat, r.program, r.kelas, r.walikls, t.tahun')->from('refkelas r')->join('tahunajaran t', 'r.tahun=t.id')->where('r.tahun', $thn->id);
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select("count(r.id) as record_count")->from('refkelas r')->join('tahunajaran t', 'r.tahun=t.id')->where('r.tahun', $thn->id);
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function get_detail_refkelas($id) {
		$arr = $this->db->get_where('refkelas', array('id' => $id));
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
	
	function lookup($key) {
		$this->db->select('NAMA')->from('guru')->like('NAMA', $key, 'after');
		$arr = $this->db->get();
		return $arr->result();
	}
	
	function cek_deposit($nis) {
		$arr = $this->db->get_where('pulsa', array('NIS' => $nis));
		
		if ($arr->num_rows() > 0) return TRUE;
		return FALSE;
	}
	
	function get_tahun_ajaran() {
		$this->db->select('id, tahun')->from('tahunajaran')->where('statusnya','aktif');
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
}
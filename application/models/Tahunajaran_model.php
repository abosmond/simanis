<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Tahunajaran_model extends Model {

	function __construct() {
		parent::Model();
		$this->CI = & get_instance();
	}
	
	function get_tahunajaran_flexigrid() {		
		$this->db->select("*")->from('tahunajaran');
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select("count(id) as record_count")->from('tahunajaran');
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function count_tahunajaran() {
		$this->db->select("count(id) as record_count")->from('tahunajaran');		
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		return $row->record_count;
	}
	
	function get_detail_tahunajaran($id) {
		$arr = $this->db->get_where('tahunajaran', array('id' => $id));
		
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
		$this->db->select('tahun')->from('tahunakademik');
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
}
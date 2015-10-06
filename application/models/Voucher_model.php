<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Voucher_model extends Model {

	function __construct() {
		parent::Model();
		$this->CI = & get_instance();
	}
	
	function get_voucher_flexigrid() {
		$this->db->select('*')->from('pulsa');		
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select("count(id) as record_count")->from('pulsa');
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function get_detail_voucher($id) {
		$arr = $this->db->get_where('pulsa', array('id' => $id));
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
	
	function lookup($key) {
		$this->db->select('NIS, NAMA,NOHP1,TELP')->from('siswa')->like('NAMA', $key, 'after')->or_like('NIS', $key, 'after');
		$arr = $this->db->get();
		return $arr->result();
	}
	
	function cek_deposit($nis) {
		$arr = $this->db->get_where('pulsa', array('NIS' => $nis));
		
		if ($arr->num_rows() > 0) return TRUE;
		return FALSE;
	}
}
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

Class Referensi_model extends Model {

	function __construct() {
		parent::Model();
	}
	
	function get_data_ref($table) {
		$arr = $this->db->get('ref_'.$table);
		
		$data = array();
		
		$data[0] = '-- Silakan Pilih --';
		foreach ($arr->result() as $r) {
			$data[$r->id] = $r->nama;
		}
		
		return $data;
	}
	
	function get_id_tahunajaran() {
		$arr = $this->db->get_where('tahunajaran', array('statusnya' => 'aktif'));
		
		$b = $arr->row();
		return $b->id;
	}
	
	function get_ta_aktif() {
		$arr = $this->db->get_where('tahunajaran', array('statusnya' => 'aktif'));		
		return $arr->row();
	}
	
	function get_sem_aktif() {
		$arr = $this->db->get_where('semester', array('status_semester' => 'aktif'));		
		return $arr->row();
	}
}
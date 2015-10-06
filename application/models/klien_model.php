<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

Class Klien_model extends Model {

	function __construct() {
		parent::Model();
	}
	
	function get_check_klien($id) {
		$this->db->like('kode', $id);
		$qry = $this->db->get('client');
		
		if ($qry->num_rows() > 0) return $qry;
		return FALSE;
	}
	
	function get_detail_klien($id) {		
		$qry = $this->db->get_where('client', array('id_client' => $id));
		
		if ($qry->num_rows() > 0) return $qry;
		return FALSE;
	}
	
	function get_klien($key, $limit = '', $start = '') {		
		$this->db->select('id_client, kode, nama, alamat, jenis');
		$this->db->from('client c');
		$this->db->join('jenis_survei j', 'j.id=c.id_jenis_survei');
		$this->db->where('id_client >','0');
		$this->db->like('nama', $key);		
		$this->db->order_by('nama');
		$this->db->limit($limit, $start);
				
		$qry = $this->db->get();
		
		if ($qry->num_rows() > 0) return $qry;
		return FALSE;
	}
	
	function get_tabel_client($id) {
		$qry = $this->db->get_where('table_sms', array('id_client' => $id));
		
		if ($qry->num_rows() > 0) return $qry->row();
		return FALSE;
	}
	
	function get_jenis_survei() {
		$qry = $this->db->get('jenis_survei');
		
		$arr[0] = '-- Silakan pilih jenis survei --';
		foreach ($qry->result() as $key) {
			$arr[$key->id] = $key->jenis;
		}
		return $arr;
	}
}
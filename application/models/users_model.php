<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

Class Users_model extends Model {

	function __construct() {
		parent::Model();
	}
	
	function select_users($start = '', $limit = '') {
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$this->db->where('id <>', '1');
		$qry = $this->db->get('users');
		
		if ($qry->num_rows() > 0) return $qry;
		return FALSE;
	}
	
	function cek_users($x) {
		$this->db->like('username', $x);
		$qry = $this->db->get('users');
		
		if ($qry->num_rows() > 0) return $qry->row();
		return FALSE;
	}
	
	function select_detail($id) {
		$qry = $this->db->get_where('users', array('id' => $id));
		
		if ($qry->num_rows() > 0) return $qry->row();
		return FALSE;
	}
	
	/* function select_client() {	
		$data = array();
		$qry = $this->db->get_where('client', array('id_client <>' => '0'));
		
		if ($qry->num_rows() > 0) {
			$data[0] = 'Silakan pilih Klien';
			foreach ($qry->result() as $key) {
				$data[$key->id_client] = $key->nama;
			}
			return $data;
		}
		return FALSE;
	} */
	
	function select_client() {
		$data = array();		
		$this->db->select('c.*, t.*');
		$this->db->from('table_sms t');
		$this->db->join('client c', 't.id_client=c.id_client');
		$this->db->where('t.nama_table <>', '');
		$qry = $this->db->get();
				
		if ($qry->num_rows() > 0) {
			$data[0] = '-- Silakan Pilih Klien --';
			foreach ($qry->result() as $key) {
				$data[$key->id_client] = $key->nama;
			}
			return $data;
		}
		return FALSE;
	}
	
	function select_client_by_code() {
		$data = array();		
		$this->db->select('c.*, t.*');
		$this->db->from('table_sms t');
		$this->db->join('client c', 't.id_client=c.id_client');
		$this->db->where('SUBSTR(t.format_sms FROM 5 FOR 7) =', 'kd_area');
		$qry = $this->db->get();
				
		if ($qry->num_rows() > 0) {
			$data[0] = '-- Silakan Pilih Klien --';
			foreach ($qry->result() as $key) {
				$data[$key->id_client] = $key->nama;
			}
			return $data;
		}
		return FALSE;
	}
}
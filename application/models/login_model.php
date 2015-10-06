<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

Class Login_model extends Model {

	function __construct() {
		parent::Model();
	}
	
	function get_user($username, $password) {
		$this->db->select('nip, passwd, levels, lastlogin');
		$this->db->from('users');
		$this->db->where(array('nip' => $username, 'passwd' => $password, 'stat' => '1'));		
		
		$qry = $this->db->get();
		if ($qry->num_rows() == 1) return $qry->row();
		return FALSE;
	}	
}
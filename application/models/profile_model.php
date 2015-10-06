<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends Model {
	
	function __construct() {
		parent::Model();
	}
	
	function get_data_profile() {
		$arr = $this->db->get('profilakademik');
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
}
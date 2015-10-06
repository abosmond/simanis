<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Semester_model extends Model {

	function __construct() {
		parent::Model();
		$this->CI = & get_instance();
	}
	
	function get_semester_flexigrid() {		
		$this->db->select("*")->from('semester');
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select("count(id) as record_count")->from('semester');
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function count_semester() {
		$this->db->select("count(id) as record_count")->from('semester');		
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		return $row->record_count;
	}	
}
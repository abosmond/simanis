<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

Class Map_model extends Model {

	function __construct() {
		parent::Model();
	}
	
	function get_data_client($id) {
		$qry = $this->db->get_where('client');
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa_model extends Model {

	function Siswa_model() {
		parent::Model();		
		$this->CI = & get_instance();
	}  

	public function get_siswa_flexigrid() {
		
		$this->db->select('*')->from('siswa');
		$this->CI->flexigrid->build_query();
		$return['records'] = $this->db->get();
		
		$this->db->select("count(NIS) as record_count")->from('siswa');
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();

		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function count_siswa() {
		$this->db->select("count(NIS) as record_count")->from('siswa');		
		$record_count = $this->db->get();
		$row = $record_count->row();

		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function get_detail_siswa($id) {
		$this->db->select('s.*, a.nama AS agamasiswa, j.nama AS kelaminsiswa')->from('siswa s')->join('ref_agama a' ,'a.id=s.AGAMA')->join('ref_jk j','s.JK=j.id')->where('s.NIS', $id);
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}	
	
	function get_nip_siswa($id) {
		$arr = $this->db->get_where('siswa', array('NIS' => $id));
		
		if ($arr->num_rows() > 0) {
			$ret = '<font color="red">NIS <STRONG>'.$id.'</STRONG> sudah digunakan.</font>';
			echo $ret;
		}
		else {
			echo 'OK';
		}		
	}
	
	function get_nis_siswa($id) {
		$arr = $this->db->get_where('siswa', array('NIS' => $id));
		
		if ($arr->num_rows() > 0) return TRUE;		
		return FALSE;
	}
}

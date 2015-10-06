<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapel_referensi extends Model {

	function Mapel_referensi() {
		parent::Model();		
		$this->CI = & get_instance();
	}  

	public function get_mapel_flexigrid() {		
		$this->db->select('mp.ID, KDMP, MP, ALIAS, TINGKAT, PROG')->from('mp');		
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select("count(ID) as record_count")->from('mp');
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		$return['record_count'] = $row->record_count;

		return $return;
	}
		
	function get_detail_mapel($id) {
		$arr = $this->db->get_where('mp', array('ID' => $id));
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}	
	
	function get_kode_mp($id) {
		$arr = $this->db->get_where('mp', array('KDMP' => $id));
		
		if ($arr->num_rows() > 0) {
			$ret = '<font color="red">Kode Mata Pelajaran <STRONG>'.$id.'</STRONG> sudah digunakan.</font>';
			echo $ret;
		}
		else {
			echo 'OK';
		}		
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
	
	function get_guru_mp() {
		$arr = $this->db->get('guru');
		
		$data = array();
		$data[0] = '-- Silakan Pilih --';
		foreach ($arr->result() as $r) {
			$data[$r->NIP] = $r->NAMA;
		}
		
		return $data;
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gurmod extends Model {

	function gurmod() {
		parent::Model();		
		$this->CI = & get_instance();
	}  

	public function get_merk_flexigrid() {
		/* $this->db->select('a.ID, a.NIP, a.NAMA, b.nama, c.nama');
		$this->db->from('guru a');
		$this->db->join('ref_jabatan b', 'a.JABATAN=b.id');
		$this->db->join('ref_jk c', 'a.JK=c.id');
		$this->db->get();		
		 */
		$this->db->select('a.ID, a.NIP, a.NAMA, b.nama as JABATAN, c.nama as JK')->from('guru a')->join('ref_jabatan b', 'a.JABATAN=b.id')->join('ref_jk c', 'a.JK=c.id');
		$this->CI->flexigrid->build_query();

		$return['records'] = $this->db->get();

		$this->db->select("count(NIP) as record_count")->from('guru');
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();

		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function get_detail_guru($id) {
		$arr = $this->db->get_where('guru', array('ID' => $id));
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}	
	
	function get_nip_guru($id) {
		$arr = $this->db->get_where('guru', array('NIP' => $id));
		
		if ($arr->num_rows() > 0) {
			$ret = '<font color="red">NIP <STRONG>'.$id.'</STRONG> sudah digunakan.</font>';
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
		print_r($data);exit;
		return $data;
	}
}

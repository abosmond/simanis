<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Pengampu_model extends Model {

	function __construct() {
		parent::Model();
		$this->CI = & get_instance();
	}
	
	function get_pengampu_flexigrid() {
		$a = $this->get_ta_aktif();
		
		$this->db->select('p.id, g.NIP AS nip, g.NAMA AS nama, mp.MP AS mapel, r.kelas')->from('pengampu p')->join('guru g', 'p.nip=g.NIP')->join('mp', 'p.idmp=mp.KDMP')->join('refkelas r', 'p.idkelas=r.id')->where('p.idtahun', $a->id);		
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select("count(p.id) as record_count")->from('pengampu p')->join('guru g', 'p.nip=g.NIP')->join('mp', 'p.idmp=mp.KDMP')->join('refkelas r', 'p.idkelas=r.id')->where('p.idtahun', $a->id);
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function count_pengampu() {
		$this->db->select('COUNT(id) as record_count')->from('pengampu');
		$arr = $this->db->get();
		$r = $arr->row();
		
		return $r->record_count;
	}
	
	function cek_jadwal($hari, $waktu, $tingkat) {
		$arr = $this->db->get_where('pengampu', array('TANGGAL' => $hari, 'JAM' => $waktu, 'TINGKAT' => $tingkat));
		
		if ($arr->num_rows() > 0) return TRUE;
		return FALSE;
	}
	
	function pilihmapel($id) {
		$this->db->select('KDMP, MP, ALIAS, TINGKAT, PROG')->from('mp')->where(array('TINGKAT' => $id));
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) {
			return $arr;			
		}
	}
	
	function pilihkelas($id) {
		$a = $this->get_ta_aktif();
		$this->db->select('id,kelas')->from('refkelas')->where(array('tingkat' => $id, 'tahun' => $a->id));
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) {
			return $arr;			
		}
	}
	
	function get_detail_pengampu($id) {
		$arr = $this->db->get_where('pengampu', array('ID' => $id));
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
	
	function lookup($key) {
		$this->db->select('NAMA, NIP')->from('guru')->like('NAMA', $key, 'after');
		$arr = $this->db->get();
		return $arr->result();
	}
	
	function get_ta_aktif() {
		$arr = $this->db->get_where('tahunajaran', array('statusnya' => 'aktif'));		
		return $arr->row();
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Kasus_model extends Model {

	function __construct() {
		parent::Model();
		$this->CI = & get_instance();
	}
	
	function get_kasus_flexigrid($idtahun) {
		$this->db->select('kasus.id, tanggal, NAMA, kasus, keterangan, kirimsms, tahunajaran.tahun')->from('kasus')->join('siswa', 'kasus.nis=siswa.NIS')->join('tahunajaran', 'tahunajaran.id=kasus.idtahun')->where('kasus.idtahun', $idtahun);		
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select("count(id) as record_count")->from('kasus');
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function get_detail_kasus($id, $idtahun) {
		$this->db->select('kasus.id, tanggal, NAMA, kasus, keterangan, kirimsms, tahunajaran.tahun')->from('kasus')->join('siswa', 'kasus.nis=siswa.NIS')->join('tahunajaran', 'tahunajaran.id=kasus.idtahun')->where(array('kasus.idtahun' => $idtahun, 'kasus.id' => $id));
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
	
	function lookup($key) {
		$tahun = $this->get_ta_aktif();
		
		$this->db->select('s.NIS, s.NAMA, r.kelas, s.TELP')->from('siswa s')->join('kelas k', 's.NIS=k.nis')->join('refkelas r', 'k.idkelas=r.id')->where('k.idtahun', $tahun)->like('s.NIS', $key, 'after');
		$arr = $this->db->get();
		return $arr->result();
	}
	
	function cek_deposit($nis) {
		$arr = $this->db->get_where('pulsa', array('NIS' => $nis));
		
		if ($arr->num_rows() > 0) return TRUE;
		return FALSE;
	}
	
	function cek_potongan_aktif() {
		$arr = $this->db->get('potonganpulsa');
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
	
	function get_ta_aktif() {
		$arr = $this->db->get_where('tahunajaran', array('statusnya' => 'aktif'));
		$ta = $arr->row();
		
		return $ta->id;
	}
}
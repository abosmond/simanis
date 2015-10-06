<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Sms_model extends Model {

	function __construct() {
		parent::Model();
	}
	
	function get_nohp_by_kelas($kelas) {
		$idtahun	= $this->get_ta_aktif();
		
		$this->db->select('TELP')->from('siswa')->join('kelas', 'siswa.NIS=kelas.nis')->where(array('idtahun' => $idtahun, 'idkelas' => $kelas));
		$arr = $this->db->get();
		
		return $arr;
	}
	
	function get_nohp_by_tingkat($tingkat) {
		$idtahun	= $this->get_ta_aktif();
		
		$this->db->select('TELP')->from('siswa')->join('kelas', 'siswa.NIS=kelas.nis')->join('refkelas', 'kelas.idkelas=refkelas.id')->where(array('kelas.idtahun' => $idtahun, 'refkelas.tingkat' => $tingkat));
		$arr = $this->db->get();
		
		return $arr;
	}
	
	function get_data_tingkat() {
		$this->db->distinct()->select('tingkat')->from('refkelas');
		$arr = $this->db->get();
		
		foreach ($arr->result() as $q) {
			$f[$q->tingkat] = $q->tingkat;
		}		
		return $f;
	}
	
	function get_ta_aktif() {
		$r = $this->db->get_where('tahunajaran', array('statusnya' => 'aktif'));
		$arr = $r->row();
		
		return $arr->id;
	}
}
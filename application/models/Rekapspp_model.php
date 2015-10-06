<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekapspp_model extends Model {

	function __construct() {
		parent::Model();		
		$this->CI = & get_instance();
	}  
	
	function get_rekap_spp_persiswa($post) {
		$this->db->select('sw.NIS as nis, sw.NAMA as nama, tglbayar, nilai')->from('spp sp')->join('siswa sw', 'sw.NIS=sp.nis')->where(array('sp.nis' => $post['nis'], 'sp.bulan' => $post['bulan'], 'sp.tahun' => $post['tahun']));
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
	
	function get_kelas() {
		$arr = $this->db->query("SELECT id, kelas FROM refkelas WHERE tahun=(SELECT id FROM tahunajaran WHERE statusnya='aktif')");
				
		if ($arr->num_rows() > 0) {
			foreach ($arr->result() as $q) {
				$w[0] = '-- Silakan Pilih Kelas --';
				$w[$q->id] = $q->kelas;
			}
			return $w;
		}
		return FALSE;
	}
	
	function report_rekap_spp($f) {
		$ta = $this->get_ta_aktif();
		$sem = $this->get_sem_aktif();
		
		$this->db->select('a.id, a.nis, s.nama, a.tanggal, a.absen')->from('absensi a')->join('siswa s', 'a.nis=s.NIS')->join('tahunajaran t', 'a.tahun=t.id')->join('semester m', 'a.smt=m.id')->join('kelas k', 'k.nis=a.nis')->where(array('a.tahun' => $ta->id, 'a.smt' => $sem->id, 'a.tanggal >=' => $f[0], 'a.tanggal <= ' => $f[1]));			
		
		if ($f[2]) {
			$this->db->where('a.nis', $f[2]);
		}
		
		if ($f[3]) {
			$this->db->where('k.idkelas', $f[3]);
		}
		
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) return $arr;
		return FALSE;
	}
		
	function get_ta_aktif() {
		$this->db->select('id')->from('tahunajaran')->where('statusnya', 'aktif');
		$arr = $this->db->get();
		
		return $arr->row();
	}
	
	function get_sem_aktif() {
		$this->db->select('id')->from('semester')->where('status_semester', 'aktif');
		$arr = $this->db->get();
		
		return $arr->row();
	}
			
	function get_nama_siswa($nis) {
		$arr = $this->db->get_where('siswa', array('nis' => $nis));
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}	
}

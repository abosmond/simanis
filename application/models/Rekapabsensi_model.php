<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekapabsensi_model extends Model {

	function rekapabsensi_model() {
		parent::Model();		
		$this->CI = & get_instance();
	}  

	function get_rekap_absensi($f) {
	
		$ta = $this->get_ta_aktif();
		$sem = $this->get_sem_aktif();
		
		$this->db->select('a.id, a.nis, s.nama, a.tanggal, a.absen')->from('absensi a')->join('siswa s', 'a.nis=s.NIS')->join('tahunajaran t', 'a.tahun=t.id')->join('semester m', 'a.smt=m.id')->join('kelas k', 'k.nis=a.nis')->where(array('a.tahun' => $ta->id, 'a.smt' => $sem->id, 'a.tanggal >=' => $f['tglawal'], 'a.tanggal <= ' => $f['tglakhir']));			
		
		if ($f['nis'] > 0) {
			$this->db->where('a.nis', $f['nis']);
		}
		
		if ($f['kelas']) {
			$this->db->where('k.idkelas', $f['kelas']);
		}
		
		$arr = $this->db->get();
		$return['records'] = $arr;
		$return['count'] 	= $arr->num_row();
	}
	
	function get_rekapabsensi_flexigrid($f) {
		
		$ta = $this->get_ta_aktif();
		$sem = $this->get_sem_aktif();
		
		$this->db->select('a.id, a.nis, s.nama, a.tanggal, a.absen')->from('absensi a')->join('siswa s', 'a.nis=s.NIS')->join('tahunajaran t', 'a.tahun=t.id')->join('semester m', 'a.smt=m.id')->join('kelas k', 'k.nis=a.nis')->where(array('a.tahun' => $ta->id, 'a.smt' => $sem->id, 'a.tanggal >=' => $f[0], 'a.tanggal <= ' => $f[1]));			
		
		if ($f[2]) {
			$this->db->where('a.nis', $f[2]);
		}
		
		if ($f[3]) {
			$this->db->where('k.idkelas', $f[3]);
		}
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select('count(a.id) as record_count')->from('absensi a')->join('siswa s', 'a.nis=s.NIS')->join('tahunajaran t', 'a.tahun=t.id')->join('semester m', 'a.smt=m.id')->join('kelas k', 'k.nis=a.nis')->where(array('a.tahun' => $ta->id, 'a.smt' => $sem->id, 'a.tanggal >=' => $f[0], 'a.tanggal <= ' => $f[1]));			
		
		if ($f[2]) {
			$this->db->where('a.nis', $f[2]);
		}
		
		if ($f[3]) {
			$this->db->where('k.idkelas', $f[3]);
		}
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();

		$return['record_count'] = $row->record_count;

		return $return;
	}
	
	function get_detail_siswa($id) {
		$arr = $this->db->get_where('siswa', array('NIS' => $id));
		
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
	
	function get_total_mapel($id) {
		$arr = $this->db->query("SELECT COUNT(idmp) AS total FROM pengampu WHERE idkelas='".$id."' AND idtahun=(SELECT id FROM tahunajaran WHERE statusnya='aktif')");		
		
		return $arr->row();
	}
	
	function get_jumlah_mapel($nis) {
		$arr = $this->db->query("SELECT COUNT(nis) AS jumlah FROM rekapabsensi WHERE nis='".$nis."' AND idtahun=(SELECT id FROM tahunajaran WHERE statusnya='aktif')");
		
		return $arr->row();
	}
	
	function get_mapel_for_score($idtingkat) {
		$a = $this->get_tahun_ajaran();
		
		$this->db->select('mp.KDMP, mp.MP, g.NIP, g.NAMA')->from('pengampu p')->join('guru g', 'p.nip=g.NIP')->join('mp', 'p.idmp=mp.KDMP')->join('refkelas r', 'p.idkelas=r.id')->where(array('p.idtahun' => $a->id, 'p.idkelas' => $idtingkat));		
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) return $arr->result();
		return FALSE;
	}
	
	function get_rekapabsensi_siswa($nis) {
		$arr = $this->db->query("SELECT kdmp, rekapabsensi FROM rekapabsensi WHERE idtahun=(SELECT id FROM tahunajaran WHERE statusnya='aktif') AND nis='".$nis."' AND sem=(SELECT id FROM semester WHERE status_semester='aktif') ORDER BY kdmp ASC");
		
		if ($arr->num_rows() > 0) return $arr->result();
		return FALSE;
	}
	
	function get_report_rekapabsensi($nis) {
		$ta = $this->get_tahun_ajaran();
		$sem = $this->get_sem_aktif();
		
		$this->db->select('mp.KDMP, mp.MP, mp.ALIAS, rekapabsensi.rekapabsensi')->from('rekapabsensi')->join('mp', 'rekapabsensi.kdmp=mp.KDMP')->where(array('idtahun' => $ta->id, 'sem' => $sem->id, 'nis' => $nis));
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
	
	function cek_rekapabsensi_siswa($nis, $kdmp, $idtahun) {
		$arr = $this->db->get_where('rekapabsensi', array('nis' => $nis, 'kdmp' => $kdmp, 'idtahun' => $idtahun));
		
		if ($arr->num_rows() > 0) return TRUE;
		return FALSE;
	}
	
	function get_nama_siswa($nis) {
		$arr = $this->db->get_where('siswa', array('nis' => $nis));
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
	
	function get_telp_ortu($nis) {
		$this->db->select('TELP')->from('siswa')->where('nis', $nis);
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) return $arr->row();
		return FALSE;
	}
}

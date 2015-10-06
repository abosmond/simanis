<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nilai_model extends Model {

	function Nilai_model() {
		parent::Model();		
		$this->CI = & get_instance();
	}  

	public function get_nilai_flexigrid($id) {
		
		$this->db->select('r.id, k.nis, s.NAMA, k.idkelas')->from('kelas k')->join('siswa s', 'k.nis=s.NIS')->join('refkelas r', 'k.idkelas=r.id')->where('r.id', $id);;
		$this->CI->flexigrid->build_query();
		$return['records'] = $this->db->get();
		
		$this->db->select("count(k.nis) as record_count")->from('kelas k')->join('siswa s', 'k.nis=s.NIS')->join('refkelas r', 'k.idkelas=r.id')->where('r.id', $id);
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
		$arr = $this->db->query("SELECT COUNT(nis) AS jumlah FROM nilai WHERE nis='".$nis."' AND idtahun=(SELECT id FROM tahunajaran WHERE statusnya='aktif')");
		
		return $arr->row();
	}
	
	function get_mapel_for_score($idtingkat) {
		$a = $this->get_tahun_ajaran();
		
		$this->db->select('mp.KDMP, mp.MP, g.NIP, g.NAMA')->from('pengampu p')->join('guru g', 'p.nip=g.NIP')->join('mp', 'p.idmp=mp.KDMP')->join('refkelas r', 'p.idkelas=r.id')->where(array('p.idtahun' => $a->id, 'p.idkelas' => $idtingkat));		
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) return $arr->result();
		return FALSE;
	}
	
	function get_nilai_siswa($nis) {
		$arr = $this->db->query("SELECT kdmp, nilai FROM nilai WHERE idtahun=(SELECT id FROM tahunajaran WHERE statusnya='aktif') AND nis='".$nis."' AND sem=(SELECT id FROM semester WHERE status_semester='aktif') ORDER BY kdmp ASC");
		
		if ($arr->num_rows() > 0) return $arr->result();
		return FALSE;
	}
	
	function get_report_nilai($nis) {
		$ta = $this->get_tahun_ajaran();
		$sem = $this->get_sem_aktif();
		
		$this->db->select('mp.KDMP, mp.MP, mp.ALIAS, nilai.nilai')->from('nilai')->join('mp', 'nilai.kdmp=mp.KDMP')->where(array('idtahun' => $ta->id, 'sem' => $sem->id, 'nis' => $nis));
		$arr = $this->db->get();
		
		if ($arr->num_rows() > 0) return $arr;
		return FALSE;
	}
	
	function get_tahun_ajaran() {
		$this->db->select('id')->from('tahunajaran')->where('statusnya', 'aktif');
		$arr = $this->db->get();
		
		return $arr->row();
	}
	
	function get_sem_aktif() {
		$this->db->select('id')->from('semester')->where('status_semester', 'aktif');
		$arr = $this->db->get();
		
		return $arr->row();
	}
	
	function cek_nilai_siswa($nis, $kdmp, $idtahun) {
		$arr = $this->db->get_where('nilai', array('nis' => $nis, 'kdmp' => $kdmp, 'idtahun' => $idtahun));
		
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

<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function ok(){
	$CI =& get_instance();
	return $CI->config->slash_item('base_url');
}

function pre($data){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

/*
 * olah data serialize
 */
function olahDataSerialize($data, $bahasa, $datapembanding='', $newlang=''){	
	if ($datapembanding != ''){
		$dp = unserialize($datapembanding);
		$dp[$newlang] = $data;
	}else{
		foreach ($bahasa as $k=>$v):
			$dp[$k] = $data;
		endforeach;
	}
	
	$data = serialize($dp);
	return $data;
}

function waktuSekarang($hari=0,$bulan=0,$tahun=0, $jam=0,$menit=0,$detik=0){
	$waktu = mktime(date("H")+$jam, date("i")+$menit, date("s")+$detik, date("m")+$bulan  , date("d")+$hari, date("Y")+$tahun);	
	return date('Y-m-d H:i:s', $waktu);
}

/*
 * HTML FORM function 
 * gunakan untuk output berupa element form dengan data tertentu
 */
function htmlLabel($id,$label,$params=''){
	$param = ($params!='' ? ' '.$params:'');
	$s = "<label for=\"{$id}\"{$param}>{$label}</label>";
	return $s;
}

function htmlSelect($name,$data,$terpilih='',$params=''){
	$param = ($params!='' ? ' '.$params:'');
		
	$s = "<select name=\"{$name}\" id=\"{$name}\"{$param}>\n";
	foreach ($data as $k=>$v):
		$selected=($terpilih==$k ? " selected=\"selected\"" :'');
		$s.= "	<option value=\"{$k}\"{$selected}>{$v}</option>\n";
	endforeach;
	$s .= "</select>";
	return $s;
}

function htmlDateSelector($name,$data='',$delimeter=' - ',$thnmulai=2000, $thnakhir=0 ,$params=''){	
	#echo $data;
	if ( $data != '' ){
		$waktu = explode('-',$data);
		#pre($waktu);
		$dTglTerpilih = $waktu[2];
		$dBlnTerpilih = $waktu[1];
		$dThnTerpilih = $waktu[0];
		//$dTglTerpilih = date('d');
	}else{
		$dTglTerpilih = date('d');
		$dBlnTerpilih = date('m');
		$dThnTerpilih = date('Y');
	}
	
	$variabelbulan['en'] = array(1=>'Jan','Feb','Marc','Apr','May','Jun','Jul','Aug','Sep','Okt','Nov','Dec');
	$variabelbulan['id'] = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

	if ($data == '0000-00-00'){
		$variabelbulan['en'][0] = '-';
		$variabelbulan['id'][0] = '-';
		$dTgl['00'] = '-';
		$dBln['00'] = '-';
		$dThn['00'] = '-';
	}	
	
	#pre($dTgl);
	$bahasa = (!isset($_SESSION['outputbahasa']) || $_SESSION['outputbahasa']=='' ? 'id' : $_SESSION['outputbahasa']);
	
	for ($i=1;$i<=31;$i++){
		$sTgl = (strlen($i)==1 ? '0'.$i : $i);
		$dTgl[$sTgl] = $sTgl; 
	}	
	#pre($dTgl);
	$namaTgl = 'tgl_'.$name;
	// build tanggal selector
	$s = htmlSelect($namaTgl, $dTgl, $dTglTerpilih);
	
	for ($i=1;$i<=12;$i++){
		$aBln= (strlen($i)==1 ? '0'.$i : $i);
		$dBln[$aBln] = $variabelbulan[$bahasa][$i]; 
	}
	$s .= $delimeter;
	$namaBln= 'bln_'.$name;
	// build bulan selector
	$s .= htmlSelect($namaBln, $dBln, $dBlnTerpilih);
	
	$akhir = date('Y')+$thnakhir;
	for ($i=$thnmulai; $i<=$akhir; $i++){
		$dThn[$i] = $i;
	}
	$s .= $delimeter;
	$namaThn = 'thn_'.$name;	
	// build tahun selector
	$s .= htmlSelect($namaThn, $dThn, $dThnTerpilih);
	
	return $s;
}

function htmlMonthYearSelector($name,$data='',$delimeter='',$thnmulai=2008, $thnakhir=10 ,$params='') {
	if ( $data != '' ){
		$waktu = explode('-',$data);
		$dTglTerpilih = $waktu[2];
		$dBlnTerpilih = $waktu[1];
		$dThnTerpilih = $waktu[0];
	}else{
		$dTglTerpilih = date('d');
		$dBlnTerpilih = date('m');
		$dThnTerpilih = date('Y');
	}
	
	$variabelbulan['en'] = array(1=>'Jan','Feb','Marc','Apr','May','Jun','Jul','Aug','Sep','Okt','Nov','Dec');
	$variabelbulan['id'] = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

	if ($data == '0000-00-00'){
		$variabelbulan['en'][0] = '-';
		$variabelbulan['id'][0] = '-';
		$dTgl['00'] = '-';
		$dBln['00'] = '-';
		$dThn['00'] = '-';
	}	

	$bahasa = (!isset($_SESSION['outputbahasa']) || $_SESSION['outputbahasa']=='' ? 'id' : $_SESSION['outputbahasa']);
	
	for ($i=1;$i<=31;$i++){
		$sTgl = (strlen($i)==1 ? '0'.$i : $i);
		$dTgl[$sTgl] = $sTgl; 
	}	
		
	for ($i=1;$i<=12;$i++){
		$aBln= (strlen($i)==1 ? '0'.$i : $i);
		$dBln[$aBln] = $variabelbulan[$bahasa][$i]; 
	}
	$s .= $delimeter;
	$namaBln= 'bln_'.$name;
	// build bulan selector
	$s .= htmlSelect($namaBln, $dBln, $dBlnTerpilih);
	
	$akhir = date('Y')+$thnakhir;
	for ($i=$thnmulai; $i<=$akhir; $i++){
		$dThn[$i] = $i;
	}
	$s .= $delimeter;
	$namaThn = 'thn_'.$name;	
	// build tahun selector
	$s .= htmlSelect($namaThn, $dThn, $dThnTerpilih);
	
	return $s;
}

function htmlYearSelector($name,$data='',$delimeter='',$thnmulai=2008, $thnakhir=10 ,$params='') {
	if ( $data != '' ){
		$waktu = explode('-',$data);
		#pre($waktu);
		$dTglTerpilih = $waktu[2];
		$dBlnTerpilih = $waktu[1];
		$dThnTerpilih = $waktu[0];
		//$dTglTerpilih = date('d');
	}else{
		$dTglTerpilih = date('d');
		$dBlnTerpilih = date('m');
		$dThnTerpilih = date('Y');
	}
	
	$s = '';
	$akhir = date('Y')+$thnakhir;
	for ($i=$thnmulai; $i<=$akhir; $i++){
		$dThn[$i] = $i;
	}
	$s .= $delimeter;
	$namaThn = $name;	
	// build tahun selector
	$s .= htmlSelect($namaThn, $dThn, $dThnTerpilih);
	
	return $s;
}

function parseForm($data,$pref='db_'){
	$d = array();
	foreach($data as $jang=>$krix){
		if (substr($jang,0,3) == $pref){
			$d[substr($jang,3)] = $krix;
		}					
	}
return $d;
}

function xl2timestamp($xl_date) {
	echo $xl_date;
	define("MIN_DATES_DIFF", 25569);
	define("SEC_IN_DAY", 86400);  
	
	// if ($excelDate <= MIN_DATES_DIFF)
		// return 0;
		
	return  ($excelDate - MIN_DATES_DIFF) * SEC_IN_DAY;
}
	
function validateForm($data, $pref = 'db_') {
	$d = array();
	
	foreach ($data as $key => $val) {
		if (substr($key,0,3) == $pref) {
			if ($val == '') {
				$d[] = "".substr($key,3)." harap diisi";
			}
		}
	}	
	return $d;
}

function setMessage($name, $url) {
	switch ($name) {
		case 'insert' :
			$ret = 'Data sukses ditambahkan. Silakan klik <a href="'.base_url().$url.'">disini</a> untuk kembali ke halaman awal.';
		break;
		case 'update' :
			$ret = 'Data sukses diupdate. Silakan klik <a href="'.base_url().$url.'">disini</a> untuk kembali ke halaman awal.';
		break;
		case 'delete' :
			$ret = 'Data sukses dihapus. Silakan klik <a href="'.base_url().$url.'">disini</a> untuk kembali ke halaman awal.';
		break;
	}
	return $ret;
}

function parseFormTgl($pref='lhr'){
	$tgl = $_POST["thn_{$pref}"].'-'.$_POST["bln_{$pref}"].'-'.$_POST["tgl_{$pref}"];
	return $tgl;
}
<?php
$fileName = "rekapabsensi_".$tgl[0]."_sd_".$tgl[1].".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$fileName");
?>
<h1>Rekap Absensi</h1>
<h1><?=$tgl[0]?> s/d <?=$tgl[1]?></h1>

<table width="100%" border="1" class="table_common" cellspacing="0" cellpadding="0">
<tr>
	<th>No.</th>
	<th>NIS</th>
	<th>Nama Lengkap</th>	
	<th>Tanggal</th>
	<th>Absen</th>
</tr>
<?php

if ($records) {
		
	$i = 1;	
	$odd_or_even = 'odd';		
	
	foreach ($records['records']->result() as $row) {
		
		$odd_or_even = ($odd_or_even == 'odd' ? 'even' : 'odd');		
				
?>
<tr class="<?=$odd_or_even;?>">	
	<td><?=$i?></td>
	<td><?=$row->nis?></td>
	<td><?=$row->nama?></td>		
	<td><?=$row->tanggal?></td>
	<td><?=$row->absen?></td>
</tr>
<?	$i++; 
	}
}
else {
?>
<tr>
	<td colspan="11" align="center"><b>Maaf, data yang anda cari tidak ditemukan.</b></td>
</tr>
<?
}
?>
</table>

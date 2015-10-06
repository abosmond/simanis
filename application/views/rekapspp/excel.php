<?php
$fileName = "rekapspp_".$post['kelas']."_".$post['bulan']."_".$post['tahun'].".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$fileName");
?>
<h1>Rekap SPP</h1>
<h1>Kelas : <?=$post['tahun']?> Bulan : <?=$post['bulan']?> Tahun : <?=$post['tahun']?></h1>

<table width="100%" border="1" class="table_common" cellspacing="0" cellpadding="0">
<tr>
	<th>No.</th>
	<th>NIS</th>
	<th>Nama</th>
	<th>Status</th>
	<th>Tanggal</th>
	<th>Nominal</th>	
</tr>

<?php
if ($absen) {	
	$i = 1;
	
	foreach ($absen->result() as $q) {
		$arr = $this->db->get_where('spp', array('nis' => $q->nis, 'bulan' => $post['bulan'], 'tahun' => $post['tahun']));
		
		if ($arr->num_rows() > 0) {
			$f = $arr->row();
			$def = 'sudah';			
		}
		else {
			$def = 'Belum Bayar';
		}
		
		echo '<tr>
				<td>'.$i.'</td>';
				
				if ($def == 'sudah') {
					echo '<td>'.$q->nis.'</td>
						  <td>'.$q->NAMA.'</td>';	
					echo '<td>Sudah Bayar</td>
						  <td>'.$f->tglbayar.'</td>
						  <td>'.$f->nilai.'</td>';
			  
				}
				else {
					echo '<td>'.$q->nis.'</td>
						  <td>'.$q->NAMA.'</td>';
					echo '<td>'.$def.'</td>';
					echo '<td>-</td>
						  <td>-</td>';
				}				
		$i++;
		echo '</tr>';
	}	
}
else {
	
}
?>	
</table>

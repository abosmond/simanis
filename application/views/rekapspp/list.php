<table class="table-common" width="760px">
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
<table>
	<tr>
		<td class="table-common-links">
			<a href="<?=base_url()?>rekapspp/ekspor/<?=$post['bulan']?>/<?=$post['tahun']?>/<?=$post['kelas']?>">Ekspor ke Excel</a>
		</td>
	</tr>
</table>
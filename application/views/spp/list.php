<script>
$(function() {
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});

	$('#add').click(function(){			
		$('#j_action').val('add_absen');
		$('#formKlien').submit();
	});
	
	$('.status').change(function() {
		var id = $(this).attr('id');
		
		if ($('.status').val() == 'sudah') {			
			$('#datepick_'+id).datepick({dateFormat: 'yyyy-mm-dd'});
			$('#datepick_'+id).show();
			$('#nilai_'+id).show();
		}
		else {
			$('#datepick_'+id).hide();
			$('#nilai_'+id).hide();
		}
	});
	
	
});
</script>

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
			$def = 'belum';
		}
		
		echo '<tr>
				<td>'.$i.'</td>';
				
				if ($def == 'sudah') {
					echo '<td>'.$q->nis.'</td>
						  <td>'.$q->NAMA.'</td>';	
					echo '<td><strong>Sudah Bayar</strong></td>
						  <td><strong>'.$f->tglbayar.'</strong></td>
						  <td><strong>'.$f->nilai.'</strong></td>';
			  
				}
				else {
					echo '<td>'.$q->nis.'<input type="hidden" name="nis[]" value="'.$q->nis.'"></td>
						  <td>'.$q->NAMA.'</td>';
					echo '<td>'.form_dropdown('status[]', $status, $def, 'class="status" id="'.$q->nis.'"').'</td>';
					echo '<td><input type="text" name="tglbayar[]" id="datepick_'.$q->nis.'" style="display:none;"></td>
						<td><input type="text" name="nilai[]" id="nilai_'.$q->nis.'" style="display:none;"></td>';
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
			<a href="javascript: void(0)" id="add">Simpan</a>
		</td>
	</tr>
</table>
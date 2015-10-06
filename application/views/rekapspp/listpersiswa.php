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
	<th>NIS</th>
	<th>Nama</th>
	<th>Status</th>
	<th>Tanggal</th>
	<th>Nominal</th>	
</tr>

<?php
if ($result) {	
	echo '<tr>
			<td>'.@$result->nis.'</td>
			<td>'.@$result->nama.'</td>
			<td>Sudah Bayar</td>
			<td>'.@$result->tglbayar.'</td>
			<td>'.@$result->nilai.'</td>
		  </tr>';
	
	echo '</table>
			<table>
				<tr>
					<td class="table-common-links">
						<a href="javascript: void(0)" id="add">Ekspor ke Excel</a>
					</td>
				</tr>
			</table>';
}
else {
	echo '<tr>
			<td colspan="5"><center>-- Data Tidak Ditemukan --</center></td>			
		  </tr>';
}
?>
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
});
</script>

<table class="table-common" width="760px">
<tr>
	<th>No.</th>
	<th>NIS</th>
	<th>Nama</th>
	<th>Status</th>
	<th>Keterangan</th>
</tr>

<?php
if ($absen) {	
	$i = 1;
	
	foreach ($absen->result() as $q) {
		$arr = $this->db->get_where('absensi', array('nis' => $q->nis, 'tanggal' => $tgl));
		
		if ($arr->num_rows() > 0) {
			$r = $arr->row();
			$def = $r->absen;
		}
		else {
			$def = 'belum';
		}
		
		echo '<tr>
				<td>'.$i.'</td>
				<td>'.$q->nis.'<input type="hidden" name="nis[]" value="'.$q->nis.'"></td>
				<td>'.$q->NAMA.'</td>
				<td>'.form_dropdown('status[]', $status, $def).'</td>
				<td></td>
			  </tr>';
		$i++;
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
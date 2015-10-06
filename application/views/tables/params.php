<script>
$(document).ready(function() {
	var j_action = $('#j_action');
	var i = 1;
	
	$('#btn_simpan').click(function() {
		j_action.val('save_params');
		$('#formTable').submit();
	});
	
});
</script>

<h3>Setting Parameter</h3>
<table width="100%" class="table-form">
<input type="hidden" name="kd_client" value="<?=$kd_client?>">
<?php 
for ($i = 1; $i <= $count; $i++) {
	echo '<tr>
			<td>Nama Parameter '.$i.'</td>
			<td>'.form_dropdown('nama_params[]', $nm_param, '0', 'class="jenis_param"').'</td>
		  </tr>';
}
?>
<tr>
	<td class="table-common-links"><a href="javascript: void(0)" id="btn_simpan">Simpan</a></td>
</tr>
</table>
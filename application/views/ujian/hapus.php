<script>
$(function() {
	$('#btn_delete').click(function() {	
		$('#j_action').val('delete_ujian');;
		$('#formSubmit').submit();
	});	
});
</script>
<?php
?>
<h2>Data Ujian</h2>
<h3>Hapus Jadwal Ujian <?=@$row->MP?></h3>
<br/>
<form id="formSubmit" method="post" action="">
<table width="100%" class="table-form">
	<tr>
		<th colspan="3"><h3>APAKAH ANDA INGIN MENGHAPUS DATA INI ?</h3></th>
	</tr>
	<?php
	$arr = array('Tanggal' => 'TANGGAL', 'Hari' => 'HARI', 'Waktu' => 'JAM', 'Tingkat' => 'TINGKAT', 'Mata Pelajaran' => 'MP');
	
	foreach ($arr as $v => $q) {
	?>
	<tr>
		<th width="23%"><?=$v?></th>
		<th width="7%">:</th>
		<td><?=@$row->$q?></td>
	</tr>	
	<?php
	}
	?>	
	<tr>
		<td colspan="2" align="left"></td>
		<td class="table-common-links">
			<input type="hidden" id="j_action" name="j_action" value=""><input type="hidden" name="id" value="<?=@$row->id?>"><a href="javascript: void(0)" id="btn_delete">Hapus</a><a href="<?=base_url();?>voucher">Kembali</a>
		</td>
	</tr>
</table>
</div>
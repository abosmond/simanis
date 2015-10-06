<script>
$(function() {
	$('#btn_delete').click(function() {	
		$('#j_action').val('delete_kasus');;
		$('#formSubmit').submit();
	});	
});
</script>
<?php
?>
<h2>Data Kasus</h2>
<h3>Hapus Data Kasus</h3>
<br/>
<form id="formSubmit" method="post" action="">
<table width="100%" class="table-form">
	<tr>
		<th colspan="3"><h3>APAKAH ANDA INGIN MENGHAPUS DATA INI ?</h3></th>
	</tr>
	<?php
	$arr = array('Nama' => 'NAMA', 'Tanggal' => 'tanggal', 'Kasus' => 'kasus', 'Keterangan' => 'keterangan');
	
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
			<input type="hidden" id="j_action" name="j_action" value=""><input type="hidden" name="id" value="<?=@$row->id?>"><a href="javascript: void(0)" id="btn_delete">Hapus</a><a href="<?=base_url();?>kasus">Kembali</a>
		</td>
	</tr>
</table>
</div>
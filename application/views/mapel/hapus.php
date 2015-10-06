<script>
$(function() {
	$('#btn_delete').click(function() {	
		$('#j_action').val('delete_mapel');;
		$('#formSubmit').submit();
	});	
});
</script>
<?php
?>
<h2>Data Mata Pelajaran</h2>
<h3>Hapus Data <?=@$row->MP?></h3>
<br/>
<form id="formSubmit" method="post" action="">
<table width="100%" class="table-form">
	<tr>
		<th colspan="3"><h3>APAKAH ANDA INGIN MENGHAPUS DATA INI ?</h3></th>
	</tr>
	<tr>
		<th width="23%">Kode MP</th>
		<th width="7%">:</th>
		<td><?=@$row->KDMP?></td>
	</tr>	
	<tr>
		<th width="23%">Nama Mata Pelajaran</th>
		<th width="7%">:</th>
		<td><?=@$row->MP?></td>
	</tr>
	<tr>
		<th>Alias</th>
		<th>:</th>
		<td><?=@$row->ALIAS?></td>
	</tr>	
	<tr>
		<th>Tingkat</th>
		<th>:</th>
		<td><?=@$row->TINGKAT?></td>
	</tr>	
	<tr>
		<th>Program</th>
		<th>:</th>
		<td><?=@$row->PROG?></td>
	</tr>	
	<tr>
		<td colspan="2" align="left"></td>
		<td class="table-common-links">
			<input type="hidden" id="j_action" name="j_action" value=""><input type="hidden" name="id" value="<?=@$row->id?>"><a href="javascript: void(0)" id="btn_delete">Hapus</a><a href="<?=base_url();?>mapel">Kembali</a>
		</td>
	</tr>
</table>
</div>
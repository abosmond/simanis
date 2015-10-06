<script>
$(function() {
	$('#btn_delete').click(function() {	
		$('#j_action').val('delete_tahunajaran');;
		$('#formSubmit').submit();
	});	
});
</script>
<?php
?>
<h2>Data Tahun Ajaran</h2>
<h3>Hapus Data Ajaran</h3>
<br/>
<form id="formSubmit" method="post" action="">
<table width="100%" class="table-form">
	<tr>
		<th colspan="3"><h3>APAKAH ANDA INGIN MENGHAPUS DATA INI ?</h3></th>
	</tr>
	<tr>
		<th width="23%">Tahun Ajaran</th>
		<th width="7%">:</th>
		<td><?=@$row->tahun?></td>
	</tr>	
	<tr>
		<th width="23%">Periode Awal</th>
		<th width="7%">:</th>
		<td><?=@$row->mulai?></td>
	</tr>
	<tr>
		<th>Periode Akhir</th>
		<th>:</th>
		<td><?=@$row->akhir?></td>
	</tr>	
	<tr>
		<th>Semester</th>
		<th>:</th>
		<td><?=@$row->semester?></td>
	</tr>		
	<tr>
		<td colspan="2" align="left"></td>
		<td class="table-common-links">
			<input type="hidden" id="j_action" name="j_action" value=""><input type="hidden" name="id" value="<?=@$row->id?>"><a href="javascript: void(0)" id="btn_delete">Hapus</a><a href="<?=base_url();?>voucher">Kembali</a>
		</td>
	</tr>
</table>
</div>
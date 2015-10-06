<script>
$(function() {
	$('#btn_delete').click(function() {	
		$('#j_action').val('delete_kelas');;
		$('#formSubmit').submit();
	});	
});
</script>
<?php
?>
<h2>Data Kelas</h2>
<h3>Hapus Kelas <?=@$row->nama?></h3>
<br/>
<form id="formSubmit" method="post" action="">
<table width="100%" class="table-form">
	<tr>
		<th colspan="3"><h3>APAKAH ANDA INGIN MENGHAPUS DATA INI ?</h3></th>
	</tr>
	<tr>
		<th width="23%">NIS</th>
		<th width="7%">:</th>
		<td><?=@$row->nis?></td>
	</tr>	
	<tr>
		<th width="23%">Nama</th>
		<th width="7%">:</th>
		<td><?=@$row->nama?></td>
	</tr>
	<tr>
		<th>Tingkat</th>
		<th>:</th>
		<td><?=@$row->tingkat?></td>
	</tr>	
	<tr>
		<th>Program</th>
		<th>:</th>
		<td><?=@$row->program?></td>
	</tr>	
	<tr>
		<th>Kelas</th>
		<th>:</th>
		<td><?=@$row->kelas?></td>
	</tr>
	<tr>
		<th>Wali Kelas</th>
		<th>:</th>
		<td><?=@$row->walikls?></td>
	</tr>
	<tr>
		<th>Tahun</th>
		<th>:</th>
		<td><?=@$row->tahun?></td>
	</tr>	
	<tr>
		<td colspan="2" align="left"></td>
		<td class="table-common-links">
			<input type="hidden" id="j_action" name="j_action" value=""><input type="hidden" name="id" value="<?=@$row->id?>"><a href="javascript: void(0)" id="btn_delete">Hapus</a><a href="<?=base_url();?>kelas">Kembali</a>
		</td>
	</tr>
</table>
</div>
<script>
$(function() {
	$('#btn_delete').click(function() {	
		$('#j_action').val('delete_guru');;
		$('#formSubmit').submit();
	});	
});
</script>
<?php
?>
<h2>Data Guru</h2>
<h3>Hapus Data <?=@$row->NAMA?></h3>
<br/>
<form id="formSubmit" method="post" action="">
<table width="100%" class="table-form">
	<tr>
		<th colspan="3"><h3>APAKAH ANDA INGIN MENGHAPUS DATA INI ?</h3></th>
	</tr>
	<tr>
		<th width="23%">NIP</th>
		<th width="7%">:</th>
		<td><?=@$row->NIP?></td>
	</tr>	
	<tr>
		<th width="23%">Nama</th>
		<th width="7%">:</th>
		<td><?=@$row->NAMA?></td>
	</tr>
	<tr>
		<th>Alamat</th>
		<th>:</th>
		<td><?=@$row->ALAMAT?></td>
	</tr>	
	<tr>
		<th>Tempat Lahir</th>
		<th>:</th>
		<td><?=@$row->TMPLHR?></td>
	</tr>	
	<tr>
		<th>Tanggal Lahir</th>
		<th>:</th>
		<td><?=@$row->TGLLHR?></td>
	</tr>
	<tr>
		<th>Agama</th>
		<th>:</th>
		<td><?=@$row->AGAMA?></td>
	</tr>
	<tr>
		<th>Jabatan</th>
		<th>:</th>
		<td><?=@$row->JABATAN?></td>
	</tr>
	<tr>
		<th>No. Telp</th>
		<th>:</th>
		<td><?=@$row->NOTLP?></td>
	</tr>
	<tr>
		<th>Foto</th>
		<th>:</th>
		<td><?=@$row->FOTO?></td>
	</tr>
	<tr>
		<td colspan="2" align="left"></td>
		<td class="table-common-links">
			<input type="hidden" id="j_action" name="j_action" value=""><input type="hidden" name="id" value="<?=@$row->id?>"><a href="javascript: void(0)" id="btn_delete">Hapus</a><a href="<?=base_url();?>guru">Kembali</a>
		</td>
	</tr>
</table>
</div>
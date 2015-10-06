<script>
$(function() {
	$('#btn_delete').click(function() {	
		$('#j_action').val('delete_users');;
		$('#formSubmit').submit();
	});	
});
</script>

<h2>Manajemen User</h2>
<h3>Hapus User</h3>
<br/>
<form id="formSubmit" method="post" action="">
<table width="100%" class="table-form">
	<tr>
		<th colspan="3"><h3>APAKAH ANDA INGIN MENGHAPUS USER INI ??</h3></th>
	</tr>
	<tr>
		<th width="23%">Username</th>
		<th width="7%">:</th>
		<td><?=@$row->username?></td>
	</tr>	
	<tr>
		<th width="23%">Nama Lengkap</th>
		<th width="7%">:</th>
		<td><?=@$row->nama?></td>
	</tr>
	<tr>
		<th>Alamat</th>
		<th>:</th>
		<td><?=@$row->alamat?></td>
	</tr>	
	<tr>
		<td colspan="2" align="left"></td>
		<td class="table-common-links">
			<input type="hidden" id="j_action" name="j_action" value=""><input type="hidden" name="id" value="<?=@$row->id?>"><a href="javascript: void(0)" id="btn_delete">Hapus</a><a href="<?=base_url();?>users">Kembali</a>
		</td>
	</tr>
</table>
</div>
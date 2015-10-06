<script>
$(function() {
	$('#btn_delete').click(function() {	
		$('#j_action').val('delete_voucher');;
		$('#formSubmit').submit();
	});	
});
</script>
<?php
?>
<h2>Data Vourcher</h2>
<h3>Hapus Data <?=@$row->NAMA?></h3>
<br/>
<form id="formSubmit" method="post" action="">
<table width="100%" class="table-form">
	<tr>
		<th colspan="3"><h3>APAKAH ANDA INGIN MENGHAPUS DATA INI ?</h3></th>
	</tr>
	<tr>
		<th width="23%">NIS</th>
		<th width="7%">:</th>
		<td><?=@$row->NIS?></td>
	</tr>	
	<tr>
		<th width="23%">Nama</th>
		<th width="7%">:</th>
		<td><?=@$row->NAMA?></td>
	</tr>
	<tr>
		<th>No. HP 1</th>
		<th>:</th>
		<td><?=@$row->NOHP1?></td>
	</tr>	
	<tr>
		<th>NO. HP 2</th>
		<th>:</th>
		<td><?=@$row->NOHP2?></td>
	</tr>	
	<tr>
		<th>Tanggal Awal</th>
		<th>:</th>
		<td><?=@$row->TGLAWAL?></td>
	</tr>
	<tr>
		<th>Pulsa</th>
		<th>:</th>
		<td><?=@$row->PULSA?></td>
	</tr>
	<tr>
		<th>Sisa Pulsa</th>
		<th>:</th>
		<td><?=@$row->SISAPULSA?></td>
	</tr>	
	<tr>
		<td colspan="2" align="left"></td>
		<td class="table-common-links">
			<input type="hidden" id="j_action" name="j_action" value=""><input type="hidden" name="id" value="<?=@$row->id?>"><a href="javascript: void(0)" id="btn_delete">Hapus</a><a href="<?=base_url();?>voucher">Kembali</a>
		</td>
	</tr>
</table>
</div>
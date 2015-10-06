<script>
$(function() {
	var j_action = $('.j_action');
	
	$('#btn_ubah').click(function() {
		$('#window_content').slideUp();
		$('#window_update').show();
	});
	
	$('#btn_add').click(function() {
		$('#window_content').slideUp();
		$('#window_content').hide();
		$('#window_add').show();
	});
	
	$('#btn_detail').click(function() {
		$('#window_update').slideDown();
		$('#window_update').hide();
		$('#window_content').show();;
	});
	
	$('#btn_detail_add').click(function() {
		$('#window_add').slideDown();
		$('#window_add').hide();
		$('#window_content').show();;
	});
	
	$('#btn_save_update').click(function() {
		j_action.val('save_update');
		$('.formSubmit').submit();
	});
	
	$('#btn_save_add').click(function() {
		if ($('#nama').val() == '') { alert('Nama harap diisi'); $('#nama').focus(); return false;}
		j_action.val('save_add');
		$('.formSubmit').submit();
	});
	
	$('.formSubmit').submit(function() {	
		
		switch (j_action.val()) {
			case 'save_update' :
				var tujuan = '<?=base_url();?>referensi/update';
			break;
			case 'save_add' :
				var tujuan = '<?=base_url();?>referensi/add';
			break;
		}
		$.ajax({
			type	: 'POST',
			url		: tujuan,
			data	: $(this).serialize(),
			success	: function(data) {
				if (j_action.val() == 'save_update') {
					$('#window_msg_content').show();
					$("#window_msg_content").html(data);
				}
				else {
					$('#window_msg_content').show();
					$("#window_msg_content").html(data);
				}
			}
		});
		return false;
	});
})
</script>
<h2>Manajemen Referensi</h2>
<h3>Detail Data Referensi <?=$nama->alias?></h3>
<br/>
<div id="window_msg_content"></div>

<div id="window_content">
<table width="100%" class="table-common">
	<tr>
		<th>No.</th>
		<th>Kode</th>
		<th>Nama</th>
	</tr>
	<?php
	if ($content) {
		$i = 1;
		foreach ($content as $key) {
	?>
	<tr>
		<td><?=$i?></td>
		<td><?=$key->kode?></td>
		<td><?=$key->nama?></td>
	</tr>	
	<?php
		$i++;
		}
	}
	else {
	echo '<tr>
			<td colspan="3"><center>-- Data tidak ditemukan --</center></td>
		  </tr>';
	}
	?>
	<tr>		
		<td colspan="3" class="table-common-links">
			<a href="javascript:void(0)" id="btn_add">Tambah Content</a><a href="javascript:void(0)" id="btn_ubah">Ubah Content</a><a href="<?=base_url();?>referensi">Kembali</a>
		</td>
	</tr>
</table>
</div>

<div id="window_update" style="display:none;">
<form class="formSubmit" method="post" action="">
<input type="hidden" class="j_action" name="j_action" value="">

<table width="100%" class="table-common">
	<tr>
		<th>No.</th>
		<th>Kode</th>
		<th>Nama</th>
	</tr>
	<?php
	if ($content) {
		$i = 1;
		foreach ($content as $key) {
	?>
	<tr>
		<td><?=$i?></td>
		<td><?=$key->kode?></td>
		<td><input type="text" name="db_nama[]" value="<?=$key->nama?>"><input type="hidden" name="db_kode[]" value="<?=$key->id?>"></td>
	</tr>	
	<?php
		$i++;
		}
	}
	else {
	echo '<tr>
			<td colspan="3"><center>-- Data tidak ditemukan --</center></td>
		  </tr>';
	}
	?>
	<tr>		
		<td colspan="3" class="table-common-links">
			<input type="hidden" name="tabel" value="<?=@$nama->nama?>"><input type="hidden" name="id" value="<?=@$nama->id?>">
			<a href="javascript:void(0)" id="btn_save_update">Simpan</a><a href="javascript:void(0)" id="btn_detail">Kembali</a>
		</td>
	</tr>
</table>

</div>

<div id="window_add" style="display:none;">

<input type="hidden" class="j_action" name="j_action" value="">
<table width="100%" class="table-form">
	<tr>
		<td>Nama</td>
		<td><input type="text" name="xx_nama" id="nama"></td>		
	</tr>	
	<tr>		
		<td colspan="3" class="table-common-links">	
			<input type="hidden" name="tabel" value="<?=@$nama->nama?>"><input type="hidden" name="id" value="<?=@$nama->id?>">
			<a href="javascript:void(0)" id="btn_save_add">Simpan</a><a href="javascript:void(0)" id="btn_detail_add">Kembali</a>
		</td>
	</tr>
</table>
</form>
</div>
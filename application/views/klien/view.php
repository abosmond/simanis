<script>
$(function() {
	var 		
		key = $('#key'),
		start_data = $('#start_data'),
		prev_button = $('#prev_button'),
		next_button = $('#next_button'),
		daftar_perhalaman = 10,		
		formCari = $('#formCari');
	
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});
	
	next_button.click(function(){		
		var x = parseInt( start_data.val() ) + daftar_perhalaman;
		start_data.val(x);
		$('#formCari').submit();
	});
		
	prev_button.click(function(){		
		var x = parseInt( start_data.val() ) - daftar_perhalaman;
		if ( x <= 0){			
			start_data.val(0);
		}else{				
			start_data.val(x);
		}
		$('#formCari').submit();
	});
	
	$('#formCari').submit(function() {						
		$.ajax({
			type: 'POST',				
			url: '<?=base_url()?>klien/search',
			data: $(this).serialize(),
			success: function(data) {																	
				$("#window_data_content").html(data);
							
			}
		})
		return false;
	});
	
	$('#search_button').click(function() {
		start_data.val(0);		
		$('#formCari').submit();
	});
});
</script>


<h3>Manajemen Klien</h3>
<h2>Daftar Klien</h2>
<br/>
<form name="form1" id="formCari" method="post" action="">
	<table class="table-form" style="width: 500px;">
		<tr>
			<th colspan="5"><h3>PENCARIAN KLIEN</h3></th>
		</tr>
		<tr>
			<th width="80px">Keyword</th>
			<th width="25px">:</th>
			<td colspan="3">
				<input type="text" name="keyword" id="key" title="Kata Kunci Pencarian" size="34">
			</td>
		</tr>		
		<tr>
			<td colspan="5" align="center" class="table-common-links">
				<a href="javascript: void(0)" id="search_button">Cari</a>
			</td>
		</tr>
	</table>

<div id="window_popup_data" style="display:none">
	<div id="window_popup_data_content"></div>
</div>

<input type="hidden" name="start_data" id="start_data" value="0" />
<div class="pageNav">	
	<a href="javascript: void(0)" id="prev_button">&#8249; Sebelumnya</a>
	<a href="javascript: void(0)" id="next_button">Sesudahnya &#8250;</a>
</div>
<div id="window_data_content">
<br/>

<table class="table-common" width="760px">
	<tr>
		<th>No.</th>
		<th>Nama Klien</th>
		<th>Jenis Survei</th>
		<th>Kode</th>
		<th>Alamat</th>
		<th>Aksi</th>
	</tr>
	<?php
if ($result) {
	$i = 1;
	foreach ($result->result() as $key) :
	?>
	<tr>
		<td><?=$i?></td>
		<td><?=$key->nama?></td>
		<td><?=$key->jenis?></td>
		<td><?=$key->kode?></td>
		<td><?=$key->alamat?></td>
		<td class="table-common-links" align="center"><a href="<?=base_url()?>klien/data/<?=$key->id_client?>">Ubah</a><a href="<?=base_url()?>klien/detail/<?=$key->id_client?>">Hapus</a></td>
	</tr>
	<?php
	$i++;
	endforeach;
}
else {
	echo '<tr>
			<td colspan="5"><center>Data tidak ditemukan</center></td>
		  </tr>';
}
	?>
</table>
<table>
	<tr>
		<td class="table-common-links">
			<a href="<?=base_url();?>klien/data" id="add">Tambah Klien</a>
		</td>
	</tr>
</table>
</div>
</form>
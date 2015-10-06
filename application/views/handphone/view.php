<script>
$(function() {
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});
	
	$('.pagination').click(function() {
		var t = $(this).attr('id');
		$('#start_data').val(t);
		$('#formCari').submit();
	});
	
	$('#formCari').submit(function() {
		$.ajax({
			type: 'POST',				
			url: '<?=base_url();?>handphone/search',
			data: $(this).serialize(),
			success: function(data) {	
				$("#msg_content").hide();
				$('#window_popup_data').show();
				$("#window_popup_data_content").html(data);			
			}
		})
		return false;
	});
	
	$('#search_button').click(function() {
		if ($('#id_client').val() == 0) { alert('Klien harap dipilih'); return false;}
		$('#formCari').submit();
	});
});
</script>

<h3>Manajemen Handphone</h3>
<h2>Daftar No. Handphone</h2>
<br/>
<form name="form1" id="formCari" method="post" action="">
	<table class="table-form" style="width: 500px;">
		<tr>
			<th colspan="5"><h3>PENCARIAN NO. HANDPHONE</h3></th>
		</tr>
		<tr>
			<th width="80px">Klien</th>
			<th width="25px">:</th>
			<td colspan="3">
				<?=form_dropdown('id_client', $client, '0', 'id="id_client"');?>
			</td>
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

<input type="hidden" name="start_data" id="start_data" value="0" />
<div id="window_popup_data" style="display:none">
	<div id="window_popup_data_content"></div>
</div>

<div id="msg_content">
<table class="table-common" width="760px">
	<tr>
		<th>No.</th>
		<th>Klien</th>
		<th>Nama </th>
		<th>No. Handphone</th>		
		<th>Aksi</th>
	</tr>
	<?php
if ($hasil) {
	$i = 1;
	foreach ($hasil->result() as $key) :
	?>
	<tr>
		<td><?=$i?></td>
		<td><?=$key->nama?></td>
		<td><?=$key->Name?></td>
		<td><?=$key->Number?></td>		
		<td class="table-common-links" align="center"><a href="<?=base_url()?>handphone/data/<?=$key->ID?>">Ubah</a><a href="<?=base_url()?>handphone/detail/<?=$key->ID?>">Hapus</a></td>
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
			<a href="<?=base_url();?>handphone/data" id="add">Tambah Nomor Handphone</a>
		</td>
	</tr>
</table>

<div class="pageNav">
	<div class="pageInfo">
		<b>Halaman : <?=(!$this->pagination->create_links()) ? '1' : '';?></b>
	</div>
	<?=$this->pagination->create_links();?>	
</div>
</div>
</form>
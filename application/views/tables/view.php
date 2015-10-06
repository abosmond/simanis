<script>
$(function() {
	var 		
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
			url: '<?=base_url()?>tables/search',
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


<h3>Manajemen Tabel</h3>
<h2>Daftar Tabel</h2>
<br/>
<form name="form1" id="formCari" method="post" action="">	
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
		<th>Nama Tabel</th>
		<th>Format SMS</th>		
	</tr>
	<?php
if ($result) {
	$i = 1;
	foreach ($result->result() as $key) :
	?>
	<tr>
		<td><?=$i?></td>
		<td><?=$key->nama?></td>
		<td><?=$key->nama_table?></td>
		<td><?=$key->format_sms?></td>		
	</tr>
	<?php
	$i++;
	endforeach;
}
else {
	echo '<tr>
			<td colspan="4"><center>Data tidak ditemukan</center></td>
		  </tr>';
}
	?>
</table>
<table>
	<tr>
		<td class="table-common-links">
			<a href="<?=base_url();?>tables/data" id="add">Tambah Tabel</a>
		</td>
	</tr>
</table>
</div>
</form>
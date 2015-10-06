<?php
if ($this->uri->segment(3) == '')
	$name = 'Tambah';
else
	$name = 'Ubah';
?>
<script>
$(document).ready(function() {
	var tujuan,
		j_action = $('#j_action');
		
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});

	$('#klien').change(onSelectChange);
	
	function onSelectChange() {		
		var selected = $('#klien option:selected');								
		var output = '';
		if (selected.val() != 0) {
			var op = $('.list_client_' + selected.val()).val();
			output = 'sms_' + op;
		}
		
		$('#nama_table').val(output);
	}
	
	$('#formTable').submit(function() {			
		switch (j_action.val()) {
			case 'add_form' :
				tujuan = '<?=base_url();?>tables/create_form';
			break;
			case 'save_params' :
				tujuan = '<?=base_url();?>tables/create_table';
			break;
		}
		
		$.ajax({
			type	: 'POST',
			url		: tujuan,
			data	: $(this).serialize(),
			success	: function(data) {
				if (j_action.val() == 'add_form') {					
					$('#form_content').html(data);
				}
				else if (j_action.val() == 'save_params') {
					$('#window_msg_content').show();
					$('#window_msg_content').html(data);
				}
			}
		});
		return false;
	});
	
	$('#btn_add').click(function() {
		if ($('#klien option:selected').val() == 0) { alert('Klien harap dipilih'); return false;}
		if ($('#parameter').val() == '') { alert('Jumlah parameter harap diisi'); $('#parameter').focus(); return false;}
		j_action.val('add_form');
		$('#formTable').submit();
	});
	
	function resetForm(){
		$('form :input').val("");		
	}
});
</script>

<h2>Manajemen Tabel</h2>
<h3><?=$name?> Tabel</h3>
<br/>
<form id="formTable" name="formTable" method="post" action="">
<input type="hidden" name="j_action" id="j_action" value="">

<table width="100%" class="table-form">	
	<tr>
        <td>Pilih Klien</td>
        <td>
			<?=form_dropdown('id_client', $ret, '0', 'id="klien"')?>
			<?php
			if ($hasil) {
				foreach ($hasil->result() as $key) {
					echo '<input type="hidden" class="list_client_'.$key->id_client.'" value="'.$key->kode.'">';
				}
			}
			?>
		</td>
    </tr>
	<tr>
        <td>Kode Klien</td>
        <td><input name="db_nama_table" type="text" id="nama_table" size="40" value="" readonly="true" /></td>
    </tr>
	<tr>
        <td>Jumlah parameter</td>
        <td><input type="text" name="params" id="parameter" size="2" value="">&nbsp;&nbsp;<a href="javascript: void(0)" id="btn_add">Tambah</a></td>		
    </tr>	
</table>
<div id="window_msg_content"></div>
<div id="form_content">
</div>
</form>
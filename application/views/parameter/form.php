<?php
if ($this->uri->segment(3) == '') {
	$name = 'Tambah';
	$disabled = '';
}
else {
	$name = 'Ubah';
	$disabled = 'readonly="true"';
}
?>
<script>
$(function(){
	$('#btn_simpan').click(function(){	
		$('#j_action').val('add_param');
		$('#formKlien').submit();
	});
	
	$('#btn_update').click(function(){				
		$('#j_action').val('update_param');
		$('#formKlien').submit();
	});
	
	$('#btn_reset').click(function(){
		resetForm();		
	});
	
	function resetForm(){
		$('form :input').val("");		
	}
});

function resetForm(){
	$('form :input').val("");		
}
</script>
<h2>Manajemen Parameter</h2>
<h3><?=$name?> Parameter</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>Nama Parameter</td>
        <td><input name="db_nama_params" type="text" id="nama" size="40" value="<?=set_value('db_nama_param', @$row->nama_params);?>" /><br/>
			<cite>Nama parameter hanya boleh menggunakan tanda '_'</cite>
		</td>
    </tr>
	<tr>
        <td>Panjang Parameter</td>
        <td><input name="db_panjang_params" type="text" id="kode" size="5" value="<?=set_value('db_panjang_param', @$row->panjang_params);?>" /> &nbsp;&nbsp; karakter</td>
    </tr>			
	<tr>
        <td>Referensi</td>
        <td><?=form_dropdown('db_id_referensi', $refer, @$row->id_referensi);?></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links">
		<?php				
		if ($this->uri->segment(3)) :
			echo "<input type='hidden' id='id_client' name='id_param' value='".@$row->id."'>";
			echo "<a href='javascript: return void(0)' id='btn_update'>Update Data</a> ";			
		else:
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		endif;
		
		?>		
		
	  </tr>
</table>
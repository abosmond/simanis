<?php
if ($this->uri->segment(3) == '') {
	$name = 'Tambah';	
}
else {
	$name = 'Ubah';	
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
<h2>Manajemen Referensi</h2>
<h3><?=$name?> Data Referensi</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>Nama Referensi</td>
        <td><input name="db_alias" type="text" id="nama" size="40" value="<?=set_value('db_alias', @$row->alias);?>" /><br/>			
		</td>
    </tr>				
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links">
		<?php				
		if ($this->uri->segment(3)) :
			echo "<input type='hidden' id='db_nama' name='nama' value='".@$row->nama."'>";
			echo "<input type='hidden' id='id_client' name='id_param' value='".@$row->id."'>";
			echo "<a href='javascript: return void(0)' id='btn_update'>Update Data</a> ";			
		else:
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		endif;
		
		?>		
		
	  </tr>
</table>
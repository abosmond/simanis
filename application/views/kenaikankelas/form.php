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
<script type="text/javascript">
$(this).ready( function() {
	$("#nis").autocomplete("<?=base_url()?>kelas/lookup", {
		width: 260,
		mustMatch: true,
		matchContains: true,
		selectFirst: false
	});
	
	$("#nis").result(function(event, data, formatted) {
		if (data) {			
			$('#nis').val(data[0]);
			$('#result').html(data[1]);
			$('#nama').val(data[1]);			
		}
	});
	
	$("#select").change(function() {
		var option = $(this).val();
		
		$.post('<?=base_url()?>kelas/get_kelas', {select:option}, function(data) {
			var result = data.split("|");
			$('#tingkat').val(result[0]);
			$('#program').val(result[1]);
			$('#walikls').val(result[2]);
			$('#tahun').val(result[3]);
		});
	});
	
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
});

function resetForm(){
	$('form :input').val("");		
}

</script>

<h2>Data Kelas</h2>
<h3><?=$name?> Kelas</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>NIS </td>
        <td><input type="text" name="db_nis" id="nis" size="20" value="<?=set_value('db_nis', @$q->nis)?>" /></td>
    </tr>		  
	<tr>
        <td>Nama </td>
        <td><input type="text" name="db_nama" id="nama" size="50" value="<?=@$q->nama?>" readonly="true" /></td>
    </tr>
	<tr>
        <td>Kelas </td>
        <td><?=form_dropdown('db_kelas', $row, @$q->kelas, "id='select'")?></td>
    </tr>
	<tr>
        <td>Tingkat </td>
        <td><input type="text" name="db_Tingkat" id="tingkat" size="20" value="<?=@$q->Tingkat?>" readonly="true" /></td>
    </tr>
	<tr>
        <td>Program </td>
        <td><input type="text" name="db_program" id="program" size="20" value="<?=@$q->program?>" readonly="true" /></td>
    </tr>
	<tr>
        <td>Wali Kelas </td>
        <td><input type="text" name="db_walikls" id="walikls" size="40" value="<?=@$q->walikls?>" readonly="true" /></td>
    </tr>
	<tr>
        <td>Tahun </td>
        <td><input type="text" name="db_tahun" id="tahun" size="20" value="<?=@$q->tahun?>" readonly="true" /></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links">
		<?php				
		if ($this->uri->segment(3)) :
			echo "<input type='hidden' id='id_client' name='id_param' value='".@$q->id."'>";
			echo "<a href='javascript: return void(0)' id='btn_update'>Update Data</a> ";			
		else:
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		endif;
		
		?>		
	  </tr>
</table>
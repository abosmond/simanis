<script type="text/javascript">
$(this).ready( function() {
	$("#nama").autocomplete("<?=base_url()?>refkelas/lookup", {
		width: 260,
		mustMatch: true,
		matchContains: true,
		selectFirst: false
	});
	
	$("#nama").result(function(event, data, formatted) {
		if (data) {						
			$('#nama').val(data[0]);				
		}
	});
	
	$('#btn_simpan').click(function(){	
		$('#j_action').val('add_param');
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

<h2>Data Referensi Kelas</h2>
<h3>Tambah Referensi Kelas</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>Tingkat </td>
        <td><?=form_dropdown('db_tingkat', $tingkat, 0)?></td>
    </tr>		  
	<tr>
        <td>Program </td>
        <td><?=form_dropdown('db_program', $program, '0')?></td>
    </tr>
	<tr>
        <td>Kelas </td>
        <td><input type="text" name="db_kelas" size="20" /></td>
    </tr>
	<tr>
        <td>Wali Kelas </td>
        <td><input type="text" name="db_walikls" size="40" id="nama" /></td>
    </tr>
	<tr>
        <td>Tahun Ajaran </td>
        <td><input type="text" name="tahun" size="20" value="<?=@$tahunajaran->tahun?>" readonly="true" /></td>
    </tr>	
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><input type="hidden" name="db_tahun" value="<?=@$tahunajaran->id?>" />
		<?php				
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		?>		
	  </tr>
</table>
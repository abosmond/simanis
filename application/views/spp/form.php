<script type="text/javascript">
$(this).ready( function() {
	$("#nis").autocomplete("<?=base_url()?>absensi/lookup", {
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
			$('#kelas').val(data[2]);
			$('#telp').val(data[3]);
		}
	});
	
	$('#btn_simpan').click(function(){	
		$('#j_action').val('add_param');
		$('#formKlien').submit();
	});
	
	$('#btn_reset').click(function(){
		resetForm();		
	});
	
	$('#popupDatepicker').datepick({dateFormat: 'yyyy-mm-dd'});
	$('#inlineDatepicker').datepick({onSelect: showDate});
});

function resetForm(){
	$('form :input').val("");		
}

</script>

<h2>Data Absensi</h2>
<h3>Tambah Absensi</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="" autocomplete="off">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>Tanggal </td>
        <td><input type="text" name="db_tanggal" id="popupDatepicker" size="20" value="" /></td>
    </tr>		  
	<tr>
        <td>NIS </td>
        <td><input type="text" name="db_NIS" id="nis" size="20" value="" /></td>
    </tr>		  
	<tr>
        <td>Nama </td>
        <td><input type="text" id="nama" readonly="true" size="40" /></div></td>
    </tr>
	<tr>
        <td>Kelas </td>        
		<td><input type="text" id="kelas" readonly="true" size="40" /></div></td>
    </tr>
	<tr>
        <td>No. Hp Orang Tua </td>        
		<td><input type="text" id="telp" readonly="true" size="40" /></div></td>
    </tr>
	<tr>
        <td>Alasan Absen </td>        
		<td><input type="radio" id="radio" name="db_absen" value="sakit" checked="checked" />Sakit &nbsp;&nbsp;&nbsp; <input type="radio" id="radio" name="db_absen" value="izin" />Izin</td>
    </tr>
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><input type="hidden" name="db_tahun" value="<?=@$ta->id?>" /><input type="hidden" name="db_smt" value="<?=@$sem->id?>" />
		<?php				
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		?>		
	  </tr>
</table>
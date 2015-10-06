<script type="text/javascript">
$(this).ready( function() {
	$("#nis").autocomplete("<?=base_url()?>kasus/lookup", {
		width: 260,
		mustMatch: true,
		matchContains: true,
		selectFirst: false
	});
	
	$("#nis").result(function(event, data, formatted) {
		if (data) {			
			$('#nis').val(data[0]);			
			$('#nama').val(data[1]);
			$('#kelas').val(data[2]);
			$('#telp').val(data[3]);
			$('#hportu').val(data[3]);
			
		}
	});
	
	$('#btn_simpan').click(function(){	
		$('#j_action').val('add_param');
		$('#formKlien').submit();
	});
	
	$('#ya').click(function() {
		$('#sms').val($('#nama').val());
		$('#isisms').fadeIn();		
		
	});
	
	$('#tidak').click(function() {
		$('#isisms').hide();
		$('#sms').val('');		
	});
	
	$('#sms').keyup(function() {
		var len = this.value.length;
		if (len >= 160) {
			this.value = this.value.substring(0, 160);
		}
		$('#sisa').val(160 - len);
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

<h2>Data Kasus</h2>
<h3>Tambah Kasus</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="" enctype="multipart/form-data" autocomplete="off">
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
        <td>Kasus </td>        
		<td><input type="text" id="kasus" name="db_kasus" size="40" /></td>
    </tr>
	<tr>
        <td>Keterangan </td>        
		<td><textarea name="db_keterangan" rows="5" cols="30"></textarea></td>
    </tr>
	<tr>
        <td>Kirim SMS </td>        
		<td><input type="radio" id="tidak" name="db_kirimsms" value="0" checked="checked" />Tidak &nbsp;&nbsp;&nbsp; <input type="radio" id="ya" name="db_kirimsms" value="1" />Ya<div id="isisms" style="display: none;"><br/><br/><textarea name="sms" id="sms" rows="5" cols="30"></textarea><br/>Sisa Karakter : <input type="text" id="sisa" size="3" readonly="true" value="160"></div></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><input type="hidden" name="hportu" id="hportu" value=""><input type="hidden" name="db_idtahun" value="<?=$tahun?>"><input type="hidden" name="db_sem" value="<?=$sem->id?>">
		<?php				
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		?>		
	  </tr>
</table>
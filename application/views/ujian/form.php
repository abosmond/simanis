<script type="text/javascript">
$(this).ready( function() {
	$("#select").change(function(){
		var selectValues = $("#select").val();
			if (selectValues == 0){				
				var msg = '<select name="db_MP" disabled><option value="Pilih Mata Pelajaran">Pilih Tingkat Dahulu</option></select>';
				$('#mapel').html(msg);
			}else{				
				var mp = {mp:$("#select").val()};
				
				$('#mp_id').attr("disabled",true);
				$.ajax({
						type: "POST",
						url : '<?=base_url()?>ujian/pilihmapel',
						data: mp,
						success: function(msg){
							$('#mapel').html(msg);
						}
				});
			}
		
	});
	$("#mp").autocomplete("<?=base_url()?>ujian/lookup", {
		width: 260,
		mustMatch: true,
		matchContains: true,
		selectFirst: false
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
<h2>Data Ujian</h2>
<h3>Tambah Ujian</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="50%" class="table-form">	
	<tr>
        <td>Tanggal </td>
        <td><input type="text" name="db_TANGGAL" id="popupDatepicker" size="20" value="" /></td>
    </tr>		  
	<tr>
        <td>Hari </td>
        <td><?=form_dropdown('db_HARI', $hari, '0');?></td>
    </tr>		  
	<tr>
        <td>Waktu </td>
        <td><input type="text" name="db_JAM" id="jam" size="10" />&nbsp;&nbsp; <cite>Contoh : 07:00</cite></td>
    </tr>
	<tr>
        <td>Tingkat </td>        
		<td><?=form_dropdown('db_TINGKAT', $tingkat, '0', 'id="select"');?></td>
    </tr>
	<tr>
        <td>Mata Pelajaran </td>        
		<td><div id="mapel"><?=form_dropdown("db_MP",array('Pilih Mata Pelajaran'=>'Pilih Tingkat Dahulu'),'','disabled');?></div></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><input type="hidden" name="db_TAHUN" value="<?=@$ta->id?>" /><input type="hidden" name="db_SEM" value="<?=@$sem->id?>" />
		<?php				
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		?>		
	  </tr>
</table>
</form>
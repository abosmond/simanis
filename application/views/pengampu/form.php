<script type="text/javascript">
$(this).ready( function() {
	$("#select").change(function(){
		var selectValues = $("#select").val();
			if (selectValues == 0){				
				var msg = '<select name="db_idkelas" disabled><option value="Pilih Kelas">Pilih Tingkat Dahulu</option></select>';
				$('#kelas').html(msg);
			}else{				
				var mp = {mp:$("#select").val()};
				
				$('#mp_id').attr("disabled",true);
				$('#kls_id').attr("disabled",true);
				$.ajax({
						type: "POST",
						url : '<?=base_url()?>pengampu/pilihmapel',
						data: mp,
						success: function(msg){
							$('#mapel').html(msg);
							return false;
						}
				});
				
				$.ajax({
						type: "POST",
						url : '<?=base_url()?>pengampu/pilihkelas',
						data: mp,
						success: function(msg){							
							$('#kelas').html(msg);
						}
				});
			}
		
	});
	
	$("#nama").autocomplete("<?=base_url()?>pengampu/lookup", {
		width: 260,
		mustMatch: true,
		matchContains: true,
		selectFirst: false
	});
	
	$("#nama").result(function(event, data, formatted) {
		if (data) {						
			$('#nama').val(data[0]);	
			$('#nip').val(data[1]);				
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
<h2>Data Ujian</h2>
<h3>Tambah Ujian</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="50%" class="table-form">	
	<tr>
        <td>Guru </td>
        <td><input type="text" name="nama" size="40" id="nama" /></td>
    </tr>		  			  	
	<tr>
        <td>Tingkat </td>        
		<td><?=form_dropdown('tingkat', $tingkat, '0', 'id="select"');?></td>
    </tr>
	<tr>
        <td>Kelas </td>        
		<td><div id="kelas"><?=form_dropdown("db_idkelas",array('Pilih Kelas'=>'Pilih Tingkat Dahulu'),'','disabled');?></div></td>
    </tr>
	<tr>
        <td>Mata Pelajaran </td>        
		<td><div id="mapel"><?=form_dropdown("db_idmp",array('Pilih Mata Pelajaran'=>'Pilih Tingkat Dahulu'),'','disabled');?></div></td>
    </tr>	
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><input type="hidden" name="db_idtahun" value="<?=@$ta->id?>" /><input type="hidden" name="db_nip" id="nip" value="" />
		<?php				
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		?>		
	  </tr>
</table>
</form>
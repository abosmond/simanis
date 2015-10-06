<script>
$(function(){
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});
	
	$('#add').click(function(){			
		if ($('#akhir').val() == 0) {
			alert('Kelas Baru Harap dipilih');
			return false;
		}
		
		$('#secondList').each(function(){
			$('#secondList option').attr("selected","selected");
		});
		$('#j_action').val('add_param');
		$('#frm_format').submit();
	});
	
	$('#noadd').click(function(){			
		if ($('#awal').val() == 0) {
			alert('Kelas Harap dipilih');
			return false;
		}
		
		$('#firstList').each(function(){
			$('#firstList option').attr("selected","selected");
		});
		$('#j_action').val('add_tinggal');
		$('#frm_format').submit();
	});
	
	$('#awal').change(function() {		
		var selectValues = $("#awal").val();
			if (selectValues == 0){				
				var msg = '<select name="kelasakhir" disabled><option value="Pilih Kelas">-- Pilih Kelas --</option></select>';
				$('#mapel').html(msg);
			}else{				
				var mp = {mp:$("#awal").val()};
				
				$('#mp_id').attr("disabled",true);
				$.ajax({
						type: "POST",
						url : '<?=base_url()?>kenaikankelas/pilihkelas',
						data: mp,
						success: function(msg){							
							$('#mapel').html(msg);
						}
				});
			}
		$('#renderkelasawal').load('<?=base_url()?>kenaikankelas/loadkelas/' + $('#awal').val() + '/' + $('#ta').val());
	});	
	
	$('#mp_id').change(function() {		
		var selectValues = $("#mp_id").val();
		if (selectValues == 0){				
			alert('Silakan pilih kelas terlebih dahulu');
			return false;
		}else{				
			$('#renderkelasakhir').load('<?=base_url()?>kenaikankelas/loadkelasakhir/' + $('#mp_id').val() + '/' + $('#tahunajaranakhir').val());
		}		
	});	
	
	$('#tahunajaranakhir').change(function() {
		if (($('#tahunajaranakhir').val() == $('#ta').val()) || ($('#tahunajaranakhir').val() < $('#ta').val())) {
			alert('Harap pilih tahun ajaran yang aktif');
			return false;
		}
	});
	
	$('#akhir').change(function() {
		if (($('#akhir').val() == $('#awal').val()) || ($('#akhir').val() < $('#awal').val())) {
			alert('Harap pilih kelas yang lebih tinggi');
			return false;
		}
	});
	
	$('#to2').click(function() {
		return !$('#firstList option:selected').remove().appendTo('#secondList'); 		
	});

	$('#to1').click(function() {
		return !$('#secondList option:selected').remove().appendTo('#firstList'); 
	});
	
});
</script>
<h2>Data Kenaikan Kelas</h2>
<h3>Kenaikan Kelas</h3>
<br /><br />
<table border="0" cellpadding="0" cellspacing="0" width="100%">	
	<tr>		
		<td width="100%">

			<form id="frm_format" name="frm_format" method="post" action="">
			<input type="hidden" id="j_action" name="j_action" value="">
			<table cellpadding="0" id="tbl_format"cellspacing="0" border="0" width="100%" class="standard_table_v4">	
				<thead>
				</thead>
				<tbody>
					<tr>
						<td>
						<td align="center">
							Tahun ajaran 	: <input type="text" name="tahunajaran" value="<?=@$thnsebelum->tahun?>" id="tahunajaran" readonly="true" /><input type="hidden" name="ta" value="<?=@$thnsebelum->id?>" id="ta" /><br /><br />
							&nbsp;&nbsp;&nbsp;&nbsp;Kelas 			: <?=form_dropdown('kelas', $kenaikankelas, '0', "id='awal'")?><br /><br/>
							<div id="renderkelasawal"><select id="firstList" multiple="multiple" style="height:420px;width: 250px;" >
							</select></div>									
						</td>
						<td align="center">
							<input id="to2" type="button" name="to2"  title='assign' value=">" /><br/><br/>						
						</td>
						<td align="center">
							Tahun ajaran 	: <input type="text" name="tahunajaranakhir" value="<?=@$thnsesudah->tahun?>" id="ti" readonly="true" /><input type="hidden" name="to" value="<?=@$thnsesudah->id?>" id="tahunajaranakhir" /><br /><br />
							&nbsp;&nbsp;Kelas 			: <div id="mapel"><?=form_dropdown("kelasakhir",array('Pilih Kelas'=>'-- Pilih Kelas --'),'','disabled');?></div>
							<div id="renderkelasakhir"><select name="secondList[]" id="secondList" multiple="multiple" style="height:420px;width: 250px;" >
							</select></div>
						</td>						
					</tr>
					
				</tbody>
			</table>

			
			
		</td>
	</tr>
	<tr>
						<td class="table-common-links" colspan="4" style="align:right ! important;"><br/>
							<input type="hidden" name="nis" id="nis" value=""><a href="javascript: return void(0)" id="add"><strong>NAIK KELAS</strong></a>
						</td>
					</tr>
</table>


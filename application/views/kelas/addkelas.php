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
		
	$('#awal').change(function() {
		if ($('#tahunajaran').val() == 0) {
			alert('Tahun Ajaran harap dipilih'); return false;
		}
		$('#renderkelasawal').load('<?=base_url()?>kenaikankelas/loadkelas/' + $('#awal').val() + '/' + $('#tahunajaran').val());
	});	
		
	$('#tahunajaranakhir').change(function() {
		if (($('#tahunajaranakhir').val() == $('#tahunajaran').val()) || ($('#tahunajaranakhir').val() < $('#tahunajaran').val())) {
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
<h2>Data Kelas</h2>
<h3>Tambah Kelas</h3>
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
							Daftar Siswa<br /><br />
							<?php
							if ($result) {
							?>
							<?=form_multiselect('firstList', $result, '', 'id="firstList" style="height:420px;width: 250px;"');?>							
							<?php
							}
							else {
							?>
							<select name="firstList" id="firstList" multiple="multiple" style="height:420px;width: 250px;" >
							</select>			
							<?php
							}
							?>
						</td>
						<td align="center">
							<input id="to2" type="button" name="to2"  title='assign' value=">" /><br/><br/>

							<input id="to1" type="button" name="to1" title='unassign' value="<">
						</td>
						<td align="center">							
							&nbsp;&nbsp;&nbsp;&nbsp;Kelas 			: <?=form_dropdown('kelasakhir', $kelas, '0', "id='akhir'")?><br /><br/>
							<select name="secondList[]" id="secondList" multiple="multiple" style="height:420px;width: 250px;" >
							</select>									
						</td>						
					</tr>
					
				</tbody>
			</table>

			
			
		</td>
	</tr>
	<tr>
						<td colspan=""></td>
						<td class="table-common-links"><br/>
							<input type="hidden" name="nis" id="nis" value=""><a href="javascript: return void(0)" id="add">Simpan</a>
						</td>
					</tr>
</table>
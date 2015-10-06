<script>
$(function(){
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});
	
	$('#simpan').click(function(){			
				
		$('#firstList').each(function(){
			$('#firstList option').attr("selected","selected");
		});
		$('#j_action').val('add_param');
		$('#frm_format').submit();
	});
	
	$('#awal').change(function() {		
		var selectValues = $("#awal").val();
			if (selectValues == '0'){				
				alert('Kelas Harap dipilih');
				return false;
			}
		$('#renderkelasawal').load('<?=base_url()?>tinggalkelas/loadkelas/' + $('#awal').val() + '/' + $('#tahunajaranakhir').val());
	});		
});
</script>
<h2>Data Tinggal Kelas</h2>
<h3>Siswa Tinggal Kelas</h3>
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
							Tahun ajaran 	: <input type="text" name="tahunajaranakhir" value="<?=@$thnsesudah->tahun?>" id="ti" readonly="true" /><input type="hidden" name="db_idtahun" value="<?=@$thnsebelum->id?>" id="tahunajaranakhir" /><br /><br />
							&nbsp;&nbsp;&nbsp;&nbsp;Kelas 			: <?=form_dropdown('db_idkelas', $tinggalkelas, '0', "id='awal'")?><br /><br/>
							<div id="renderkelasawal"><select id="firstList" name="firstList[]" multiple="multiple" style="height:420px;width: 250px;" >
							</select></div>									
						</td>												
					</tr>
					
				</tbody>
			</table>

			
			
		</td>
	</tr>
	<tr>
						<td class="table-common-links" colspan="4" style="align:right ! important;"><br/>
							<input type="hidden" name="nis" id="nis" value=""><a href="javascript: return void(0)" id="simpan"><strong>TINGGAL KELAS</strong></a>
						</td>
					</tr>
</table>
		</form>

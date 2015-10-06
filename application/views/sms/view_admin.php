<script>
$(function() {
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});
			
	$('#formCari').submit(function() {	
		
		switch ($('#j_action').val()) {
			case 'paging' :
				var tujuan = '<?=base_url();?>sms_admin/search';
			break;
			case 'show' :
				var tujuan = '<?=base_url();?>sms_admin/show';
			break;
		}
		
		$.ajax({
			type: 'POST',				
			url: tujuan,
			data: $(this).serialize(),
			success: function(data) {				
				//alert(data);
				$('#window_popup_data').show();
				$("#window_popup_data_content").html(data);						
			}
		})
		return false;
	});
	
	$('#btn_simpan').click(function() {
		if ($('#id_client').val() == 0) {alert('Klien harap dipilih');return false;}
		$('#j_action').val('show');
		$('#formCari').submit();
	});
});
</script>
<h3>Manajemen Data SMS</h3>
<h2>Daftar SMS</h2>
<br/><br/>

<form id="formCari" method="post" action="">
<input type="hidden" name="start_data" id="start_data" value="0" />
<input type="hidden" name="j_action" id="j_action" value="">
<div id="msg_content">
<table class="table-form" width="760px">
	<tr>
        <td>Klien</td>
        <td><?=form_dropdown('id_client', $client, '0', 'id="id_client"');?></td>
    </tr>	
	<tr>
        <td>Tahun</td>
        <td><?=htmlYearSelector('tahun')?></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><a href='javascript: return void(0)' id='btn_simpan'>Tampilkan Data</a></td>				
	</tr>
</table>
</div>


<div id="window_popup_data" style="display:none">
	<div id="window_popup_data_content"></div>
</div>


</div>
</form>
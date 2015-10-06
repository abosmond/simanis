<script>
$(function(){
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});
	
	$('#btn_simpan').click(function(){			
		$('#j_action').val('add_param');
		$('#formKlien').submit();
	});
	
	/* $('#formKlien').submit(function() {
		$.ajax({
			type	: 'POST',
			url		: '<?=base_url()?>nilai/lists',
			data	: $(this).serialize(),
			success	: function(data) {				
				$('#render_chart').html(data);
			}
		});
		return false;
	});	 */
	
	$('#client').change(function() {
		$('#render_chart').load('<?=base_url()?>nilai/lists/' + $('#client').val());
	});	
});
</script>
<h2>Broadcast SMS</h2>
<br/>

<form id="formKlien" name="formKlien" method="post" action="">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>NIS </td>
        <td><input name="nis" type="text" id="nis" size="20" />&nbsp;[opsional]</td>
    </tr>
	<tr>
        <td>Tingkat </td>
        <td><?=form_dropdown('tingkat', $tingkat, '0');?>&nbsp;[opsional]</td>
    </tr>	
	<tr>
        <td>Group </td>
        <td><?=form_dropdown('group', $group, '0');?></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><a href='javascript: return void(0)' id='btn_simpan'>Pilih</a></td>		
	</tr>
</table>
<br/><br/>
<div id="render_chart"></div>
</form>
<script>
$(function(){
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});
	
	$('#btn_simpan').click(function(){	
		if ($('#tingkat').val() == '0') {
			alert('Silakan Pilih Tingkat Terlebih Dahulu');
			return false;
		}
		$('#j_action').val('add_param');
		$('#formKlien').submit();
	});
	
	$('#isisms').keyup(function() {
		var len = this.value.length;
		if (len >= 160) {
			this.value = this.value.substring(0, 160);
		}
		$('#sisa').val(160 - len);
	});
});

</script>
<h2>Broadcast SMS</h2>
<br/>

<form id="formKlien" name="formKlien" method="post" action="">
<input type="hidden" id="j_action" name="j_action" value="">
<?=validation_errors();?>
<table width="100%" class="table-form">	
	<tr>
        <td>Isi SMS </td>
        <td><textarea name="isisms" id="isisms" cols="35" rows="5"></textarea></td>
    </tr>
	<tr>
        <td colspan="2">Sisa Karakter : <input type="text" id="sisa" size="3" readonly="true" value="160"></td>        
    </tr>
	<tr>
        <td>Tingkat </td>
        <td><?=form_dropdown('tingkat', $kls, '0', 'id="tingkat"');?></td>
    </tr>		
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><a href='javascript: return void(0)' id='btn_simpan'>Pilih</a></td>		
	</tr>
</table>
<br/><br/>
<div id="render_chart"></div>
</form>
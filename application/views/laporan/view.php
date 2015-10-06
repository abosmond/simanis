<script>
$(function(){
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});

	$('#btn_simpan').click(function(){	
		if ($('#paramx').val() == 0) {alert('Parameter 1 harap dipilih'); $('#paramx').focus(); return false;}
		if ($('#paramy').val() == 0) {alert('Parameter 2 harap dipilih'); $('#paramy').focus(); return false;}
		if ($('#paramx').val() == $('#paramy').val()) {alert('Parameter tidak boleh sama'); return false;}
		$('#j_action').val('add_param');
		$('#formKlien').submit();
	});
	
	$('#formKlien').submit(function() {
		$.ajax({
			type	: 'POST',
			url		: '<?=base_url()?>laporan/render_chart',
			data	: $(this).serialize(),
			success	: function(data) {				
				$('#render_chart').html(data);
			}
		});
		return false;
	});
});
</script>
<h2>Manajemen Laporan</h2>
<h3>Buat Laporan</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>Parameter 1 (sumbu X) </td>
        <td><?=form_dropdown('paramx', $opsi, '0', 'id="paramx"');?></td>
    </tr>
	<tr>
        <td>Parameter 2 (sumbu Y)</td>
        <td><?=form_dropdown('paramy', $opsi, '0', 'id="paramy"');?></td>
    </tr>			
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><a href='javascript: return void(0)' id='btn_simpan'>Lihat Grafik</a></td>		
	</tr>
</table>
<br/><br/>
<div id="render_chart"></div>
</form>
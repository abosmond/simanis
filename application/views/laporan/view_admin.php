<script>
$(function(){
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});
	
	$('#btn_simpan').click(function(){	
		if ($('#client').val() == 0) {alert('Klien harap dipilih'); $('#client').focus(); return false;}
		if ($('#paramx').val() == 0) {alert('Parameter 1 harap dipilih'); $('#paramx').focus(); return false;}
		if ($('#paramy').val() == 0) {alert('Parameter 2 harap dipilih'); $('#paramy').focus(); return false;}
		if ($('#paramx').val() == $('#paramy').val()) {alert('Parameter tidak boleh sama'); return false;}
		$('#j_action').val('add_param');
		$('#formKlien').submit();
	});
	
	$('#formKlien').submit(function() {
		$.ajax({
			type	: 'POST',
			url		: '<?=base_url()?>laporan_admin/render_chart',
			data	: $(this).serialize(),
			success	: function(data) {
				//alert(data);
				$('#render_chart').html(data);
			}
		});
		return false;
	});
	
	$('#client').change(function() {
		if ($('#client').val() == 0) {
			$('#params_satu').hide();
			$('#params_dua').hide();
		}
		else {
			$('#params_satu').show();
			$('#params_dua').show();
			$('#params_satu').load('<?=base_url()?>laporan_admin/show_referensi/' + $('#client').val() + '/x');
			$('#params_dua').load('<?=base_url()?>laporan_admin/show_referensi/' + $('#client').val() + '/y');
		}
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
        <td>Klien </td>
        <td><?=form_dropdown('id_client', $client, '0', 'id="client"');?></td>
    </tr>
	<tr>
        <td>Parameter 1 </td>
        <td><div id="params_satu"></div></td>
    </tr>
	<tr>
        <td>Parameter 2 </td>
        <td><div id="params_dua"></div></td>
    </tr>					
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><a href='javascript: return void(0)' id='btn_simpan'>Lihat Grafik</a></td>		
	</tr>
</table>
<br/><br/>
<div id="render_chart"></div>
</form>
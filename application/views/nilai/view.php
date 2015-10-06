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
<h2>Manajemen Data Siswa & Aktiftas</h2>
<h3>Daftar Nilai</h3>
<br/>

<form id="formKlien" name="formKlien" method="post" action="">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>Kelas</td>
        <td><?=form_dropdown('kelas', $kelas, '0', 'id="client"');?></td>
    </tr>					
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><a href='javascript: return void(0)' id='btn_simpan'>Pilih</a></td>		
	</tr>
</table>
<br/><br/>
<div id="render_chart"></div>
</form>
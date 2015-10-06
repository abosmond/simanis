<script>
$(function(){
	var dest;
	
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});
	
	$('#btn_simpan').click(function(){		
		if ($('#client').val() == 0) { alert('Kelas harap dipilih'); return false; }
		$('#j_action').val('add_kelas');
		$('#formKlien').submit();
	});	
	
	$('#formKlien').submit(function() {
		switch ($('#j_action').val()) {
			case 'add_kelas' :
				dest = '<?=base_url()?>spp/lists'; 
			break;
			
			case 'add_absen' :
				dest = '<?=base_url()?>spp/add'; 
			break;
		}
		
		$.ajax({
			type	: 'POST',
			url		: dest,
			data	: $(this).serialize(),
			success	: function(data) {	
				
				if ($('#j_action').val() == 'add_kelas') {		
					alert(data);
					$('#render_chart').html(data);
				}
				else if ($('#j_action').val() == 'add_absen') {					
					alert('Data sukses disimpan');
				}
				
			}
		});
		return false;
	});	
});
</script>
<h2>Manajemen Data Siswa & Aktiftas</h2>
<h3>Daftar SPP</h3>
<br/>

<form id="formKlien" name="formKlien" method="post" action="">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>Periode </td>
        <td><?=form_dropdown('bulan', $bln, date('m'))?>&nbsp;&nbsp;&nbsp;<?=htmlYearSelector('tahun')?></td>
    </tr>
	<tr>
        <td>Kelas </td>
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
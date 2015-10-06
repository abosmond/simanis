<script>
$(function(){
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});
	
	$('#btn_simpan').click(function(){		
		if ($('#popupDatepicker').val() == '') { alert('Periode awal harap diisi'); return false;}
		if ($('#akhirDatepicker').val() == '') { alert('Periode akhir harap diisi'); return false;}
		//if ($('#akhirDatepicker').val() > $('#popupDatepicker').val()) { alert('Periode awal harus lebih kecil dari periode akhir'); return false;}
		if ($('#kelas').val() == 0) { alert('kelas harap dipilih'); return false;}
		if ($('#nis').val() == '') $('#nis').val('0');
		$('#j_action').val('add_rekap');
		$('#formKlien').submit();		
	}); 
	
	$('#popupDatepicker').datepick({dateFormat: 'yyyy-mm-dd'});
	$('#akhirDatepicker').datepick({dateFormat: 'yyyy-mm-dd'});
	
	$("#nis").autocomplete("<?=base_url()?>kasus/lookup", {
		width: 260,
		mustMatch: true,
		matchContains: true,
		selectFirst: false
	});
	
	$('#formKlien').submit(function() {
		$.ajax({
			type	: 'POST',
			url		: '<?=base_url()?>rekapspp/lists',
			data	: $(this).serialize(),
			success	: function(data) {					
				$('#render_chart').html(data);
			}
		});
		return false;
	});	 
});
</script>
<h2>Laporan SPP</h2>
<h3>Rekap SPP</h3>
<br/>

<form id="formKlien" name="formKlien" method="post" action="">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>Periode </td>
        <td><?=form_dropdown('bulan', $bln, date('m'))?>&nbsp;&nbsp;&nbsp;<?=htmlYearSelector('tahun')?></td>
    </tr>
	<tr>
        <td>NIS </td>
        <td><input type="text" name="nis" id="nis" size="20" value="" />&nbsp;&nbsp;[opsional]</td>
    </tr>
	<tr>
        <td>Kelas </td>
        <td><?=form_dropdown('kelas', $kelas, '0', 'id="kelas"')?></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><a href='javascript: return void(0)' id='btn_simpan'>Pilih</a></td>		
	</tr>
</table>
<br/><br/>
<div id="render_chart"></div>
</form>
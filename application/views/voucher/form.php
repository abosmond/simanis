<script type="text/javascript">
$(this).ready( function() {
	$("#nis").autocomplete("<?=base_url()?>voucher/lookup", {
		width: 260,
		mustMatch: true,
		matchContains: true,
		selectFirst: false
	});
	
	$("#nis").result(function(event, data, formatted) {
		if (data) {			
			$('#nis').val(data[0]);
			$('#result').html(data[1]);
			$('#nama').val(data[1]);
			$('#nohp1').val(data[2]);
			$('#nohp2').val(data[3]);
		}
	});
	
	$('#btn_simpan').click(function(){	
		$('#j_action').val('add_param');
		$('#formKlien').submit();
	});
	
	$('#btn_reset').click(function(){
		resetForm();		
	});
});

function resetForm(){
	$('form :input').val("");		
}

</script>

<h2>Data Voucher</h2>
<h3>Tambah Voucher</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>NIS </td>
        <td><input type="text" name="db_NIS" id="nis" size="20" value="" /></td>
    </tr>		  
	<tr>
        <td>Nama </td>
        <td><div id="result"></div></td>
    </tr>
	<tr>
        <td>Pulsa </td>
        <td><?=form_radio('db_PULSA', '5000')?>5000<br/>
		    <?=form_radio('db_PULSA', '10000')?>10000<br/>
			<?=form_radio('db_PULSA', '20000')?>20000<br/>
			<?=form_radio('db_PULSA', '50000', TRUE)?>50000<br/>
			<?=form_radio('db_PULSA', '100000')?>100000<br/></td>
    </tr>
	
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><input type="hidden" name="db_NOHP1" id="nohp1" value="" /><input type="hidden" name="db_NOHP2" id="nohp2" value="" /><input type="hidden" name="db_NAMA" id="nama" value="" />
		<?php				
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		?>		
	  </tr>
</table>
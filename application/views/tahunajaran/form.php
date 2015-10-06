<script type="text/javascript">
$(this).ready( function() {	
	$('#btn_simpan').click(function(){	
		$('#j_action').val('add_param');
		$('#formKlien').submit();
	});
	
	$('#btn_reset').click(function(){
		resetForm();		
	});
	
	$('#mulai').datepick({dateFormat: 'yyyy-mm-dd'});
	$('#akhir').datepick({dateFormat: 'yyyy-mm-dd'});
});

function resetForm(){
	$('form :input').val("");		
}

</script>

<h2>Data Tahun Ajaran</h2>
<h3>Tambah Tahun Ajaran</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>Tahun Ajaran </td>
        <td><input type="text" name="db_tahun" size="20" id="nama" /><br/><cite>Contoh : 2008/2009</cite></td>
    </tr>		  
	<tr>
        <td>Periode Awal </td>
        <td><input type="text" name="db_mulai" id="mulai" size="20" value="" /></td>
    </tr>
	<tr>
        <td>Periode Akhir </td>
        <td><input type="text" name="db_akhir" id="akhir" size="20" value="" /></td>
    </tr>
	<tr>
        <td>Semester </td>
        <td><?=form_dropdown('db_semester', $sem, '0');?></td>
    </tr>	
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links">
		<?php				
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		?>		
	  </tr>
</table>
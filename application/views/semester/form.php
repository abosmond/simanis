<script type="text/javascript">
$(this).ready( function() {	
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

<h2>Data Semester</h2>
<h3>Tambah Semester</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="" autocomplete="off">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>Nama Semester</td>
        <td><input type="text" name="db_nama_semester" size="20" id="nama" /><br/><cite>Contoh : I / II</cite></td>
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
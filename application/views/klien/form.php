<?php
if ($this->uri->segment(3) == '') {
	$name = 'Tambah';
	$disabled = '';
}
else {
	$name = 'Ubah';
	$disabled = 'readonly="true"';
}
?>
<script>
$(function(){
	$('#btn_simpan').click(function(){	
		$('#j_action').val('add_client');
		$('#formKlien').submit();
	});
	
	$('#btn_update').click(function(){				
		$('#j_action').val('update_client');
		$('#formKlien').submit();
	});
	
	$('#btn_reset').click(function(){
		resetForm();		
	});
	
	function resetForm(){
		$('form :input').val("");		
	}
});

function resetForm(){
	$('form :input').val("");		
}
</script>
<h2>Manajemen Klien</h2>
<h3><?=$name?> Klien</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>Nama Klien</td>
        <td><input name="db_nama" type="text" id="nama" size="40" value="<?=set_value('db_nama', @$row->nama);?>" /></td>
    </tr>
	<tr>
        <td>Kode Klien</td>
        <td><input name="db_kode" type="text" id="kode" size="40" value="<?=set_value('db_kode', @$row->kode);?>" <?=$disabled?> /></td>
    </tr>		
	<tr>
        <td>Alamat</td>
        <td><input name="db_alamat" type="text" id="alamat" size="40" value="<?=set_value('db_alamat', @$row->alamat);?>"/></td>
    </tr>	
	<tr>
        <td>Jenis Survei</td>
        <td><?=form_dropdown('db_id_jenis_survei', $survei, @$row->id_jenis_survei);?></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links">
		<?php				
		if ($this->uri->segment(3)) :
			echo "<input type='hidden' id='id_client' name='id_client' value='".@$row->id_client."'>";
			echo "<a href='javascript: return void(0)' id='btn_update'>Update Data</a> ";			
		else:
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		endif;
		
		?>		
		
	  </tr>
</table>
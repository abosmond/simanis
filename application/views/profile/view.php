<script>
$(function(){
	$('#btn_update').click(function(){				
		$('#formKlien').submit();
	});
});
</script>
<h2>Profile Akademik</h2>

<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="">
<table width="100%" class="table-form">	
	<?php
	$field = array('nama_sekolah' => 'Nama Sekolah', 'alamat' => 'Alamat', 'telp' => 'No. Telp');
	
	
	foreach ($field as $r => $v) {
	?>
	<tr>
        <td><?=$v?></td>
        <td><input name="db_<?=$r?>" type="text" id="<?=$r?>" size="40" value="<?=set_value('db_'.$r, @$row->$r);?>" /></td>
    </tr>
	<?php
	}
	?>	
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links">
			<a href='javascript: return void(0)' id='btn_update'>Update Data</a>		
	  </tr>
</table>
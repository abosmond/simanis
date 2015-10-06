<script>
$(function(){
	$('#btn_update').click(function(){				
		$('#formKlien').submit();
	});
});
</script>
<h2>Potongan Pulsa</h2>

<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="">
<table width="100%" class="table-form">		
	<tr>
        <td>Besar Potongan Pulsa</td>
        <td>Rp <input name="db_biayapotong" type="text" id="biayapotong" size="40" value="<?=set_value('db_biayapotong', @$row->biayapotong);?>">
		<input type="checkbox" name="db_stat_potong_pulsa" value="<?=@$row->stat_potong_pulsa?>" <?php if (@$row->stat_potong_pulsa == '1') echo 'checked="checked"';?>>Aktifkan potongan pulsa</td>
    </tr>	
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links">
			<a href='javascript: return void(0)' id='btn_update'>Simpan</a>		
	  </tr>
</table>
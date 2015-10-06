<script>
$(function(){		
	$('#add').click(function(){	
		$('#j_action').val('kirim_sms');
		$('#formKlien').submit();
	});	
});

function resetForm(){
	$('form :input').val("");		
}
</script>

<h2>Data Nilai</h2>
<h3>Nilai <?=$siswa->NAMA?></h3>
<br/>

<form id="formKlien" name="formKlien" method="post" action="" enctype="multipart/form-data">
<input type="hidden" id="j_action" name="j_action" value="">
<input type="hidden" name="tahunajaran" value="<?=@$tahunajaran->id?>">
<input type="hidden" name="semester" value="<?=@$sem->id?>">
<input type="hidden" name="namasiswa" value="<?=@$siswa->NAMA?>">
<input type="hidden" name="nis" value="<?=@$this->uri->segment(3)?>">
<table class="table-common" width="760px">
	<tr>
		<th>No.</th>
		<th>Kode MP</th>
		<th>Mata Pelajaran</th>		
		<th>Alias</th>		
		<th>Nilai</th>
	</tr>
	<?php
if ($nilai) {
	$i = 1;
	foreach ($nilai->result() as $key) :		
	?>
	<tr>
		<td><?=$i?>.</td>		
		<td><?=$key->KDMP?></td>
		<td><?=$key->MP?></td>
		<td><?=$key->ALIAS?></td>
		<td><?=$key->nilai?></td>						
	</tr>
	<?php	
		$i++;
	endforeach;	
}
?>
	<tr>
		<td class="table-common-links" colspan="5" style="align: right !important;">
			<a href="javascript: return void(0)" id="add">Kirim</a>	
		</td>
	</tr>
</table>
</form>
<script>
$(function(){		
	$('#add').click(function(){	
		$('#j_action').val('add_nilai');
		$('#formKlien').submit();
	});	
});

function resetForm(){
	$('form :input').val("");		
}
</script>

<h2>Data Nilai</h2>
<h3>Tambah / Ubah Data Nilai <?=$siswa->NAMA?></h3>
<br/>

<form id="formKlien" name="formKlien" method="post" action="" enctype="multipart/form-data">
<input type="hidden" id="j_action" name="j_action" value="">
<input type="hidden" name="tahunajaran" value="<?=@$tahunajaran->id?>">
<input type="hidden" name="nis" value="<?=@$this->uri->segment(3)?>">
<table class="table-common" width="760px">
	<tr>
		<th>No.</th>
		<th>NIP</th>
		<th>Guru</th>		
		<th>Kode Mapel</th>
		<th>Mata Pelajaran </th>		
		<th>Nilai</th>
	</tr>
	<?php
if ($mapel) {
	$i = 1;$k = 0;
	foreach ($mapel as $key) :
	
		if ($nilaisiswa) {
			$j = 0;
			foreach ($nilaisiswa as $v) {		
				
				if ($v->kdmp == $key->KDMP) {
					$mNilai[$j] = $v->nilai;
				}
				else
					$mNilai[$j] = '';
				$j++;
			}			
		}
	?>
	<tr>
		<td><?=$i?></td>		
		<td><?=$key->NIP?></td>
		<td><?=$key->NAMA?></td>
		<td><?=$key->KDMP?></td>
		<td><?=$key->MP?></td>				
		<td class="table-common-links" align="center"><input type="hidden" name="db_kdmp[]" value="<?=@$key->KDMP?>" /><input type="hidden" name="db_nip[]" value="<?=@$key->NIP?>" /><input type="text" name="db_nilai[]" size="5" value="<?=@$mNilai[$k]?>" /></td>
	</tr>
	<?php			
	$i++; $k++;
	endforeach;
	
}
?>
	<tr>
		<td class="table-common-links" colspan="6" style="align: right !important;">
			<a href="javascript: return void(0)" id="add">Simpan</a>&nbsp;&nbsp;<a href="<?=base_url()?>nilai/kirimsms/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>" id="kirimsms">Kirim Nilai</a>
		</td>
	</tr>
</table>
</form>
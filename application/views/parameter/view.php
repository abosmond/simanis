<h3>Manajemen Parameter</h3>
<h2>Daftar Parameter</h2>
<br/>

<table class="table-common" width="760px">
	<tr>
		<th>No.</th>
		<th>Nama Parameter</th>
		<th>Referensi</th>		
		<th>Aksi</th>
	</tr>
	<?php
if ($hasil) {
	$i = 1;
	foreach ($hasil->result() as $key) :
	?>
	<tr>
		<td><?=$i?></td>
		<td><?=$key->nama_params?></td>
		<td><?=($key->alias == NULL ? 'Tidak ada' : $key->alias)?></td>		
		<td class="table-common-links" align="center"><a href="<?=base_url()?>parameter/data/<?=$key->id?>">Ubah</a><a href="<?=base_url()?>parameter/detail/<?=$key->id?>">Hapus</a></td>
	</tr>
	<?php
	$i++;
	endforeach;
}
else {
	echo '<tr>
			<td colspan="4"><center>Data tidak ditemukan</center></td>
		  </tr>';
}
	?>
</table>
<table>
	<tr>
		<td class="table-common-links">
			<a href="<?=base_url();?>parameter/data" id="add">Tambah Parameter</a>
		</td>
	</tr>
</table>
</div>
</form>
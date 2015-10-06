<h2>Manajemen Referensi</h2>
<h3>Daftar Data Referensi</h3>
<br/>
<table width="700px" class="table-common">
<tr>
	<th>No.</th>	
	<th>Nama Referensi</th>
	<th colspan="2">Aksi</th>
</tr>

<?php
if (!$result) {
	echo '<tr>
			<td colspan="3">Data tidak dtemukan.</td>
		  </tr>';
}
else {
	$i = 1;
	foreach ($result->result() as $key) {
?>
<tr>
	<td><?=$i?></td>	
	<td><?=$key->alias?></td>
	<td align="center" class="table-common-links"><a href="<?=base_url()?>referensi/detail/<?=$key->id?>">Detail</a><a href="<?=base_url()?>referensi/data/<?=$key->id?>">Ubah</a><a href="<?=base_url()?>referensi/hapus/<?=$key->id?>">Hapus</a></td>
</tr>
<?php
	$i++;
	}
}
?>
</table>
<table>
	<tr>
		<td class="table-common-links">
			<a href="<?=base_url();?>referensi/data" id="add">Tambah Referensi</a>
		</td>
	</tr>
</table>

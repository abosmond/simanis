<h2>Manajemen User</h2>
<h3>Daftar User</h3>
<br/>
<table width="700px" class="table-common">
<tr>
	<th>No.</th>
	<th>Username</th>
	<th>Nama</th>
	<th colspan="2">Aksi</th>
</tr>

<?php
if (!$result) {
	echo '<tr>
			<td colspan="5"><center>-- Data tidak dtemukan. --</center></td>
		  </tr>';
}
else {
	$i = 1;
	foreach ($result->result() as $key) {
?>
<tr>
	<td><?=$i?></td>
	<td><?=$key->username?></td>
	<td><?=$key->nama?></td>
	<td align="center" class="table-common-links"><a href="<?=base_url()?>users/data/<?=$key->id?>">Ubah</a><a href="<?=base_url()?>users/detail/<?=$key->id?>">Hapus</a></td>
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
			<a href="<?=base_url();?>users/data" id="add">Tambah User</a>
		</td>
	</tr>
</table>

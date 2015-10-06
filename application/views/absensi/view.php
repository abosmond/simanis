<?php
echo $js_grid;
?>

<h3>Manajemen Data Absensi</h3>
<h2>Daftar Absensi TA <?=@$ta->tahun?> Semester <?=@$sem->nama_semester?></h2>
<br/>
<table id="flex1" style="display:none"></table>
<br />
<table>
	<tr>
		<td class="table-common-links">
			<a href="<?=base_url();?>absensi/data" id="add">Tambah Data Absensi</a>
		</td>
	</tr>
</table>
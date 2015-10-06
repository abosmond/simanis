<?php
echo $js_grid;
?>

<h3>Manajemen Data Kelas</h3>
<h2>Daftar Kelas TA <?=@$ta->tahun?></h2>
<br/>
<table id="flex1" style="display:none"></table>
<br />
<table>
	<tr>
		<td class="table-common-links">
			<a href="<?=base_url();?>kelas/tambahkelas" id="add">Tambah Data Kelas</a>
		</td>
	</tr>
</table>
<?php
echo $js_grid;
?>

<h3>Manajemen Data Wali Kelas</h3>
<h2>Daftar Wali Kelas Tahun <?=@$tahun->tahun?></h2>
<br/>
<table id="flex1" style="display:none"></table>
<br />
<table>
	<tr>
		<td class="table-common-links">
			<a href="<?=base_url();?>refkelas/data" id="add">Tambah Wali Kelas</a>
		</td>
	</tr>
</table>
<?php
echo $js_grid;
?>

<h3>Manajemen Data Kasus</h3>
<h2>Daftar Kasus TA <?=@$ta->tahun?> Semester <?=@$sem->nama_semester?></h2>


<br/>
<table id="flex1" style="display:none"></table>
<br />
<table>
	<tr>
		<td class="table-common-links">
			<a href="<?=base_url();?>kasus/data" id="add">Tambah Data Kasus</a>
		</td>
	</tr>
</table>
<?php
echo $js_grid;
?>

<h3>Manajemen Pengampu Mata Pelajaran</h3>
<h2>Pengampu Mata Pelajaran TA <?=@$ta->tahun?></h2>

<br/>
<table id="flex1" style="display:none"></table>
<br />
<table>
	<tr>
		<td class="table-common-links">
			<a href="<?=base_url();?>pengampu/data" id="add">Tambah Pengampu</a>
		</td>
	</tr>
</table>
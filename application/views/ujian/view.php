<?php
echo $js_grid;
?>

<h3>Manajemen Jadwal Ujian</h3>
<h2>Jadwal Ujian TA <?=@$ta->tahun?> Semester <?=@$sem->nama_semester?></h2>

<br/>
<table id="flex1" style="display:none"></table>
<br />
<table>
	<tr>
		<td class="table-common-links">
			<a href="<?=base_url();?>ujian/data" id="add">Tambah Jadwal Ujian</a>
		</td>
	</tr>
</table>
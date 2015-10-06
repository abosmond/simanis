<h2>Data Siswa</h2>
<h3>Detail Data <?=@$row->NAMA?></h3>
<br/>
<table width="100%" class="table-form">	
	<tr>
		<th width="23%">NIS</th>
		<th width="7%">:</th>
		<td><?=@$row->NIS?></td>
	</tr>	
	<tr>
		<th width="23%">Nama</th>
		<th width="7%">:</th>
		<td><?=@$row->NAMA?></td>
	</tr>
	<tr>
		<th>Tahun Masuk</th>
		<th>:</th>
		<td><?=@$row->tahun?></td>
	</tr>
	<tr>
		<th>Status</th>
		<th>:</th>
		<td><?=(@$row->AKTIF == 1) ? 'Aktif' : 'Tidak Aktif';?></td>
	</tr>
	<tr>
		<th>Alamat</th>
		<th>:</th>
		<td><?=@$row->ALAMAT?></td>
	</tr>	
	<tr>
		<th>Tempat Lahir</th>
		<th>:</th>
		<td><?=@$row->TMPLHR?></td>
	</tr>	
	<tr>
		<th>Tanggal Lahir</th>
		<th>:</th>
		<td><?=@$row->TGLLHR?></td>
	</tr>
	<tr>
		<th>Agama</th>
		<th>:</th>
		<td><?=@$row->AGAMA?></td>
	</tr>
	<tr>
		<th>Jenis Kelamin</th>
		<th>:</th>
		<td><?=@$row->JK?></td>
	</tr>
	<tr>
		<th>Nama Ayah</th>
		<th>:</th>
		<td><?=@$row->NAMAAYAH?></td>
	</tr>
	<tr>
		<th>Pekerjaan Ayah</th>
		<th>:</th>
		<td><?=@$row->PEKERJAANAYAH?></td>
	</tr>
	<tr>
		<th>Nama Ibu</th>
		<th>:</th>
		<td><?=@$row->NAMAIBU?></td>
	</tr>
	<tr>
		<th>Pekerjaan Ibu</th>
		<th>:</th>
		<td><?=@$row->PEKERJAANIBU?></td>
	</tr>
	<tr>
		<th>Alamat Orang Tua</th>
		<th>:</th>
		<td><?=@$row->ALAMAT2?></td>
	</tr>
	<tr>
		<th>No. Hp Siswa</th>
		<th>:</th>
		<td><?=@$row->NOHP1?></td>
	</tr>
	<tr>
		<th>No. Hp Orang Tua</th>
		<th>:</th>
		<td><?=@$row->TELP?></td>
	</tr>
	<tr>
		<th>AC. ID</th>
		<th>:</th>
		<td><?=@$row->AC_ID?></td>
	</tr>
	<tr>
		<th>Foto</th>
		<th>:</th>
		<td><img src="<?=base_url()?>uploadpic/<?=trim(@$row->Photo)?>" /></td>
	</tr>
	<tr>
		<td colspan="2" align="left"></td>
		<td class="table-common-links">
			<a href="<?=base_url();?>siswa">Kembali</a>
		</td>
	</tr>
</table>
</div>
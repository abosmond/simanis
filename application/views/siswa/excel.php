<strong>Berikut tata cara menginputkan data siswa lewat file excel : </strong><br/>
1. Silakan download template <a href="<?=base_url()?>siswa/template">di sini.</a><br/>
2. Isikan data sesuai field yang sesuai. Untuk data Agama dan Jenis Kelamin gunakan ketentuan berikut : <br/>
&nbsp;&nbsp;&nbsp;&nbsp;Agama : Budha = 1, Hindu = 2, Islam = 3, Katholik = 4, Kristen = 5.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;Jenis Kelamin : Laki - Laki = 1, Perempuan = 2.<br/>
3. Klik Browse, cari file yang akan diinputkan lalu klik open.<br/>
4. Setelah itu klik button upload.<br/><br/><br/>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="j_action" value="add_siswa" />
File Excel : <input type="file" name="userfile" size="50" />

<br /><br />

<input type="submit" value="upload" />

</form>
<br/><br/>
<?php
if ($true) {	
	echo 'Jumlah Data Sukses : '.count($true).'<br/>';
	foreach ($true as $t => $y) {
		echo $y.'<br/>';
	}
}
echo '<br/><br/>';

if ($false) {	
	echo 'Jumlah Error : '.count($false).'<br/>';
	foreach ($false as $f => $e) {
		echo $e.'<br/>';
	}
}
?>
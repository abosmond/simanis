<?php
foreach ($kelas->result() as $v) {
	$a[0]= '-- Pilih Kelas--';
	$a[$v->id]= $v->kelas;
}
echo form_dropdown("db_idkelas",$a,'',"id='kls_id'");
?>


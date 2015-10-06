<?php
foreach ($mapel->result() as $v) {
	$a[0]= '-- Pilih Mata Pelajaran --';
	$a[$v->KDMP]= $v->MP;
}

echo form_dropdown("db_idmp",$a,'',"id='mp_id'");
?>


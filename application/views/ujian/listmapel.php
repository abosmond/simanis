<?php
foreach ($mapel->result() as $v) {
	$a[0]= '-- Pilih Mata Pelajaran --';
	$a[$v->MP]= $v->MP;
}

$b = $mapel->row();

echo form_dropdown("db_MP",$a,'',"id='mp_id'");
?>
<input type="hidden" name="db_ALIAS" value="<?=$b->ALIAS?>" /><input type="hidden" name="db_PROGRAM" value="<?=$b->PROG?>" />


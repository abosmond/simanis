<?php
if ($this->session->userdata('id_client') == 0) {
}
else {
?>
<center>
	<embed width="700" height="500" src="<?=base_url();?>map/kel.psvg?id=<?=@$this->session->userdata('id_client')?>&tahun=<?=date('Y')?>" type="image/svg+xml" />
</center>
<?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Halaman Administrator</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="<?=base_url()?>styles/a_common.css"    rel="stylesheet" type="text/css" title="Default" />
		<link href="<?=base_url()?>styles/common.css"      rel="stylesheet" type="text/css" title="Default" />
		<link href="<?=base_url()?>styles/subcontent.css"  rel="stylesheet" type="text/css" title="Default" />
		<link href="<?=base_url()?>styles/sidebar.css"     rel="stylesheet" type="text/css" title="Default" />
		<link href="<?=base_url()?>styles/table.css"       rel="stylesheet" type="text/css" title="Default" />
		<link href="<?=base_url()?>styles/forms.css"       rel="stylesheet" type="text/css" title="Default" />		
		<link href="<?=base_url()?>styles/jquery.autocomplete.css"       rel="stylesheet" type="text/css" title="Default" />	
		<link href="<?=base_url()?>styles/flexigrid.css"       rel="stylesheet" type="text/css" title="Default" />	
		<link href="<?=base_url()?>styles/humanity.datepick.css"       rel="stylesheet" type="text/css" title="Default" />
		<link href="<?=base_url()?>styles/test.css"       rel="stylesheet" type="text/css" title="Default" />
		<script type="text/javascript" src="<?=base_url()?>library/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>library/jquery/jquery.datepick.js"></script>
		<script type="text/javascript" src="<?=base_url()?>library/jquery/jquery.datepick-id.js"></script>
		<script type="text/javascript" src="<?=base_url()?>library/jquery/flexigrid.pack.js"></script>
		<script type="text/javascript" src="<?=base_url()?>library/jquery/settings.js"></script>
		<script type="text/javascript" src="<?=base_url()?>library/jquery/ajaxupload.3.5.js"></script>	
		<script type="text/javascript" src="<?=base_url()?>library/jquery/jquery.autocomplete.js"></script>
	</head>
	<body>
<?php
echo $js_grid;
?>
<table id="flex1" style="display:none"></table>
<br />

</body>
</html>
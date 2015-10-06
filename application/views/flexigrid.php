<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Flexigrid Implemented in CodeIgniter</title>
<link href="<?=$this->config->item('base_url');?>public/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?=$this->config->item('base_url');?>styles/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>library/jquery/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>library/jquery/flexigrid.pack.js"></script>
</head>
<body>
<?php
echo $js_grid;
?>
<script type="text/javascript">

function test(com,grid)
{
    if (com=='Select All')
    {
		$('.bDiv tbody tr',grid).addClass('trSelected');
    }
    
    if (com=='DeSelect All')
    {
		$('.bDiv tbody tr',grid).removeClass('trSelected');
    }
    
    if (com=='Delete')
        {
           if($('.trSelected',grid).length>0){
			   if(confirm('Delete ' + $('.trSelected',grid).length + ' items?')){
		            var items = $('.trSelected',grid);
		            var itemlist ='';
		        	for(i=0;i<items.length;i++){
						itemlist+= items[i].id.substr(3)+",";
					}
					$.ajax({
					   type: "POST",
					   url: "<?=site_url("/ajax/deletec");?>",
					   data: "items="+itemlist,
					   success: function(data){
					   	$('#flex1').flexReload();
					  	alert(data);
					   }
					});
				}
			} else {
				return false;
			} 
        }          
} 
</script>
<div style="font-size:18px; text-align:center"><a href="<?=site_url("/flexigrid/index");?>">Demo</a> | <a href="<?=site_url("/flexigrid/example");?>">Documentation</a> | <a href="http://flexigrid.eyeviewdesign.com/<?=$download_file;?>">Download</a></div>
<h1>About:</h1>
- This is a demonstration of the <a href="http://webplicity.net/flexigrid/" target="_blank">Flexigrid</a> javascript datagrid by <strong>Paulo Mariñas</strong> integrated with CodeIgniter.
<h1>v0.36 Change log:</h1>
- Added support for "json_encode" function from the JSON PHP Extension. <a href="<?=site_url("/flexigrid/example#s3");?>">Read more here</a><br/><br/>
- <a href="http://flexigrid.eyeviewdesign.com/<?=$download_file;?>" target="_blank">Click here to download v<?=$version;?></a>
<h1>v0.35 Change log:</h1>
- Fixed helper bugs<br/><br/>
- Query's now built with Active Record (thanks to <a href="http://codeigniter.com/forums/member/43281/" target="_blank">daBayrus</a>)<br/><br/>
- Added "build_query" function to library for active record query build. Function "build_querys" is still present but deprecated. <a href="<?=site_url("/flexigrid/example#s2");?>">Read more here</a><br/><br/>
<h1>v0.3 Change log:</h1>
- Fixed some helper bugs<br/><br/>
- Removed "width" and "height" parameter and replaced it with an array where you can insert any FlexiGrid parameter you want. Read more about these changes <a href="<?=site_url("/flexigrid/example#s1");?>">here</a>.<br/><br/>
- The $buttons variable in the "build_grid_js" function is now the last parameter and optional<br/><br/>
<h1>Demo (v<?=$version;?>):</h1>

<table id="flex1" style="display:none"></table>
<h1>Links:</h1>
- <a href="http://codeigniter.com/forums/viewthread/90208/" target="_blank">CodeIgniter Flexigrid lib discussion on CodeIgniter forum</a> <br/>
- <a href="http://webplicity.net/flexigrid/" target="_blank">Flexigrid Home</a> <br/>
- <a href="http://groups.google.com/group/flexigrid?hl=en" target="_blank">Flexigrid Google Groups</a> | <a href="http://codeigniter.com/forums/viewthread/75326" target="_blank">Flexigrid discussion on CodeIgniter forum (NOT USED ANYMORE)</a>
<h1>Download:</h1>
- <a href="http://flexigrid.eyeviewdesign.com/<?=$download_file;?>" target="_blank">Click here to download v<?=$version;?></a>
<h1>Install:</h1>
- Unzip to the CI directory. The example controler is flexigrid.php<br/>
- Activate CI Database Lib and URL helper in CI's AutoLoad config<br/>
- <a href="<?=site_url("/flexigrid/example");?>">Read documentation here</a>
<h1>CodeIgniter implementation by:</h1>
- <strong>Frederico Carvalho</strong>: <a href="mailto:frederico at eyeviewdesign dot com" target="_blank">frederico at eyeviewdesign dot com</a>
<h1>Thanks to:</h1>
- Paulo Mariñas for the excellent <a href="http://webplicity.net/flexigrid/" target="_blank">Flexigrid</a>.<br/>
- Kevin Kietel for the <a href="http://sanderkorvemaker.nl/test/flexigrid/" target="_blank">PHP example</a>.
<h1>License:</h1>
- Same as Flexigrid's (MIT + GPL)
</body>
</html>
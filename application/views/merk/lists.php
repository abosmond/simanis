<link href="<?=$this->config->item('base_url');?>css/style.css" rel="stylesheet" type="text/css" />
<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>

<?
echo $js_grid;
?>

<script type="text/javascript">
var _base_url = '<?= base_url() ?>';

function delete_brg(id) {
  i = confirm('Hapus Merk : ' + id + ' ?');
  if (i) {
    window.location = _base_url + 'index.php/merk/delete/' + id;
  }
}

function edit_brg(id) {
  window.location = _base_url + 'index.php/merk/edit/' + id;
}

function btn(com,grid)
{
    if (com == 'Add') {
      alert('Add');
    }
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

$(function(){
  
});
</script>

<h2>Master Merk</h2>

<!--
<input type="button" value="Tambah"
    onclick="window.location = '<?= base_url() ?>index.php/merk/add'"/><br />
-->

<table id="flex1" style="display:none"></table>

<br/>
<input type="button" value="Tambah"
    onclick="window.location = '<?= base_url() ?>index.php/merk/add'"/>
<input type="button" value="Kembali"
    onclick="window.location='<?= base_url() ?>index.php/menu_utama'"/>
<?php
if ($this->uri->segment(3) == '') {
	$name = 'Tambah';
	$disabled = '';
}
else {
	$name = 'Ubah';
	$disabled = 'readonly="true"';
}
?>
<script>
pic1 = new Image(16, 16); 
pic1.src = "<?=base_url()?>images/loader.gif";

$(function(){
	var btnUpload=$('#upload');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
	<?php
	if ($this->uri->segment(3)) {
		$destination = base_url().'siswa/upload/'.$this->uri->segment(3);
	}
	else
		$destination = base_url().'siswa/upload';
	?>
	action: '<?=$destination?>',
	name: 'userfile',
	onSubmit: function(file, ext)
	{
	 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
     // extension is not allowed 
	status.text('Only JPG, PNG or GIF files are allowed');
	return false;
	}status.text('Uploading...');
	},
	
	onComplete: function(file, response)
	{
		//On completion clear the status
		//alert(file);
		status.text('');
		//Add uploaded file to list
		var bb=response.substr(0,7)
		var idd=response.replace('success',' ');
		var idb =idd.replace(/^\s*|\s*$/g,'');
		var idc = idb.substr(-4);
		//alert(idd);
		if(bb==="success")
		{	
			<?php
			if ($this->uri->segment(3)) {
			?>
			$('#files').html('<img src="<?=base_url()?>uploadpic/'+file+'" alt="" />').addClass('success');
			$('#foto').val(idd);
			<?php
			}
			else {
			?>
			$('<span id='+idd+'></span>').appendTo('#files').html('<img src="<?=base_url()?>uploadpic/'+file+'" alt="" />').addClass('success');
			$('#upload').hide();
			$('#foto').val(idd);
			<?php
			}
			?>
		}
		else 
		{
			
			$('<span></span>').appendTo('#files').text(response).addClass('error');
		}
	}});
	
	$('#btn_simpan').click(function(){	
		$('#j_action').val('add_param');
		$('#formKlien').submit();
	});
	
	$('#btn_update').click(function(){				
		$('#j_action').val('update_param');
		$('#formKlien').submit();
	});
	
	$('#btn_reset').click(function(){
		resetForm();		
	});
	
	function resetForm(){
		$('form :input').val("");		
	}
	
	$("#nip").change(function() { 	
		var usr = $("#nip").val();
		
		if(usr.length == 8) {
			$("#hasil").html('<img src="<?=base_url()?>images/loader.gif" align="absmiddle">&nbsp;Checking availability...');

			$.ajax({  
			type: "POST",  
			url: "<?=base_url()?>siswa/cek_nis",  
			data: "NIP="+ usr,  
			success: function(msg){     
				$("#hasil").ajaxComplete(function(event, request, settings){ 
					if(msg == 'OK') { 
						$("#nip").removeClass('object_error'); // if necessary
						$("#nip").addClass("object_ok");
						$(this).html('&nbsp;<img src="<?=base_url()?>images/accepted.png" align="absmiddle"> <font color="Green"> NIP tersedia </font>  ');
					}  
					else {  
						$("#nip").removeClass('object_ok'); // if necessary
						$("#nip").addClass("object_error");
						$(this).html(msg);
					}  
		   
				});
			}	 		
			}); 

		}
		else {
			$("#status").html('<font color="red">NIP harus terdiri dari 8 digit</font>');
			$("#nip").removeClass('object_ok'); // if necessary
			$("#nip").addClass("object_error");
		}
	});
});

function resetForm(){
	$('form :input').val("");		
}

function f(o) {
	o.value=o.value.toUpperCase().replace(/([^0-9A-Z])/g,"");
}

</script>
<style type="text/css">
#upload{
	-moz-border-radius:5px 5px 5px 5px;
background:none repeat scroll 0 0 #FF0000;
color:#FFFFFF;
cursor:pointer !important;
font-family:Arial,Helvetica,sans-serif;
font-size:1.3em;
font-weight:bold;
margin:10px 0;
padding:5px;
text-align:center;
width:98px;
}
</style>
<h2>Data Siswa</h2>
<h3><?=$name?> Siswa</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="" enctype="multipart/form-data">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>NIS </td>
        <td><input name="db_NIS" type="text" id="nip" size="20" value="<?=set_value('db_NIS', @$row->NIS);?>" />&nbsp;&nbsp;<div id="hasil"></div></td>
    </tr>		  
	<tr>
        <td>Nama </td>
        <td><input name="db_NAMA" type="text" id="nama" size="40" value="<?=set_value('db_NAMA', @$row->NAMA);?>" /><br/></td>
    </tr>
	<tr>
        <td>Alamat </td>
        <td><input name="db_ALAMAT" type="text" id="alamat" size="40" value="<?=set_value('db_ALAMAT', @$row->ALAMAT);?>" /><br/></td>
    </tr>
	<tr>
        <td>Tempat Lahir</td>
        <td><input name="db_TMPLHR" type="text" id="tmplhr" size="20" value="<?=set_value('db_TMPLHR', @$row->TMPLHR);?>" onkeydown="f(this)" onkeyup="f(this)" onblur="f(this)" onclick="f(this)" /></td>
    </tr>	
	<tr>
        <td>Tanggal Lahir</td>
        <td><?=htmlDateSelector('tgllhr', @$row->TGLLHR)?></td>
    </tr>
	<tr>
        <td>Tahun Masuk</td>
        <td><input name="db_tahun" type="text" id="tahun" size="40" value="<?=set_value('db_tahun', @$row->tahun);?>" /><br/></td>
    </tr>		
	<tr>
        <td>Agama</td>
        <td><?=form_dropdown('db_AGAMA', $agama, @$row->AGAMA);?></td>
    </tr>	
	<tr>
        <td>Jenis Kelamin</td>
        <td><?=form_dropdown('db_JK', $jk, @$row->JK);?></td>
    </tr>
	<tr>
        <td>No. Telp Mahasiswa</td>
        <td><input name="db_NOHP1" type="text" id="notlp" size="40" value="<?=set_value('db_NOTLP', @$row->NOHP1)?>" /><br/></td>
    </tr>	
	<?php 
	
	?>
	<tr>		
		<td valign="top">Foto</td>
		<td valign="top"><div id="upload" ><span>Upload Image<span></div><span id="status"></span><br /><br />
		<?php
		if ($this->uri->segment(3)) {
			if ($row->Photo == NULL || $row->Photo == '')
				echo '<div id="files">-<?div>';
			else
				echo "<div id='files'><img src='".base_url()."uploadpic/".$row->Photo."' /><br/></div>";
		}
		else {
			echo "<div id='files'></div>";
		}
		?>
		<input type="hidden" id="foto" name="db_Photo" value="<?=@$row->Photo;?>" /></td>
	</tr>

	<tr>
        <td colspan="2"><strong>DATA ORANG TUA</strong> </td>        
    </tr>
	<?php	
	$arr = array('NAMAAYAH' => 'Nama Ayah', 'PEKERJAANAYAH' => 'Pekerjaan Ayah', 'NAMAIBU' => 'Nama Ibu', 'PEKERJAANIBU' => 'Pekerjaan Ibu', 'ALAMAT2' => 'Alamat Orang Tua', 'TELP' => 'No. Telp Orang Tua');
	foreach ($arr as $r => $v) {
	?>
	<tr>
        <td><?=$v?></td>
        <td><input name="db_<?=$r?>" type="text" id="<?=$r?>" size="40" value="<?=set_value('db_'.$r, @$row->$r);?>" /></td>
    </tr>
	<?php
	}
	?>
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links">
		<?php				
		if ($this->uri->segment(3)) :
			echo "<input type='hidden' id='id_client' name='id_param' value='".@$row->NIS."'>";
			echo "<a href='javascript: return void(0)' id='btn_update'>Update Data</a> ";			
		else:
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		endif;
		
		?>		
		
	  </tr>
</table>
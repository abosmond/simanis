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
	
	$("#kdmp").change(function() { 	
		var usr = $("#kdmp").val();
		
		if(usr.length == 4) {
			$("#hasil").html('<img src="<?=base_url()?>images/loader.gif" align="absmiddle">&nbsp;Checking availability...');

			$.ajax({  
			type: "POST",  
			url: "<?=base_url()?>mapel/cek_kodemp",  
			data: "kdmp="+ usr,  
			success: function(msg){     
				$("#hasil").ajaxComplete(function(event, request, settings){ 
					if(msg == 'OK') { 
						$("#kdmp").removeClass('object_error'); // if necessary
						$("#kdmp").addClass("object_ok");
						$(this).html('&nbsp;<img src="<?=base_url()?>images/accepted.png" align="absmiddle"> <font color="Green"> Kode Mata Pelajaran tersedia </font>  ');
					}  
					else {  
						$("#kdmp").removeClass('object_ok'); // if necessary
						$("#kdmp").addClass("object_error");
						$(this).html(msg);
					}  
		   
				});
			}	 		
			}); 

		}
		else if (usr.length !== '4'){
			$("#status").html('<font color="red">Kode Mata Pelajaran harus terdiri dari 4 digit</font>');
			$("#kdmp").removeClass('object_ok'); // if necessary
			$("#kdmp").addClass("object_error");
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

<h2>Data Mata Pelajaran</h2>
<h3><?=$name?> Mata Pelajaran</h3>
<br/>
<?=validation_errors();?>

<form id="formKlien" name="formKlien" method="post" action="">
<input type="hidden" id="j_action" name="j_action" value="">
<table width="100%" class="table-form">	
	<tr>
        <td>Kode Mata Pelajaran </td>
        <td><input name="db_KDMP" type="text" id="kdmp" size="20" value="<?=set_value('db_KDMP', @$row->KDMP);?>" />&nbsp;&nbsp;<div id="hasil"></div></td>
    </tr>		  
	<tr>
        <td>Mata Pelajaran </td>
        <td><input name="db_MP" type="text" id="mp" size="40" value="<?=set_value('db_MP', @$row->MP);?>" onkeydown="f(this)" onkeyup="f(this)" onblur="f(this)" onclick="f(this)" /><br/></td>
    </tr>
	<tr>
        <td>Alias </td>
        <td><input name="db_ALIAS" type="text" id="alias" size="3" value="<?=set_value('db_ALIAS', @$row->ALIAS);?>" /><br/></td>
    </tr>
	<tr>
        <td>Tingkat</td>
        <td><?=form_dropdown('db_TINGKAT', $tingkat, @$row->TINGKAT);?></td>
    </tr>	
	<tr>
        <td>Program</td>
        <td><?=form_dropdown('db_PROG', $program, @$row->PROG);?></td>
    </tr>			
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links">
		<?php				
		if ($this->uri->segment(3)) :
			echo "<input type='hidden' id='id_client' name='id_param' value='".@$row->ID."'>";
			echo "<a href='javascript: return void(0)' id='btn_update'>Update Data</a> ";			
		else:
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
			echo '<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>';
		endif;
		
		?>		
		
	  </tr>
</table>
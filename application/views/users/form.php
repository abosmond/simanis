<?php
if ($this->uri->segment(3) == '')
	$name = 'Tambah';
else 
	$name = 'Ubah';
?>
<script>
$(function(){
	var 
		jquery_action = $("#jquery_action");
	
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});
	
	$('#formUsers').submit(function() {	
		
			switch ( jquery_action.val()){
				case 'simpan_users':
					var tujuan = '<?=base_url().'users/data';?>';
					break;
				case 'update_users':
					var tujuan = '<?=base_url().'users/data/';?>';
					break;
			}
			
			$.ajax({
				type: 'POST',				
				url: tujuan,
				data: $(this).serialize(),
				success: function(data) {
					if (jquery_action.val()=='simpan_users'){
						$('#window_msg_content').show();
						$("#window_msg_content").html(data);
					}else if (jquery_action.val()=='update_users'){
						$('#window_msg_content').show();
						$("#window_msg_content").html(data);
					}
				}
			})
			return false;
	});
	
	/* button simpan*/
	$('#btn_simpan').click(function(){
		if ($('#id_client').val() == 0) {alert('Klien harap dipilih'); return false;}
		jquery_action.val('simpan_users');
		$('#formUsers').submit();
	});
	
	$('#btn_update').click(function(){
		//alert('test');
		jquery_action.val('update_users');
		$('#formUsers').submit();
	});
	
	$('#btn_reset').click(function(){
		resetForm();		
	});
	
	function resetForm(){
		$('form :input').val("");
		//alert('seluruh form penjualan tereset');
	}
});

function resetForm(){
	$('form :input').val("");		
}
</script>
<h2>Manajemen User</h2>
<h3><?=$name?> User</h3>
<form id="formUsers" name="formUsers" method="POST">
<input type="hidden" id="jquery_action" name="jquery_action" value="">

<div id="window_msg"><div id="window_msg_content"></div></div>
<table width="100%" class="table-form">	
	<tr>
        <td>Klien</td>
        <td><?=form_dropdown('db_id_client', $client, @$row->id_client, 'id="id_client"');?></td>
    </tr>
	<tr>
        <td>Username</td>
        <td><input name="db_username" type="text" id="username" size="40" value="<?=@$row->username?>" /></td>
    </tr>
	<tr>
        <td>Password</td>
        <td><input name="passwd" type="password" id="password" size="40" value=""/></td>
    </tr>	
	<tr>
        <td>Konfirmasi Password</td>
        <td><input name="konf_pass" type="password" id="konf_pass" size="40" value=""/></td>
    </tr>	
	<tr>
        <td>Nama Lengkap</td>
        <td><input name="db_nama" type="text" id="nama" size="40" value="<?=@$row->nama?>"/></td>
    </tr>
	<tr>
        <td>Alamat</td>
        <td><input name="db_alamat" type="text" id="alamat" size="40" value="<?=@$row->alamat?>"/></td>
    </tr>	
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links">
		<?php				
		if ($this->uri->segment(3)) :
			echo '<input type="hidden" id="id_customer" name="id" value="'.@$row->id.'">';
			echo "<a href='javascript: return void(0)' id='btn_update'>Update Data</a> ";
		else:
			echo "<a href='javascript: return void(0)' id='btn_simpan'>Simpan Data</a>";
		endif;
		
		?>		
		<a href="javascript: return void(0)" id="btn_reset">Reset Data</a> </td>
	  </tr>
</table>
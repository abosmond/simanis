<script>
$(function(){
	var 
		jquery_action = $("#jquery_action");
			
	/* button simpan*/
	$('#btn_simpan').click(function(){
		if ($('#id_client').val() == 0) {alert('Klien harap dipilih'); return false;}
		jquery_action.val('show_result');
		$('#formUsers').submit();
	});	
});

function resetForm(){
	$('form :input').val("");		
}
</script>
<h2>Manajemen Peta</h2>

<form id="formUsers" name="formUsers" method="POST">
<input type="hidden" id="jquery_action" name="jquery_action" value="">

<table width="100%" class="table-form">	
	<?php
	if ($client) {
	?>
	<tr>
        <td>Klien</td>
        <td><?=form_dropdown('id_client', $client, '0', 'id="id_client"');?></td>
    </tr>	
	<?php
	}
	?>	
	<tr>
        <td>Tahun</td>
        <td><?=htmlYearSelector('tahun')?></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
		<td class="table-common-links"><a href='javascript: return void(0)' id='btn_simpan'>Tampilkan Data</a></td>				
	</tr>
</table>

<?=$graph?>
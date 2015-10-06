<script>
$(function() {
	$("#self_loading").ajaxStart(function(){
		$(this).show();
	});
	
	$("#self_loading").ajaxStop(function(){
		$(this).hide();
	});
	
	$('.pagination').click(function() {
		var t = $(this).attr('id');
		$('#start_data').val(t);
		$('#formCari').submit();
	});
	
	$('#formCari').submit(function() {
		$.ajax({
			type: 'POST',				
			url: '<?=base_url();?>sms/search',
			data: $(this).serialize(),
			success: function(data) {	
				$("#msg_content").hide();
				$('#window_popup_data').show();
				$("#window_popup_data_content").html(data);						
			}
		})
		return false;
	});
	
	$('.mapdetail').popupWindow({
		centerScreen : 1
	});
});
</script>
<h3>Manajemen Data SMS</h3>
<h2>Daftar SMS</h2>
<br/><br/>

<form id="formCari" method="post" action="">
<input type="hidden" name="start_data" id="start_data" value="0" />
<div id="window_popup_data" style="display:none">
	<div id="window_popup_data_content"></div>
</div>

<div id="msg_content">
<table class="table-common" width="760px">
<tr>
	<th>No.</th>
<?php
$arr = array();
foreach ($param as $foo => $val) {
	$arr[] = $val;
?>
	<th><?=$val?></th>
<?php
}
?>
</tr>

<?php
if ($return) {
	
	$nil = $return->result_array();	
	$j = $offset + 1;
	for ($j; $j <= count($nil); $j++) {
		echo '<tr><td>'.$j.'</td>';
		foreach ($arr as $err => $vi) {
			
			if ($err == 0) {
				$exp = explode('-', $nil[$j-1]['tglPost']);
				echo("<td><a href=\"".base_url()."map/detail.php?id=".$nil[$j-1]['kode']."&tahun=".$exp[0]."\" class=\"mapdetail\">".$nil[$j-1][$vi]."</a></td>");
			}
			else 
				echo('<td>'.$nil[$j-1][$vi].'</td>');
		}
		echo '</tr>';		
	}	
}
else {
	$x = count($arr) + 1;
	echo '<tr>
			<td colspan="'.$x.'"><center>Data tidak ditemukan</center></td>
		  </tr>';
}
?>
	
</table>
<div class="pageNav">
	<div class="pageInfo">
		<b>Halaman : <?=(!$this->pagination->create_links()) ? '1' : '';?></b>
	</div>
	<?=$this->pagination->create_links();?>	
</div>

</div>
</form>
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
		$('#j_action').val('paging');
		$('#start_data').val(t);
		$('#formCari').submit();
	});		
	
	$('.mapdetail').popupWindow({
		centerScreen : 1
	});
});
</script>

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
	
	$j = 1;
	$i = $offset + 1;
	for ($j; $j <= count($nil); $j++) {
		
		echo '<tr><td>'.$i.'</td>';
		foreach ($arr as $err => $vi) {			
			if ($err == 0) {
			$exp = explode('-', $nil[$j-1]['tglPost']);
				//echo("<td><a href=\"javascript:void(0)\" onclick=\"mapClickDetail('kelurahan_".$nil[$j-1]['kode']."','2010')\">".$nil[$j-1][$vi]."</a></td>");
				if (!isset($nil[$j-1]['kode'])) {
					echo('<td><a href="'.base_url().'info/detail_non_peta/'.$_POST['id_client'].'/'.$_POST['tahun'].'" class="mapdetail">'.$nil[$j-1][$vi].'</a></td>');
				}
				else {
					echo("<td><a href=\"".base_url()."map/detail.php?id=".$nil[$j-1]['kode']."&tahun=".$exp[0]."&tabel=".$tabel."\" class=\"mapdetail\">".$nil[$j-1][$vi]."</a></td>");
				}	
			}
			else 
				echo('<td>'.$nil[$j-1][$vi].'</td>');
		}
		echo '</tr>';		
		$i++;
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
		<b>Halaman : <?=str_replace('&nbsp;', '', $this->pagination->create_links());?></b>
	</div>
	
</div>
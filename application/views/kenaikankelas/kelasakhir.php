<?php
if ($result) {
	echo form_multiselect('secondList[]', @$result, '', 'id="secondList" style="height:420px;width: 250px;"');
}
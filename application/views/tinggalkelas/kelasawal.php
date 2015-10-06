<?php
if ($result) {
	echo form_multiselect('firstList[]', @$result, '', 'id="firstList" style="height:420px;width: 250px;"');
}
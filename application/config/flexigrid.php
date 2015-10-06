<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Json header params
|--------------------------------------------------------------------------
*/
$config['json_header'] = array(
"Expires: Mon, 26 Jul 1997 05:00:00 GMT",
"Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT",
"Cache-Control: no-cache, must-revalidate",
"Pragma: no-cache",
"Content-type: text/x-json");

$config['ajax_header'] = array(
"Expires: Mon, 26 Jul 1997 05:00:00 GMT",
"Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT",
"Cache-Control: no-cache, must-revalidate",
"Pragma: no-cache",
"Content-type: text/plain");

/*
|--------------------------------------------------------------------------
| Starting page number
|--------------------------------------------------------------------------
*/
$config['page_number'] = 1;

/*
|--------------------------------------------------------------------------
| Default number of records per page
|--------------------------------------------------------------------------
*/
$config['per_page'] = 10;
?>
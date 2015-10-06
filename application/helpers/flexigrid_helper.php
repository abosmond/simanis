<?php  if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Flexigrid CodeIgniter implementation
 *
 * PHP version 5
 *
 * @category  CodeIgniter
 * @package   Flexigrid CI
 * @author    Frederico Carvalho (frederico@eyeviewdesign.com)
 * @version   0.3
 * Copyright (c) 2008 Frederico Carvalho  (http://flexigrid.eyeviewdesign.com)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
*/
if (! function_exists('build_grid_js'))
{
	/**
	 * Build Javascript to display grid
	 *
	 * @param	grid id, or the div id
	 * @param	url to make the ajax call
	 * @param	array with colModel info: 		 
	 * 			* 0 - display name
	 *	 		* 1 - width
	 *	 		* 2 - sortable
	 *			* 3 - align
	 * 			* 4 - searchable (2 -> yes and default, 1 -> yes, 0 -> no.)
	 * 			* 5 - hidden (TRUE or FALSE, default is FALSE. This index is optional.) 
	 * @param	array with button info: 	
	 * 		 	* 0 - display name
	 *	 		* 1 - bclass
	 *	 		* 2 - onpress
	 * @param	default sort column name
	 * @param	default sort order
	 * @param	array with aditional parameters
	 * @return	string
	 */
	function build_grid_js($grid_id,$url,$colModel,$sortname,$sortorder,$gridParams = NULL,$buttons = NULL)
	{
		//Basic propreties
		$grid_js = '<script type="text/javascript">$(document).ready(function(){';
		$grid_js .= '$("#'.$grid_id.'").flexigrid({';
		$grid_js .= "url: '".$url."',";
		$grid_js .= "dataType: 'json',";
		$grid_js .= "sortname: '".$sortname."',";
		$grid_js .= "sortorder: '".$sortorder."',";
		$grid_js .= "usepager: true,";
		$grid_js .= "useRp: true,";
		
		//Other propreties
		if (is_array($gridParams))
		{
			//String exceptions that dont have ' '. Must be lower case.
			$string_exceptions = array("rpoptions");
			
			//Print propreties
			foreach ($gridParams as $index => $value) {
				//Check and print with or without ' '
				if (is_numeric($value)) {
					$grid_js .= $index.": ".$value.",";
				} 
				else 
				{
					if (is_bool($value))
						if ($value == true)
							$grid_js .= $index.": true,";
						else
							$grid_js .= $index.": false,";
					else
						if (in_array(strtolower($index),$string_exceptions))
							$grid_js .= $index.": ".$value.",";
						else
							$grid_js .= $index.": '".$value."',";
				}
			}
		}
		
		$grid_js .= "colModel : [";
		
		//Get colModel
		
		foreach ($colModel as $index => $value) {
			$grid_js .= "{display: '".$value[0]."', ".($value[2] ? "name : '".$index."', sortable: true," : "")." width : ".$value[1].", align: '".$value[3]."'".(isset($value[5]) && $value[5] ? ", hide : true" : "")."},";  
			
			//If item is searchable
			if ($value[4] != 0)
			{
				//Start searchitems var
				if (!isset($searchitems))
					$searchitems = "searchitems : [";
					
				if ($value[4] == 2)
					$searchitems .= "{display: '".$value[0]."', name : '".$index."', isdefault: true},";
				else if ($value[4] == 1)
					$searchitems .= "{display: '".$value[0]."', name : '".$index."'},";
			}
				
		}
		//Remove the last ","
		$grid_js = substr($grid_js,0,-1).'],';
		$searchitems = substr($searchitems,0,-1).']';
		
		//Add searchitems to grid
		$grid_js .= $searchitems;

		//Get buttons
		if (is_array($buttons)) 
		{
			$grid_js .= ",buttons : [";
			foreach ($buttons as $index => $value) {
				if ($value[0] == 'separator')
					$grid_js .= "{separator: true},";
				else
					$grid_js .= "{name: '".$value[0]."', bclass : '".$value[1]."', onpress : ".$value[2]."},";
			}
			//Remove the last ","
			$grid_js = substr($grid_js,0,-1).']';
		} 
		
		//Finalize
		$grid_js .= "}); })</script>";
		
		return $grid_js;
	}
}

?>
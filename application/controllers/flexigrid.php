<?php
class Flexigrid extends Controller {

	function Flexigrid  ()
	{
		parent::Controller();	
		$this->load->helper('flexigrid');
	}
	
	function index()
	{
		//ver lib
		
		/*
		 * 0 - display name
		 * 1 - width
		 * 2 - sortable
		 * 3 - align
		 * 4 - searchable (2 -> yes and default, 1 -> yes, 0 -> no.)
		 */
		$colModel['id'] = array('ID',40,TRUE,'center',2);
		$colModel['iso'] = array('ISO',40,TRUE,'center',0);
		$colModel['name'] = array('Name',180,TRUE,'left',1);
		$colModel['printable_name'] = array('Printable Name',120,TRUE,'left',0);
		$colModel['iso3'] = array('ISO3',130, TRUE,'left',0);
		$colModel['numcode'] = array('Number Code',80, TRUE, 'right',1);
		$colModel['actions'] = array('Actions',80, FALSE, 'right',0);
		
		
		/*
		 * Aditional Parameters
		 */
		$gridParams = array(
		'width' => 'auto',
		'height' => 400,
		'rp' => 15,
		'rpOptions' => '[10,15,20,25,40]',
		'pagestat' => 'Displaying: {from} to {to} of {total} items.',
		'blockOpacity' => 0.5,
		'title' => 'Hello',
		'showTableToggleBtn' => true
		);
		
		/*
		 * 0 - display name
		 * 1 - bclass
		 * 2 - onpress
		 */
		$buttons[] = array('Delete','delete','test');
		$buttons[] = array('separator');
		$buttons[] = array('Select All','add','test');
		$buttons[] = array('DeSelect All','delete','test');
		$buttons[] = array('separator');

		
		//Build js
		//View helpers/flexigrid_helper.php for more information about the params on this function
		$grid_js = build_grid_js('flex1',site_url("/ajax"),$colModel,'id','asc',$gridParams,$buttons);
		
		$data['js_grid'] = $grid_js;
		$data['version'] = "0.36";
		$data['download_file'] = "Flexigrid_CI_v0.36.rar";
		
		$this->load->view('flexigrid',$data);
	}
	
	function example () 
	{
		$data['version'] = "0.36";
		$data['download_file'] = "Flexigrid_CI_v0.36.rar";
		
		$this->load->view('example',$data);	
	}
}
?>
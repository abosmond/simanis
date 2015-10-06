<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Flexigrid CodeIgniter implementation
 *
 * PHP version 5
 *
 * @category  CodeIgniter
 * @package   Flexigrid CI
 * @author    Frederico Carvalho (frederico@eyeviewdesign.com)
 * @version   0.1
 * Copyright (c) 2008 Frederico Carvalho  (http://flexigrid.eyeviewdesign.com)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
*/
class Flexigrid
{
	//Validated $_POST data
	var $post_info = array();
	
	//Json code
	var $json_build;
	
	/**
	* Constructor
	* 
	* @access	public
	*/	
	public function Flexigrid()
    {
		$this->CI =& get_instance();
		//Load config
		$this->CI->config->load('flexigrid');
		log_message('debug', "EVD CMS Flexigrid Class Initialized");
	}
	
	/**
	 * Validate Post data
	 *
	 * @access	public
	 * @param	default sort name
	 * @param	default sort order
	 * @param	List of all fields that can be sortable/searchable
	 * @return	void
	 */
	public function validate_post($d_sortname,$d_sortorder,$valid_fields = NULL) 
	{
		//Validate page number
		if ($this->CI->input->post('page') != FALSE && is_numeric($this->CI->input->post('page')))
			$this->post_info['page'] = $this->CI->input->post('page');
		else
			$this->post_info['page'] = $this->CI->config->item('page_number');
		
		//Validate records per page
		if ($this->CI->input->post('rp') != FALSE && is_numeric($this->CI->input->post('rp')))
			$this->post_info['rp'] = $this->CI->input->post('rp');
		else
			$this->post_info['rp'] = $this->CI->config->item('per_page');
		
		//Calculate limit start based on page and rp
		$this->post_info['limitstart'] = (($this->post_info['page']-1) * $this->post_info['rp']);
			
		//Validate page sort
		if ($this->record_sorter_validator($this->CI->input->post('sortname'),$this->CI->input->post('sortorder')))
		{
			if (is_array($valid_fields))
			{
				if (in_array($this->CI->input->post('sortname'),$valid_fields)) 
				{
					$this->post_info['sortname'] = $this->CI->input->post('sortname');
					$this->post_info['sortorder'] = $this->CI->input->post('sortorder');
				}
				else
				{
					$this->post_info['sortname'] = $d_sortname;
					$this->post_info['sortorder'] = $d_sortorder;	
				}
			}
			else
			{
				$this->post_info['sortname'] = $this->CI->input->post('sortname');
				$this->post_info['sortorder'] = $this->CI->input->post('sortorder');
			}
		}
		else
		{
			$this->post_info['sortname'] = $d_sortname;
			$this->post_info['sortorder'] = $d_sortorder;
		}
		
		//Validate search query
		if ($this->CI->input->post('query') != FALSE && $this->CI->input->post('query') != "" &&
		$this->CI->input->post('qtype') != FALSE && $this->CI->input->post('qtype') != ""
		)	
			if (is_array($valid_fields))
				if (in_array($this->CI->input->post('qtype'),$valid_fields))
					$this->post_info['swhere'] = $this->searchstr_validator($this->CI->input->post('query'),$this->CI->input->post('qtype'));
				else
					$this->post_info['swhere'] = FALSE;
			else
				$this->post_info['swhere'] = $this->searchstr_validator($this->CI->input->post('query'),$this->CI->input->post('qtype'));
		else
			$this->post_info['swhere'] = FALSE;
	}
	
	/**
	 * Sort Validator
	 *
	 * @access	private
	 * @param	sort name
	 * @param	sort order
	 * @return	boolean
	 */
	private function record_sorter_validator($sortname,$sortorder)
	{
		if ($sortname == FALSE || $sortorder == FALSE)
		{
			return FALSE;
		}
		else
		{
			$sortorder = strtoupper($sortorder);
			
			if (($sortorder == "ASC" || $sortorder == "DESC"))
				return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * Search Validator
	 *
	 * @access	private
	 * @param	search string
	 * @param	search by
	 * @return	string/boolean
	 */
	private function searchstr_validator($searchstr,$searchby)
	{
		if ($searchstr == FALSE || $searchby == FALSE)
		{
			return FALSE;
		}
		else
		{
			if (trim($searchstr) != "" && $searchby != "")
			{
				$searchstr_split = explode(" ",$searchstr);
				$searchstr_final = "";
				
				foreach ($searchstr_split as $key => $value) 
				{
					if (trim($value) != "")
						if ($key == 0)
							$searchstr_final .= $searchby.' LIKE "%'.$value.'%"';
						else
							$searchstr_final .= ' OR '.$searchby.' LIKE "%'.$value.'%"';
				}
				
				return $searchstr_final;
			}
		}
		return FALSE;
	}
	
	/**
	 * OLD (DEPRECATED) Query builder. Takes the striped query and adds sort, search and limit
	 *
	 * @access	public
	 * @param	stripped query
	 * @param	Use WHERE or AND, depending if there allready is a WHERE or not in the query: 
	 * 			TRUE: use WHERE
	 * 			FALSE: use AND
	 * @return	array
	 */
	public function build_querys($querys,$use_where = TRUE) 
	{
		//Build querys
		if ($this->post_info['swhere'] == FALSE)
		{
			$return['main_query'] = str_replace('{SEARCH_STR}','',$querys['main_query']).' ORDER BY '.$this->post_info['sortname'].' '.$this->post_info['sortorder'].' LIMIT '.$this->post_info['limitstart'].','.$this->post_info['rp'];
			$return['count_query'] = str_replace('{SEARCH_STR}','',$querys['count_query']);
			return $return;
		}
		else
		{
			$return['main_query'] = str_replace('{SEARCH_STR}',($use_where == TRUE ? ' WHERE ' : ' AND ').$this->post_info['swhere'],$querys['main_query']).' ORDER BY '.$this->post_info['sortname'].' '.$this->post_info['sortorder'].' LIMIT '.$this->post_info['limitstart'].','.$this->post_info['rp'];
			$return['count_query'] = str_replace('{SEARCH_STR}',($use_where == TRUE ? ' WHERE ' : ' AND ').$this->post_info['swhere'],$querys['count_query']);
			return $return;
		}
		
	}
	
	/**
	 * Query builder. Adds sort, search and limit to the query
	 *
	 * @access	public
	 * @param	insert LIMIT in the query, true by default. This is used to strip the count query from LIMIT
	 * @return	nothing
	 */
	public function build_query($limit = TRUE)
	{
		if ($this->post_info['swhere'])
			$this->CI->db->where($this->post_info['swhere']);
	
		$this->CI->db->order_by($this->post_info['sortname'], $this->post_info['sortorder']);
		
		if ($limit)
			$this->CI->db->limit($this->post_info['rp'], $this->post_info['limitstart']);
	} 
	
	/**
	 * Starts the json code (Do not use if you have json_encode)
	 *
	 * @access	public
	 * @param	number of records in the table
	 * @return  boolean
	 */
	public function init_json_build($record_count)
	{
		$this->post_info['record_count'] = $record_count;
		
		if ($this->post_info['record_count'] > 0)
		{
			$this->json_build = "{";
			$this->json_build .= "page: ".$this->post_info['page'].",";
			$this->json_build .= "total: ".$this->post_info['record_count'].",";
			$this->json_build .= "rows: [";
			
			//Records exist!
			return TRUE;
		}
		else
		{
			$this->json_build = "{";
			$this->json_build .= "page: ".$this->post_info['page'].",";
			$this->json_build .= "total: ".$this->post_info['record_count'].",";
			$this->json_build .= "rows: [ ]}";

			//No records.
			return FALSE;
		}
	}
	
	/**
	 * Adds items to json code (Do not use if you have json_encode)
	 *
	 * @access	public
	 * @param	item data
	 * @return	void
	 */
	public function json_add_item ($item_data = NULL) 
	{
		if ($item_data != NULL)
		{
			$this->json_build .= "{";
			
			//First array index is the ID
			$this->json_build .= "id:'".$item_data[0]."',cell:[";
			
			foreach ($item_data as $key => $value) {
				if ($key != 0) 
				{
					$this->json_build .= "'".addslashes($value)."',";
				}
			}
			$this->json_build = substr($this->json_build,0,-1);
			$this->json_build .= "]},";
		}
		else
		{
			if ($this->post_info['record_count'] > 0)
			{
				$this->json_build = substr($this->json_build,0,-1);
				$this->json_build .= "]}";
			}
		}
	}
	
	/**
	 * Builds JSON code with the data and returns it
	 *
	 * @access	public
	 * @param	total number of records
	 * @param	processed data that is going to the grid
	 * @return  json formated data
	 */
	public function json_build($record_count,$data) 
	{
		//Creates new Data Set and sends all the information
		$fg_data_set = new Fg_data_set($record_count,$this->post_info['page'],$data);
		
		//Builds and returns JSON 
		return $fg_data_set->build_json();
	}
}


/*
* This is a helper object. It retains a row as object for JSON format purposes.
* Based on gpasq's (greg@pasq.net) PHP Flexigrid Class
*/
class Fg_set_row 
{
	public $id;
	public $cell = array();
}

/*
* This is the data grid's Data Set object
* Based on gpasq's (greg@pasq.net) PHP Flexigrid Class
*/

/**
* This is the data grid's Data Set object
*/
class Fg_data_set 
{
	public $page;
    public $total;
    public $rows = array();
    
	/**
	 * Class constructor
	 *
	* @param	total number of records
	* @param	page number
	* @param	processed data that is going to the grid
	 */
    public function Fg_data_set($record_count,$page,&$data) {
    	//Set initial params
    	$this->total = $record_count;
    	$this->page = $page;
    	
    	//Prepare data for json encoding
		$this->load($data);
	}
	
	/**
	* Loads the data into row objects and into the rows array
	*
	* @param	processed data that is going to the grid
	*/
	public function load(&$data) {
		foreach ($data as $row) {
			$obj = new Fg_set_row(); //Helper Object, for JSON format purposes.
			$obj->id = array_shift($row); //Remove first element, and save it. Its the ID of the row.
			$obj->cell = $row;
			array_push($this->rows, $obj); //Adds the row object to the rows array
		}
	}
	
	/**
	* Json Encodes de data
	*
	* @return   json formated data
	*/	
	public function build_json() {
		//Encodes and returns JSON
		return json_encode($this);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Flexigrid Implemented in CodeIgniter - Example</title>
<link href="<?=$this->config->item('base_url');?>public/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?=$this->config->item('base_url');?>public/css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>public/js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>public/js/flexigrid.pack.js"></script>
</head>
<body>
<div style="font-size:18px; text-align:center"><a href="<?=site_url("/flexigrid/index");?>">Demo</a> | <a href="<?=site_url("/flexigrid/example");?>">Documentation</a> | <a href="http://flexigrid.eyeviewdesign.com/<?=$download_file;?>">Download</a></div>
<h1>Files Needed:</h1>
- <a href="http://flexigrid.eyeviewdesign.com/<?=$download_file;?>">Click here to download CI Flexigrid with samples</a>
<h1>Introduction:</h1>
This is an example on how to setup a grid like in the <a href="<?=site_url("/flexigrid/index");?>">demonstration</a>. I assume that you already have some bases on CI before reading this, if you dont, read their excellent documentation <a href="http://codeigniter.com/user_guide/">here</a>. <br/>I'm sorry for any misspellings. <br/>I strongly advise to <a href="http://flexigrid.eyeviewdesign.com/<?=$download_file;?>">download the example</a> and look at the code while reading this, it will be much easier. 
<h1>Setup:</h1>
After downloading and extracting the library, config file and helper, import the country.sql table to your database and create 2 controllers, 1 model and 1 view:<br/><br/>
- Controller <var>flexigrid.php</var> - This controller can be named anything, its the controller that's going to configure and generate the grid's structure (javascript) and load the view<br/><br/>
- Controller <var>ajax.php</var> - This is the controller thats going to handle the AJAX requests<br/><br/>
- Model <var>ajax_model.php</var> - This is the model thats going to make all the database calls that the ajax controller needs<br/><br/>
- View <var>flexigrid.php</var> - This is the view thats going to display it all<br/><br/>
Before continuing make sure you have the CI URL helper and the CI Database Library in <strong>"autoload"</strong>. Also you need the $config['base_url'] in the config.php file correctly set, with ending slash. (eg. http://flexigridci/)
<a name="s1"></a><h1>Flexigrid Controller:</h1>
As said before, in this controller we are going to setup the grid's structure. <br/>
First of all, we must load the <strong>flexigrid helper</strong>:
<code>
	function Flexigrid  ()<br/>
	{<br/>
		parent::Controller();<br/>	
		$this->load->helper('flexigrid');<br/>
	}
</code>
Next, we have to create an array with all the columns that you want the grid to have, based on your query, so we can build the column header. <br/>
For example, for the query <strong>"SELECT id,iso,name,printable_name,iso3,numcode FROM country"</strong> we have to build the following array (insert the code below in the <strong>index</strong> function of your controller):<br/>
<code>
$colModel['id'] = array('ID',40,TRUE,'center',2);<br/>
$colModel['iso'] = array('ISO',40,TRUE,'center',0);<br/>
$colModel['name'] = array('Name',180,TRUE,'left',1);<br/>
$colModel['printable_name'] = array('Printable Name',120,TRUE,'left',0);<br/>
$colModel['iso3'] = array('ISO3',130, TRUE,'left',0);<br/>
$colModel['numcode'] = array('Number Code',80, TRUE, 'right',1);<br/>
$colModel['actions'] = array('Actions',80, FALSE, 'right',0);
</code>
How to build this array:<br/><br/>
- The index of the array $colModel <strong>has to be exactly</strong> the same name as the column in the database. (eg: column id -> id, column name -> name etc)<br/><br/>
- <strong>1st</strong> value of the array is label thats going to show in the column header<br/><br/>
- <strong>2nd</strong> value is the width of the column in pixels<br/><br/>
- <strong>3rd</strong> value determines if the column is sortable: TRUE or FALSE<br/><br/>
- <strong>4th</strong> value determines the columns identation: "left", "right" or "center"<br/><br/>
- <strong>5th</strong> value determines if that column is searchable with Flexigrid's search feature: 2 -> yes and default, 1 -> yes, 0 -> no<br/><br/>
- <strong>6th</strong> value determines if that column is hidden by default: TRUE or FALSE (This is Optional)<br/><br/><br/>
Now, to setup the other parameters like "width", "height", and every other parameter that's available on FlexiGrid we have to create another array:<br/>
<code>
$gridParams = array(<br/>
'width' => 'auto',<br/>
'height' => 400,<br/>
'rp' => 15,<br/>
'rpOptions' => '[10,15,20,25,40]',<br/>
'pagestat' => 'Displaying: {from} to {to} of {total} items.',<br/>
'blockOpacity' => 0.5,<br/>
'title' => 'Hello',<br/>
'showTableToggleBtn' => true<br/>
);
</code>
This array is simple; the array index is the name of the param like width, height, etc (look above for some examples. you can see all of these in the beginning of flexigrid.js) and the value of the array is the value of the param. <br/><br/>Also, you can store various FlexiGrid configuration arrays in a CI configuration file and load them depending on your needs.<br/><br/>Mandatory: use boolean and numeric values for parameters with bool or numeric values (eg.: Use TRUE instead of 'TRUE' or 400 instead of '400')<br/><br/><br/>
Now that we have the column array built and the parameters set, if we want to add some buttons to the top of the grid, like "Delete", "Select All", etc we have to build another array (this is optional). In this example we will have: "Delete", "Select All", "DeSelect All":<br/>
<code>
$buttons[] = array('Delete','delete','test');<br/>
$buttons[] = array('separator');<br/>
$buttons[] = array('Select All','add','test');<br/>
$buttons[] = array('DeSelect All','delete','test');<br/>
$buttons[] = array('separator');
</code>
How to build this array:<br/><br/>
- <strong>1st</strong> value of the array is button's label<br/><br/>
- <strong>2nd</strong> value is the CSS class of the button, so you can add a nice icon like in the demonstration<br/><br/>
- <strong>3rd</strong> value is the JavaScript function that's going to be called when you press the button<br/><br/>
- As you noticed, I added a 'separator' value to the array, this will add a separator between buttons.<br/><br/><br/>
Now that we have our column header, buttons and parameters set, lets build the grid's javascript. To do this we call a helper function:<br/>
<code>
$grid_js = build_grid_js('flex1',site_url("/ajax"),$colModel,'id','asc',$gridParams,$buttons);
</code>

<strong>Description of the function's parameters in order:</strong><br/><br/>
- Grid id, or the tables's id where the grid is going to be displayed<br/><br/>
- URI of the controller that handles the ajax requests, in this case, the index method of the ajax controller handles this job. (/ajax)<br/><br/>
- Column header array<br/><br/>
- The name of the column that's going to be sorted by default<br/><br/>
- Default sort order<br/><br/>
- Array with aditional parameters (This param is optional)<br/><br/>
- Button array (This param is optional. If you want to use buttons without sending "aditional parameters" set "aditional paramenters" to NULL)<br/><br/>

Finally, we setup a data array to send to the view.
<code>
$data['js_grid'] = $grid_js;<br/>
$this->load->view('flexigrid',$data); //Load view
</code>
<a name="s2"></a><h1>Ajax Model:</h1>
 This is the model thats going to make all the database calls that the ajax controller needs. In this model, we need to call a Flexigrid lib function to help build the query according to the grid's request. This function adds the limit, order and search functionality of the grid. <br/>
 To do that, we have to build the querys. We can use two methods, one with CI's <a href="http://codeigniter.com/user_guide/database/active_record.html" target="blank_">active record</a>, the other one without. I advise the active record aproach, its more clean and less likely to fail.<br/><br/>
<a name="s21"></a>
<strong>WITH ACTIVE RECORD (recommended):</strong><br/><br/>
First, we build the query that's going to return the contents of the grid and execute it:
<code>
//Select table name<br/>
$table_name = "country";<br/><br/>
		
//Build contents query<br/>
$this->db->select('id,iso,name,printable_name,iso3,numcode')->from($table_name);<br/>
$this->CI->flexigrid->build_query();//Add search, order and limit<br/><br/>
		
//Get contents<br/>
$return['records'] = $this->db->get();
</code>
Then we build and execute the COUNT query, that's going to count the total results returned by the content query:
<code>
//Build count query<br/>
$this->db->select('count(id) as record_count')->from($table_name);<br/>
$this->CI->flexigrid->build_query(FALSE); //Add search, order and limit<br/>
$record_count = $this->db->get();<br/>
$row = $record_count->row();<br/><br/>
		
//Get Record Count<br/>
$return['record_count'] = $row->record_count;
</code>
Notice that in the COUNT query, when we call the "build_query" function, we pass a bool parameter (FALSE). This is for the "build_query" function to ignore the LIMIT part of the query (we want to count all values).
<br/>The $return array must have the indexes as above.<br/><br/>

<strong>WITHOUT ACTIVE RECORD:</strong><br/><br/>
First, we build the querys:
<a name="s22"></a>
<code>
$querys['main_query'] = "SELECT id,iso,name,printable_name,iso3,numcode FROM country {SEARCH_STR}";<br/>
$querys['count_query'] = "SELECT count(id) as record_count FROM country {SEARCH_STR}";
</code>
 Two things:<br/>
 - We <strong>ALWAYS</strong> need two querys, one to retreive the records, another that serves only as record counting. The querys must always be inserted in an array with the indexes as above.<br/>
 - In order to have the Flexigrid search function, you have <strong>always</strong> to include the "{SEARCH_STR}" string at <strong>the very end</strong> of the query.<br/><br/>
 Note: I never tried this with querys that have aggregate functions that require GROUP BY. So if anyone encounters problems please notify me. If you use the active record aproach its likely that you'll not have any problems.<br/><br/>
 Now we call the build_querys function, that processes the querys.
 <code>
 $build_querys = $this->CI->flexigrid->build_querys($querys,TRUE);
 </code>
Description of the function's parameters in order:<br/><br/>
- Array with both querys<br/><br/>
- Use WHERE or AND, depending if there already is a WHERE or not in the query: TRUE -> use WHERE, FALSE -> use AND. In this case its TRUE, because there is no WHERE in the query.<br/><br/>
This function will return an array with 2 indexes; main_query and count_query, that are the two processed querys.<br/><br/>
Now we make a final array with the results:
<code>
		//Get contents<br/>
		$return['records'] = $this->db->query($build_querys['main_query']);<br/>
		//Get record count<br/>
		$get_record_count = $this->db->query($build_querys['count_query']);<br/>
		$row = $get_record_count->row();<br/>
		$return['record_count'] = $row->record_count;
</code>
The $return array must have the indexes as above.
<a name="s3"></a><h1>Ajax Controller:</h1>
Now we move on to the Ajax controller. This is the controller that holds the methods that are called when there's an AJAX request.<br/>
Again, we must load some flexigrid componentes like the library and model:
<code>
	function Ajax ()<br/>
	{<br/>
		parent::Controller();	<br/>
		$this->load->model('ajax_model');<br/>
		$this->load->library('flexigrid');<br/>
	}
</code>
Now, lets start by validating the columns that are going to be sortable and searchable. This is an <strong>optional</strong> choice but prevents some undesired searching or sorting if someone messes the JS code:
<code>
$valid_fields = array('id','iso','name','printable_name','iso3','numcode');<br/>
$this->flexigrid->validate_post('id','asc',$valid_fields);
</code>
In the $valid_fields array you just have to include all the columns that are sortable / searchable, defined in the $colModel array above.<br/><br/>
The validate_post funciton executes the validation. Parameters in order:<br/><br/>
- Name of the default sorting column<br/><br/>
- Default sorting order<br/><br/>
- Array with the valid fields<br/><br/>
Next lets get the records from the database and turn them into JSON format to send to the grid.<br/>
There are <strong>two ways</strong> of doing this. The simpler and best way, envolves using the php <a href="http://uk.php.net/json" target="_blank">JSON Extension</a> that needs to be installed on PHP. If you use this method, you increase the performance and reduce the code:
<code>
		//Get countries<br/>
		$records = $this->ajax_model->get_countries();<br/><br/>
		/*<br/>
		 * Json build WITH json_encode.<br/>
		 */<br/>
		foreach ($records['records']->result() as $row)<br/>
		{<br/>
			$record_items[] = array($row->id,<br/>
			$row->id,<br/>
			$row->iso,<br/>
			$row->name,<br/>
			'<span style=\'color:#ff4400\'>'.addslashes($row->printable_name).'</span>',<br/>
			$row->iso3,<br/>
			$row->numcode,<br/>
			'&lt;a href=\'#\'&gt;&lt;img border=\'0\' src=\''.$this->config->item('base_url').'public/images/close.png\'&gt;&lt;/a&gt; '<br/>
			);<br/>
		}<br/><br/>
		//Print please<br/>
		$this->output->set_header($this->config->item('json_header'));<br/>
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));<br/>
</code>
If you do not have the JSON PHP Extension installed, you can use the following method:
<code>
		//Get countries<br/>
		$records = $this->ajax_model->get_countries();<br/><br/>
		//Init json build<br/>
		if ($this->flexigrid->init_json_build($records['record_count'])) <br/>
		{<br/>
			//Add records<br/>
			foreach ($records['records']->result() as $row)<br/>
			{<br/>
				$record_item = array($row->id,<br/>
				$row->id,<br/>
				$row->iso,<br/>
				$row->name,<br/>
				'&lt;span style=\'color:#ff4400\'&gt;'.addslashes($row->printable_name).'&lt;/span&gt;',<br/>
				$row->iso3,<br/>
				$row->numcode,<br/>
				'&lt;a href=\'#\'&gt;&lt;img border=\'0\' src=\''.$this->config->item('base_url').'public/images/close.png\'&gt;&lt;/a&gt; '<br/>
				);<br/>
				$this->flexigrid->json_add_item($record_item);<br/>
			}<br/>
			//Last item added, close up.<br/>
			$this->flexigrid->json_add_item();<br/>
		}<br/><br/>
					//Print please<br/>
$this->output->set_header($this->config->item('json_header'));<br/>
$this->output->set_output($this->flexigrid->json_build);
</code>
In both aproaches, we loop through all records. In each record an array is formed ($record_item) with the formated data. In the second aproach, some extra functions are called to build the JSON code. This is ignored on the first aproach. <br/><br/>There are two very important things about this array ($record_item or $record_items):<br/><br/>
- The first value of the array <strong>MUST</strong> be some sort of unique id of the record so it can be used later for operations such as "Delete" etc.<br/><br/>
- The values of the array <strong>MUST</strong> be in the same order as the values in the $colModel array. id -> id, iso -> iso, etc.<br/><br/>
Now all its left is to return the output. To do that, we have to call a couple of CI functions, set_header and set_output. You can read about them <a href="http://codeigniter.com/user_guide/libraries/output.html">here</a>.

<a name="s4"></a><h1>Flexigrid View:</h1>
Finally, we setup the view:
<code>
&lt;html&gt;<br />
  &lt;head&gt;<br />
  &lt;title&gt;Flexigrid Implemented in CodeIgniter&lt;/title&gt;<br />
  &lt;script type=&quot;text/javascript&quot; src=&quot;&lt;?=$this-&gt;config-&gt;item('base_url');?&gt;public/js/jquery.pack.js&quot;&gt;&lt;/script&gt;<br />
  &lt;script type=&quot;text/javascript&quot; src=&quot;&lt;?=$this-&gt;config-&gt;item('base_url');?&gt;public/js/flexigrid.pack.js&quot;&gt;&lt;/script&gt;<br />
  &lt;/head&gt;<br />
  &lt;body&gt;
<br /><br />
  &lt;?=$js_grid;?&gt;<br /><br />
&lt;table id=&quot;flex1&quot; style=&quot;display:none&quot;&gt;&lt;/table&gt;<br /><br />
&lt;/body&gt;<br />
&lt;/html&gt;
</code>
We print the $js_grid variable, passed by the flexigrid controller that contains the javascript code, and insert the table id "flex1" where the grid is going to apear.
<h1>The End:</h1>
I hope I was clear enough. This example is meant only to give the users an idea of how to use this implementation. I advise to look at the code, that is fully commented, to understand how it works and hopefully give some feedback to improve the system.<br/>
The CodeIgniter discussion thread on this lib is <a target="_blank" href="http://codeigniter.com/forums/viewthread/90208/">here</a>. You're free to leave your feedback/flames :)
<h1>Download:</h1>
- <a href="http://flexigrid.eyeviewdesign.com/<?=$download_file;?>">Click here to download CI Flexigrid with samples</a>
</body>
</html>
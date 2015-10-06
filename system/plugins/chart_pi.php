<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once("libchart/classes/libchart.php");
 
/**
 * @author Ibnu Daqiqil Id
 * @param string 	$title 	Judul Chart
 * @param array 	$data 	Data array dengan dua dimensi (key,value)
 * @param integer 	$x		Lebar chart
 * @param integer	$y		Tinggi Chart
 * @param string	$type 	tipe output chart (bar_vertikal,bar_horizontal,pie)
 * @param boolean	$render	Apakah di render ke file?
 */
function create_bar_chart($title,$data,$x=500,$y=300,$type="bar_vertikal",$render_file=FALSE)
{
	if ("bar_horizontal"==$type)
		$chart = new HorizontalBarChart($x,$y);
	else if ("bar_vertikal"==$type)
		$chart = new VerticalBarChart($x,$y);
	else
		$chart = new PieChart($x,$y);
 
	$dataSet = new XYDataSet();
	foreach ($data as $value)
	{
		$dataSet->addPoint(new Point($value['key'], $value['value']));
	}
	$chart->setDataSet($dataSet);
	$chart->setTitle($title);
	if (!$render_file)
		return $chart->render();
	else
		return $chart->render($render_file);	
}
?>
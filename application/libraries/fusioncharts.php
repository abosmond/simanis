<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Page: FusionCharts.php
// Author: InfoSoft Global (P) Ltd.
// This page contains functions that can be used to render FusionCharts.
 
class Fusioncharts {
 
    public function __construct(){
 
    }
 
    public function encodeDataURL($strDataURL, $addNoCacheStr=false) {
        //Add the no-cache string if required
        if ($addNoCacheStr==true) {
            // We add ?FCCurrTime=xxyyzz
            // If the dataURL already contains a ?, we add &FCCurrTime=xxyyzz
            // We replace : with _, as FusionCharts cannot handle : in URLs
		if (strpos(strDataURL,"?")<>0)
			$strDataURL .= "&FCCurrTime=" . Date("H_i_s");
		else
			$strDataURL .= "?FCCurrTime=" . Date("H_i_s");
        }
	// URL Encode it
	return urlencode($strDataURL);
    }
 
    public function datePart($mask, $dateTimeStr) {
        @list($datePt, $timePt) = explode(" ", $dateTimeStr);
        $arDatePt = explode("-", $datePt);
        $dataStr = "";
        // Ensure we have 3 parameters for the date
        if (count($arDatePt) == 3) {
            list($year, $month, $day) = $arDatePt;
            // determine the request
            switch ($mask) {
                case "m": return $month;
                case "d": return $day;
                case "y": return $year;
            }
            // default to mm/dd/yyyy
            return (trim($month . "/" . $day . "/" . $year));
        }
 
        return $dataStr;
     }
 
    public function renderChart($chartSWF, $strURL, $strXML, $chartId, $chartWidth, $chartHeight, $debugMode, $registerWithJS) {
 
	if ($strXML=="")
            $tempData = "//Set the dataURL of the chart\n\t\tchart_$chartId.setDataURL(\"$strURL\")";
        else
            $tempData = "//Provide entire XML data using dataXML method\n\t\tchart_$chartId.setDataXML(\"$strXML\")";
 
        // Set up necessary variables for the RENDERCAHRT
        $chartIdDiv = $chartId . "Div";
        $ndebugMode = $this->boolToNum($debugMode);
        $nregisterWithJS = $this->boolToNum($registerWithJS);
 
    // create a string for outputting by the caller
        $render_chart = <<<RENDERCHART
 
                        <!-- START Script Block for Chart $chartId -->
                        <div id="$chartIdDiv" align="center">
                              Chart.
                      </div>
                      <script type="text/javascript">	
                          //Instantiate the Chart	
                          var chart_$chartId = new FusionCharts("$chartSWF", "$chartId", "$chartWidth", "$chartHeight", "$ndebugMode", "$nregisterWithJS");
                          $tempData
                          //Finally, render the chart.
                          chart_$chartId.render("$chartIdDiv");
                      </script>	
                      <!-- END Script Block for Chart $chartId -->
RENDERCHART;
 
        return $render_chart;
    }
 
    public function renderChartHTML($chartSWF, $strURL, $strXML, $chartId, $chartWidth, $chartHeight, $debugMode) {
        // Generate the FlashVars string based on whether dataURL has been provided
        // or dataXML.
        $strFlashVars = "&chartWidth=" . $chartWidth . "&chartHeight=" . $chartHeight . "&debugMode=" . $this->boolToNum($debugMode);
        if ($strXML=="")
            // DataURL Mode
            $strFlashVars .= "&dataURL=" . $strURL;
        else
            //DataXML Mode
            $strFlashVars .= "&dataXML=" . $strXML;
 
        $HTML_chart = <<<HTMLCHART
                      <!-- START Code Block for Chart $chartId -->
                         <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="$chartWidth" height="$chartHeight" id="$chartId">
                            <param name="allowScriptAccess" value="always" />
                            <param name="movie" value="$chartSWF"/>		
                            <param name="FlashVars" value="$strFlashVars" />
                            <param name="quality" value="high" />
                            <embed src="$chartSWF" FlashVars="$strFlashVars" quality="high" width="$chartWidth" height="$chartHeight" name="$chartId" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                          </object>
                          <!-- END Code Block for Chart $chartId --> 
HTMLCHART;
 
        return $HTML_chart;
    }
 
    // boolToNum function converts boolean values to numeric (1/0)
    public function boolToNum($bVal) {
        return (($bVal==true) ? 1 : 0);
    }
 
    public function setDataXML($arrData,$caption = '',$numberPrefix) {
        $strXML = "<chart caption='".$caption."' numberPrefix='".$numberPrefix."' formatNumberScale='0'>";
	//Convert data to XML and append
	
	foreach ($arrData as $arSubData)
		$strXML .= "<set label='" . $arSubData[1] . "' value='" . $arSubData[2] . "' />";
 
	//Close <chart> element
	$strXML .= "</chart>";
 
        return $strXML ;
    }
 
}
?> 

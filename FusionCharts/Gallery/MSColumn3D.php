<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>DGFM :: BSMS</title>
<link rel="stylesheet" href="../Contents/Style.css" type="text/css" />
<script language="JavaScript" src="../JSClass/FusionCharts.js"></script>

</head>

<body>
<?php 

require_once('../../includes/config.php');
require_once('../../classes/db_con.php');
require_once('../../classes/projects.class.php');

//session_start();
$new_year = $_GET['years'];	


//$year = 2013;	
		 	 	 	 	 	
//$graph_data_Allc = Projects :: GetBudgetReportdgfm($new_year);
$graph_data_Alloc = Projects :: GetExpenditureDetailsReportdgfm($new_year);
$graph_data_Expend = Projects :: GetExpenditureDetailsReportdgfm($new_year);
$graph_data_SFHQ = Projects :: GetExpenditureDetailsReportdgfm($new_year);
//$graph_data_Expend_lastyear = Projects :: GetExpenditureDetailsReportdgfmLastYear($new_year);



$string="<graph xaxisname='Account Office' yaxisname='Amount' hovercapbg='DEDEBE' hovercapborder='889E6D' rotateNames='0' yAxisMaxValue='100' numdivlines='20' divLineColor='CCCCCC' divLineAlpha='80' decimalPrecision='0' showAlternateHGridColor='1' AlternateHGridAlpha='30' AlternateHGridColor='CCCCCC' caption='Annual Money Allocation and Expenditure Chart' subcaption= 'For the Year of ".$new_year."' >  
  
  
  
  <categories font='Arial' fontSize='11' fontColor='000000'>";
while($speed_row=mysql_fetch_array($graph_data_SFHQ))
{
	$string .="<category name='".$speed_row[3]."' /><br/>";
	
}

//<categories font='Arial' fontSize='11' fontColor='000000'>";
	//$string .="<category name='DTE OF FIN' /><br/>";
	//$string .="<category name='SFHQ(WEST)' /><br/>";
	//$string .="<category name='SFHQ(W)' /><br/>";
	//$string .="<category name='SFHQ(E)' /><br/>";
	//$string .="<category name='SFHQ(J)' /><br/>";
	//$string .="<category name='SFHQ(KLN)' /><br/>";
	//$string .="<category name='SFHQ(M)' /><br/>";	
	//$string .="<category name='SFHQ(C)' /><br/>";
	
$string .= "</categories>".





"<dataset seriesName='Allocation' color='1D8BD1' >";
while($speed_row=mysql_fetch_array($graph_data_Alloc))
{
	$string .="<set value='".$speed_row[2]."' /><br/>";	
	
}
$string .= "</dataset>".


"<dataset seriesName='Expenditure' color='FF0000' >";
while($end_row=mysql_fetch_array($graph_data_Expend))
{
	$string .="<set value='".$end_row[1]."' /><br/>";	
}
$string .="</dataset>";






$string .="</graph>";  
$myFile ="MSColumn3D.xml";                
$fh = fopen($myFile, 'w');


fwrite($fh,$string);
?>
<table width="98%" border="0" cellspacing="0" cellpadding="3" align="center">
  <tr> 
    <td valign="top" class="text" align="center"> <div id="chartdiv" align="center"> 
        FusionCharts. </div>
      <script type="text/javascript">
		    var chart = new FusionCharts("../Charts/FCF_MSColumn3D.swf", "ChartId", "1200", "600");
		    chart.setDataURL("MSColumn3D.xml");	
		   chart.render("chartdiv");
		</script> </td>
  </tr>
  <tr>
    <td valign="top" class="text" align="center">&nbsp;</td>
  </tr>
  <tr> 

    <td valign="top" class="text" align="center"><a href="../../ExpenwithAlloc.php" target="_self"><img src="../Contents/Images/backbut.gif" alt="Performance" width="75" height="25" border="0" /></a></td>
  </tr>
</table>
</body>
</html>

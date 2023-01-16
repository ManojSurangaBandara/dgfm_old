<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FusionCharts Free Documentation</title>
<link rel="stylesheet" href="../Contents/Style.css" type="text/css" />
<script language="JavaScript" src="../JSClass/FusionCharts.js"></script>

</head>

<body>
<?php 
require_once('../../includes/config.php');
require_once('../../classes/db_con.php');
require_once('../../classes/projects.class.php');

	//	$year = isset( $_POST['year'])?$_POST['year']:$year;		
		$year = $_GET['years'];	
		//$year = 2013;
		$graph_data = Projects :: GetBudgetReportdgfm($year);
		
$string="<graph caption='Annual Money Allocation' subcaption= 'For the Year of ".$year."' xAxisName='ACCOUNT OFFICE' yAxisName='Amount' decimalPrecision='0' formatNumberScale='0'>";

while($value=mysql_fetch_array($graph_data))
{
	switch($value[0])
	{
		case 0:
		$val ='TRIPOLI';
		$col='F6BD0F';
		break;
		
		case 1:
		$val ='SFHQ(S)';
		$col='AFD8F8';
		break;
		
		case 2:
		$val ='SFHQ(W)';
		$col='8BBA00';
		break;
		
		case 3:
		$val ='SFHQ(E)';
		$col='FF8E46';
		break;
		
		case 4:
		$val ='SFHQ(J)';
		$col='008E8E';
		break;
		
		case 5:
		$val ='SFHQ(KLN)';
		$col='D64646';
		break;
		
		case 6:
		$val ='SFHQ(MLT)';
		$col='F6BD0F';
		break;
		
		case 7:
		$val ='SFHQ(C)';
		$col='#e3ad09';
		break;
		
	}
	
$string .= "<set name='".$val."' value='".$value[1]."'   color='".$col."' />";		 
	
}

$string .= "</graph>";	
	
$myFile = "Column3D.xml";
$fh = fopen($myFile, 'w');
fwrite($fh, $string);
?>
<table width="98%" border="0" cellspacing="0" cellpadding="3" align="center">
  <tr> 
    <td valign="top" class="text" align="center"> <div id="chartdiv" align="center"> 
        FusionCharts. </div>
      <script type="text/javascript">
		   var chart = new FusionCharts("../Charts/FCF_Column3D.swf", "ChartId", "1000", "500");
		   chart.setDataURL("Column3D.xml");		   
		   chart.render("chartdiv");
		</script> </td>
  </tr>
  <tr>
    <td valign="top" class="text" align="center">&nbsp;</td>
  </tr>
  <tr> 
    <td valign="top" class="text" align="center"><a href="../../Bud_rpt_monthwise_allSfhq.php" target="_self"><img src="../Contents/Images/backbut.gif" alt="Go to home" width="75" height="25" border="0" /></a></td>
  </tr>
</table>
</body>
</html>

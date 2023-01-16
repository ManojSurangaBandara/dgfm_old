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
require_once('../../classes/sports_performance.class.php');

		$event_id		= isset( $_POST['event_id'])?$_POST['event_id']:$event_id;
		$coacher_id		= isset( $_POST['coacher_id'])?$_POST['coacher_id']:$coacher_id;
		$sportsman_id	= isset( $_POST['sportsman_id'])?$_POST['sportsman_id']:$sportsman_id;	
		$year 			= isset( $_POST['year'])?$_POST['year']:$year;
		
		 	 	 	 	 	
$graph_data_speed = Performance :: get_performancespeed($event_id, $coacher_id, $sportsman_id, $year);
$graph_data_endurance = Performance :: get_performanceendurance($event_id, $coacher_id, $sportsman_id, $year);
$graph_data_strength = Performance :: get_performancestrength($event_id, $coacher_id, $sportsman_id, $year);
$graph_data_power = Performance :: get_performancepower($event_id, $coacher_id, $sportsman_id, $year);
$graph_data_skills = Performance :: get_performanceskills($event_id, $coacher_id, $sportsman_id, $year);

$string="<graph caption='Annual Performance Chart' subcaption='For the Year ".$year."' hovercapbg='FFECAA' hovercapborder='F47E00' formatNumberScale='0' decimalPrecision='0' showvalues='0' numdivlines='20' numVdivlines='0' yaxisminvalue='0' yaxismaxvalue='100'  rotateNames='1'>

<categories >";
	$string .= "<category name='Jan' /><br/>";
	$string .= "<category name='Feb' /><br/>";
	$string .= "<category name='Mar' /><br/>";
	$string .= "<category name='Apr' /><br/>";
	$string .= "<category name='May' /><br/>";
	$string .= "<category name='Jun' /><br/>";
	$string .= "<category name='Jul' /><br/>";
	$string .= "<category name='Aug' /><br/>";
	$string .= "<category name='Sep' /><br/>";
	$string .= "<category name='Oct' /><br/>";
	$string .= "<category name='Nov' /><br/>";
	$string .= "<category name='Dec' /><br/>";
$string .= "</categories>".


"<dataset seriesName='Speed' color='1D8BD1' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>";
while($speed_row=mysql_fetch_array($graph_data_speed))
{
	$string .= "<set value='".$speed_row[1]."' /><br/>";	
}
$string .= "</dataset>".


"<dataset seriesName='Endurance' color='FF0000' anchorBorderColor='1D8BD1' anchorBgColor='FF0000'>";
while($end_row=mysql_fetch_array($graph_data_endurance))
{
	$string .= "<set value='".$end_row[1]."' /><br/>";	
}
$string .= "</dataset>".


"<dataset seriesName='Strength' color='00FF00' anchorBorderColor='1D8BD1' anchorBgColor='00FF00'>";
while($str_row=mysql_fetch_array($graph_data_strength))
{
	$string .= "<set value='".$str_row[1]."' /><br/>";	
}
$string .= "</dataset>".


"<dataset seriesName='Power' color='FFFF00' anchorBorderColor='1D8BD1' anchorBgColor='FFFF00'>";
while($pow_row=mysql_fetch_array($graph_data_power))
{
	$string .= "<set value='".$pow_row[1]."' /><br/>";	
}
$string .= "</dataset>".


"<dataset seriesName='Skill' color='CCEEFF' anchorBorderColor='1D8BD1' anchorBgColor='CCEEFF'>";
while($skil_row=mysql_fetch_array($graph_data_skills))
{
	$string .= "<set value='".$skil_row[1]."' /><br/>";	
}
$string .= "</dataset>";


$string .= "</graph>";
$myFile = "DATA/MSLine.xml";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $string);
?>
<table width="98%" border="0" cellspacing="0" cellpadding="3" align="center">
  <tr> 
    <td valign="top" class="text" align="center"> <div id="chartdiv" align="center"> 
        FusionCharts. </div>
      <script type="text/javascript">
		   var chart = new FusionCharts("../Charts/FCF_MSLine.swf", "ChartId", "1000", "600");
		   chart.setDataURL("Data/MSLine.xml?txt_to_date=1");		   
		   chart.render("chartdiv");
		</script> </td>
  </tr>
  <tr>
    <td valign="top" class="text" align="center">&nbsp;</td>
  </tr>
  <tr> 
    <td valign="top" class="text" align="center"><a href="/../Sports/Chiefacc.php" target="_blank"><img src="../Contents/Images/backbut.gif" alt="View XML for the above chart" width="75" height="25" border="0" /></a></td>
  </tr>
</table>
</body>
</html>

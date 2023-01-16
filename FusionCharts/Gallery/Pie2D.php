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
		$month			= isset( $_POST['month'])?$_POST['month']:$month;
	    $performance	= isset( $_POST['performance'])?$_POST['performance']:$performance;
		
$graph_data = Performance :: get_performance($performance, $event_id, $coacher_id, $sportsman_id, $year, $month);
//$year=array('2000','2001','2002','2003','2004','2005');
//$value=array(23,34,54,65,45,67, 68,69, 70, 71, 72);
//while($graph_data = mysql_fetch_array($graph_data))
while($graph_data_detail=mysql_fetch_array($graph_data))
{
	
	//print_r($graph_data_detail);
	
	//$i = 0;
	//$month[$i] = $graph_data_detail[0];
	$value[] = $graph_data_detail[$performance];
	//$i++;
} 
//echo "-----------------------------------------------------------------------";
//var_dump($year);
//var_dump($value);
$week[0] = 1;
$week[1] = 2;
$week[2] = 3;
$week[3] = 4;

//$value[0] = 12;
//$value[1] = 24;
$month_value = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
//echo $month;
for($i=0; $i<=$month; $i++)
{
$month = " ".$month_value[$i];
}
/*if($month==1)
{
	$month = "  ".'January';
}
else if()
{
}
*/
echo "Performance pie chart for month $month";
$string="<graph showNames='1'  decimalPrecision='0'  >";

//for($a=0;$a<count($week);$a++)
//{
	$string .= "<set name='Week 1'  value='$value[0]' isSliced='1'/>"."<set name='Week 2' value='$value[1]'/>"
	."<set name='Week 3'". "value='".$value[2]."'/>"."<set name='Week 4' value='".$value[3]."'/></graph>";
	



//}


/*$string .= "</categories>
<dataset seriesName='Sports man performance graph' color='1D8BD1' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>";

for($a=0;$a<count($value);$a++)
{
	$string .= "<set value='$value[$a]' /><br/>";
	
}

$string .= "</dataset>";

$string .= "</graph>";
*/

$myFile = "DATA/Pie2D.xml";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $string);
?>
<table width="98%" border="0" cellspacing="0" cellpadding="3" align="center">
  <tr> 
    <td valign="top" class="text" align="center"> <div id="chartdiv" align="center"> 
        FusionCharts. </div>
      <script type="text/javascript">
		   var chart = new FusionCharts("../Charts/FCF_Pie2D.swf", "ChartId", "500", "369");
		   chart.setDataURL("Data/Pie2D.xml");		   
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

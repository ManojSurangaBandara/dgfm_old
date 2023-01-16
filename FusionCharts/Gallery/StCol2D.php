<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Chart Demostration</title>
<link rel="stylesheet" href="../Contents/Style.css" type="text/css" />
<script language="JavaScript" src="../JSClass/FusionCharts.js"></script>

</head>

<body>
<?php 

require_once('../../includes/config.php');
require_once('../../classes/db_con.php');
require_once('../../classes/projects.class.php');

$new_year = $_GET['years'];	

		 	 	 	 	 	
$graph_data_Rec = Projects :: GetAllocationRecurrent($new_year);
$graph_data_Cap = Projects :: GetAllocationCapital($new_year);
$graph_data_Othe = Projects :: GetAllocationOther($new_year);
  
  
$string= "<graph xAxisName='Vote Types' yAxisName='Allocation' caption='Annual Money Allocation Chart' subCaption='For the Year of ".$new_year."' 
 decimalPrecision='0' rotateNames='1' numDivLines='3' numberPrefix='Rs:' showValues='0' formatNumberScale='0'>
 
 
 <categories font='Arial' fontSize='11' fontColor='000000'>";
	$string .="<category name='TRIPOLI' /><br/>";
	$string .="<category name='SFHQ(WEST)' /><br/>";
	$string .="<category name='SFHQ(Wanni)' /><br/>";
	$string .="<category name='SFHQ(E)' /><br/>";
	$string .="<category name='SFHQ(J)' /><br/>";
	$string .="<category name='SFHQ(KLN)' /><br/>";
	$string .="<category name='SFHQ(MLT)' /><br/>";	
	$string .="<category name='SFHQ(C)' /><br/>";	
	
$string .= "</categories>".



"<dataset seriesName='Recurrent' color='AFD8F8' showValues='0' >";
while($speed_row=mysql_fetch_array($graph_data_Rec))
{
	$string .="<set value='".$speed_row[1]."' /><br/>";	
}
$string .= "</dataset>".


"<dataset seriesName='Capital' color='F6BD0F' showValues='0' >";
while($row=mysql_fetch_array($graph_data_Cap))
{
	$string .="<set value='".$row[1]."' /><br/>";	
}
$string .= "</dataset>".


"<dataset seriesName='Others' color='8BBA00' showValues='0' >";
while($end_row=mysql_fetch_array($graph_data_Othe))
{
	$string .="<set value='".$end_row[1]."' /><br/>";	
}


$string .="</dataset>";


$string .="</graph>";  
$myFile ="StCol2D.xml";                
$fh = fopen($myFile, 'w');


fwrite($fh,$string);
?>
<table width="98%" border="0" cellspacing="0" cellpadding="3" align="center">
  <tr> 
    <td valign="top" class="text" align="center"> <div id="chartdiv" align="center"> 
        FusionCharts. </div>
      <script type="text/javascript">
		   var chart = new FusionCharts("../Charts/FCF_StackedColumn2D.swf", "ChartId", "1000", "550");
		   chart.setDataURL("StCol2D.xml");		   
		   chart.render("chartdiv");
		</script> </td>
  </tr>
  <tr>
    <td valign="top" class="text" align="center">&nbsp;</td>
  </tr>
  <tr> 
       <td valign="top" class="text" align="center"><a href="../../AllocationsToDgfm.php" target="_self"><img src="../Contents/Images/backbut.gif" alt="Performance" width="75" height="25" border="0" /></a></td>
    
    
    
  </tr>
</table>
</body>
</html>

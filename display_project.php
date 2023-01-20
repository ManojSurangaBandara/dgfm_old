<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/progress_report.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$unit_id	=	isset( $_GET['unitid'])?$_GET['unitid']:1;
$project_id =  $_GET['projectID'];
$ptype =  $_GET['ptype'];

$projdata = Common :: GetProject($project_id);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Progress Report</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
    <script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>
</head>
<body>
<div id="main">
	<div id="header">
	  <?php //include ('tpl/topmenu.tpl');?>
	</div>
	<div id="middle">
		<div id="left-column">
			<?php include ('tpl/log_out.tpl');?>
            <p></p>
            <?php include ('tpl/left_munu.tpl');?>
			<a href="#" class="link"> Related Links</a>		
		</div>
		<div id="center-column">			
            <div class="top-bar">
           
            <?php 
            if($_SESSION['userType'] == 1)
            {				
            	echo "<a href=\"admin_home.php\" class=\"button\"> Home</a>";
				
            }if ($_SESSION['userType'] == 2)
            {            	
				echo "<a href=\"home.php\" class=\"button\"> Home</a>";
            }
			if ($_SESSION['userType'] == 3)
            {            	
				echo "<a href=\"projects.php\" class=\"button\"> Home</a>";
            }
			if ($_SESSION['userType'] == 4)
            {            	
				echo "<a href=\"projects.php\" class=\"button\"> Home</a>";
            }
            ?>
            
            
			
			<h1><?php echo $projdata['project_name']; ?></h1>
			</div><br /><br />
			<br />
            <table width="100%" border="0">
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="93%"><table width="100%" border="0">
      
      <tr>
        <td height="20"><strong>Project Name </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_name']; ?></td>
      </tr>      
       <tr>
        <td height="20"><strong>Job Number </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['Job_number']; ?></td>
      </tr>  
       <tr>
        <td height="20"><strong>Project Type </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_type_name']; ?></td>
      </tr>       
      <tr>
        <td height="20"><strong>Project Allocated Amount Rs:</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo number_format($projdata['project_allocated_amount'],'2','.',','); ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Sheduled Start Date</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_start_date']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Sheduled End Date</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_end_date']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Project Location</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_location']; ?></td>
      </tr>
       <tr>
        <td width="35%" height="20"><strong>Vote Number </strong></td>
        <td width="3%"><strong>:</strong></td>
        <td width="62%"><?php echo $projdata['Vote_Number']; ?></td>
      </tr>
   
    <tr>
        <td width="35%" height="20"><strong>Allocated ESS </strong></td>
        <td width="3%"><strong>:</strong></td>
        <td width="62%"><?php echo $projdata['ge_center_id']; ?></td>
      </tr>
   
    <tr>
        <td width="35%" height="20"><strong>Allocated Regiment </strong></td>
        <td width="3%"><strong>:</strong></td>
        <td width="62%"><?php echo $projdata['allocated_regiment']; ?></td>
      </tr>
   
      
      <?php if($ptype==2) { ?>
      
      <tr>
        <td height="20"><strong>Date of Tender Called</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['date_of_tender_called']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Date of Tender Opened</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['date_of_tender_opened']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Date of Tec Appointed</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['date_of_tec_appointed']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Date of T/B Appointed</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['date_of_tb_appointed']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Name of Contractor</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['name_of_contractor']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Awarded Date</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['awarded_date']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Extension Given</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['extension_given']; ?></td>
      </tr>
       
      
    <?php /*?><!--  <tr>
        <td height="20"><strong>Project Allocated Stations</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['proj_allocated_stations']; ?></td>
      </tr>--><?php */?>
      
      <?php } else {?>
      
      <tr>
        <td width="35%" height="20"><strong>Project Reference ID  </strong></td>
        <td width="3%"><strong>:</strong></td>
        <td width="62%"><?php echo $projdata['project_reference_id']; ?></td>
      </tr>
      
      
      
      <tr>
        <td width="35%" height="20"><strong>Date  </strong></td>
        <td width="3%"><strong>:</strong></td>
        <td width="62%"><?php echo $projdata['RefDate']; ?></td>
      </tr>
      
      
      
      <tr>
        <td width="35%" height="20"><strong>Estimated Amount Rs:</strong></td>
        <td width="3%"><strong>:</strong></td>        
         <td width="62%"><?php echo number_format($projdata['Estimated_Amount'],'2','.',','); ?></td>
        
      </tr>
      
      
      <tr>
        <td width="35%" height="20"><strong>G 69 No  </strong></td>
        <td width="3%"><strong>:</strong></td>
        <td width="62%"><?php echo $projdata['G69_No']; ?></td>
      </tr>
      
      
      <tr>
        <td width="35%" height="20"><strong>Dates  </strong></td>
        <td width="3%"><strong>:</strong></td>
        <td width="62%"><?php echo $projdata['Dates']; ?></td>
      </tr>
      
      
     
      
      <?php    } ?>
      
     <tr>
        <td height="20"><strong>ESR Unit</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['unit_name']; ?></td>
      </tr>
      
      <tr>
        <td height="20"><strong>Remarks</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_Description']; ?></td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="6%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>



	<?php //-----------------First part-----------------------------------------------------?>	
		      
<?php 
	
	@$max_rec = $_GET["max"];
	@$limit = $_GET["limit"];
	@$page_id = $_GET["page"];	
	$id = trim(@$_GET['id']);
		
	if (!$page_id) $page_id = 0;
	if (!$limit) $limit = 10;		
	
	if (!$max_rec) 
		{					
			$result = Common :: GetAllprojectReports($project_id);
			if (!$result) return;
		
			$max_rec = count($result);
	     }
		           
				$current1 = $page_id * $limit;
				$length = $limit;
				
				$result = Common :: GetAllprojectReportsPagination($project_id,$current1, $length);				
				if (!$result) return;			
				$num_rows = count($result);
				
				$color_arr = array("#F6F6F6", "#EBEBEB");
				$row_count = ($page_id * $limit) + 1;
			?>	
				
                <?php 
				if($num_rows > 0) {
				
				//-----------------end first part-----------------------------------------------------?>
                
                	
                                             
                 <div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<form action="#" method="get" name="frmprojreport">
                <table class="listing" cellpadding="0" cellspacing="0">              
                
                <tr>
					<th width="29" rowspan="2" class="first">No</th>					
					<th width="69" rowspan="2">Date</th>
                    
                    <?php if($ptype==2) {?>
					<th colspan="2"><center>Allocation </center> </th>
					<th colspan="2"><center>Payment</center></th>	
                    		<?php } ?>	   
					<th width="92" rowspan="2"> Completed %</th>
					<th width="221" rowspan="2"> Remarks</th>                      
					<th width="49" rowspan="2" class="last">View</th> 
                        
				  </tr>
					<tr>
                     <?php if($ptype==2) {?>
					  <th width="65">Year</th>
					  <th width="78">Amount</th>
					  <th width="56"> Year</th>
					  <th width="89"> Amount</th>
                      <?php } ?>	  
	              </tr>
                
                
                  <?php 
						
						$i=1;
						foreach ($result as $row)
						{
					?>
                  
					<tr>
						<td><?php echo $i; ?></td>         
						<td align="left"><?php echo $row[1]; ?></td>
                         <?php if($ptype==2) {?>
						<td><?php echo $row[2]; ?></td>
						<td><?php echo number_format($row[3],'2','.',''); ?></td> 
						<td><?php echo $row[4]; ?></td>                        
                        <td><?php echo number_format($row[5],'2','.',''); ?></td>	   
                                  <?php } ?>	            		
						<td><?php echo $row[7]; ?></td>
                         <td><?php echo $row[8]; ?></td>			
                        <td><a href="displayProgressReport.php?progressID=<?php echo $row[0];?>"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
                        
						
					
						
					</tr>
                     <?php 
					 $i +=1;
					 } ?>
			  </table>
</form>
				   
		     <?php 
			
			 //-----------------second part-----------------------------------------------------?>

<?php
if ($num_rows > 0) {
	?>	
		<table align="center">
		<tr><td align="right">
			 <a name="test"></a>
			<?php
				if ((($page_id * $limit) - ($limit - 1)) > 0) { 
                	  
				?>
				<a href="display_project.php?&page=<?php echo($page_id - 1); ?>&unitid=<?php echo "$unit_id"; ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec); ?>&#test">&laquo; Previous</a> | <?php } ?>
				<?php echo((($page_id * $limit) + 1));?> - <?php echo((($page_id * $limit) + $num_rows)); ?> of <?php echo($max_rec); ?>
				<?php if ((($page_id * $limit) + $limit) < $max_rec) { ?>
				| <a href="display_project.php?page=<?php echo($page_id + 1); ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec)?>&unitid=<?php echo "$unit_id"; ?>&#test">Next &raquo</a>
				
<?php
}
}
?>
</td>
</tr>
</table>

<?php //-----------------end second part-----------------------------------------------------?>
			  </div>
              
              <?php } ?>
		  </div>
         
		</div>
		<div id="right-column"></div>
      <div id="footer"></div>
     <?php include_once("tpl/footter.tpl");?>
	</div>
	
</div>


</body>
</html>

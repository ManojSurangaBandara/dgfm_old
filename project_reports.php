<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/progress_report.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}

$project_id  = $_GET['projectID'] ?? 0;
$progress_id = $_GET['progressID'];
$ptype       = $_GET['ptype'];
$userId 	 = $_SESSION['userID'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>View Progress Report</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
    <script language="JavaScript" type="text/JavaScript" src="js/deleteconfirmations.js"></script>
</head>
<body>
<div id="main">
	<div id="header">
	  <?php // include ('tpl/topmenu.tpl');?>
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
				
                <a href="projects.php" class="button"><< BACK</a>
                 <a href="add_progress_report.php" class="button">ADD NEW</a>
				<h1>Project Reports</h1>
				<div class="breadcrumbs">
                
                <?php /*?><a href="projects.php">Project</a> / Project Reports<?php */?>
                
                </div>
			</div><br />
		  <div class="select-bar">          
           <div id="error" align="center" style="height:25px;">
            <?php require_once('messages/project.message.php'); ?>
		   
      </div> </div>
      
           
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
			$result = ProjectsProgress :: GetprojectReports($project_id);
			if (!$result) return;
		
			$max_rec = count($result);
	     }
		           
				$current1 = $page_id * $limit;
				$length = $limit;
				
				$result = ProjectsProgress :: GetprojectReportsPagination($project_id,$current1, $length);				
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
				
                <table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th width="29" rowspan="2" class="first">No</th>
						 <th width="83" rowspan="2">Report Date</th>
                         <?php if($ptype==2) {?>
						<th colspan="2"><center>Allocation </center>  </th>
						<th colspan="2"><center> Payment </center>  </th>
                        <?php }?>
                        
                        <th width="89" rowspan="2"> Completed %</th>
                        <th width="64" rowspan="2"> Remarks</th>						
                         <th width="40" rowspan="2"> Send</th>
						<th width="33" rowspan="2">Edit</th>
						<th width="49" rowspan="2" >Delete</th>       
                         <th width="45" rowspan="2" class="last">View</th>                 
                       
				
				  </tr>
                  
                  
					<tr>
                     <?php if($ptype==2) {?>
					  <th width="45">Year</th>
					  <th width="61">Amount</th>
					  <th width="38"> Year</th>
					  <th width="83">Amount</th>
	          <?php }?> 
                 </tr>
                   
                  
                  <?php 
						
						$i = $page_id *10 +1;
						foreach ($result as $row)
						{
							
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td align="left"><?php echo $row[1]; ?></td>
                        
                        
                         <?php if($ptype==2) {?>
                        
						<td><?php echo $row[2]; ?></td>
						<td><?php echo number_format($row[3],'2','.',','); ?></td>
						<td><?php echo $row[4]; ?></td>
                     	<td><?php echo number_format($row[5],'2','.',','); ?></td>	
                                 <?php }?>                   
                                			
                        <td><?php echo $row[7]; ?></td>
                        <td><?php echo $row[8]; ?></td>            
						
                        
						  <?php 
						
						
						  if($row[6] == 1){?>
                 <td> <input type="checkbox" name="chksend" id="chksend"  checked="checked"  disabled="disabled" />   </td>
        <td><a onclick="editSentProgressreport();" href="#" ><img src="images/edit-icon.gif" width="16" height="16" alt="" /></a></td>
	        <td class="last"><a onclick="deleteSentProgressreport();" href="#" ><img src="images/hr.gif" width="16" height="16" alt="Delete" /></a></td>
					                      
				  
				  
				  <?php } 
						  else {?>
      <td>  <input type="checkbox" name="chksend" id="chksend" onchange="sendprojectreport('<?php echo $row[0];?>','<?php echo $project_id; ?>','<?php echo $userId ?>');" /> </td>
      <td width="28"><a href="edit_project_progress.php?progress_id=<?php echo $row[0]; ?>&projectid=<?php echo $project_id; ?>&ptype=<?php echo $ptype; ?>"><img src="images/edit-icon.gif" width="16" height="16" alt="" /></a></td>
	                      
                        <td width="28" ><a onclick="deleteprojectreport('<?php echo $row[0];?>','<?php echo $project_id; ?>');" href="#" >                             <img src="images/hr.gif" width="16" height="16" alt="Delete" /></a></td>
					    
						  
						  <?php }?>     
                          <td width="33" class="last"><a href="displayProgressReport.php?progressID=<?php echo $row[0]; ?>&ptype=<?php echo $ptype; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
                    
            </tr>
                     <?php 
					 $i +=1;
					 } ?>
                     
			  </table>
              
		     <?php //-----------------second part-----------------------------------------------------?>

<?php
if ($num_rows > 0) {
	?>	
		<table align="center">
		<tr><td align="right">
			<?php
				if ((($page_id * $limit) - ($limit - 1)) > 0) { 
                	  
				?>
				<a href="project_reports.php?&page=<?php echo($page_id - 1); ?>&unitid=<?php echo "$unit_id"; ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec); ?>">&laquo; Previous</a> | <?php } ?>
				<?php echo((($page_id * $limit) + 1));?> - <?php echo((($page_id * $limit) + $num_rows)); ?> of <?php echo($max_rec); ?>
				<?php if ((($page_id * $limit) + $limit) < $max_rec) { ?>
				| <a href="project_reports.php?page=<?php echo($page_id + 1); ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec)?>&unitid=<?php echo "$unit_id"; ?>">Next &raquo</a>
				
<?php
}
}
?>
</td>
</tr>
</table>

<?php //-----------------end second part-----------------------------------------------------?>
		  </div>
          <?php } else  ?>
		</div>
	</div>
	<div id="footer"></div>
    <?php include_once("tpl/footter.tpl");?>
</div>


</body>
</html>

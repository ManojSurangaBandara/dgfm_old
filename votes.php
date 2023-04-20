<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/vote.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$path="";

$user_type_id = $_SESSION['userType'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM :: BSMS</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
    
    <script language="JavaScript" type="text/JavaScript" src="js/deleteconfirmations.js"></script>
  
  
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
			<!--<a href="#" class="link"> Related Links</a>	-->	
		</div>
		<div id="center-column">
			<div class="top-bar">
            
            <?php 
          //  if ($user_type_id == 6) { ?>
				<a href="new_vote.php" class="button">ADD NEW </a>
                
				<?php //}?>
                
				<h1>Allocated votes for the Year of - <?php echo $log_year; ?></h1>
				<div class="breadcrumbs"></div>
			</div><br />
		  <div class="select-bar">
		   <div id="error" align="center" style="height:25px;">
		     <?php require_once('messages/vote.message.php'); ?>
		   </div>
		  </div>
          
          
          
          
          
          
          <?php //-----------------First part-----------------------------------------------------?>	
		      
<?php 
	
	@$max_rec = $_GET["max"];
	@$limit = $_GET["limit"];
	@$page_id = $_GET["page"];	
	$id = isset($_GET['id'])?trim(@$_GET['id']) : '';
		
	if (!$page_id) $page_id = 0;
	if (!$limit) $limit = 400;		
	
	if (!$max_rec) 
		{					
			$result = Vote :: GetVoteDetails();
			if (!$result) return;
		
			$max_rec = count($result);
	     }
		           
				$current1 = $page_id * $limit;
				//$length = $limit;
				
				$result = Vote :: GetVoteDetails_pagination($current1,  $limit);				
				if (!$result) return;			
				$num_rows = count($result);
				
				$color_arr = array("#F6F6F6", "#EBEBEB");
				$row_count = ($page_id * $limit) + 1;
			?>	
				
                <?php //-----------------end first part-----------------------------------------------------?>
                
          
          
          
          
          
          
			<div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" rowspan="2" width="31">No</th>
						<th width="141" rowspan="2">Vote Number</th>
						<th width="522" rowspan="2">Description</th> 
                        <th width="100" rowspan="2">Vote Type</th> 
                        
                         <?php 
          //  if ($user_type_id == 6) { ?>
                        
                        <th width="54" rowspan="2">Edit</th>
                        
                        <?php // } ?>
						<th width="80" rowspan="2" class="last">Delete</th>
				  </tr>
                  
                  
                  <?php 
				  
								if($_SESSION['userType']==1)
								{
									$path='admin_home.php';
								}
								
								if($_SESSION['userType']==2)
								{
									$path='home.php';
								}
						
						$i = $page_id *400 +1;
						foreach ($result as $row)
						{ 
						
								
				
		?>
					<tr>
                    <tr>
						<td><?php echo $i; ?></td>                        
						<td align="left"><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td> 
                         <td><?php echo $row[6];?></td>                   
        
                       <?php 
           // if ($user_type_id == 6) { ?>
                        <td><center><a href="edit_vote.php?vote_id=<?php echo $row[0]; ?>"><img src="images/edit-icon.gif" width="16" height="16" alt="" /></a></center></td>
                        
                        <?php  //} ?>
                        
                        
						<td class="last"><center><a onclick="delete_vote('<?php echo $row[0];?>');" href="#" ><img src="images/hr.gif" width="16" height="16" alt="Delete" /></a></center></td>
                                       
                        </tr>
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
				<a href="votes.php?&page=<?php echo($page_id - 1); ?>&max=<?php echo($max_rec); ?>">&laquo; Previous</a> | <?php } ?>
				<?php echo((($page_id * $limit) + 1));?> - <?php echo((($page_id * $limit) + $num_rows)); ?> of <?php echo($max_rec); ?>
				<?php if ((($page_id * $limit) + $limit) < $max_rec) { ?>
				| <a href="votes.php?page=<?php echo($page_id + 1); ?>&max=<?php echo($max_rec)?>">Next &raquo</a>
				
<?php
}
}
?>
</td>
</tr>
</table>

<?php //-----------------end second part-----------------------------------------------------?>
		  </div>
		</div>
	</div>
	<div id="footer"></div>
    <?php include_once("tpl/footter.tpl");?>
</div>


</body>
</html>

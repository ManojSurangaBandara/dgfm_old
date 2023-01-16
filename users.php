<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/users.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$log_year	= $_SESSION['log_year'];
$user_type_id 	= $_SESSION['userType'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM :: BSMS</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
     <style media="all" type="text/css">@import "css/style.css";</style>
    <script language="JavaScript" type="text/JavaScript" src="js/deleteconfirmations.js"></script>
     <script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>
<script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>
<script language="JavaScript" type="text/JavaScript" src="js/jquery.min.js"></script>  
<script language="JavaScript" type="text/JavaScript" src="js/ddaccordion.js"></script>  
<script language="JavaScript" type="text/JavaScript" src="js/niceforms.js"></script> 
  
</head>
<body>
<div id="main">
	<div id="header">
	  <?php //include ('tpl/topmenu.tpl');
	 $urls ='NewAccountCreation.php';
	 if($_SESSION['userType'] == 1)
	  {
		  $urls='new_user.php';
	  }
	 
	  
	  
	  ?>
	</div>
	<div id="middle">
		<div id="left-column">
			<?php include ('tpl/log_out.tpl');?>
            <p></p>
            <?php include ('tpl/left_munu.tpl');?>
			<!--<a href="#" class="link"> Related Links</a>		-->
		</div>
		<div id="center-column">
			<div class="top-bar">
           <?php if($user_type_id==8 || $user_type_id==7 )
		   { ?>
				
                
               <?php  } else { ?>
               <?php /*?><a href="<?php echo $urls;?>" class="button">ADD NEW </a><?php */?>
               
               <?php  }  ?>
               
				<h1> <?php echo $_SESSION['username']; ?> - USER PROFILE - <?php echo $log_year; ?></h1>
				<div class="breadcrumbs">
                
                
                </div>
			</div><br />
		  <div class="select-bar">
		   <div id="error" align="center" style="height:25px; ">
		     <?php require_once('messages/users.message.php'); ?>
		   </div>
		  </div>
          
               
	<?php //-----------------First part-----------------------------------------------------?>	
		      
<?php 

   $deleteurl='index.php';
				  
				 /*  if($_SESSION['userType'] == 1){
					$type = user_type; 
					 $userid = user_id; 
					 $editurl='AdminUserAccountEdit.php';
					 $deleteurl='users.php';
					
				 }*/
				 
				 	 if ($_SESSION['userType'] == 1){
					 $type = $_SESSION['userType'] ; 
					 $userid = $_SESSION['userID'] ; 
					  $editurl='edit_user.php';
					            
				 }
				 
				 
				 
				 if ($_SESSION['userType'] == 2){
					 $type = $_SESSION['userType'] ; 
					 $userid = $_SESSION['userID'] ; 
					  $editurl='edit_user.php';
					            
				 }
				 
				  if ($_SESSION['userType'] == 3){
					 $type = $_SESSION['userType'] ; 
					  $userid = $_SESSION['userID'] ; 
					   $editurl='edit_user.php';
				 }
				 
				   if ($_SESSION['userType'] == 4){
					$type = $_SESSION['userType'] ; 
					 $userid = $_SESSION['userID'] ; 
					  $editurl='edit_user.php';
				 }	
				 
				  if ($_SESSION['userType'] == 5){
					$type = $_SESSION['userType'] ; 
					 $userid = $_SESSION['userID'] ; 
					  $editurl='edit_user.php';
				 }	
				 
				  if ($_SESSION['userType'] == 6){
					$type = $_SESSION['userType'] ; 
					 $userid = $_SESSION['userID'] ; 
					  $editurl='edit_user.php';
				 }	
				 
				   if ($_SESSION['userType'] == 7){
					$type = $_SESSION['userType'] ; 
					 $userid = $_SESSION['userID'] ; 
					  $editurl='edit_user.php';
				 }	
				 
				 if ($_SESSION['userType'] == 8){
					$type = $_SESSION['userType'] ; 
					 $userid = $_SESSION['userID'] ; 
					  $editurl='edit_user.php';
				 }	
				 
				 
				  if ($_SESSION['userType'] == 9){
					$type = $_SESSION['userType'] ; 
					 $userid = $_SESSION['userID'] ; 
					  $editurl='edit_user.php';
				 }	
				 
				   if ($_SESSION['userType'] == 10){
					$type = $_SESSION['userType'] ; 
					 $userid = $_SESSION['userID'] ; 
					  $editurl='edit_user.php';
				 }	
				 
				 
				 
	
	@$max_rec = $_GET["max"];
	@$limit = $_GET["limit"];
	@$page_id = $_GET["page"];	
	$id = trim(@$_GET['id']);
		
	if (!$page_id) $page_id = 0;
	if (!$limit) $limit = 100;		
	
	if (!$max_rec) 
		{					
			$result = Users::getAllUsersForUserType($type,$userid);
			if (!$result) return;
		
			$max_rec = mysql_num_rows($result);
	     }
		           
				$current1 = $page_id * $limit;
				$length = $limit;
				
				$result = Users :: getAllUsersForUserTypePagination($type,$userid,$current1, $length);				
				if (!$result) return;			
				$num_rows = mysql_num_rows($result);
				
				$color_arr = array("#F6F6F6", "#EBEBEB");
				$row_count = ($page_id * $limit) + 1;
			?>	
				
                <?php //-----------------end first part-----------------------------------------------------?>
          
			<div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="29">No</th>
						<th width="70"><span class="first">User Name</span></th>
						<th width="80">Location</th>
						<!--<th width="83">User Type</th>-->
                        
						<th width="280">Name</th>
						<!--<th width="69">NIC</th>-->
                        <th width="65">Telephone</th>
                        <th width="150">Email</th>
                        
                        
                       <!-- <th width="61">Privilege</th>-->
						<th width="32" class="last">Edit</th>
						<!--<th width="65" class="last">Delete</th>-->
				  </tr>
                  <?php 
				  
				  
				  $i = $page_id *100 +1;
						while($row = mysql_fetch_array($result))
						{
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td align="left"><?php echo $row[1]; ?></td>
                        
                    <?php if ($row[9] == "") { ?>
					
					<td><?php echo $row[2]; ?></td>
					<?php  } else  { ?>                    
                        <td><?php echo $row[9]; ?></td>
						 <?php } ?>
                        
                        
                        
					<?php /*?>	<td><?php echo $row[6]; ?></td>  <?php */?>               
						<td><?php echo $row[10]; ?></td>
                        <?php /*?><td><?php echo $row[11]; ?></td><?php */?>
						<td><?php echo $row[12]; ?></td>
                        <td><?php echo $row[13]; ?></td>
                        
                        
                  <?php /*?>    
                    <?php if($row[4]==0) {  ?>                      
                        <td>All</td>
                        <?php } else { ?>
                          <td><?php echo $row[4]; ?></td>
                        <?php } ?>
                        
                        
                        
                        <?php if($row[5]==0) {  ?>                      
                        <td>All</td>
                        <?php } else { ?>
                          <td><?php echo $row[9]; ?></td>
                        <?php } ?>
                        
                        
                        <td><?php echo $row[8]; ?></td>
                       <?php */?>
                       
                       
                        <?php /*?><?php if($row[7]==1) {  ?>                      
                        <td>Yes</td>
                        <?php } else { ?>
                          <td>No</td>
                        <?php } ?><?php */?>
                        
						<td width="48"><a href="<?php echo $editurl;?>?userid=<?php echo $row[0]; ?>"><img src="images/edit-icon.gif" width="16" height="16" alt="" /></a></td>
						<?php /*?><td width="27" class="last"><a onclick="deleteotherAccount('<?php echo $row[0];?>','<?php echo $type; ?>','<?php echo $deleteurl;?>');" href="#" ><img src="images/hr.gif" width="16" height="16" alt="Delete" /></a></td><?php */?>
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
				<a href="users.php?&page=<?php echo($page_id - 1); ?>&unitid=<?php echo "$unit_id"; ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec); ?>">&laquo; Previous</a> | <?php } ?>
				<?php echo((($page_id * $limit) + 1));?> - <?php echo((($page_id * $limit) + $num_rows)); ?> of <?php echo($max_rec); ?>
				<?php if ((($page_id * $limit) + $limit) < $max_rec) { ?>
				| <a href="users.php?page=<?php echo($page_id + 1); ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec)?>&unitid=<?php echo "$unit_id"; ?>">Next &raquo</a>
				
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

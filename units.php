<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/units.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$path="";
$log_year	= $_SESSION['log_year'];
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
	  <?php //include ('tpl/topmenu.tpl');?>
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
				<!--<a href="new_units.php" class="button">ADD NEW </a>-->
				<h1>Progress of the Account Offices - <?php echo $log_year; ?></h1>
				<div class="breadcrumbs"> </div>
			</div><br />
		  <div class="select-bar">
		   <div id="error" align="center" style="height:25px;">
		     <?php require_once('messages/unit.message.php'); ?>
		   </div>
		  </div>
          
          
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
			$result = Units :: GetUnitDetails();
			if (!$result) return;
		
			$max_rec = count($result);
	     }
		           
				$current1 = $page_id * $limit;
				$length = $limit;
				
				$result = Units :: GetUnitDetailsPagination($current1, $length);				
				if (!$result) return;			
				$num_rows = count($result);
				
				$color_arr = array("#F6F6F6", "#EBEBEB");
				$row_count = ($page_id * $limit) + 1;		
				
				
				$myresult = Units :: GetVoucherDetailstodgfm();			
			?>	
				
                <?php //-----------------end first part-----------------------------------------------------?>
                
               
			<div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" rowspan="2" width="25">No</th>
						<th width="150" rowspan="2"><span class="first">Location</span></th>
						<!--<th width="100" rowspan="2">Location</th> -->                         
                        <th colspan="4" align="center" ><center>No of Vouchers</center></th>
						<!--<th width="70" rowspan="2">Edit</th>
						<th width="102" rowspan="2" class="last">Delete</th>-->
				  </tr>
                  <tr>
                  		<th width="80">All</th>
                        <th width="80">Settled </th>
                        <th width="80">Not Settled</th>
						<!--<th width="80">Canceled</th>-->
                        <th width="80">Returned</th>
						
                  </tr>
                  
                  <?php 
                  
					foreach ($myresult as $row2) 
					{	?>
                  
                  	<tr>
						<td>1</td>
						<td align="left">DIRECTORATE OF FINANCE</td>
                       <!-- <td>Tripoli Maradana</td>   -->                 
                     	<?php /*?><td><?php echo $row[4]; ?></td><?php */?>
						<td align="center"><?php echo $row2[0]; ?></td>                             
                      
                   <td align="center"><a href="ViewChiefAccount.php?branch_id=6&status=1"><?php echo $row2[2]; ?></a></td>   
                   <td align="center"><a href="ViewChiefAccount.php?branch_id=6&status=0"><?php echo $row2[1]; ?></a></td>                
                 <?php /*?>  <td align="center"><a href="ViewChiefAccount.php?branch_id=6&status=2"><?php echo $row2[3]; ?></a></td>     <?php */?> 
                   <td align="center"><a href="ViewChiefAccount.php?branch_id=6&status=3"><?php echo $row2[4]; ?></a></td>      
					</tr>
                  
                  
                  
                  
                  
                  
                   <?php 
                  
						}
							
					?>
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  <?php 
						
						$i = $page_id *10 +2;
						foreach ($result as $row)
						{
													
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td align="left"><?php echo $row[1]; ?></td>
                        <!--<td><?php echo $row[2]; ?></td>      -->           	
					   <td align="center"><?php echo $row[3]; ?></td>     
                                           
                       <td align="center"><a href="ViewSfhq.php?status=1&sfhq_id=<?php echo $row[0]; ?>"><?php echo $row[4]; ?></a></td>
                       <td align="center"><a href="ViewSfhq.php?status=0&sfhq_id=<?php echo $row[0]; ?>"><?php echo $row[5]; ?></a></td>        
                      <?php /*?> <td align="center"><a href="ViewSfhq.php?status=2&sfhq_id=<?php echo $row[0]; ?>"><?php echo $row[6]; ?></a></td>          <?php */?>
                       <td align="center"><a href="ViewSfhq.php?status=3&sfhq_id=<?php echo $row[0]; ?>"><?php echo $row[7]; ?></a></td>          
                     
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
				<a href="units.php?&page=<?php echo($page_id - 1); ?>&unitid=<?php echo "$unit_id"; ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec); ?>">&laquo; Previous</a> | <?php } ?>
				<?php echo((($page_id * $limit) + 1));?> - <?php echo((($page_id * $limit) + $num_rows)); ?> of <?php echo($max_rec); ?>
				<?php if ((($page_id * $limit) + $limit) < $max_rec) { ?>
				| <a href="units.php?page=<?php echo($page_id + 1); ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec)?>&unitid=<?php echo "$unit_id"; ?>">Next &raquo</a>
				
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

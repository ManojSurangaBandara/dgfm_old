<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/ge.class.php');
require_once('classes/money.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}

$year_r  	=	isset( $_GET['year'])?$_GET['year']:2012;
//$voteCode 	=	isset( $_GET['voteCode'])?$_GET['voteCode']:1 ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>View Vote Summery Report </title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
    <style media="all" type="text/css">@import "css/style.css";</style>
    <script language="JavaScript" type="text/JavaScript" src="js/deleteconfirmations.js"></script>
    <script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>
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
			<a href="#" class="link"> Related Links</a>		
		</div>
		<div id="center-column">
			<div class="top-bar">
           
            
			
                
                 
                
               
                
                 <?php
		 
		 if($_SESSION['userType'] == 1)
			{ ?>
				<a href="Chiefacc.php" class="button"> << Back </a>
		 <?php	}
            
        if($_SESSION['userType'] == 2)
		   {?>
			   <a href="units.php" class="button"> << Back</a>
		 <?php   }?>
		   
           
           
               <?php
		 
		 if($_SESSION['userType'] == 3)
			{ ?>
				<a href="Chiefacc.php" class="button"> << Back </a>
		 <?php	}
            
        if($_SESSION['userType'] == 4)
		   {?>
			   <a href="units.php" class="button" > << Back</a>
		 <?php   }?>
		   
           
               <?php
		 
		 if($_SESSION['userType'] == 5)
			{ ?>
				<a href="Chiefacc.php" class="button" > << Back </a>
		 <?php	}?>
		   
           
           
				<div class="breadcrumbs">
           
           
           
                <h1> View Vote Amounts</h1></div>
			</div>
          
		    <div class="select-bar">
           <td>
             <table width="100%" border="0">
               <tr>
                 <td width="9%">Select Year</td>
                 <td width="27%"> <label>
	<select name="cmb_allocated_year" id="cmb_allocated_year" style="width:70px" onchange="getYearsvotsummery(this.value)">
					      													
                            <?php 
							for($i=2011; $i<2051; $i++){
							?>                         
 <option value="<?php echo $i; ?>" <?php if( $i == $year_r ){ echo "selected=selected"; }?>><?php echo $i; ?></option>
                   
					        <?php } ?>
				          </select>
				      </label>  
                      </td>
                 <td width="50%">
                 
                 
                 <?php /*?> <td width="9%">Vote Name</td>
                 <td ><select name="vote"  id="vote"  onchange="getvotecodevotesummery(this.value,'<?php echo $year_r; ?>')" >
                   <?php 
							$esrunit = Common :: GetVotesName();
							foreach ($esrunit as $rowesrunit) {
							?>
                   <option value="<?php echo $rowesrunit[0]; ?>" <?php if( $rowesrunit[0] == $voteCode){ echo "selected=selected"; }?> ><?php echo $rowesrunit[1]; ?></option>
                   <?php } ?>
                 </select></td>
                 
                 <td width="60%"><?php */?>
                 
                 
                 <div id="error" align="left" style="height:15px;">
		     <?php require_once('messages/ge_branch.message.php'); ?>
		   </div></td>
               </tr>
             </table></td>
           <td>
            <td>    
           
		  </div>
          
          
         
      
                  
	<?php //-----------------First part-----------------------------------------------------?>	
		      
<?php 
	
	@$max_rec = $_GET["max"];
	@$limit = $_GET["limit"];
	@$page_id = $_GET["page"];	
	$id = trim(@$_GET['id']);
		
	if (!$page_id) $page_id = 0;
	if (!$limit) $limit = 100;		
	
	if (!$max_rec) 
		{					
			$result = Money :: getMoneyAllocationvtSummery($year_r);
			if (!$result) return;
		
			$max_rec = count($result);
	     }
		           
				$current1 = $page_id * $limit;
				$length = $limit;
				
				$result = Money :: getMoneyAllocationDetailsvtSummeryPagination($year_r,$current1, $length);				
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
						<th rowspan="2" class="first" width="15">No</th>
						<th rowspan="2" width="130"><span class="first">Vote Code</span></th>
                        <th rowspan="2" width="500"><span class="first">Vote Name</span></th>
                        <th align="right" rowspan="2" width="60">Total Allocation</th>	
                        <th style="fon" align="right" colspan="2" width="90">Usage</th>
                        
                                
						<th align="right" rowspan="2" width="60">Total Expenditure</th>	
                        <th align="right" rowspan="2" class="last" width="60">In Hands</th>						
						
						
				  </tr>
                  
                  
                  
                  <tr>
                  
                  
                       <th align="right"  width="60">ChiefAcc</th>	
                        <th  align="right" width="60">RegAcc</th>	  
                  </tr>
                  
                  
                  <?php 
				
					
						
						$i = $page_id *100 +1;
						foreach ($result as $row)
						{
					?>
					<tr>
						<td><?php echo $i; ?></td>
					 <td><?php echo ($row[0]); ?></td>
					<td><?php echo ($row[1]); ?></td>
                     <td align="right"><?php echo number_format($row[2],'2','.',','); ?></td>
					<td align="right"><?php echo number_format($row[3],'2','.',','); ?></td>               
                     <td align="right"><?php echo number_format($row[4],'2','.',','); ?></td>
					<td align="right"><?php echo number_format($row[5],'2','.',','); ?></td>
                     <td align="right"><?php echo number_format($row[6],'2','.',','); ?></td>
					
						
						
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
				<a href="ViewVoteAmtSummery.php?&page=<?php echo($page_id - 1); ?>&unitid=<?php echo "$unit_id"; ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec); ?>">&laquo; Previous</a> | <?php } ?>
				<?php echo((($page_id * $limit) + 1));?> - <?php echo((($page_id * $limit) + $num_rows)); ?> of <?php echo($max_rec); ?>
				<?php if ((($page_id * $limit) + $limit) < $max_rec) { ?>
				| <a href="ViewVoteAmtSummery.php?page=<?php echo($page_id + 1); ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec)?>&unitid=<?php echo "$unit_id"; ?>">Next &raquo</a>
				
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

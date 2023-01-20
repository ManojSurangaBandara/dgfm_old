<?php 
	require_once('includes/config.php');
	require_once('classes/db_con.php');
	require_once('classes/common.class.php');
	require_once('classes/projects.class.php');

	


//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}

$log_year	= $_SESSION['log_year'];

$search_str = "";
$search = $_POST[tags];

$user_id 			= $_SESSION['userID'];
$Isprivilege_user 	= $_SESSION['Isprivilege_user'];
$Sessionbranch_id  	= $_SESSION['branchID'];
$branch_id   		= isset( $_GET['branch_id'])?$_GET['branch_id']:$Sessionbranch_id;

$Branch 			= Common :: GetBranchNametoPsoView($branch_id);


/*switch ($branch_id) {
    case 8:
       $branch_id='8 || 3';
        break;
    case 60:
        $branch_id='60 || 3';
        break;
    case 37:
        $branch_id='37 || 3';
        break;
	case 63:
        $branch_id='63 || 3';
        break;
    default:
        $branch_id = $branch_id;	
}

*/




//echo $branch_id;

$status   		= isset( $_GET['status'])?$_GET['status']:0;	
$vote_id 		= isset( $_GET['vote_id'])?$_GET['vote_id']:vote_id;
$alloc   		= isset( $_GET['alloc'])?$_GET['alloc']:$alloc;


$bName 			= $Branch['branch_name']; 


if ($alloc==NULL)
{
	$alloc=0;
}
else 
{
	$alloc=$alloc;
}
		 
switch($status)
{
	case 0:
	$st = 'Not settled';
	break;
	
	case 1:
	$st = 'Settled';
	break;
	
	//case 2:
	//$st = 'Cancelled';
	//break;
	
	case 3:
	$st = 'Returned';
	break;
	
	default:
	$st = 'Not settled';
	break;
	
	
	
}

//$progressdata = Common :: GetSumofSFHQBillstoPSOView($status,$search,$branch_id,$vote_id,$log_year);
$progressdata = Common :: GetVtCode($vote_id);

//$DirSum = Common :: GetSumofDirectoratebillstoPSOView($status,$search,$branch_id,$vote_id,$log_year);


//$ttl = $progressdata['amount']+ $DirSum['Amt'];

		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM :: BSMS </title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
    <style media="all" type="text/css">@import "css/style.css";</style>
    
    
    <script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>  
    <script language="JavaScript" type="text/JavaScript" src="js/deleteconfirmations.js"></script>  
    
     <script language="JavaScript" type="text/JavaScript" src="js/jquery.min.js"></script>  
    <script language="JavaScript" type="text/JavaScript" src="js/ddaccordion.js"></script>  
      <script language="JavaScript" type="text/JavaScript" src="js/niceforms.js"></script> 
  
    
    <link type="text/css" href="themes/base/ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery-1.4.1.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.position.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.autocomplete.js"></script>    
	
    
	<link type="text/css" href="demos.css" rel="stylesheet" />
    <?php	

	 
	$project = Common :: GetBillNoforPSOView($status,$branch_id,$vote_id,$log_year);
	 foreach ($project as $rowproject){
	 
		 if($search_str == ""){
			 $search_str = "'{$rowproject[0]}'";
		 }
		 else{
			 $search_str = $search_str.",'{$rowproject[0]}'";
		 }
	 }
	 
	?>
	<script type="text/javascript">
	$(function() {
			   
			   
		var availableTags = [<?php echo $search_str; ?>];		
		$("#tags").autocomplete({
			source: availableTags
		});
	});
	</script>
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
<script type="text/javascript" src="jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>


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
            <!--<a href="#" class="link"> Related Links</a>-->			
			
		</div>
		<div id="center-column" class="top-bar">       
       <!--  <a href="PsoView.php" class="button">BACK</a>-->
       <?php if($status==1) {?>
          <?php /*?>  <a href="FusionCharts/Gallery/AllocExpandChartPso.php?years=<?php echo $log_year; ?>&vote_id=<?php echo $vote_id; ?>&status=<?php echo $status; ?>&branch_id=<?php echo $branch_id; ?>&alloc=<?php echo $alloc; ?>" class="button">CHART</a><?php */?>
           	  	<?php } ?>
			<div class="top-bar" style="width:75%">
		
               
              <!--  <a href="add_progress_report.php" class="button_r">PROGRESS REPORT </a>-->
				<h2 style="text-transform:uppercase">Allocation for <?php echo $progressdata['voteName']; ?> is <?php echo  number_format($alloc,'2','.',','); ?> - <?php echo $log_year; ?>  </h2>
                 
				<div class="breadcrumbs">   
				  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><?php require_once('messages/project.message.php'); ?></div>
			</div>
		  <form action="" method="post">
			<div class="select-bar">
			  <div style="height:25px; ">
         
        
    
         
        
 Supplier Name	
            <span class="ui-widget">
            <input id="tags" type="text" class="textBoxces"size="27" name="tags" />
           
            <span class="last">
            <input type="submit"  name="btnsubmit" id="btnsubmit" value="Submit" />            
            </span>
            
            <td>&nbsp;         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;    </td> 
            
            Status </span>  
            
          
          
            <select name="billstatus" class="ComboBoxcesSmall" id="billstatus" onchange="getbillstatustopso(this.value,'<?php echo $vote_id; ?>','<?php echo $branch_id; ?>','<?php echo $alloc; ?>')" style="width:100px;"> 
              <option value="0" <?php if( $_GET['status'] == 0){ echo "selected=selected"; }?>>Not Settled</option>
              <option value="1" <?php if( $_GET['status'] == 1){ echo "selected=selected"; }?>>Settled</option>
 			  <option value="3" <?php if( $_GET['status'] == 3){ echo "selected=selected"; }?>>Returned</option>
            </select>
        
            
<div class="demo">
  <div class="ui-widget"></div>
</div>
           </td> 
            <td>&nbsp;</td>
           <td>&nbsp;</td>
           
		  </div>
            </div>
          
          
	<?php //-----------------First part-----------------------------------------------------?>	
		      
<?php   	  
	
	@$max_rec 	= $_GET["max"];
	@$limit 	= $_GET["limit"];
	@$page_id 	= $_GET["page"];	
	$id 		= trim(@$_GET['id']);
	$tag 		= $_POST['tags'];
		
	if (!$page_id) $page_id = 0;
	if (!$limit) $limit = 1000;		
	
	if (!$max_rec) 
		{		
		
		if($branch_id ==6){
		
			//$result = Projects :: GetAllBillsDGFMToBigUserAll($status,$search,$user_type_id);
		//	if (!$result) return;

		}
		else{	$result = Projects :: GetSFHQbilltoviewtoPSO($status,$search,$branch_id,$vote_id,$log_year);
			if (!$result) return;
		}
			$max_rec = count($result);
	     }
		           
				$current1 = $page_id * $limit;
				$length = $limit;
				
			if($branch_id == $branch_id){
		
			//$result = Projects :: GetAllBillsDGFMPaginationToBigUserAll($status,$search,$user_type_id,$current1, $length);	
			//if (!$result) return;

			}
			else{
				$result = Projects :: GetSFHQbilltoviewtoPSOPagination($status,$search,$branch_id,$vote_id,$log_year,$current1, $length);				
				if (!$result) return;	
				
				}		
				$num_rows = count($result);
				
				$color_arr = array("#F6F6F6", "#EBEBEB");
				$row_count = ($page_id * $limit) + 1;
			?>	
				
                <?php //-----------------end first part-----------------------------------------------------?>
			<div class="table">
           
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="15">No</th>
                        <th width="57">Acct Office</th>
                        <th width="28">Bill No</th>
                        <th width="184">Supplier Name</th>
                        <th width="75"> Received Date</th>	
						<th width="70">Amount(Rs)</th>
						
				
                   <?php 		
				  
				   if($status==0)
						{ ?>
                          <th width="20" >View</th>
                          
				  <?php }
						
						if($status==1)
						{ ?>
                       		<th width="66" >Settled Date</th>
							<th width="20" class="last">View</th>
				  <?php }
						
						if($status==2)
						{ ?>
                        	<th width="20" class="last">View</th>
				  <?php } if($status==3)
						{ ?>
                        	<th width="75">Returned Date</th>                           
                            <th width="20" class="last">View</th>
				  <?php }   ?>                     
						
                         
				  </tr>
                  <?php 
						
						$i = $page_id *1000 +1;		
						$total=0;					
						foreach ($result as $row)
						{
							 
					?>
					<tr>
						<td><?php echo $i; ?></td>                        
                        <td><?php echo $row[7]; ?></td>	
                         <td><?php echo $row[1]; ?></td>						
						<td><?php echo $row[2]; ?></td>                   
                        <td><?php echo $row[3]; ?></td>
                        <td align="right"><?php echo  number_format($row[4],'2','.',','); ?></td>
                       
                     
				
                           <?php 	
						   
						   if($row[7]=='Dte of Fin')
							{
							   $seturl='ViewDteFullFileDetails.php'; 
							}
							else 
							{
								$seturl='ViewPsoFullFileDetails.php';
							}
						   
						  // echo $seturl;
						   
						 
					if($status==0)
						{ ?>
                     <td class="last"><a href="<?php echo $seturl;?>?billId=<?php echo $row[0]; ?>&status=<?php echo $status; ?>&vote_id=<?php echo $vote_id; ?>&branch_id=<?php echo $branch_id; ?>&alloc=<?php echo $alloc; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
                      
                     
				  <?php }
						
						if($status==1)
						{ ?>
                        
                         <td><?php echo $row[5]; ?></td>			
                          <td class="last"><a href="<?php echo $seturl;?>?billId=<?php echo $row[0]; ?>&status=<?php echo $status; ?>&vote_id=<?php echo $vote_id; ?>&branch_id=<?php echo $branch_id; ?>&alloc=<?php echo $alloc; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
							
				  <?php }
						
						if($status==2)
						{ ?>
						
                              <td class="last"><a href="<?php echo $seturl;?>?billId=<?php echo $row[0]; ?>&status=<?php echo $status; ?>&vote_id=<?php echo $vote_id; ?>&branch_id=<?php echo $branch_id; ?>&alloc=<?php echo $alloc; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
				  <?php }
						
						
						if($status==3)
						{ ?>
                        		<td><?php echo $row[6]; ?></td>									                            
                             <td class="last"><a href="<?php echo $seturl;?>?billId=<?php echo $row[0]; ?>&status=<?php echo $status; ?>&vote_id=<?php echo $vote_id; ?>&branch_id=<?php echo $branch_id;?>&alloc=<?php echo $alloc; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
				  <?php }   ?>
                       
                       
				  </tr>
                     <?php 
					 $i +=1;
					 $total=$row[4]+$total;
					 }  ?>
                     
                     <tr><td  colspan="5" align="center"><b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Expenditure (Rs)</b></td> <td colspan="4"><b><?php echo  number_format($total,'2','.',','); ?></b></td>	</tr>
                     
                  <?php    if($status ==1) { ?>
                     
                      <tr><td  colspan="5" align="center"><b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Remaining Balance On This Vote (Rs)</b></td> <td colspan="4"><b><?php echo  number_format($alloc-$total,'2','.',','); ?></b></td>	</tr>
			  
          <?php     } ?>
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
				<a href="ViewFullDetailsforPSO.php?&page=<?php echo($page_id - 1); ?>&vote_id=<?php echo $vote_id; ?>&projectID=<?php echo $project_id; ?>&status=<?php echo "$status"; ?>&max=<?php echo($max_rec); ?>">&laquo; Previous</a> | <?php } ?>
				<?php echo((($page_id * $limit) + 1));?> - <?php echo((($page_id * $limit) + $num_rows)); ?> of <?php echo($max_rec); ?>
				<?php if ((($page_id * $limit) + $limit) < $max_rec) { ?>
				| <a href="ViewFullDetailsforPSO.php?page=<?php echo($page_id + 1); ?>&vote_id=<?php echo $vote_id; ?>&max=<?php echo($max_rec)?>&status=<?php echo "$status"; ?>">Next &raquo</a>
	
    			
<?php
	
				
}
}
?>
</td>
</tr>
</table>

<?php //-----------------end second part-----------------------------------------------------?>

   </div>
   </form>
		</div>
	</div>
	<div id="footer"></div>
    <?php include_once("tpl/footter.tpl");?>
</div>


</body>
</html>


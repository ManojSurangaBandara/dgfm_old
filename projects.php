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
$search = $_POST['tags'];

$user_id 		= $_SESSION['userID'];
$Isprivilege_user = $_SESSION['Isprivilege_user'];

$user_type_id 	= $_SESSION['userType'];
$status   		= isset( $_GET['status'])?$_GET['status']:0;	
$branch_id 		= isset( $_GET['branch_id'])?$_GET['branch_id']:6;
$sfhq_id 		= $_SESSION['sfhqID'];




//echo "log_year".$log_year."user_id".$user_id."user_type_id".$user_type_id."status".$status."branch_id".$branch_id."sfhq_id".$sfhq_id."";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM::BSMS </title>
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

	 
	$project = Common :: GetDGFMBillDetailsToSFHQ($status,$branch_id,$user_type_id,$sfhq_id,$log_year);
	 foreach ($project as $rowproject){
	 
		 if($search_str == ""){
			 $search_str = "'{$rowproject[1]}'";
		 }
		 else{
			 $search_str = $search_str.",'{$rowproject[1]}'";
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
		<div id="center-column">
			<div class="top-bar">
				<a href="SfhqAddBills.php?prcon_id=1&opcon_id=1&brach_id=2" class="button">ADD NEW </a>
            
				
               
              <!--  <a href="add_progress_report.php" class="button_r">PROGRESS REPORT </a>-->
				<h1>Bill Details for the Year of  <?php echo $_SESSION['log_year']; ?></h1>
				<div class="breadcrumbs">    
				  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><?php require_once('messages/project.message.php'); ?></div>
			</div><br />
          <form action="" method="post">
		  <div class="select-bar">
            <div style="height:25px; ">
         
        
        <td>
         <td>Directorate</td>
           <td><label>         
           
<select name="branch_id" class="ComboBoxcesSmall" id="branch_id" onchange="getbranchStatusToSFHQ(this.value,'<?php echo $status; ?>')"style="width:100px;">
						   
							 <?php 
							$esrunit = Projects::get_all_branchestosfhq();
							foreach ($esrunit as $rowesrunit) {?>
						     <option value="<?php echo $rowesrunit[0];  ?>" <?php if( $rowesrunit[0] == $branch_id){ echo "selected=selected"; }?> > <?php echo $rowesrunit[1]; ?></option>
						      <?php }?>
	          </select>
	    </label> </td>
         <td>&nbsp;&nbsp;</td> 
        
Reg No or Sup Name	
            <span class="ui-widget">
            <input id="tags" type="text" class="textBoxces"size="32" name="tags" />
           
            <span class="last">
            <input type="submit"  name="btnsubmit" id="btnsubmit" value="Submit" />            
            </span>
            
            <td>&nbsp;&nbsp; Status</td> 
            
            </span>  <select name="billstatus" class="ComboBoxcesSmall" id="billstatus"  onchange="getBillStatusToSFHQ(this.value,'<?php echo $branch_id; ?>')" style="width:100px;" >
              <option value="0" <?php if( $_GET['status'] == 0){ echo "selected=selected"; }?>>Not Settled</option>
              <option value="1" <?php if( $_GET['status'] == 1){ echo "selected=selected"; }?>>Settled</option>              <option value="3" <?php if( $_GET['status'] == 3){ echo "selected=selected"; }?>>Returned</option>
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
	if (!$limit) $limit = 5;		
	
	if (!$max_rec) 
		{		
		
		if($branch_id ==6){
		
			$result = Projects :: GetAllBillsDGFMToSFHQAll($status,$search,$user_type_id,$sfhq_id);
			if (!$result) return;

		}
		else{	$result = Projects :: GetAllBillsDGFMToSFHQ($branch_id,$status,$search,$user_type_id,$sfhq_id);
			if (!$result) return;
		}
			$max_rec = count($result);
	     }
		           
				$current1 = $page_id * $limit;
				$length = $limit;
				
			if($branch_id==6){
		
			$result = Projects :: GetAllBillsDGFMPaginationToSFHQAll($status,$search,$user_type_id,$sfhq_id,$current1, $length);	
			if (!$result) return;

			}
			else{
				$result = Projects :: GetAllBillsDGFMPaginationToSFHQ($branch_id,$status,$search,$user_type_id,$sfhq_id,$current1, $length);				
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
                        <th width="15">Bill No</th>
                        <th width="180">Supplier Name</th>
                        
                                        
               
                        <?php 					
						if($branch_id==6)
						{ ?>
                         	<th width="40">Dte</th>
                  <?php }?>  
                        <!--<th width="90"> Vote Name</th>	-->
                  		<th width="50"> Rec Date</th>	
						<th width="15">Amt(LKR) </th>
						
					
                        
                   <?php 		
				   
				   
				   
				   if($Isprivilege_user ==1) {
				   
						if($status==0)
						{ ?>
                         	<th width="20">Edit</th>
							<!--<th width="20">Cancel</th>-->
							<!--<th width="20" >Delete</th>     -->
                            <th width="20">Rtn</th>                      
                            <th width="20" >View</th>
                            <th width="20" class="last" >Settle</th>
				  <?php }
						
						if($status==1)
						{ ?>
                        	<th width="40">Set Date</th>
							<th width="20" >View</th>
                            <th width="20" class="last">Unsettle</th>
				  <?php }
						
						if($status==2)
						{ ?>
                        	
							<!--<th width="20">Activate</th>-->
							<!--<th width="20" >Delete</th>-->
                          <!--  <th width="20" class="last">View</th>-->
                            
				  <?php } if($status==3)
						{ ?>
                        	<th width="40">Rtn Date</th>
							<th width="20">Act</th>
							<!--<th width="20" >Delete</th>-->
                            <th width="20" >View</th>
                            <th width="20" class="last">Delete</th>
				  <?php }  
				  
				   } else  { if($status==0)
						{ ?>
							<th width="20">Edit</th> 
                         	<th width="20">Rtn</th>                 
                            <th width="20" >View</th>
                            <th width="20" class="last" >Settle</th>
				  <?php }
						
						if($status==1)
						{ ?>
                        	<th width="40" >Set Date</th>
							<th width="20" >View</th>
                            <th width="20" class="last">Cheque</th>
				  <?php }
						
						if($status==2)
						{ ?>
                        	
                            <th width="20" class="last">View</th>
				  <?php } if($status==3)
						{ ?>
                        	 <th width="50">Rtn Date</th>
							<th width="20">Act</th>
                            <th width="20" class="last">View</th>
				  <?php }  } ?>                     
						
                         
				  </tr>
                  <?php 
						
						$i = $page_id *5 +1;							
						foreach ($result as $row)
						{
					?>
					<tr>
						<td><?php echo $i; ?></td>
                        <td><?php echo $row[1]; ?></td>						
						<td><?php echo $row[5]; ?></td>
                   
                       <?php 					
						if($branch_id==6)
						{ ?>
                        <td><?php echo $row[7]; ?></td>
                 <?php }?>  
                                               
                   <?php /*?>    <td><?php echo $row[6]; ?></td><?php */?>
                        <td><?php echo $row[3]; ?></td>
                        <td><?php echo  number_format($row[4],'2','.',','); ?></td>
                      
				
                           <?php 	
						  if($Isprivilege_user ==1) {  
						   
						if($status==0)
						{ ?>
                        <td><a href="EditSfhqBills.php?projectid=<?php echo $row[0]; ?>&branch_id=<?php echo $row[6]; ?>"><img src="images/edit-icon2.gif" width="16" height="16" alt="" /></a></td>
						
                        <?php /*?><td><a href="CancelSfhqBills.php?projectid=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>&cval=cancel"><img src="images/Cancel.ico" width="16" height="16" alt="" /></a></td><?php */?>
                        
						<?php /*?><td ><a onclick="deletebillsSfhq('<?php echo $row[0];?>','<?php echo $row[1]; ?>');" href="#" ><img src="images/hr.gif" width="16" height="16" alt="Delete" /></a></td><?php */?>
                     
                          <td><a href="ReturnSfhqBill.php?projectid=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>&cval=cancel"><img src="images/undo.ico" width="16" height="16" alt="" /></a></td>
                        
                         <td class="last"><a href="ViewSfhqBillDetails.php?billId=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
                      
                        <td><a href="#" onclick="SettleSfhqBill('<?php echo $row[0];?>','<?php echo $user_id ?>','<?php echo $branch_id; ?>');"><img src="images/settle.ico" width="16" height="16" alt="" /></a></td>
                        
				  <?php }
						
						if($status==1)
						{ ?>
                          <td><?php echo $row[8]; ?></td>	
                        
                         <td class="last"><a href="ViewSfhqBillDetails.php?billId=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
                         
                    
                        
                       <td class="last"><a href="UnSettleSFHQBills.php?bill_id=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>" class="link"><img src="images/settle.ico" width="16" height="16" alt="" /></a></td>
						
                        <?php /*?><td><a href="#" onclick="SetUnSettleSfhqBill('<?php echo $row[0];?>','<?php echo $user_id ?>','<?php echo $branch_id; ?>');"><img src="images/settle.ico" width="16" height="16" alt="" /></a></td>
                      <?php */?>
                        
                        
                        
                        	
				  <?php }
						
						if($status==2)
						{ ?>
							<?php /*?><td><a href="CancelSfhqBills.php?projectid=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>&cval=active"><img src="images/Button-Reload.ico" width="16" height="16" alt="" /></a></td><?php */?>
                            
							<?php /*?><td ><a onclick="deletebillsSfhq('<?php echo $row[0];?>','<?php echo $row[1]; ?>');" href="#" ><img src="images/hr.gif" width="16" height="16" alt="Delete" /></a></td><?php */?>
                            
                             <?php /*?><td class="last"><a href="ViewSfhqBillDetails.php?billId=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td><?php */?>
				  <?php }
						
						
						if($status==3)
						{ ?>
                     <td><?php echo $row[9]; ?></td>	
							<td><a href="ReturnSfhqBill.php?projectid=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>&cval=active"><img src="images/undo.ico" width="10" height="16" alt="" /></a></td>                      
                            
							                            
                    <td width="35" class="last"><a href="ViewSfhqBillDetails.php?billId=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
                             
                    <td width="29" ><a onclick="deletebillsSfhq('<?php echo $row[0];?>','<?php echo $row[1]; ?>','<?php echo $sfhq_id; ?>');" href="#" ><img src="images/hr.gif" width="16" height="16" alt="Delete" /></a></td>
                             
                             
				  <?php }
						 
						 
						 
						  } else 
						  
						  { 
						  
					if($status==0)
						{ ?>
                       <td><a href="EditSfhqBills.php?projectid=<?php echo $row[0]; ?>&branch_id=<?php echo $row[10]; ?>"><img src="images/edit-icon2.gif" width="16" height="16" alt="" /></a></td>
                         <td><a href="ReturnSfhqBill.php?projectid=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>&cval=cancel"><img src="images/undo.ico" width="16" height="16" alt="" /></a></td>
                        
                         
                         <td class="last"><a href="ViewSfhqBillDetails.php?billId=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
                      
                        <td><a href="#" onclick="SettleSfhqBill('<?php echo $row[0];?>','<?php echo $user_id ?>','<?php echo $branch_id ?>');"><img src="images/settle.ico" width="16" height="16" alt="" /></a></td>
                        
				  <?php }
						
						if($status==1)
						{ ?>
                          <td><?php echo $row[8]; ?></td>	
                         <td class="last"><center><a href="ViewSfhqBillDetails.php?billId=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></center></td>
                         
                          <td><center><a href="ChequeDetails.php?projectid=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>&cval=active"><img src="images/print.png" width="16" height="16" alt="" /></a></center></td>
							
				  <?php }
						
						if($status==2)
						{ ?>
						                            
                             <td class="last"><a href="ViewSfhqBillDetails.php?billId=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
				  <?php }
						
						
						if($status==3)
						{ ?>
                         	 <td><?php echo $row[8]; ?></td>	
								<td><a href="ReturnSfhqBill.php?projectid=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>&cval=active"><img src="images/undo.ico" width="16" height="16" alt="" /></a></td>						
                            
                             <td width="35" class="last"><a href="ViewSfhqBillDetails.php?billId=<?php echo $row[0]; ?>&branch_id=<?php echo $branch_id; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
				  <?php } }  ?>
                       
                       
				  </tr>
                     <?php 
					 $i +=1;
					 }  ?>
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
				<a href="projects.php?&page=<?php echo($page_id - 1); ?>&branch_id=<?php echo $branch_id; ?>&status=<?php echo $status; ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec); ?>">&laquo; Previous</a> | <?php } ?>
				<?php echo((($page_id * $limit) + 1));?> - <?php echo((($page_id * $limit) + $num_rows)); ?> of <?php echo($max_rec); ?>
				<?php if ((($page_id * $limit) + $limit) < $max_rec) { ?>
				| <a href="projects.php?page=<?php echo($page_id + 1); ?>&branch_id=<?php echo $branch_id; ?>&status=<?php echo $status; ?>&max=<?php echo($max_rec)?>&unitid=<?php echo "$unit_id"; ?>">Next &raquo</a>
	
    			
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




<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/ge.class.php');
require_once('classes/money.class.php');
require_once('classes/projects.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
//$year_r 	= $_SESSION['log_year'];	

//$year_r  	=	isset( $_GET['year_r'])?$_GET['year_r']:$log_year;
$year_r 	= $_SESSION['log_year'];
$branch_id 	=	isset( $_GET['branch_id'])?$_GET['branch_id']:59;
//$voteCode 	=	isset( $_GET['voteCode'])?$_GET['voteCode']:163;

//$sfhq_id 	=	isset( $_GET['sfhq_id'])?$_GET['sfhq_id']:0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM::BSMS</title>
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
			<!--<a href="#" class="link"> Related Links</a>	-->	
		</div>
		<div id="center-column">
			<div class="top-bar">
				<a href="newmoneyallocation.php" class="button">ADD NEW </a>
				<h1>Allocation For the Year of <?php echo $log_year; ?> </h1>
				<div class="breadcrumbs">
                
          
                 
                 
                 </div>
			</div>
          
		    <div class="select-bar">
           <td>
             <table width="100%" border="0">
               <tr>
                 <?php /*?><td width="3%"> Year</td>
                 <td width="12%"> <label>
	<select name="year_r" id="year_r" style="width:70px" onchange="getYears(this.value,'<?php echo $voteCode; ?>','<?php echo $sfhq_id; ?>')">
					      													
                            <?php 
							for($i=$log_year; $i<$log_year+2; $i++){
							?>                         
 <option value="<?php echo $i; ?>" <?php if( $i == $year_r ){ echo "selected=selected"; }?>><?php echo $i; ?></option>
                   
					        <?php } ?>
				          </select>
				      </label>  
                      </td><?php */?>
                      
                      
                      
                   
                      <td width="18%" class="first"><strong>Operational Controller</strong></td>
                   
                            <td class="last">     <select name="branch_id" class="ComboBoxcesSmall" id="branch_id"   style="width:80px;" onchange="getAccountOffice(this.value,'<?php echo $year_r; ?>')" >
                        <?php $result = Projects::get_all_Operationalbranches(); ?>
                        <?php 
						foreach ($result as $row)
						{
						?>
                       <option value='<?php echo $row[0]; ?>' <?php if($row[0] == $branch_id ){ echo "selected=selected"; }?> ><?php echo $row[1]; ?></option>
                        <?php } ?>
                      </select></td>
                        
                  
                    
                      
                      
                      
                      
                     <?php /*?> <td width="10%" >Account Office</td>
                <td width="14%" class="last">
				      <label>
<select name="sfhq_id" class="ComboBoxcesSmall" id="sfhq_id"  style="width:120px;" onchange="getAccountOffice(this.value,'<?php echo $voteCode; ?>','<?php echo $year_r; ?>')" > 

				<option value="0" <?php if( $sfhq_id == 0){ echo "selected=selected"; }?>>DTE OF FIN</option>                       
                      <option value="1" <?php if( $sfhq_id == 1){ echo "selected=selected"; }?>>SFHQ (WEST)</option>
                      <option value="2" <?php if( $sfhq_id == 2){ echo "selected=selected"; }?>>SFHQ (Wanni)</option>
                      <option value="3" <?php if( $sfhq_id == 3){ echo "selected=selected"; }?>>SFHQ (E)</option>
                      <option value="4" <?php if( $sfhq_id == 4){ echo "selected=selected"; }?>>SFHQ (J)</option>
                      <option value="5" <?php if( $sfhq_id == 5){ echo "selected=selected"; }?>>SFHQ (KLN)</option>
                      <option value="6" <?php if( $sfhq_id == 6){ echo "selected=selected"; }?>>SFHQ (MLT)</option>
                      <option value="7" <?php if( $sfhq_id == 7){ echo "selected=selected"; }?>>SFHQ (C)</option>
                      <option value="8" <?php if( $sfhq_id == 8){ echo "selected=selected"; }?>>DTE OF P&R</option>
                    </select>
				      </label>
                      </td><?php */?>
                      
                      
                 
                 <td width="">
                 <div id="error" align="left" style="height:15px;">
		     <?php require_once('messages/ge_branch.message.php'); ?>
		   </div></td>
           
            <?php /*?> <td width="10%">
                 
                 
                  <td width="9%"><strong>Vote Head</strong></td>
                 <td width="20%" ><select name="vote"  id="vote"  onchange="getvotecode(this.value,'<?php echo $year_r; ?>','<?php echo $branch_id; ?>')" >
                   <?php 
							$esrunit = Common :: GetReleventVotesName($branch_id);
							foreach ($esrunit as $rowesrunit) {
							?>
                            

                   <option value="<?php echo $rowesrunit[0]; ?>" <?php if( $rowesrunit[0] == $voteCode){ echo "selected=selected"; }?> ><?php echo $rowesrunit[1]; ?></option>
                   <?php } ?>
                 </select></td>
               </tr>
             </table></td>
           <td>
            <td><?php */?>    
           </tr>
           </table>
</td>

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
			$result = Money :: getMoneyAllocationDetails($year_r,$branch_id);
			if (!$result) return;
		
			$max_rec = count($result);
	     }
		           
				$current1 = $page_id * $limit;
				$length = $limit;
				
				$result = Money :: getMoneyAllocationDetailsPagination($year_r,$branch_id,$current1, $length);				
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
						<th class="first" width="20">No</th>
						<!--<th width="228"><span class="first">Unit Name</span></th>-->
                        <th width="130">Allocated Date</th>
                        <th width="200">Vote</th>			
						<th width="100">Amount (LKR)</th>						
						<th width="300">Remarks</th>
						<th width="40">Edit</th>
						<th width="40" class="last">Delete</th>
				  </tr>
                  <?php 
				
					
						
						$i = $page_id *100 +1;
						foreach ($result as $row)
						{
					?>
					<tr>
						<td><?php echo $i; ?></td>
					<?php /*?>	<td align="left"><?php echo $row[1]; ?></td><?php */?>
                        <td align="left"><?php echo $row[2]; ?></td>
                         <td align="left"><?php echo $row[6]; ?></td>
						<td><?php echo number_format($row[3],'2','.',','); ?></td>
					
						<td><?php echo $row[4]; ?></td>
						<td><a href="EditmoneyAllocation.php?allocationid=<?php echo $row[0]; ?>&brach_id=<?php echo $branch_id; ?>"><img src="images/edit-icon.gif" width="16" height="16" alt="" /></a></td>
						<td class="last"><a onclick="deletemoneyallocation('<?php echo $row[0];?>');" href="#" ><img src="images/hr.gif" width="16" height="16" alt="Delete" /></a></td>
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
				<a href="displaymoneyallocation.php?&page=<?php echo($page_id - 1); ?>&unitid=<?php echo "$unit_id"; ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec); ?>">&laquo; Previous</a> | <?php } ?>
				<?php echo((($page_id * $limit) + 1));?> - <?php echo((($page_id * $limit) + $num_rows)); ?> of <?php echo($max_rec); ?>
				<?php if ((($page_id * $limit) + $limit) < $max_rec) { ?>
				| <a href="displaymoneyallocation.php?page=<?php echo($page_id + 1); ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec)?>&unitid=<?php echo "$unit_id"; ?>">Next &raquo</a>
				
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

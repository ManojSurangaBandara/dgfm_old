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

$user_type_id 	= $_SESSION['userType'];
$branch_id  	= $_SESSION['branchID'];
$year_r			= $_SESSION['log_year'];


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
				<a href="DirstributetoSFHQLevel.php" class="button">ADD</a>
				<h1>Allocation For the Year of <?php echo $log_year; ?> </h1>
				<div class="breadcrumbs">
                
                </div>
			</div>
          
		    <div class="select-bar">
           <td>
             <table width="100%" border="0">
               <tr>
                            
                    <td width="18%" class="first"><strong>Operational Controller</strong></td>
                   
                    <td class="last"><select name="branch_id" class="ComboBoxcesSmall" id="branch_id" style="width:80px;">
                        <?php $result = Projects::GetBranchName($branch_id); ?>
                        <?php 
						while($row = mysql_fetch_array($result))
						{
						?>
                       <option value='<?php echo $row[0]; ?>'><?php echo $row[1]; ?></option>
                        <?php } ?>
                      </select></td>
                 
                 
                 <td width="">
                 <div id="error" align="left" style="height:15px;">
		     <?php require_once('messages/ge_branch.message.php'); ?>
		   </div></td>
           
           
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
		
			$max_rec = mysql_num_rows($result);
	     }
		           
				$current1 = $page_id * $limit;
				$length = $limit;
				
				$result = Money :: getBranchViewMoneyAllocationPagination($year_r,$branch_id,$current1, $length);				
				if (!$result) return;			
				$num_rows = mysql_num_rows($result);
				
				$color_arr = array("#F6F6F6", "#EBEBEB");
				$row_count = ($page_id * $limit) + 1;
			?>	
				
                <?php //-----------------end first part-----------------------------------------------------?>
          
          
			<div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<table class="listing" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<th rowspan="2" class="first" width="15">No</th>                 
                        <th rowspan="2" width="200">&emsp;&emsp;&emsp;Vote</th>			
						<th rowspan="2" width="65">Budget</th>	
                        <th rowspan="2" width="65"></th>
                        <th  colspan="8" align="center" width="400">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Dte of Fin & Regional Account Office (SFHQ's) </th>		
                      <th rowspan="2" class="last" width="60">Total</th>  		
                     <!-- <th class="last" rowspan="2" width="60">Remain</th> 	-->	
				  </tr>
                  
                  <tr>
						<th  width="50">Dte</th>     
                        <th  width="50">West</th>   
                        <th  width="50">Wanni</th>  
                        <th  width="50">East</th>  
                        <th  width="50">Jaffna</th>  
                        <th  width="50">Kilino</th>  
                        <th  width="50">Mula</th>  
                        <th  width="50">Central</th>          
                        	
                        				
				  </tr>
                  
                  
                  <?php 
				
					
						
						$i = $page_id *100 +1;
						while($row = mysql_fetch_array($result))
						{
							$ttl=0;
							$ttlexped=0;
							$ttl=$ttl+$row[3]+$row[4]+$row[5]+$row[6]+$row[7]+$row[8]+$row[9]+$row[10];
							$ttlexped=$ttlexped+$row[11]+$row[12]+$row[13]+$row[14]+$row[15]+$row[16]+$row[17]+$row[18];
					?>
					<tr>
						<td rowspan="3"><?php echo $i; ?></td>                      
                         <td rowspan="3" align="left"><?php echo $row[1]; ?></td>
						<td rowspan="3"><?php echo number_format($row[2],'2','.',','); ?></td>	                        
                         <td  align="left"><b><?php echo "A"; ?></b></td>                      
                                 
                  
                        <td><?php echo number_format($row[3],'2','.',','); ?></td>	                        	
                        <td><?php echo number_format($row[4],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[5],'2','.',','); ?></td>		
                        <td><?php echo number_format($row[6],'2','.',','); ?></td>		
                        <td><?php echo number_format($row[7],'2','.',','); ?></td>		
                        <td><?php echo number_format($row[8],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[9],'2','.',','); ?></td>		
                        <td><?php echo number_format($row[10],'2','.',','); ?></td>		
                         <td><?php echo number_format($ttl,'2','.',','); ?></td>
                        </tr>
                        
                        <tr>
                        <td  align="left"><b><?php echo "E"; ?></b></td>   
                        <td><?php echo number_format($row[11],'2','.',','); ?></td>	 
                        <td><?php echo number_format($row[12],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[13],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[14],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[15],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[16],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[17],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[18],'2','.',','); ?></td>	
                         <td><?php echo number_format($ttlexped,'2','.',','); ?></td>
                        </tr>
                        
                        <tr>
                        <td  align="left"><b><?php echo "R"; ?></b></td>   
                        <td><?php echo number_format($row[3]-$row[11],'2','.',','); ?></td>	 
                        <td><?php echo number_format($row[4]-$row[12],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[5]-$row[13],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[6]-$row[14],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[7]-$row[15],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[8]-$row[16],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[9]-$row[17],'2','.',','); ?></td>	
                        <td><?php echo number_format($row[10]-$row[18],'2','.',','); ?></td>	
                        <td><?php echo number_format($ttl-$ttlexped,'2','.',','); ?></td>
                        </tr>
                     
                      
                      <?php /*?>  <td><?php echo number_format($ttl,'2','.',','); ?></td>		ttl
                        <td><?php echo number_format(($row[2]-$ttl),'2','.',','); ?></td>		<?php */?>
                      					
					</tr>
                     <tr><td colspan="13"></td></tr>
                     <?php 
					 $i +=1;
					
					 } ?>
			
	   
		     <?php //-----------------second part-----------------------------------------------------?>


</td>
</tr>
</table>
  </table>
              
              <table align="left" width="200"> 
              <tr align="left"><th align="left"></th></tr>
              <tr align="left"><th align="left">A = Allocation of Fund </th></tr>
              <tr align="left"><th align="left">E = Expenditure from Each Place</th></tr>
              <tr align="left"><th align="left">R = Remaining Balance</th></tr> 
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

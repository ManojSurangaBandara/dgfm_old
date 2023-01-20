<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/projects.class.php');
require_once('classes/common.class.php');
require_once('classes/progress_report.class.php');




//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
//$project_id 	= $_GET['projectid'];
$project_id 	= $_GET['billId'];
$user_type_id = $_SESSION['userType'];
$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
//$projtype_id	= isset( $_GET['typeid'])?$_GET['typeid']:$projtype_id;
//$ptype	  		= isset( $_GET['ptype'])?$_GET['ptype']:$ptype;
//$status	  		= isset( $_GET['cval'])?$_GET['cval']:$status;



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM :: BSMS</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
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
				<a href="Chiefacc.php?branch_id=<?php echo $branch_id; ?>" class="button"><< Back</a>
				<h1>Unsettle Bill for the Year of <?php echo $_SESSION['log_year']; ?></h1>
				<div class="breadcrumbs">
                
                
                <?php /*?><a href="Chiefacc.php">Home</a> / Settle Bill <?php */?>
                </div>
			</div><br />
		  <div class="select-bar">
		   <div id="error" align="center" style="height:25px;">
		     <?php require_once('messages/project.message.php'); ?>
		   </div>
		  </div>
		  <div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="images/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                <?php
				if($project_id>0)
				{
                	$result = Projects :: GetBillDataToBigUser($project_id,$user_type_id);
					//echo $result;
					$row=$result[0];
				}
				
				$result = ProjectsProgress :: GetBillAmountandVotes($project_id,$row[1]);
				?>
	<form id="form1" name="form1" method="post" action="controller/projects.controller.php?mode=unsettlenowbiguser&projectid=<?php echo $project_id; ?>&branch_id=<?php echo $branch_id; ?>">
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	<th class="full" colspan="2">&nbsp;</th>
					</tr>
                    
                  
                         
                   <tr class="bg">
						<td width="179" class="first"><strong>Voucher Number</strong></td>
						<td width="569" class="last">
						<label>
						 <input type="text" disabled="disabled" value="<?php echo $row[1]; ?> " name="bill_no" id="bill_no" />
					    </label>
					   </td>
			</tr>
            
            
            
            
             <tr class="bg">
                      <td class="first"><strong>Invoice No</strong></td>
                    	<td width="569" class="last">
						<label>
						 <input type="text" disabled="disabled" value="<?php echo $row[14]; ?> " name="Invoice_no" id="Invoice_no" />
					    </label>
					  </td>
           </tr>
            
            
          <tr class="bg" >
						<td class="first"><strong>Invoice Date</strong></td>
						<td class="last">
                        <label>
                          <input disabled="disabled" value="<?php echo $row[4]; ?> " name="invoice_date" type="text" class="textBoxces" id="invoice_date"  />
                        </label>
                       </td>
					</tr>	 
            
            
            <tr class="bg">
                      <td class="first"><strong>G-35 No</strong></td>
                    	<td width="569" class="last">
						<label>
						 <input type="text" disabled="disabled" value="<?php echo $row[15]; ?> " name="g35no" id="g35no" />
					    </label>
					  </td>
           </tr>
           
           
            <tr class="bg">
                      <td class="first"><strong>G-35 Date</strong></td>
                    	<td width="569" class="last">
						<label>
						 <input type="text" disabled="disabled" value="<?php echo $row[16]; ?> " name="G35_date" id="G35_date" />
					    </label>
					  </td>
           </tr>
           
           
          		 <tr >
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
           
            
              <tr class="bg">
                      <td class="first"><strong>Supplier Name</strong></td>
                     <td width="569" class="last">
						<label>
						 <input type="text" disabled="disabled" value="<?php echo $row[10]; ?> " name="payee_no" id="payee_no" />
					    </label>
					   </td>
                    </tr>

            
           
            
          
             <tr class="bg">
                      <td class="first"><strong>Supplier Address</strong></td>
                    	<td width="569" class="last">
						<label>
						 <textarea disabled="disabled" name="sup_addrs" cols="50" rows="1" class="textArea" id="sup_addrs"><?php echo $row[17]; ?> </textarea>                    
                        
					    </label>
					  </td>
           </tr>
           
            <tr class="bg">
                      <td class="first"><strong>VAT No</strong></td>
                    	<td width="569" class="last">
						<label>
						 <input type="text" disabled="disabled" value="<?php echo $row[18]; ?> " name="vat_no" id="vat_no" />
					    </label>
					  </td>
           </tr>
           
             		<tr>
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
           
          
           
            
            
            
                    <tr class="bg">
                      <td class="first"><strong>Directorate Name</strong></td>
                    	<td width="569" class="last">
						<label>
						 <input type="text" disabled="disabled" value="<?php echo $row[7]; ?> " name="branch_no" id="branch_no" />
					    </label>
					   </td>
                    
            <tr class="bg">
						<td class="first"><strong>Dir Ref No</strong></td>
						<td width="569" class="last">
						<label>
						 <input type="text" disabled="disabled" value="<?php echo $row[9]; ?> " name="ref_no" id="ref_no" />
					    </label>
					   </td>
			</tr>
            
         
                        
           <tr class="bg" >
						<td class="first"><strong>Received Date</strong></td>
						<td class="last">
                        <label>
                          <input disabled="disabled" value="<?php echo $row[3]; ?> " name="txtstart_date" type="text" class="textBoxces" id="txtstart_date"  />
                        </label>
                       </td>
					</tr>			
                              
                              
        
                    
                       <tr class="bg" >
					  <td valign="top" class="first"><strong>Remarks</strong></td>
					  <td class="last">
					    <label>
					      <textarea disabled="disabled" name="remarks" cols="50" rows="1" class="textArea" id="remarks"><?php echo $row[6]; ?> </textarea>
				      </label>
				      </td>
		    </tr>	
         
        <tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    </tr>

 			<tr>
										
					<th width="69" >Vote Code</th>
                    <th width="69" colspan="2" class="last"=>Amount</th>
            </tr>
            
            
            
             <?php 
			 $total;
						
						$i=1;
						foreach ($result as $row1) 
						{
							$total= $total+ $row1[2];	
					?>
                  
					<tr>
						     
						<td align="left"><?php echo $row1[3]; ?></td>                   
						<td><?php echo number_format($row1[2],'2','.',''); ?></td> 						
					</tr>
                     <?php 
					 $i +=1;
					 } ?>
			
           
             
             
                    
             	<tr >
                 		
					  <td class="first"><strong>Total</strong></td>
					  <td class="last"><strong><?php echo number_format($total,'2','.',''); ?></strong></td>
		    		</tr>
             
          
             
             
     
            
            
            <tr class="bg">
					<td class="first">&nbsp;</td>
					<td class="last">&nbsp;</td>
		    </tr>
             
           
            
                      <td class="first"><strong>Unsettle This Bill</strong></td>
                      <td class="last"><label>
					    <input type="checkbox" name="chk_cancel" id="chk_cancel" value="false" />
				      </label></td>
                     
                      
				
		    </tr>
					
       
					
					
					<tr >
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
					<tr class="bg" >
					  <td class="first">&nbsp;</td>
					  <td class="last"><input type="submit" name="btnsubmit" id="btnsubmit" value="      Submit      " />
					    <label>
					      <input type="reset" name="btncancel" id="btncancel" value="     Cancel      " />
			          </label></td>
		    		</tr>
					
		   </table>
	        <p>&nbsp;</p>
           </form>
		  </div>
		</div>
		<div id="right-column"></div>
	</div>
	<div id="footer"></div>
</div>
<script type="text/javascript">
<!--

//-->
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");

//-->
</script>
</body>
</html>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="date_calander/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>

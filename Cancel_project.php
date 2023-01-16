<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/projects.class.php');
require_once('classes/common.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$project_id 	= $_GET['projectid'];
//$projtype_id	= isset( $_GET['typeid'])?$_GET['typeid']:$projtype_id;
//$ptype	  		= isset( $_GET['ptype'])?$_GET['ptype']:$ptype;
$status	  		= isset( $_GET['cval'])?$_GET['cval']:$status;



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM - CANCEL BILL</title>
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
			<a href="#" class="link"> Related Links</a>		
		</div>
		<div id="center-column">
			<div class="top-bar">
				<a href="projects.php" class="button"><< Back</a>
				<h1>Cancel Project</h1>
				<div class="breadcrumbs"></div>
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
                	$result = Projects :: GetBillData($project_id);
					//echo $result;
					$row=mysql_fetch_array($result);
				}
				?>
		 <form id="form1" name="form1" method="post" action="controller/projects.controller.php?mode=cancel&projectid=<?php echo $project_id; ?>&cval=<?php echo $status; ?>">
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	
						<th class="full" colspan="2">Project Details</th>
					</tr>
                    
                  
                         
                      <tr class="bg">
                      <td class="first"><strong>Branch Name</strong></td>
                      <td class="last">
                 		<label>
						 <input value="<?php echo $row[1]; ?> " disabled="disabled" type="text" name="Branch_name" id="Branch_name" />
					    </label>
                        </td>                 
                    </tr>
                    
                     
                         <tr class="bg">
                      <td class="first"><strong>Unit Name</strong></td>
                      <td class="last">
                 		<label>
						 <input value="<?php echo $row[5]; ?> " disabled="disabled" type="text" name="allocated_regiment" id="allocated_regiment" />
					    </label>
                        </td>                 
                    </tr>        
                    
           		 <tr class="bg">
						<td class="first"><strong>Bill Number</strong></td>
						<td class="last"><span id="sprytextfield1">
						  <label>
						    <input value="<?php echo $row[2]; ?> " disabled="disabled" type="text" name="bill_no" id="bill_no" />
					    </label>
					    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
			</tr>
            
            
<tr >
						<td class="first"><strong>Bill Name</strong></td>
						<td class="last"><span id="sprytextfield2">
						  <label>
						    <input disabled="disabled" type="text" name="bill_name" id="bill_name" value="<?php echo $row[3]; ?> " />
					    </label>
					    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
			</tr>
            
           
                        
           <tr class="bg" >
						<td class="first"><strong>Recieved Date</strong></td>
						<td class="last"><span id="sprytextfield4">
                        <label>
                          <input disabled="disabled" value="<?php echo $row[6]; ?> " name="txtstart_date" type="text" class="textBoxces" id="txtstart_date"  />
                        </label>
                        <span class="textfieldRequiredMsg">*</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.txtstart_date);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date_calander/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
					</tr>			
                               
          
<tr >
						<td class="first"><strong>Bill Amount<span class="last">Rs :</span></strong></td>
						<td class="last"><span id="sprytextfield3">
						  <label>
						    <input value="<?php echo number_format($row[4],'2','.',''); ?>" disabled="disabled" type="text" name="txt_bill_amount" id="txt_bill_amount" />
					    </label>
					    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
			</tr>
            
           
           <tr class="bg" >
					  <td valign="top" class="first"><strong>Remarks</strong></td>
					  <td class="last">
					    <label>
					      <textarea disabled="disabled" name="remarks" cols="50" rows="5" class="textArea" id="remarks"><?php echo $row[7]; ?> </textarea>
				      </label>
				      </td>
		    </tr>	
					<tr>
                    <?php if($status=='cancel') {  ?>
					  <td class="first"><strong>Cancel Project</strong></td>
                      <td class="last"><label>
					    <input type="checkbox" name="chk_cancel" id="chk_cancel" value="true" />
				      </label></td>
                      <?php } if ($status=='active') { ?>
                      <td class="first"><strong>Active Project</strong></td>
                      <td class="last"><label>
					    <input type="checkbox" name="chk_cancel" id="chk_cancel" value="false" />
				      </label></td>
                      <?php }  ?>
                      
				
		    </tr>
					
       
					
					<tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
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
     <?php include_once("tpl/footter.tpl");?>
</div>
<script type="text/javascript">
<!--
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "date", {format:"yyyy-mm-dd"});
//-->
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");

//-->
</script>
</body>
</html>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="date_calander/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>

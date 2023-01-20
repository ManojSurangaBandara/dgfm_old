<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/ge.class.php');
require_once('classes/common.class.php');
require_once('classes/money.class.php');
require_once('classes/projects.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}

//$brach_id	=	isset( $_GET['brach_id'])?$_GET['brach_id']:$brach_id;
//$sfhq_id = $_GET['sfhq_id'];


@session_start(); 

$user_type_id 	= $_SESSION['userType'];
$brach_id  	= $_SESSION['branchID'];
$log_year		= $_SESSION['log_year'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM::BSMS</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
    <script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script> 
    
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

 

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
			  <a href="ViewAllocationofOpsController.php" class="button">&lt;&lt; Back </a>
              <a href="EditSFHQLevelAllocation.php" class="button"> Edit </a>
	            <h1>Money Allocation for Regional Account Level</h1>
				<div class="breadcrumbs"></div>
		  </div><br />
		  <div class="select-bar">
		   <div id="error" align="center" style="height:25px;">
		     <?php require_once('messages/ge_branch.message.php'); ?>
		   </div>
		  </div>
		  <div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="images/bg-th-right.gif" width="7" height="7" alt="" class="right" />
               
		 <form id="form1" name="form1" method="post" action="controller/money.controller.php?mode=saveSFHQLevel">
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	
						<th class="full" colspan="2">&nbsp;</th>
					</tr>
                    

                    
					<tr class="bg" >
						<td class="first" width="172"><strong>Year</strong></td>
					  
<td class="last">
				      <label>
					      <select name="cmb_allocated_year" id="cmb_allocated_year" style="width:90px"  class="ComboBoxces" >
					        <?php 
							for($i= $log_year; $i< $log_year+ 1; $i++){
							?>
					        <option value="<?php echo $i; ?>" <?php if($i==$row[1]){ echo "selected=selected"; }?>><?php echo $i; ?></option>
					        <?php } ?>
				          </select>
				      </label></td>


					</tr>					
                    <tr class="bg">
                      <td class="first"><strong>Operational Controller</strong></td>
                   
                            <td class="last"><select name="brach_id" class="ComboBoxcesSmall" id="brach_id"   style="width:100px;" onchange="showbranchvalueTonewmoneyallocation(this.value)" >
                        <?php $result = Projects::GetBranchName($brach_id); ?>
                        <?php 
						foreach ($result as $row3)
						{
						?>
                       <option value='<?php echo $row3[0]; ?>' <?php if($row3[0] == $brach_id ){ echo "selected=selected"; }?> ><?php echo $row3[1]; ?></option>
                        <?php } ?>
                      </select></td>
                        
                    </tr>
                    
                    
                    
                   <tr>   
                  <td class="first"><strong>Vote Number</strong></td>
                   
                   <td class="last"><select name="vote"  id="vote"  class="ComboBoxcesSmall" style="width:300px;" >
                   <?php 
							$esrunit = Common :: GetReleventVotesName($brach_id);
							foreach ($esrunit as $rowesrunit) {
							?>
                   <option value="<?php echo $rowesrunit[0]; ?>" ><?php echo $rowesrunit[1]; ?></option>
                   <?php } ?>
                 </select></td>                 
                 </tr>
                 
            <tr>   
                  <td class="first"><strong>Regional Account Office</strong></td>
                   
                   <td class="last">
                   <select name="AccountOffice"  id="AccountOffice"  class="ComboBoxcesSmall" style="width:150px;" >
                  	<option value="0">DTE OF FIN </option>
                   <?php 
							$esrunit = Common :: GetSHGQName();						
							foreach ($esrunit as $rowesrunit) {
							?>
                            
                   <option value="<?php echo $rowesrunit[0]; ?>" ><?php echo $rowesrunit[1]; ?></option>
                   <?php } ?>
                 </select></td>                 
                 </tr>
                 
          
          
          
          
                    
                    <tr class="bg">
						<td class="first"><strong>Amount (Rs)</strong></td>
					  <td class="last"><span id="sprytextfield2">
						  <label>
		 <input name="amount" type="text" class="textBoxces" id="amount" size="20" />
         <span class="textfieldRequiredMsg">*</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></label>
		 </span></td>
		</tr>
					
					
  			<tr>
						<td class="first"><strong>Remarks</strong></td>
						<td class="last">
						  <textarea name="txtdescription" id="txtdescription" cols="43" rows="1" class="textArea"></textarea>				    		  </td>
					</tr>
					<tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
                   
					<tr>
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr> 
                    <tr class="bg">
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");

var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "currency");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1"});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
//-->
</script>
</body>
</html>

<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/users.class.php');

if(!isset($_SESSION['userID'])){
header("Location:index.php");
}

//$unit_id		  =	isset( $_GET['unitid'])?$_GET['unitid']:1;
// $typeid		  =	isset( $_GET['typeid'])?$_GET['typeid']:$typeid;
$typeid		  =	isset( $_GET['typeid'])?$_GET['typeid']:1;
//$user_id = $_GET['userid'];
//$unitvisible = "hidden";
//$gevisible = "hidden";	
$log_year	= $_SESSION['log_year'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>DGFM :: BSMS</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<style media="all" type="text/css">@import "css/all.css";</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>
<script type="text/javascript">
function showregid(typeid){
document.location.href="NewAccountCreation.php?typeid="+typeid;
}
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
				<a href="ViewAllUsers.php" class="button"><< BACK </a>
				<h1>Create New User for the Year of - <?php echo $log_year; ?></h1>
				<div class="breadcrumbs"></div>
			</div><br />
		 <div class="select-bar">
		   <div id="error" align="center" style="height:25px;">
		     <?php require_once('messages/users.message.php'); ?>
		   </div>
		  </div>
		  <form action="controller/users.controller.php?mode=saveUser" method="post" enctype="multipart/form-data" name="frmuser">
          <div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="images/bg-th-right.gif" width="7" height="7" alt="" class="right" />
		  <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">&nbsp;</th>
					</tr>
                   
                   
                   <tr>
					<td class="first" width="210"><strong>Account Type</strong></td>
					 	
                    <td width="525" class="last">
                    <label>
                         
					  <select name="typeid" style="width:150px" id="typeid" onchange="showregid(this.value)" >
                     
                     
                      <option value="-1"> -- Account Type -- </option>
					    	<?php 	
						 	$ranks = Common :: GetAllAcountType();
							
							foreach ($ranks as $rowissueplace) {
							?>                            
					        <option value="<?php echo $rowissueplace[0]; ?>" <?php if($rowissueplace[0]==$typeid) { echo "selected=selected"; } ?> ><?php echo $rowissueplace[1]; ?></option>
					      
							<?php  } ?>
				          </select>
				      </label>
                          
					
			        </td>
			</tr>
                    
                    
                      <tr class="bg">
						<td class="first">&nbsp;</td>
                        <td class="first">&nbsp;</td>
                     </tr >
					
                     <tr>
						<td  class="first"><strong>SFHQs / Branch</strong></td>
					     <td width="525" class="last">
                          <label>
                         
					      <select name="branchsfhq" style="width:150px" id="branchsfhq"  >
					    	<?php 	
						 	$unit = Common :: GetUserType($typeid);
							
							foreach ($unit as $rowunit) {
							?>                            
					        <option value="<?php echo $rowunit[0]; ?>" ><?php echo $rowunit[1]; ?></option>
					      
							<?php  } ?>
				          </select>
				      </label>
                          
					
			        </td>
                        
					</tr>
                   
                   
                    	
                   
<tr class="bg">
						<td class="first" width="172"><strong>User Name</strong></td>
						<td class="last"><span id="sprytextfield1">
					    <label>
					      <input name="txtusername" type="text" class="textBoxces" id="txtusername" size="35" />
					    </label>
					    <span class="textfieldRequiredMsg">*</span></span></td>
					</tr>
				
                
                
<tr >
						<td class="first"><strong>Password</strong></td>
						<td class="last"><span id="sprypassword2">
						  <label>
						    <input name="txtpassword" type="password" class="textBoxces" id="txtpassword" size="35" />
					    </label>
					    <span class="passwordRequiredMsg">*</span></span></td>
					</tr>
				
                
                	
                    
                    <tr >
						<td class="first">&nbsp;</td>
                        <td class="first">&nbsp;</td>
                     </tr >
                     
                            <tr> 
                      <td style="color:#33F" class="first"><strong>Is Privilege User..?</strong></td>
                      <td class="last"><label>
					    <input type="checkbox" name="isprivilege" id="isprivilege" value="false" />
				      </label> <label style="color:#F00"> <b>Caution : If you check this He / She become as an administrator rights User</b></label></td>
                     
                      
				
		    </tr>
                     
                       <tr >
						<td class="first">&nbsp;</td>
                        <td class="first">&nbsp;</td>
                     </tr >
                    
            <tr class="bg" >
                      <td class="first"><strong>Name</strong></td>
              <td class="last"><span id="sprytextfield3">
                <label>
                  <input type="text" name="myname" id="myname" size="35" />
                </label>
              <span class="textfieldRequiredMsg">*</span></span></td>
            </tr>
           
            <tr >
				  <td class="first"><strong>NIC</strong></td>
					  <td class="last"><span id="sprytextfield4">
				      <label>
				        <input type="text" name="nic" id="nic" size="35"  />
				      </label>
     <span class="textfieldRequiredMsg">*</span></span></td>
    		</tr>
            
             <tr >
				  <td class="first"><strong>Telephone</strong></td>
					  <td class="last"><span id="sprytextfield5">
				      <label>
				        <input type="text" name="tele" id="tele" size="35"  />
				      </label>
     <span class="textfieldRequiredMsg">*</span></span></td>
    		</tr>
            
            <tr >
				  <td class="first"><strong>E Mail</strong></td>
					  <td class="last"><span id="sprytextfield6">
				      <label>
				        <input type="text" name="email" id="email" size="35"  />
				      </label>
     <span class="textfieldRequiredMsg">*</span></span></td>
    		</tr>
            
            
                       
                    <tr >
						<td class="first">&nbsp;</td>
                        <td class="first">&nbsp;</td>
                     </tr >
                    
					<tr class="bg">
						<td class="first">&nbsp;</td>
						<td class="last"><label>
						  <input type="submit" name="btnSubmit" id="btnSubmit" value="   Submit   " />
				      </label></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
          </form>
		</div>
		<div id="right-column"></div>
	</div>
	<div id="footer"></div>
    <?php include_once("tpl/footter.tpl");?>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword2  = new Spry.Widget.ValidationPassword("sprypassword2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
//-->
</script>
</body>
</html>

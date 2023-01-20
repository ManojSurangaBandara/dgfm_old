<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/users.class.php');
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}

$user_id = $_GET['userid'];
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
				<a href="users.php" class="button"><< BACK</a>
				<h1>Edit User Password</h1>
				<div class="breadcrumbs">
                
                
             
                
                <?php /*?><?php
		 
		 if($_SESSION['userType'] == 1)
			{ ?>
				<a href="admin_home.php"> Home </a> 
		 <?php	}
            
         if($_SESSION['userType'] == 2)
		   {?>
			     <a href="Home.php"> Home </a> 
		 <?php   }
		 
		  if($_SESSION['userType'] == 3)
		   {?>
			       <a href="projects.php">Home </a> 
		  <?php  }
		  
		   
		  if($_SESSION['userType'] == 4)
		   {?>
			       <a href="projects.php">Home </a> 
		  <?php  }
		  
		  
		  
		  ?>
		   
                
                
                
                
                
                / <a href="users.php">User </a>/ Edit User<?php */?>
                
                </div>
			</div><br />
		  <div class="select-bar">
		   <div id="error" align="center" style="height:25px;">
		     <?php require_once('messages/users.message.php'); ?>
		   </div>
		  </div>
          <?php
				if($user_id>0)
				{
                	$result = Users :: getUserData($user_id);
					//echo $result;
					$row=$result[0];
					
				}
				?>
		  <form action="controller/users.controller.php?mode=editaccount&userid=<?php echo $row[0];?>" method="post" enctype="multipart/form-data" name="frmuser">
          <div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="images/bg-th-right.gif" width="7" height="7" alt="" class="right" />
		  <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">EDIT User</th>
					</tr>
					<tr>
						<td class="first"  width="172"><strong>User Name</strong></td>
						<td class="last"><span id="sprytextfield1">
						  <label>
						    <input name="txtusername" type="text" disabled="disabled" class="textBoxces" id="txtusername" value="<?php echo $row[1]; ?>" size="45" />
					    </label>
					    <span class="textfieldRequiredMsg">*</span></span></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>New Password</strong></td>
						<td class="last"><span id="sprypassword1">
						  <label>
						    <input name="txtpassword" type="password" class="textBoxces" id="txtpassword" size="45" />
					    </label>
					    <span class="passwordRequiredMsg">*</span></span></td>
					</tr>
					<tr>
						<td class="first"><strong>Confirm Password</strong></td>
						<td class="last"><span id="spryconfirm1">
						  <label>
						    <input name="txtconfirmpassword" type="password" class="textBoxces" id="txtconfirmpassword" size="45" />
					    </label>
					    <span class="confirmRequiredMsg">*</span><span class="confirmInvalidMsg">The values don't match.</span></span></td>
					</tr>
					
                    
                  
					
					
					<tr>
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
					<tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
					<tr>
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
		<div id="right-column">
	  </div>
	</div>
	<div id="footer"></div>
    <?php include_once("tpl/footter.tpl");?>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "txtpassword");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
//-->
</script>
</body>
</html>

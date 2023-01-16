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
<title>Edit User Account</title>
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
			<a href="#" class="link"> Related Links</a>		
		</div>
		<div id="center-column">
			<div class="top-bar">
				<a href="users.php" class="button"><< BACK</a>
				<h1>Edit User</h1>
				<div class="breadcrumbs"></div>
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
					$row=mysql_fetch_array($result);
					
				}
				?>
		  <form action="controller/users.controller.php?mode=edit&userid=<?php echo $row[0];?>" method="post" enctype="multipart/form-data" name="frmuser">
          <div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="images/bg-th-right.gif" width="7" height="7" alt="" class="right" />
		  <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Create a New User</th>
					</tr>
					<tr>
						<td class="first"  width="172"><strong>User Name</strong></td>
						<td class="last"><span id="sprytextfield1">
						  <label>
						    <input name="txtusername" type="text" class="textBoxces" id="txtusername" value="<?php echo $row[1]; ?>" size="45" />
					    </label>
					    <span class="textfieldRequiredMsg">*</span></span></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>New password</strong></td>
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
					
                    
                    <tr class="bg">
					  <td class="first"><strong>User Type</strong></td>
					  <td class="last"><span id="spryselect1">
					    <label>
					      <select name="force_type"  id="force_type"  class="ComboBoxcesSmall">
						   <option value=""></option>
						   <?php 
							$usertype = Common :: UserTypeName();
							while($rowusertype=mysql_fetch_array($usertype)){
							?>
                            <option value="<?php echo $rowusertype[0]; ?>" <?php if($rowusertype[0] == $row[4] ){ echo 'selected=selected'; }?>><?php echo $rowusertype[1]; ?></option>
						      <?php } ?>
					        </select>
				      </label>
				      <span class="selectRequiredMsg">Please select an item.</span></span></td>
		    		</tr>
					<tr>
					  <td class="first"><strong>Unit</strong></td>
					  <td class="last"><span id="spryselect2">
					    <label>
					      <select name="unit_name" class="ComboBoxcesSmall" id="unit_name">
						   <option value="0">0</option>
						   <?php 
							$unitname = Common :: GetUnitName();
							while($rowunitname=mysql_fetch_array($unitname)){
							?>
						      <option value="<?php echo $rowunitname[0]; ?>" <?php if($rowunitname[0] == $row[5] ){ echo 'selected=selected'; }?>  ><?php echo $rowunitname[1]; ?></option>
						      <?php } ?>
					        </select>
				      </label>
				      <span class="selectRequiredMsg">Please select an item.</span></span></td>
		    		</tr>
					<tr class="bg">
					  <td class="first"><strong>ESS </strong></td>
					  <td class="last"><span id="spryselect3">
					    <label>
					      <select name="ge_branch" class="ComboBoxcesSmall" id="ge_branch">
						    <option value="0">0</option> 
							<?php 
							$gename = Common :: GetGEName();
							while($rowgename=mysql_fetch_array($gename)){
							?>
						      <option value="<?php echo $rowgename[0]; ?>" <?php if($rowgename[0] == $row[6] ){ echo 'selected=selected'; }?>  ><?php echo $rowgename[1]; ?></option>
						      <?php } ?>
					        </select>
				      </label>
				      <span class="selectRequiredMsg">Please select an item.</span></span></td>
		    		</tr>
                   
                    <?php  
					$val="";  					
					if($row[8]==1) 
					{ 					
					$val='checked';
					} 
					else  
					{ 					
					$val="";
					} 
					?>
                    
                     <tr >
					  <td class="first"><strong>Is Privileged User</strong></td>
					  <td class="last">
					    <label>
					      <input type="checkbox" name="chk_privilege"  id="chk_privilege" <?php echo $val; ?>  /> 
				      </label>
                     
				     </td>
		    		</tr>
                    
					<tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
					<tr >
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
                    
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

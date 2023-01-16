<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/users.class.php');

if(!isset($_SESSION['userID'])){
header("Location:index.php");
}

$unit_id	 =	isset( $_GET['unitid'])?$_GET['unitid']:1;
$typeid		 =	isset( $_GET['typeid'])?$_GET['typeid']:0;
$unitvisible = "hidden";
$gevisible = "hidden";	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title> DGFM :: BSMS</title>
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
<script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
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
			<!--<a href="#" class="link"> Related Links</a>		-->
		</div>
		<div id="center-column">
			<div class="top-bar">
				<a href="users.php" class="button"><< BACK </a>
				<h1>New User</h1>
				<div class="breadcrumbs">
                
   <?php /*?>             <a href="home.php">Home</a> / <a href="users.php">User / New User</a><?php */?>
                
                </div>
			</div><br />
		 <div class="select-bar">
		   <div id="error" align="center" style="height:25px;">
		     <?php require_once('messages/users.message.php'); ?>
		   </div>
		  </div>
		  <form action="controller/users.controller.php?mode=save" method="post" enctype="multipart/form-data" name="frmuser">
          <div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="images/bg-th-right.gif" width="7" height="7" alt="" class="right" />
		  <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Create New User</th>
					</tr>
                    	<tr class="bg">
					  <td class="first"><strong>User Type</strong></td>
					  <td class="last"><span id="spryselect1">
					    <label>
					   <select name="user_type"  class="ComboBoxces" style="width:130px;"  id="user_type" onchange="GetUserTypeId(this.value)">
					        
					       
						      <?php 
							$usertype = Common :: UserTypeName();
							while($rowusertype=mysql_fetch_array($usertype)){
							?>
                    
						     
  <option value="<?php echo $rowusertype[0]; ?>" <?php if( $rowusertype[0] == $typeid){ echo "selected=selected"; }?>><?php echo $rowusertype[1]; ?></option>
                             
                             
                              <?php } ?>
					        </select>
				      </label>
				      <span class="selectRequiredMsg">*</span></span></td>
		    		</tr>
                    <tr>
					  <td class="first"><strong>Location</strong></td>
					  <td class="last"><label>
					    <input name="txtlocation" type="text" class="textBoxces" id="txtlocation" size="35" />
				      </label></td>
		    		</tr>
					
                    <tr tr class="bg">
						<td class="first" width="172"><strong>User Name</strong></td>
						<td class="last"><span id="sprytextfield1">
					    <label>
					      <input name="txtusername" type="text" class="textBoxces" id="txtusername" size="35" />
					    </label>
					    <span class="textfieldRequiredMsg">*</span></span></td>
					</tr>
					
                    
                    <tr >
						<td class="first"><strong>Password</strong></td>
						<td class="last"><span id="sprypassword1">
						  <label>
						    <input name="txtpassword" type="password" class="textBoxces" id="txtpassword" size="35" />
					    </label>
					    <span class="passwordRequiredMsg">*</span></span></td>
					</tr>
					<tr tr class="bg">
						<td class="first"><strong>Confirm Password</strong></td>
						<td class="last"><span id="spryconfirm1">
						  <label>
						    <input name="txtconfirmpassword" type="password" class="textBoxces" id="txtconfirmpassword" size="35" />
					    </label>
					    <span class="confirmRequiredMsg">*</span><span class="confirmInvalidMsg">*</span></span></td>
					</tr>
                    
                    <?php
                    
                    if($typeid ==1)
					{						
						$unitvisible = "hidden";
						$gevisible = "hidden";						
					}
					if($typeid ==2)
					{
						$unitvisible = "hidden";
						$gevisible = "hidden";
					}
					if($typeid ==3)
					{
						$unitvisible = "visible";
						$gevisible = "hidden";
					}
					if($typeid ==4)
					{
						$unitvisible = "visible";
						$gevisible = "visible";
					}	
								
					
                    ?>
                    
				
                
                
                
					<tr  style="visibility:<?php echo $unitvisible; ?>">
					  <td class="first"><strong>Regional Account Ofc</strong></td>
					  <td class="last">
                     
					    <label>
                        
				<select name="sfhq_id" style="width:130px"  class="ComboBoxces" id="sfhq_id" >
                 <option value="0">-------Select--------</option>
						      
							  <?php 
							$unitname = Common :: GetSFHQName();
							
							while($rowunitname=mysql_fetch_array($unitname)){
							?>
						      <option value="<?php echo $rowunitname[0]; ?>" <?php if($rowunitname[0] == $row[4] ){ echo 'selected=selected'; }?>  ><?php echo $rowunitname[1]; ?></option>
						      <?php } ?>
					        </select>
				      </label>
				      </td>
		    		</tr>                   
                    
                   <?php /*?> <tr class="bg" style="visibility:<?php echo $gevisible; ?>">
					  <td class="first"><strong>Ge Center </strong></td>
					  <td class="last">
					    <label>
					      <select name="ge_branch" style="width:100px"  class="ComboBoxces" id="ge_branch">
						    <option value=""></option>
							<?php 
							$gename = Common :: GetGEName();
							while($rowgename=mysql_fetch_array($gename)){
							?>
						      <option value="<?php echo $rowgename[0]; ?>" <?php if($rowgename[0] == $row[3] ){ echo 'selected=selected'; }?>  ><?php echo $rowgename[1]; ?></option>
						      <?php } ?>
					        </select>
				      </label>
				     </td>
		    		</tr><?php */?>
					
                    
                     <tr tr class="bg">
						<td class="first" width="172"><strong>Name</strong></td>
						<td class="last">
					    <label>
					      <input name="Pers_name" type="text" class="textBoxces" id="Pers_name" size="35" />
					    </label>
					    </td>
					</tr>
                    
                     <tr tr class="bg">
						<td class="first" width="172"><strong>NIC</strong></td>
						<td class="last">
					    <label>
					      <input name="nic" type="text" class="textBoxces" id="nic" size="35" />
					    </label>
					    </td>
					</tr>
                    
                     <tr tr class="bg">
						<td class="first" width="172"><strong>Telephone</strong></td>
						<td class="last">
					    <label>
					      <input name="telephone" type="text" class="textBoxces" id="telephone" size="35" />
					    </label>
					    </td>
					</tr>
                    
                    
                     <tr tr class="bg">
						<td class="first" width="172"><strong>Email</strong></td>
						<td class="last">
					    <label>
					      <input name="emailadd" type="text" class="textBoxces" id="emailadd" size="35" />
					    </label>
					 </td>
					</tr>
                    
                     
                    
                    <tr >
					  <td class="first"><strong>Is Privileged User</strong></td>
					  <td class="last">
					    <label>
					      <input type="checkbox" name="chk_privilege" id="chk_privilege" value="privilege" />
				      </label>
				     </td>
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
		<div id="right-column"></div>
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
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
//-->
</script>
</body>
</html>

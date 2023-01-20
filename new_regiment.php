<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/units.class.php');
require_once('classes/common.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$unit_id = $_GET['unitid'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>New Unit</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
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
			<a href="#" class="link"> Related Links</a>		
		</div>
		<div id="center-column">
			<div class="top-bar">
				<a href="units.php" class="button">&lt;&lt; Back</a>
				<h1>Regiments</h1>
				<div class="breadcrumbs">
           <?php /*?>     <a href="admin_home.php">Home</a> / <a href="regiments.php">Regiments</a> / New Regiment<?php */?>
                
                </div>
			</div><br />
		  <div class="select-bar"><div id="error" align="center" style="height:25px;">
 					 <?php require_once('messages/unit.message.php'); ?>
			</div>
		  </div>
		  <div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="images/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                <?php
				if($unit_id>0)
				{
                	$result = Units::SelectUnitDetailRow($unit_id);
					//echo $result;
					$row=$result[0];
					
				}
				?>
		 <form id="form1" name="form1" method="post" action="controller/regiment.controller.php?mode=save&regimentid=<?php echo $row[0];?>">
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	
						<th class="full" colspan="2">Create New Regiment</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Regiment Name</strong></td>
					  <td class="last"><span id="sprytextfield1">
					    <label>
                          <input name="regiment_name" type="text" class="textBoxces" id="regiment_name" size="45" value="<?php echo $row[1]; ?>" />
                      <span class="textfieldRequiredMsg">*</span></label>
</span></td>
					</tr>
					
					<tr class="bg">
						<td class="first"><strong>Description</strong></td>
						<td class="last">
						  <textarea name="txtdescription" id="txtdescription" cols="49" rows="5" class="textArea"></textarea>				      </td>
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
					  <td class="last"><input type="submit" name="btnsubmit" id="btnsubmit" value="      Submit      " />
				      <input type="reset" name="btncancel" id="btncancel" value="     Cancel      " /></td>
		    </tr>
		   </table>
	        <p>&nbsp;</p>
           </form>
		  </div>
		</div>
		<div id="right-column">
	  </div>
	</div>
	<div id="footer"></div>
    <?php include_once("tpl/footter.tpl");?>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1"});
//-->
</script>
</body>
</html>

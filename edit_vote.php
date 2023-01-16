<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/vote.class.php');
require_once('classes/common.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$vote_id = $_GET['vote_id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM :: BSMS</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" /></head>
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
				<a href="votes.php" class="button">&lt;&lt; Back</a>
				<h1>Edit Votes for the Year of <?php echo $_SESSION['log_year']; ?></h1>
				<div class="breadcrumbs"> <?php /*?><a href="Votes.php">Votes</a>/ Update Votes<?php */?></div>
			</div><br />
		  <div class="select-bar"><div id="error" align="center" style="height:25px;">
 					 <?php require_once('messages/vote.message.php'); ?>
			</div>
		  </div>
		  <div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="images/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                <?php
				if($vote_id>0)
				{
                	$result = Vote::SelectVoteDetailRow($vote_id);
					//echo $result;
					//exit;
					$row=mysql_fetch_array($result);
					
				}
				?>
		 <form id="form1" name="form1" method="post" action="controller/vote.controller.php?mode=edit&vote_id=<?php echo $row[0];?>">
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	
						<th class="full" colspan="2">&nbsp;</th>
					</tr>
				  <tr>
						<td width="172" class="first"><strong>Vote Number</strong></td>
					    <td class="last"><span id="sprytextfield1">
					    <label>
                        <input name="vote_number" type="text" class="textBoxces" id="vote_number" size="45" value="<?php echo $row[1]; ?>" />
                      <span class="textfieldRequiredMsg">*</span></label>
</span></td>
			</tr>
					
					<tr class="bg">
						<td class="first"><strong>Description</strong></td>
						<td class="last">
						  <textarea name="txtdescription" id="txtdescription" cols="49" rows="5" class="textArea"><?php echo $row[2]; ?></textarea></td>
					</tr>
					
                    
                  <!--  <tr>
					  <td class="first"><strong>Vote Type</strong></td>
					  <td class="last"><select name="vttype" class="ComboBoxcesSmall" id="vttype"  style="width:100px;" >
              <option value="2" >Capital</option>
              <option value="1" >Recurrent</option>             
            </select></td>
		    		</tr>-->
                    
                     <tr>
					<td width="150" class="first"><strong>Vote Type</strong></td>
                 <td><select name="vttype" style="width:200px"  id="vttype" >
                   <?php 
							
							$esrunit = Common :: GetTypeofVotes();
							
							while($rowesrunit=mysql_fetch_array($esrunit)){
							?>
                   <option value="<?php echo $rowesrunit[0]; ?>" <?php if( $rowesrunit[0] == $row[3]){ echo "selected=selected"; }?> ><?php echo $rowesrunit[1]; ?></option>
                   <?php } ?>
                 </select></td>
                
                    </tr>
                
                    
                    
                    
                    
					<tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
					<tr>
					  <td class="first">&nbsp;</td>
					  <td class="last"><input type="submit" name="btnsubmit" id="btnsubmit" value="      Submit      " />
                      <input type="hidden" name="vote_id" value='<?php echo $vote_id;?>' />
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>

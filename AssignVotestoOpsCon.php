<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/units.class.php');
require_once('classes/common.class.php');
require_once('classes/projects.class.php');

//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$unit_id = $_GET['unitid'] ?? "";
$pro_id	=	isset( $_GET['pro_id'])?$_GET['pro_id']:18;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM :: BSMS</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
<script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script> 
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>



<script type="text/javascript">
function showUser1(str)
{	
	
  
if (str=="")
  {
  document.getElementById("txtHint1").innerHTML="";
  
  
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
	
	
    }
  }

xmlhttp.open("GET","Viewvotede.php?q="+str,true);

xmlhttp.send();
}





</script>






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
				<!--<a href="votes.php" class="button">&lt;&lt; Back</a>-->
				<h1>Assign Votes to Ops Controller for <?php echo $log_year; ?></h1>
				<div class="breadcrumbs">
                
               <?php /*?> <a href="votes.php"> Votes/ </a>New Vote<?php */?>
                
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
		 <form id="form1" name="form1" method="post" action="controller/vote.controller.php?mode=assignvote">
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	
						<th class="full" colspan="2">&nbsp;</th>
					</tr>
				
                
                
                </tr>
					
                    <tr class="bg">
                      <td class="first"><strong>Procedure Controller Controller</strong></td>
                   
                            <td width="528" class="last"><select name="procon_id" class="ComboBoxcesSmall" id="procon_id"   style="width:100px;" onchange="showprocContobudget(this.value)" >
                        <?php $result = Projects::get_all_ProController(); ?>
                        <?php 
						foreach ($result as $row3)
						{
						?>
                       <option value='<?php echo $row3[0]; ?>' <?php if($row3[0] == $pro_id ){ echo "selected=selected"; }?> ><?php echo $row3[1]; ?></option>
                        <?php } ?>
                      </select></td>
                        
                    </tr>
                    
                
                </tr>
					
                    <tr class="bg">
                      <td class="first"><strong>Operational Controller</strong></td>
                   
                            <td class="last"><select name="opcon_id" class="ComboBoxcesSmall" id="opcon_id"   style="width:100px;" >
                        <?php $result = Projects::get_all_OpstoProcController($pro_id); ?>
                        <?php 
						foreach ($result as $row3)
						{
						?>
                       <option value='<?php echo $row3[0]; ?>' ><?php echo $row3[1]; ?></option>
                        <?php } ?>
                      </select></td>
                        
                    </tr>
                    
                <tr>
					<td width="220" class="first"><strong>Vote Head</strong></td>
                 <td><select name="vote_id1" style="width:260px"  id="vote_id1" onchange="showUser1(this.value)">
                   <?php 
							
							$esrunit = Common :: GetVotesName();
							
							//added by Lt. Manoj Bandara to prevent error in PHP 8
							$vote_id1=0;

							foreach ($esrunit as $rowesrunit) {
							?>
                   <option value="<?php echo $rowesrunit[0]; ?>" <?php if( $rowesrunit[0] == $vote_id1){ echo "selected=selected"; }?>><?php echo $rowesrunit[1]; ?></option>
                   <?php } ?>
                 </select></td>
                
                    </tr>
                    
                    <tr>
                    <td></td>
					  <td id="txtHint1">  
						
						<?php 
					  if($vote_id1 !=0){ ?>
                      
                
                    <td class="last">
                    <label>
                    <input type="text" name="vote_name1"  id="vote_name1" style="width:430px" value="<?php echo $_GET['votename'] ?? ""; ?>" />
                    </label>
                    </td>
                  
                 <?php } ?></td>
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
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
//-->
</script>
</body>
</html>

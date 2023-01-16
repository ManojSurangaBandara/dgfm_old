<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/progress_report.class.php');
require_once('classes/common.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$project_id = $_GET['projectid'];



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	
	<title>New Progress Report</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript" src="js/deleteconfirmations.js"></script>
<script type="text/javascript">
function showUser(str)
{
  
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
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
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("GET","view_project.php?q="+str,true);
xmlhttp.send();
}
</script>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="main">
	<div id="header">
	  <?php ///include ('tpl/topmenu.tpl');?>
	</div>
	<div id="middle">
		<div id="left-column">
        <br />
			<?php include ('tpl/log_out.tpl');?>
            <p></p>
            
           
            <?php include ('tpl/left_munu.tpl');?>
			<a href="#" class="link"> Related Links</a>		
		</div>
		<div id="center-column">
			<div class="top-bar">
            <a href="projects.php" class="button">Home</a>
	      <h1>Project Progress Report</h1>
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
                	$result = Projects :: GetProjectData($project_id);
					//echo $result;
					$row=mysql_fetch_array($result);			
					
				}
				
			
				?>
		 <form action="controller/progress_report.controller.php?mode=save" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	
						<th class="full" colspan="2">Create New Progress Report</th>
					</tr>
					<tr>
						<td class="first" width="210"><strong>Select Project</strong></td>
					  <td width="525" class="last"><span id="spryselect1">
					    <label>
					      <select name="cmbproject" style="width:500px" id="cmbproject" onchange="showUser(this.value)">
					        <option value="-1"></option>
					        <?php 
							
							
					if($_SESSION['userType'] == 1){
					$unitid = 'esr_unit_id'; 
					$ge_id ='ge_center_id';
				 }
				 if ($_SESSION['userType'] == 2){
					 $unitid = 'esr_unit_id';
					 $ge_id ='ge_center_id';
				 }
				 
				  if ($_SESSION['userType'] == 3){
					 $unitid = $_SESSION['unitID'];
					 $ge_id ='ge_center_id';
				 }
				 
				   if ($_SESSION['userType'] == 4){
					 $unitid = 'esr_unit_id';
					 $ge_id =$_SESSION['ge_id'];
				 }	  
				  	
							
							$projectprogress = ProjectsProgress :: GetAllProjects($unitid,$ge_id);
							while($rowprojectprodress = mysql_fetch_array($projectprogress)){
							?>
					        <option value="<?php echo $rowprojectprodress[0]; ?>" ><?php echo $rowprojectprodress[1]; ?></option>
					        <?php } ?>
				          </select>
				      </label>
				      <span class="selectInvalidMsg">*</span><span class="selectRequiredMsg">Please select an item.</span></span></td>
					</tr>
					
                    
                    
                    
                    <tr class="bg">
					  <td colspan="2" id="txtHint"></td>
		    </tr>
		  
          
          
                    
             <tr class="bg">
					  <td valign="top" class="first"><strong>Report Date as at</strong></td>
					  <td class="last"><span id="sprytextfield1">
					    <label>
					      <input type="text" name="txt_as_at_date" id="txt_as_at_date"  />
				      </label>
				      <span class="textfieldRequiredMsg">*</span></span><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.txt_as_at_date);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date_calander/calbtn.gif" width="34" height="22" border="0" alt="" /></a></td>
		    </tr>
					
					<tr >
					  <td valign="top" class="first"><strong>Completing State as Percentage</strong></td>
					  <td class="last"><label>
					      <select name="cmb_percentage" id="cmb_percentage">
					        <?php 
							for($i=1; $i<101; $i++){
							?>
					 <option value="<?php echo $i; ?>" <?php if($i== 1){ echo "selected=selected"; }?>><?php echo $i; ?></option>
					        <?php } ?>
				          </select>
				      % Completed.</label></td>
                      
		    </tr>
            
           
            
            <tr class="bg" >
					  <td valign="top" class="first"><strong>Remarks</strong></td>
					  <td class="last"><label>
					    <textarea name="txaremarks" id="txaremarks" cols="45" rows="5"></textarea>
				      </label></td>
		    </tr>
            
					<tr >
					  <td valign="top" class="first"><strong>Upload a Picture 1</strong></td>
					  <td class="last"><label>
					    <input type="file" name="upfile" id="upfile" />
				      </label></td>
		    </tr>
            
            <tr class="bg" >
					  <td valign="top" class="first"><strong>Upload a Picture 2</strong></td>
					  <td class="last"><label>
					    <input type="file" name="upfile1" id="upfile1" />
				      </label></td>
		    </tr>
            
            <tr >
					  <td valign="top" class="first"><strong>Upload a Picture 3</strong></td>
					  <td class="last"><label>
					    <input type="file" name="upfile2" id="upfile2" />
				      </label></td>
		    </tr>
            
             <tr class="bg" >
					  <td valign="top" class="first"><strong>Upload a file</strong></td>
					  <td class="last"><label>
					    <input type="file" name="upfile3" id="upfile3" />
				      </label></td>
		    </tr>
            
			<tr >
           			  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    </tr>
					<tr class="bg" >
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
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1"});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//-->
</script>
</body>
</html>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="date_calander/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>

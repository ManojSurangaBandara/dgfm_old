<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/progress_report.class.php');
require_once('classes/projects.class.php');
require_once('classes/common.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}

//$unit_id		  =	isset( $_GET['unitid'])?$_GET['unitid']:1;
$projType         =	isset( $_GET['projType'])?$_GET['projType']:1;



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Generate Progress Report</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
    <style media="all" type="text/css">@import "css/style.css";</style>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script language="JavaScript" type="text/JavaScript" src="js/deleteconfirmations.js"></script>
<script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

 <script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>
<script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>
<script language="JavaScript" type="text/JavaScript" src="js/jquery.min.js"></script>  
<script language="JavaScript" type="text/JavaScript" src="js/ddaccordion.js"></script>  
<script language="JavaScript" type="text/JavaScript" src="js/niceforms.js"></script> 
</head>
<body>
<div id="main">
	<div id="header">
	  <?php ///include ('tpl/topmenu.tpl');?>
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
            
         <?php
		 
		 if($_SESSION['userType'] == 1)
			{ ?>
				<a href="admin_home.php" class="button">Home </a>
		 <?php	}
            
        if($_SESSION['userType'] == 2)
		   {?>
			   <a href="Home.php" class="button">Home</a>
		 <?php   }?>
		   
		  
            
	      <h1>Project Progress Report</h1>
				<div class="breadcrumbs"><?php /*?>
                
                     
         <?php
		 
		 if($_SESSION['userType'] == 1)
			{ ?>
				<a href="admin_home.php"> Home </a> 
		 <?php	}
            
         if($_SESSION['userType'] == 2)
		   {?>
			     <a href="Home.php"> Home </a> 
		 <?php   }?>
		   
                
                
                
            
              
              
              
              
              
              / Generate Progress Report<?php */?></div>
			</div><br />
		  <div class="select-bar">
		   <div id="error" align="center" style="height:25px;">
		     <?php require_once('messages/project.message.php'); ?>
		   </div>
		  </div>
		  <div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="images/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                
		 <form action="excel/excel_example.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	
						<th class="full" colspan="2">Generate Progress Report</th>
					</tr>
                    
                        
					<tr>
						<td ><strong>Select Project Type</strong></td>
					  <td width="538" ><span id="spryselect1"><span class="selectInvalidMsg">*</span><span class="selectRequiredMsg">Please select an item.</span>   </span>
					        <select name="cmbproject" id="cmbproject" onchange="getProjTypepr(this.value)"   >                       
					      <?php 
							$projecttype = Projects :: GetProjectType();
							while($rowprojecttype = mysql_fetch_array($projecttype)){
							?>
					      <option value="<?php echo $rowprojecttype[0]; ?>" <?php if($rowprojecttype[0]==$projType){?> selected="selected" <?php } ?> ><?php echo $rowprojecttype[1]; ?></option>
					      <?php } ?>
			          </select></td>
					</tr>
					
                    
                    <tr class="bg">
						<td class="first"><strong>Select ESR Unit </strong>  </td>
           <td align="justify"><label>
          <!--   <select name="esr_unit" class="ComboBoxcesSmall" style="width:70px;" id="esr_unit" onchange="getEsrUnitIDForProgressReport(this.value)"> -->
             <select name="esr_unit" class="ComboBoxcesSmall" style="width:70px;" id="esr_unit" > 
             
             <?php if($projType==2)  {?>
             
             <option value="All">All</option>
             
             
               <?php  }
			   
			  echo $projType;
			  
							$esrunit = Common :: GetUnitName();
							while($rowesrunit=mysql_fetch_array($esrunit)){
							?>
               <option value="<?php echo $rowesrunit[0]; ?>"><?php echo $rowesrunit[1]; ?></option>
               <?php } ?>
             </select>
           </label></td>
					</tr>
                    
                    
                    
                   <?php /*?><!-- <tr class="bg">
						<td ><strong>Select ESS</strong>  </td>
           <td><label>
             <select name="gecenter"  style="width:70px;" class="ComboBoxcesSmall"   id="gecenter" > 
             <option value="All">All</option>
              
               <?php 
			   
			 
							$gecenter = Projects :: GetGEName($unit_id);
							while($rowgecenter=mysql_fetch_array($gecenter)){
							?>             
               
                   <option value="<?php echo $rowgecenter[0]; ?>" ><?php echo $rowgecenter[1]; ?></option>
               
               
               <?php } ?>
             </select>
           </label></td>
					</tr>                  
               --><?php */?>     
                    
               
					<tr >
					  <td valign="top" class="first"><strong>Report Date as at</strong></td>
					  <td ><span id="sprytextfield1">
					    <label>
					      <input type="text" style="width:115px;"  name="txt_as_at_date" id="txt_as_at_date"  />
				      </label>
				      <span class="textfieldRequiredMsg">*</span></span><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.txt_as_at_date);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date_calander/calbtn.gif" width="34" height="22" border="0" alt="" /></a></td>
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

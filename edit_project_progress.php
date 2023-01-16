<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/progress_report.class.php');
require_once('classes/common.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$project_id   = $_GET['projectid'];
$progress_id  = $_GET['progress_id'];
$ptype        = $_GET['ptype'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
	      <h1>Project Progress Report</h1>
				<div class="breadcrumbs">
               
            <?php /*?>    <a href="projects.php">Project</a> / <a href="project_reports.php?projectID=<?php echo $project_id; ?>"> Progress Report </a>/ Update</a><?php */?>
                
                </div>
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
		
                	$result = ProjectsProgress :: GetprogressReport($progress_id);	
					$row=mysql_fetch_array($result);	
					
					$Truncresult = ProjectsProgress :: Truncate_tembill();						
					$Billresult = ProjectsProgress :: InsertIntoBillsToTempTable($progress_id);					
				//	$billrow=mysql_fetch_array($Billresult);	
					
					
				
				?>
                
                
                
                
                
		 <form action="controller/progress_report.controller.php?mode=edit&proj_pro_report_id= <?php echo $row[0];  ?>&ptype= <?php echo $ptype;  ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
            
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	
						<th class="full" colspan="2">Header Here</th>
					</tr>
<tr>
						<td class="first" width="210"><strong>Select Project</strong></td>
					 <td class="last" ><label>
                       <textarea name="txtprojname" cols="41" disabled="disabled" class="textBoxces" id="txtprojname"><?php echo $row[17]; ?></textarea>
                        
                        <input name="txtprojid" type="hidden" id="txtprojid" value="<?php echo $row[1]; ?>" />
				      </label></td>
			<tr>
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    </tr>
          
            
					<tr class="bg">
					  <td valign="top" class="first"><strong>Report Date as at</strong></td>
	    <td class="last"><span id="sprytextfield1">
					    <label>
					      <input type="text" name="txt_as_at_date" id="txt_as_at_date" value="<?php echo $row[2]; ?>" />
				      </label>                    
				      <span class="textfieldRequiredMsg">*</span></span><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.txt_as_at_date);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date_calander/calbtn.gif" width="34" height="22" border="0" alt="" /></a></td>
		    </tr>
            
            
					
                   <?php if($ptype==2){ ?>
                    
                     <tr >
					  <td valign="top"  class="first"><strong>Awarded Sum Rs:</strong></td>
					  <td class="last"><span id="sprytextfield2">
                      <label>
                        <input type="text" name="txtawardsum" id="txtawardsum" value="<?php echo number_format($row[23],'2','.',''); ?>" />
                      </label>
                      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
		    </tr>
                    
                    
<tr class="bg">
					  <td valign="top" class="first"><strong>Allocated Amount In 
					    <label>
					      <select name="cmb_allocated_year" id="cmb_allocated_year">
					        <?php 
							for($i=2011; $i<2051; $i++){
							?>
					        <option value="<?php echo $i; ?>" <?php if($i== date('Y')){ echo "selected=selected"; }?>><?php echo $i; ?></option>
					        <?php } ?>
				          </select>
				      </label>
					  </strong></td>
					  <td class="last"><label>
					    <input type="text" name="txtallocatedamount" id="txtallocatedamount" value="<?php echo number_format($row[4],'2','.',''); ?>" />
				      </label></td>
		    </tr>
					<tr >
					  <td valign="top" class="first"><strong>Amount Paid In  
					    <select name="cmb_amount_paid_in" id="cmb_amount_paid_in">
					      <?php 
							for($j=2011; $j<2051; $j++){
							?>
					      <option value="<?php echo $j; ?>" <?php if($j== date('Y')){ echo "selected=selected"; }?>><?php echo $j; ?></option>
					      <?php } ?>
				      </select>
					  </strong></td>
					  <td class="last"><label>
					    <input type="text" name="txtamountpaid" id="txtamountpaid" value="<?php echo number_format($row[6],'2','.',''); ?>" />
				      </label></td>
		    </tr>
					
             <tr >
					  <td height="27" valign="top" class="first"><strong>Bills Paid</strong></td>
					  <td class="last"><a href="#"  onclick="window.open('BillsDetails.php?id=id','Windowname','width=800,top=200,left=250,resizable,scrollbars,height=300');  return false;">Edid bills</a></td>
		    </tr>
            
            
            
            
            
            
            <?php } else { ?>
            
              <tr>
					  <td class="first" ><strong>T/B Approval Yes/No</strong></td>
					  <td class="last"><textarea name="txttbapproval" cols="20" rows="1" class="textArea" id="txttbapproval"><?php echo $row[20]; ?></textarea></td>
		    </tr>
            		
					<tr class="bg">
					  <td height="27" valign="top" class="first"><strong>Dates of Approval By T/B </strong></td>
					  <td class="last"><label>					   
                         <textarea name="txtdateoftbaproval" cols="20" rows="5"  class="textArea" id="txtdateoftbaproval" ><?php echo $row[21]; ?> </textarea>
				      </label></td>
		    </tr>
            
            <?php } ?>
            
            
            
            
            
            
            
					<tr >
					  <td valign="top" class="first"><strong>Completing State as Percentage</strong></td>				
                      
                       <td class="last"><label>
					      <select name="cmb_percentage" id="cmb_percentage">
					        <?php 
							
							for($i=1; $i<101; $i++){
							?>
					 <option value="<?php echo $i; ?>" <?php if($i == $row[8]){ echo "selected=selected"; }?>><?php echo $i; ?></option>
					        <?php } ?>
				          </select>
				      % Completed.</label></td>
                      
                      
		    </tr>
            <tr >
					  <td valign="top" class="first"><strong>Remarks</strong></td>
					  <td class="last"><label>
					    <textarea name="txaremarks" id="txaremarks" cols="45" rows="5"> <?php echo $row[16]; ?>  </textarea>
				      </label></td>
		    </tr>
            
					<tr class="bg">
					  <td valign="top" class="first"><strong>Picture 1</strong></td>
					  <td class="last"><label>
					    <input type="file" name="upfile" id="upfile"  /><a href="download.php?filename=<?php echo $row[15];?>"><?php echo $row[15]; ?></a><input name="txt_updoc" type="hidden" value="<?php echo $row[15]; ?>" />
				      </label></td>
		    </tr>
            <tr >
					  <td valign="top" class="first"><strong>Picture 2</strong></td>
					  <td class="last"><label>
					    <input type="file" name="upfile1" id="upfile1"  /><a href="download.php?filename=<?php echo $row[18];?>"><?php echo $row[18]; ?></a><input name="txt_updoc" type="hidden" value="<?php echo $row[18]; ?>" />
				      </label></td>
		    </tr>
            
            
            
            <tr class="bg">
					  <td valign="top" class="first"><strong>Picture 3</strong></td>
					  <td class="last"><label>
					    <input type="file" name="upfile2" id="upfile2"  /><a href="download.php?filename=<?php echo $row[19];?>"><?php echo $row[19]; ?></a><input name="txt_updoc" type="hidden" value="<?php echo $row[19]; ?>" />
				      </label></td>
		    </tr>
            
            
             <tr >
					  <td valign="top" class="first"><strong>Upload a File</strong></td>
					  <td class="last"><label>
					    <input type="file" name="upfile3" id="upfile3"  /><a href="download.php?filename=<?php echo $row[22];?>"><?php echo $row[22]; ?></a><input name="txt_updoc" type="hidden" value="<?php echo $row[22]; ?>" />
				      </label></td>
		    </tr>
            
            
					<tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    </tr>
					<tr >
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
					<tr >
					  <td class="first">&nbsp;</td>
					  <td class="last"><input type="submit" name="btnsubmit" id="btnsubmit" value="      Submit      " />
					    <label>
					      <input type="reset" name="btncancel" id="btncancel" value="     Cancel      " />
			          </label></td>
		    		</tr>
					<tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    </tr>
		   </table>
	        <p>&nbsp;</p>
           </form>
		  </div>
		</div>
		<div id="right-column"></div>
	</div>
	<div id="footer"></div>
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
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "currency");
//-->
</script>
</body>
</html>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="date_calander/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>

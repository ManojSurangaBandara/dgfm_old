<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/projects.class.php');
require_once('classes/common.class.php');
require_once('classes/progress_report.class.php');


//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$project_id 	= $_GET['projectid'];
//$status	  		= isset( $_GET['cval'])?$_GET['cval']:$status;
$user_type_id 	= $_SESSION['userType'];

$sfhq_id 		= $_SESSION['sfhqID'];
$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM :: BSMS</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>
<script type="text/javascript">



function showUser1(str,ar)
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

xmlhttp.open("GET","amount1.php?q="+str+"&ar="+ar,true);

xmlhttp.send();
}



function showUser2(str,ar)
{
	
  
if (str=="")
  {
  
   document.getElementById("txtHint2").innerHTML="";
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
    
	    document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
	
    }
  }

xmlhttp.open("GET","amount2.php?q="+str+"&ar="+ar,true);

xmlhttp.send();
}




function showUser3(str,ar)
{
  
if (str=="")
  {
  
   document.getElementById("txtHint3").innerHTML="";
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
    
	    document.getElementById("txtHint3").innerHTML=xmlhttp.responseText;
	
    }
  }

xmlhttp.open("GET","amount3.php?q="+str+"&ar="+ar,true);

xmlhttp.send();
}

function showUser4(str,val,uni)
{
  
if (str=="")
  {
  
   document.getElementById("txtHint4").innerHTML="";
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
    
	    document.getElementById("txtHint4").innerHTML=xmlhttp.responseText;
	
    }
  }

xmlhttp.open("GET","UnitDistribution.php?q="+str+"&r="+val+"&s="+uni,true);

xmlhttp.send();
}

</script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
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
				<a href="projects.php?branch_id=6" class="button"><< Back</a>
				<h1>Edit Voucher</h1>
				<div class="breadcrumbs">
        <?php /*?>        <a href="projects.php?branch_id=<?php echo $branch_id; ?>">Home</a> / Edit Voucher <?php */?>
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
				if($project_id>0)
				{
                	$result = Projects :: GetBillDataToSFHQ($sfhq_id,$project_id,$user_type_id);
					//echo $result;
					$row=$result[0];
					
				}		
				
				//$result = ProjectsProgress :: GetBillAmountandVotes($row[1]);
				
				?>

                
		<form id="form1" name="form1" method="post"  action="controller/billcontroller.php?mode=editSFHQ&projectid=<?php echo $project_id; ?>&user_type_id=<?php echo $user_type_id;?>&bill_no=<?php echo $row[1]; ?>&branch_id=<?php echo $branch_id; ?>&sfhq_id=<?php echo $sfhq_id; ?>" enctype="multipart/form-data">
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	
						<th class="full" colspan="2">Edit Voucher Details</th>
					</tr>
               
               <tr class="bg">
						<td width="187" class="first"><strong>Voucher Number</strong></td>
						<td width="561" class="last">
						<label>
						 <input name="bill_no" type="text" id="bill_no"  value="<?php echo $row[1]; ?>" readonly="readonly" />
					    </label>
					   </td>
			</tr>
            
            
                       
                        <tr class="bg">
                      <td class="first"><strong>Operational Controller</strong></td>
                         <td class="last">
                      <table width="100%" border="0">
                          <tr>                  
                    
					
					
					 <td>				 

                        
                        
                         <select name="brach_id" class="ComboBoxcesSmall" id="brach_id"   style="width:100px;" onchange="showvaluetoEditsfhqbill(this.value,'<?php echo $project_id; ?>')">
                        <?php $result = Projects::get_all_branchestosfhqnotall($sfhq_id); ?>
                        <?php 
						foreach ($result as $row1) 
						{
						?>
              <option value='<?php echo $row1[0]; ?>' <?php if($row1[0] == $branch_id ){ echo "selected=selected"; }?> ><?php echo $row1[1]; ?></option>
            
			            <?php } ?>
                      </select>
					
					  </td>
					     
					  
                 <td width="77%" >

                            
					<select name="allocated_regiment" id="allocated_regiment">
                        <?php $result1 = Projects::get_all_regiment_namesDGFM1($branch_id,$sfhq_id); ?>
                        <?php 
            foreach ($result1 as $row1)
						{ 
						?>
                      
             <option value='<?php echo $row1[0]; ?>' <?php if($row1[0] == $row[15] ){ echo "selected=selected"; }?> ><?php echo $row1[5]; ?>
             </option>
                                               
                    <?php } ?>
                      </select>
					  
							
							</td>
							
							   
							
                          </tr>
                        </table>
                      </td>
                    </tr>
                  
           
            
            
               <tr class="bg">
				 <td width="189" height="26" class="first"><strong>Invoice Details </strong></td>
				 <td width="559" class="last">
                 
                 <table>                 
                 <td class="first"><strong> No </strong> </td>
                    <td>   
                    <span id="sprytextfield5">
						<label>
						    <input type="text" name="Invoice_no" value="<?php echo $row[17]; ?>" id="Invoice_no" />
					    </label>
					    <span class="textfieldRequiredMsg">*</span></span>
                   </td>
                      
                    <td> <strong> Date </strong> </td>
                          <td> <span id="sprytextfield2">
                        <label>
                          <input value="<?php echo $row[4]; ?>" name="invoice_date" type="text" class="textBoxces" id="invoice_date"  />
                        </label>
                        <span class="textfieldRequiredMsg">*</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.invoice_date);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date_calander/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
              </table>
              
              </td>
			</tr>
           
           
           <tr class="bg">
				 <td height="26" class="first"><strong>G 35 Details </strong></td>
				 <td class="last">
                 
                 <table>                 
                 <td class="first"><strong> No </strong> </td>
                    <td>   
                    <span id="sprytextfield6">
						<label>
						    <input type="text" name="g35_no" value="<?php echo $row[18]; ?>" id="g35_no" />
					    </label>
					    <span class="textfieldRequiredMsg">*</span></span>
                   </td>
                      
                    <td> <strong> Date </strong> </td>
                          <td> <span id="sprytextfield7">
                        <label>
                       <input name="g35_date" type="text" class="textBoxces" id="g35_date" value="<?php echo $row[19]; ?>" />
                        </label>
                        <span class="textfieldRequiredMsg">*</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.g35_date);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date_calander/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
              </table>
              
              </td>
			</tr>
           <tr >
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    </tr>
            
            
            
            
                  
               <tr>
                    <td class="first"><strong>Supplier Name</strong></td>
                     <td class="last"><select name="Payee_name" class="ComboBoxcesSmall" id="Payee_name"   style="width:500px;" >
                        <?php $result = Projects::get_all_Suplier($sfhq_id); ?>
                        <?php 
						foreach ($result as $row1) 
						{
						?>
                        <option value='<?php echo $row1[0]; ?>' <?php if($row1[0] == $row[2] ){ echo "selected=selected"; }?> ><?php echo $row1[1]; ?></option>
                        <?php } ?>
                      </select></td>

            </tr>
            
            
            
				 
            <tr class="bg">
						<td class="first"><strong>Dir Ref No</strong></td>
						<td width="561" class="last"><span id="sprytextfield1">
						<label>
						 <input type="text" value="<?php echo $row[9]; ?>" name="bill_ref_no" id="bill_ref_no" />
					    </label> <span class="textfieldRequiredMsg">*</span></span>
					   </td>
			</tr>
            
           
              			<td class="first"><strong>Ledgered Date</strong></td>
						<td class="last">
                        <label>
                          <input name="ledger_date" value="<?php echo $row[35]; ?>"  type="text" class="textBoxces" id="ledger_date"  />
                        </label>
                       <span class="textfieldInvalidFormatMsg">Invalid format.</span></span><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.ledger_date);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date_calander/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
					</tr>	
                    
             <tr>
				<td class="first">&nbsp;</td>
				<td class="last">&nbsp;</td>
		    </tr>
                    
           
                        
           <tr class="bg" >
						<td class="first"><strong>Received Date</strong></td>
						<td class="last"><span id="sprytextfield4">
                        <label>
                          <input  value="<?php echo $row[3]; ?>" name="txtstart_date" type="text" class="textBoxces" id="txtstart_date"  />
                        </label>
                        <span class="textfieldRequiredMsg">*</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.txtstart_date);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date_calander/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
					</tr>	
                    
                     <tr >
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		   			 </tr>
                    
                        <tr class="bg" >
						<td class="first"><strong>Bill Period</strong></td>
						<td class="last">
                        
                        
                        
                        <label>
                          <input name="from_period" value="<?php echo $row[27]; ?>" type="text" class="textBoxces" id="from_period"   />
                        </label>
                       <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.from_period);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date_calander/calbtn.gif" width="34" height="22" border="0" alt=""></a>
                        
        <label>
          <input name="to_period" value="<?php echo $row[28]; ?>"  type="text" class="textBoxces" id="to_period"  />
        </label>
        <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.to_period);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date_calander/calbtn.gif" width="34" height="22" border="0" alt=""></a>
                        
                        
                        </td>
                        
                        
					</tr> 		
                              
                              
                            
                      <tr class="bg" >
					  <td valign="top" class="first"><strong>Remarks</strong></td>
					  <td class="last">
					    <label>
					      <textarea  name="remarks" cols="68" rows="1" class="textArea" id="remarks"><?php echo $row[6]; ?> </textarea>
				      </label>
				      </td>
		    </tr>	
         
        <tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    </tr>
					<tr >
					  <td class="first" colspan="2"> 
                      <?php
					  
					  $billdetails = Common :: getallbilldetailstosfhq($row[1],$row[0]);
					  while($rowbilldata = mysql_fetch_assoc($billdetails)){
						$billamountarr[] =  $rowbilldata['Amount']; 
						$voteidarr[] =  $rowbilldata['Vote_ID']; 
						$votenamearr[] =  $rowbilldata['description']; 
						$idarr[] =  $rowbilldata['id']; 
					  }
					 
					  
					  ?>
                      <table width="100%" border="0">
               <tr>
                <td width="24%" class="first"><strong>Vote Code</strong></td>
                 <td width="50%" class="first"><strong>Vote Name</strong></td>
                <td width="26%" class="first"><strong>Amount<span class="last">(LKR)</span></strong></td>
               </tr>
               <tr>
                 <td><select name="vote_id1"  style="width:160px"   id="vote_id1" onchange="showUser1(this.value,<?php echo $billamountarr[0]; ?>)">
                   <option value="0" ></option>
				   <?php 
							$esrunit = Common :: GetReleventVotesName($branch_id);
							foreach ($esrunit as $rowesrunit) {
							?>
                   <option value="<?php echo $rowesrunit[0]; ?>" <?php if( $rowesrunit[0] == $voteidarr[0]){ echo "selected=selected"; }?>><?php echo $rowesrunit[1]; ?></option>
                   <?php } ?>
                 </select><input name="hdnbill_id1" type="hidden" value="<?php echo $idarr[0] ?>" /></td>
              
           
				    <td colspan="2" id="txtHint1">
                      <table cellpadding="0" cellspacing="0">


                        <tr class="bg">
              
                            <td class="last">
                        <label>
                        <input type="text" name="vote_name1"  id="vote_name1" style="width:430px" value="<?php echo $votenamearr[0]; ?>" />
                        </label>
                        </td>
                                            
                        <td class="last">
                        <label>
                        <input type="text" name="amount1"  id="amount1" style="width:80px" value="<?php echo $billamountarr[0]; ?>" />
                        </label>
                        </td>
                       <?php /*?> <?php } ?><?php */?>            
                        </tr>
                                 
                              
                              
                              
                                     
                     </table>
                      </td>
                 </tr>
             
                 
               <tr>
                 <td><select name="vote_id2" style="width:160px"   id="vote_id2" onchange="showUser2(this.value,<?php echo $billamountarr[1]; ?>)">
                   <option value="0" ></option>
				   <?php 
							$esrunit = Common :: GetReleventVotesName($branch_id);
							foreach ($esrunit as $rowesrunit) {
							?>
                   <option value="<?php echo $rowesrunit[0]; ?>" <?php if( $rowesrunit[0] == $voteidarr[1]){ echo "selected=selected"; }?>><?php echo $rowesrunit[1]; ?></option>
                   <?php } ?>
                 </select><input name="hdnbill_id2" type="hidden" value="<?php echo $idarr[1] ?>" /></td>
                
                    
					  <td colspan="2" id="txtHint2">
                      
                      <table cellpadding="0" cellspacing="0">

                        <tr class="bg">
                  <?php /*?>  <?php  if($row[14]!=$branch_id) { ?>
                    
                        <td class="last">
                        <label>
                        <input type="text" name="vote_name2"  id="vote_name2" style="width:430px" value="" />
                        </label>
                        </td>
                                            
                        <td class="last">
                        <label>
                        <input type="text" name="amount2"  id="amount2" style="width:80px" value="" />
                        </label>
                        </td>
                            <?php } else { ?>  <?php */?>
                        <td class="last">
                        <label>
                        <input type="text" name="vote_name2"  id="vote_name2" style="width:430px" value="<?php echo $votenamearr[1]; ?>" />
                        </label>
                        </td>
                                            
                        <td class="last">
                        <label>
                        <input type="text" name="amount2"  id="amount2" style="width:80px" value="<?php echo $billamountarr[1]; ?>" />
                        </label>
                        </td>
                            <?php /*?>  <?php } ?> <?php */?>              
                        </tr>
                                        
                     </table></td>
                 </tr>
                
                <tr>
                 <td><select name="vote_id3"  style="width:160px"   id="vote_id3" onchange="showUser3(this.value,<?php echo $billamountarr[2]; ?>)">
                   			<option value="0" ></option>
				   <?php 
							$esrunit = Common :: GetReleventVotesName($branch_id);
							foreach ($esrunit as $rowesrunit) {
							?>
                   <option value="<?php echo $rowesrunit[0]; ?>" <?php if( $rowesrunit[0] == $voteidarr[2]){ echo "selected=selected"; }?>><?php echo $rowesrunit[1]; ?></option>
                   <?php } ?>
                 </select><input name="hdnbill_id3" type="hidden" value="<?php echo $idarr[2] ?>" /></td>
                
                    
					  <td colspan="2" id="txtHint3"><table cellpadding="0" cellspacing="0">

                        <tr class="bg">
                  <?php /*?>  <?php  if($row[14]!=$branch_id) { ?>
                    
                        <td class="last">
                        <label>
                        <input type="text" name="vote_name3"  id="vote_name3" style="width:430px" value="" />
                        </label>
                        </td>
                                            
                        <td class="last">
                        <label>
                        <input type="text" name="amount3"  id="amount3" style="width:80px" value="" />
                        </label>
                        </td>
                            <?php } else { ?>  <?php */?>
                        <td class="last">
                        <label>
                        <input type="text" name="vote_name3"  id="vote_name3" style="width:430px" value="<?php echo $votenamearr[2]; ?>" />
                        </label>
                        </td>
                                            
                        <td class="last">
                        <label>
                        <input type="text" name="amount3"  id="amount3" style="width:80px" value="<?php echo $billamountarr[2]; ?>" />
                        </label>
                        </td>
                          <?php /*?>  <?php } ?><?php */?>                 
                        </tr>
                                        
                     </table></td>
                 </tr>
             </table></td>
					 
		    		</tr>
					<tr class="bg" >
					  <td class="first">&nbsp;</td>
					  <td class="last"><input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" />
					    <label>
					      <input type="reset" name="btncancel" id="btncancel" value="Cancel" />
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
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "date", {format:"yyyy-mm-dd"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"yyyy-mm-dd"});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "date", {format:"yyyy-mm-dd"});
//-->
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
//-->
</script>
</body>
</html>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="date_calander/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>

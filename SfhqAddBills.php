<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/projects.class.php');
require_once('classes/common.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}

$user_id 		= $_SESSION['userID'];
$user_type_id 	= $_SESSION['userType'];
$sfhq_id 		= $_SESSION['sfhqID'];

$brach_id  		= isset( $_GET['brach_id'])?$_GET['brach_id']:0 ;
$sup_id   		= isset( $_GET['sup_id'])?$_GET['sup_id']:0 ;
$vote_id1  		= isset( $_GET['vote_id1'])?$_GET['vote_id1']:0 ;
$vote_id2   	= isset( $_GET['vote_id2'])?$_GET['vote_id2']:0 ;
$vote_id3   	= isset( $_GET['vote_id3'])?$_GET['vote_id3']:0 ;

$maxresult  	= isset( $_GET['maxresult'])?$_GET['maxresult']:0 ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM :: ADD NEW VOUCHER</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>
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

xmlhttp.open("GET","amount1.php?q="+str,true);

xmlhttp.send();
}



function showUser2(str)
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

xmlhttp.open("GET","amount2.php?q="+str,true);

xmlhttp.send();
}




function showUser3(str)
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

xmlhttp.open("GET","amount3.php?q="+str,true);

xmlhttp.send();
}

function showUser4(str)
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

xmlhttp.open("GET","details.php?q="+str,true);

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
				<a href="projects.php" class="button"><< Back</a>
				<h1>New Bill Details</h1>
				<div class="breadcrumbs">
                
                <?php /*?><a href="projects.php">Home</a>/ New Bill Details<?php */?>
                
                </div>
		  </div><br />
		  <div class="select-bar">
		   <div id="error" align="center" style="height:25px; ">
		     <?php require_once('messages/project.message.php'); ?>
		   </div>
		  </div>
		  <div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="images/bg-th-right.gif" width="7" height="7" alt="" class="right" />
              
           
		 <form id="form1" name="form1" method="post" action="controller/billcontroller.php?mode=savesfhq&user_type_id=<?php echo $user_type_id;?>&user_id=<?php echo $user_id; ?>&sfhq_id=<?php echo $sfhq_id; ?>" enctype="multipart/form-data">
		 
		
		 
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	
			 <?php if ($maxresult > 0 ){?>
                         
						<th class="full" colspan="2"> <strong style="color:#00F">Entered Voucher No is   <?php echo $maxresult; ?> </strong></th>
			   
                         <?php } else { ?>
                         
                         
               			<th width="100" colspan="2" class="full">WelCome to Enter the Voucher  (Bill No will display after you successfully entered the bill)</th>
                          <?php }?>
                   
                   
                             
                   
            <tr class="bg">
                      <td class="first"><strong>Operational Controller</strong></td>
                      <td class="last">
                        <table width="100%" border="0">
                          <tr>
                            <td class="last"><select name="brach_id" class="ComboBoxcesSmall" id="brach_id"   style="width:100px;" onchange="showbranchvalueToSfhq(this.value)" >
                        <?php 
					$result = Projects::get_all_branchestosfhqnotall($sfhq_id); 
					//$result = Projects::get_all_OpsController(); 
						foreach ($result as $row)
						{
						?>
                       <option value='<?php echo $row[0]; ?>' <?php if($row[0] == $brach_id ){ echo "selected=selected"; }?> ><?php echo $row[1]; ?></option>
                        <?php } ?>
                      </select></td>
                         
						<td width="77%" id="txtHint4">	
								  
					<?php   if($brach_id==5){ ?>
					
					
          <input type="text" name="details" style="width:350px"  id="details" value="<?php echo $_GET['details1']; ?>" />
					
			
					
					
					 <?php $result = Projects::get_all_regiment_namesDGFM($sfhq_id,$brach_id); ?>
                        <?php 
						foreach ($result as $row2) 
						{
						$unit = $row2[0];
						   
						}
						
					 
					  }
					 ?>
					<input type="hidden"  name="unit" style="width:350px"   id="unit" value="<?php echo $unit ?? 0;  ?>"  />
					
                		 
								
								
							</td>
                          </tr>
                        </table></td>
                    </tr>
                    
                    <?php if($brach_id !=5) { ?>
                     <tr class="bg">
                      <td class="first"><strong>Unit Name</strong></td>
                      <td class="last"> &nbsp;&nbsp;<select name="allocated_regiment">
                        <?php $result = Projects::get_all_regiment_namesDGFM($sfhq_id,$brach_id); ?>
                        <?php 
						foreach ($result as $row1) 
						{
						?>
                        <option value='<?php echo $row1[0]; ?>'><?php echo $row1[5]; ?></option>
						
		                <?php } ?>
                      </select></td>
                    </tr>
					
				<?php } ?>
                
                   
                   
            <tr class="bg">
				 <td width="165" height="26" class="first"><strong>Invoice Details </strong></td>
				 <td width="575" class="last">
                 
                 <table>                 
                 <td class="first"><strong> No </strong> </td>
                    <td>   
                    <span id="sprytextfield5">
						<label>
						    <input type="text" name="Invoice_no" id="Invoice_no" />
					    </label>
					    <span class="textfieldRequiredMsg">*</span></span>
                   </td>
                      
                    <td> <strong> Date </strong> </td>
                          <td> <span id="sprytextfield2">
                        <label>
                          <input name="invoice_date" type="date" required="" class="textBoxces" id="invoice_date" value="<?php echo $_GET['in_date'] ?? "";  ?>"  />
                        </label>
                        </td>
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
						    <input type="text" name="g35_no" id="g35_no" />
					    </label>
					    <span class="textfieldRequiredMsg">*</span></span>
                   </td>
                      
                    <td> <strong> Date </strong> </td>
                          <td> <span id="sprytextfield7">
                        <label>
                          <input name="g35_date" type="date" required="" class="textBoxces" id="g35_date" value="<?php echo $_GET['in_date'] ?? "";  ?>"  />
                        </label>
                        </td>
              </table>
              
              </td>
			</tr>
           <tr >
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    </tr>
           
           
       
                
                
                   <tr class="bg">
                      <td class="first"><strong>Supplier Name</strong></td>
                      <td class="last"><select name="Payee_name" style="width:462px;">
                        <?php $result = Projects::get_all_Suplier($sfhq_id); ?>
                        <?php 
						foreach ($result as $row)
						{
						?>
                       <option value='<?php echo $row[0]; ?>' <?php if($row[0] == $sup_id ){ echo "selected=selected"; }?> ><?php echo $row[1]; ?></option>
                        <?php } ?>
                      </select></td>
                    </tr>
                   
                    
            <tr class="bg">
						<td height="44" class="first"><strong>Dir Ref No</strong></td>
						<td class="last">
                        
                        <span id="sprytextfield1">
						  <label>
						    <input type="text" name="bill_ref_no" id="bill_ref_no" />
					    </label>
					    <span class="textfieldRequiredMsg">*</span></span></td>
			</tr>
            
          <tr class="bg" >
						<td class="first"><strong>Ledgered Date</strong></td>
						<td class="last">
                        <label>
                          <input name="ledger_date"  type="date" class="textBoxces" id="ledger_date"  />
                        </label>
                       </td>
					</tr>	
                    
             <tr>
				<td class="first">&nbsp;</td>
				<td class="last">&nbsp;</td>
		    </tr>

                        
           <tr class="bg" >
						<td class="first"><strong>Received Date</strong></td>
						<td class="last"><span id="sprytextfield4">
                        <label>
                          <input name="txtstart_date" type="date" required="" class="textBoxces" id="txtstart_date" value="<?php echo $_GET['re_date'] ?? "";  ?>"   />
                        </label>
                       </td>
					</tr>
                    
                              <tr>
				<td class="first">&nbsp;</td>
				<td class="last">&nbsp;</td>
		    </tr>			
                  	
                    
                    
                     <tr class="bg" >
						<td class="first"><strong>Bill Period</strong></td>
						<td class="last">
                        
                         <table>                 
                 <td> <strong> From </strong> </td>
                          <td> <span id="sprytextfield2">
                        <label>
                          <input name="from_period" type="date" class="textBoxces" id="from_period"   />
                        </label>
                        </td>
                      
                    <td> <strong> To </strong> </td>
                          <td> <span id="sprytextfield2">
                        <label>
                          <input name="to_period"  type="date" class="textBoxces" id="to_period"  />
                        </label>
                        </td>
              </table>
                        
                        </td>
                        
                        
					</tr>                    
                    
                        <tr>
				<td class="first">&nbsp;</td>
				<td class="last">&nbsp;</td>
		    </tr>			
                              
                                
                       <tr class="bg" >
					  <td valign="top" class="first"><strong>Remarks</strong></td>
					  <td class="last">
					    <label>
					      <textarea name="remarks" cols="50" rows="1" class="textArea" id="remarks"></textarea>
				      </label>
				      </td>
		    </tr>	
          <tr >
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    </tr>
           <tr >
             <td colspan="2" class="first">
             
             <table width="100%" border="0">
               <tr>
                <td width="15%" class="first"><strong>Vote Code</strong></td>
                 <td width="65%" class="first"><strong>Vote Name</strong></td>
                <td width="13%" class="first"><strong>Amount<span class="last">(LKR)</span></strong></td>
               </tr>
               <tr>
                 <td><select name="vote_id1" style="width:160px"  id="vote_id1" onchange="showUser1(this.value)">
                   <?php 
							//$esrunit = Common :: GetVotesName();
							$esrunit = Common :: GetReleventVotesName($brach_id);
							
							foreach ($esrunit as $rowesrunit) {
							?>
                   <option value="<?php echo $rowesrunit[0]; ?>" <?php if( $rowesrunit[0] == $vote_id1){ echo "selected=selected"; }?>><?php echo $rowesrunit[1]; ?></option>
                   <?php } ?>
                 </select></td>
                
                    
					  <td colspan="2" id="txtHint1">    <?php 
					  if($vote_id1 !=0){ ?>
                      <table cellpadding="0" cellspacing="0">

                    <tr class="bg">
                
                    <td class="last">
                    <label>
                    <input type="text" name="vote_name1"  id="vote_name1" style="width:230px" value="<?php echo $_GET['votename']; ?>" />
                    </label>
                    </td>
                                        
                    <td class="last">
                    <span id="sprytextfield5">
                    <label>
                    <input type="text" style="width:80px" name="amount1"  id="amount1" value="0" />
                    </label>
                   <span class="textfieldRequiredMsg">*</span></span></td>
                                        
                    </tr>
                                    
                 </table>
                 <?php } ?></td>
                 </tr>
             
                 
               <tr>
                 <td><select name="vote_id2"  style="width:160px"  id="vote_id2" onchange="showUser2(this.value)">
                   <?php 
							$esrunit = Common :: GetReleventVotesName($brach_id);
							foreach ($esrunit as $rowesrunit) {
							?>
                   <option value="<?php echo $rowesrunit[0]; ?>" <?php if( $rowesrunit[0] == $vote_id2){ echo "selected=selected"; }?>><?php echo $rowesrunit[1]; ?></option>
                   <?php } ?>
                 </select></td>
                
                    
					  <td colspan="2" id="txtHint2">
					      <?php if($vote_id2 !=0) { ?>
                      <table cellpadding="0" cellspacing="0">

	<tr class="bg">

	<td class="last">
    <label>
	<input type="text" name="vote_name2"  id="vote_name2" style="width:230px" value="<?php echo $_GET['votename2']; ?>" />
	</label>
    </td>
                        
    <td class="last">
    <label>
	<input type="text" style="width:80px" name="amount2"  id="amount2" value="" />
	</label>
    </td>
                        
	</tr>
					
 </table>
                      <?php } ?>
					  </td>
                 </tr>
                
                <tr>
                 <td><select name="vote_id3" style="width:160px"  id="vote_id3" onchange="showUser3(this.value)">
                   <?php 
							$esrunit = Common :: GetReleventVotesName($brach_id);
							foreach ($esrunit as $rowesrunit) {
							?>
                   <option value="<?php echo $rowesrunit[0]; ?>" <?php if( $rowesrunit[0] == $vote_id3){ echo "selected=selected"; }?>><?php echo $rowesrunit[1]; ?></option>
                   <?php } ?>
                 </select></td>
                
                    
					  <td colspan="2" id="txtHint3">
					      <?php if($vote_id3 !=0) { ?>
                      <table cellpadding="0" cellspacing="0">

	<tr class="bg">

	<td class="last">
    <label>
	<input type="text" name="vote_name3"  id="vote_name3" style="width:230px" value="<?php echo $_GET['votename3']; ?>" />
	</label>
    </td>
                        
    <td class="last">
    <label>
	<input type="text" style="width:80px" name="amount3"  id="amount3" value="" />
	</label>
    </td>
                        
	</tr>
					
 </table>
                      
                      <?php }  ?>
					  </td>
                 </tr>
             </table>
             
             
             </td>
            </tr>
             
					<tr class="bg" >
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
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "date", {format:"yyyy-mm-dd"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"yyyy-mm-dd"});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "date", {format:"yyyy-mm-dd"});

//-->
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield6");


var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "currency");
</script>
</body>
</html>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="date_calander/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>

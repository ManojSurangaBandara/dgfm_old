<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/vote.class.php');
require_once('classes/common.class.php');
require_once('classes/units.class.php');
require_once('classes/projects.class.php');


//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$sup_id = $_GET['sup_id'];
$sfhq_id 	= $_SESSION['sfhqID'];

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
				<a href="Suppliers.php" class="button">&lt;&lt; Back</a>
				<h1 style="text-transform:uppercase">Edit Supplier for the Year of <?php echo $_SESSION['log_year']; ?></h1>
				<div class="breadcrumbs">
                
     <?php /*?>            <a href="Suppliers.php">Suppliers</a>/ Update Suppliers<?php */?>
                 
                 </div>
			</div><br />
		  <div class="select-bar"><div id="error" align="center" style="height:25px;">
 					 <?php require_once('messages/vote.message.php'); ?>
			</div>
		  </div>
		  <div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="images/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                <?php
					
				if($sup_id>0)
				{
				
                	$result = Vote::SelectSupplierDetailRow($sup_id);
					//echo $result;
					//exit;
					$row=mysql_fetch_array($result);
					
				}
				?>
		 <form id="form1" name="form1" method="post" action="controller/vote.controller.php?mode=editsup&sup_id=<?php echo $row[0];?>">
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	
						<th class="full" colspan="2">&nbsp;</th>
					</tr>
				 
        <tr>
						<td width="198" class="first" ><strong>Is Vehicle</strong></td>
					 	
                        <td width="550" class="last">
                        <label>
                         
		<select name="isveh" disabled="disabled" style="width:150px" id="isveh" onchange="vehstatus(this.value)">
		<option value="0" <?php if("0" == $row[15] ){ echo "selected=selected"; }?>>Not a Vehicle</option>
        <option value="1" <?php if("1" == $row[15]){ echo "selected=selected"; }?>>Yes Its a Vehicle</option>
                 
						  
				</select>
				     </label>
                          
                       
			          </td>
					</tr>
                    
                    <?php  if($row[15]==1){  ?>
                    <tr class="bg">
						<td class="first"><strong>Vehicle Number <span class="last"></strong></td>
						<td class="last">
						  <label>
						    <input type="text"   size="30" name="vehno" id="vehno" value="<?php echo $row[14]; ?>" />
					    </label>
                        
					   </td>
					</tr>
                    
                    
                    
                      <tr class="bg">
						<td class="first"><strong>NIC Number</strong></td>
						<td class="last">
                        
                        <span id="sprytextfield7">
				<label>
                      <input name="nic" id="nic" value="<?php echo $row[16]; ?>" type="text" pattern="^(?:19|20)?\d{2}[0-9]{10}|[0-9]{9}[X|V]$" />
                      <span class="textfieldRequiredMsg">*</span>
					    </label>
					   </span> 
                
              <b>Ex :- 881033831V or 198810303831</b>
                       </td>
					</tr> 
                    
              <tr class="bg">
						<td class="first"><strong>Veh Running Place</strong></td>
                     <td><label><select name="vrp" class="ComboBoxcesSmall"  id="vrp" style="width:250px;">
						   
							 <?php 							
							$bankname = Projects::get_VehRunPlace($sfhq_id);
							
							while($rowbank=mysql_fetch_array($bankname))
							{
							?>
						<option value='<?php echo $rowbank[0];  ?>'  <?php if($rowbank[0] == $row[17] ){ echo "selected=selected"; }?> > <?php echo $rowbank[1]; ?></option>
						     <?php }?>
                             
                             
	          </select>
	    </label> </td>
                    
                    
            <?php } ?>
            
					<tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
        
        
        
        </tr>
					
					<tr class="bg">
						<td class="first"><strong>Supplier Name</strong></td>
						<td class="last">
		              <span id="sprytextfield1">
                      <label>
                  <input type="text" readonly="readonly" name="txtdescription" size="50" id="txtdescription" value="<?php echo $row[2]; ?>" />
                   <span class="textfieldRequiredMsg">*</span>   </label>
                      </span></td>
					</tr>
					
                    <tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
                    
                    
                   
                    <tr class="bg">
						<td class="first"><strong>Address Line 1</strong></td>
						<td class="last"><span id="sprytextfield2">
						  <label>
						    <input type="text"  size="30" name="line1" id="line1" value="<?php echo $row[10]; ?>" /> <span class="textfieldRequiredMsg">*</span>
					    </label>
					   </span></td>
					</tr>
                    
                    <tr class="bg">
						<td class="first"><strong>Address Line 2</strong></td>
						<td class="last"><span id="sprytextfield3">
						  <label>
						    <input type="text"  size="30" name="line2" id="line2" value="<?php echo $row[11]; ?>" /> <span class="textfieldRequiredMsg">*</span>
					    </label>
					   </span></td>
					</tr>
                    
                    <tr class="bg">
						<td class="first"><strong>Address Line 3</strong></td>
						<td class="last"><span id="sprytextfield4">
						  <label>
						    <input type="text"  size="30" name="line3" id="line3" value="<?php echo $row[12]; ?>" /> <span class="textfieldRequiredMsg">*</span>
					    </label>
					   </span></td>
					</tr>
                    
                    <tr class="bg">
						<td class="first"><strong>Address Line 4</strong></td>
						<td class="last"><span id="sprytextfield5">
						  <label>
						    <input type="text"  size="30" name="line4" id="line4" value="<?php echo $row[13]; ?>" /> <span class="textfieldRequiredMsg">*</span>
					    </label>
					   </span></td>
					</tr>
                    <tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
                    
                    <tr class="bg">
						<td class="first"><strong>Mobile No </strong></td>
						<td class="last"><span id="sprytextfield6">
						  <label>
						   <b> +94 </b><input type="number"  max="999999999" min="700000000" name="mobile" id="mobile" value="<?php echo $row[8]; ?>" /> <span class="textfieldRequiredMsg">*</span>
					    </label>
					   </span>
					   </td>
					</tr>
                    
                    
                     <tr class="bg">
						<td class="first"><strong>Contact No</strong></td>
						<td class="last">
						  <label>
						    <b> +94 </b><input type="number" max="999999999"  min="100000000"  name="contactNo" id="contactNo" value="<?php echo $row[3]; ?>" /> </label>
					   </td>
					</tr>
                    
                     <tr class="bg">
						<td class="first"><strong>E Mail Address</strong></td>
						<td class="last">
						  <label>
						  <input type="text"  size="20" name="email" id="email" value="<?php echo $row[9]; ?>" /> </label>
					   </td>
					</tr>
                    
                    
                       
                    <tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
                    
                     <tr class="bg">
						<td class="first"><strong>VAT Registered No</strong></td>
						<td class="last">
						  <label>
						    <input type="text"  size="20" name="vatNo" id="vatNo" value="<?php echo $row[4]; ?>" />
					    </label>
					   </td>
					</tr>
                    
                    <tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
                    
                     <tr>
						<td ><strong>Bank Name</strong></td>
					     <td><label><select name="bank_id" class="ComboBoxcesSmall"  id="bank_id" style="width:260px;">
						   
							 <?php 							
							$bankname = Projects::get_all_BankDetails();
							
							while($rowbank=mysql_fetch_array($bankname))
							{
							?>
						<option value='<?php echo $rowbank[0];  ?>'  <?php if($rowbank[1] == $row[5] ){ echo "selected=selected"; }?> > <?php echo $rowbank[1]; ?></option>
						     <?php }?>
                             
                             
	          </select>
	    </label> </td>
       
					</tr>
                    
                
                       <tr class="bg">
						<td class="first"><strong>Bank Branch</strong></td>
						<td class="last">
						  <label>
						    <input type="text"   name="bnk_branch_id" id="bnk_branch_id" value="<?php echo $row[6]; ?>" /> 
					    </label>
					 </td>
					</tr>
                    
                    <tr class="bg">
						<td class="first"><strong>Account No</strong></td>
						<td class="last">
						  <label>
						    <input type="number"   name="txtacctNo" id="txtacctNo" value="<?php echo $row[7]; ?>" /> 
					    </label>
					 </td>
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
                      <input type="hidden" name="vote_id" value='<?php echo $sup_id;?>' />
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
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");


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

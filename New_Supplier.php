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

$sfhq_id 	= $_SESSION['sfhqID'];
$isveh   = isset( $_GET['isveh'])?$_GET['isveh']:0;	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM :: BSMS</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

<script type="text/javascript">
function vehstatus(isveh){
document.location.href="New_Supplier.php?isveh="+isveh;
}
</script>


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
			
		</div>
		<div id="center-column">
			<div class="top-bar">
				<a href="Suppliers.php" class="button">&lt;&lt; Back</a>
				<h1 style="text-transform:uppercase">New Supplier</h1>
				<div class="breadcrumbs">
                
              <?php /*?>  <a href="Suppliers.php"> supplier/ </a>New supplier<?php */?>
                
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
				
                //	$result = Units::GetMaxidforGroupbySFHQ($sfhq_id);
					//echo $result;
					//$row=$result[0];
					
				
					/*switch($sfhq_id)
					{
					case 0:
					$sf = 'S/TM/'.$row[1].'/';
					break;
					
					case 1:
					$sf = 'S/S/'.$row[1].'/';
					break;
					
					case 2:
					$sf = 'S/W/'.$row[1].'/';
					break;
					
					case 3:
					$sf = 'S/E/'.$row[1].'/';
					break;
					
					case 4:
					$sf = 'S/J/'.$row[1].'/';
					break;
					
					case 5:
					$sf = 'S/KLN/'.$row[1].'/';
					break;
					
					case 6:
					$sf = 'S/MLT/'.$row[1].'/';
					break;
					
					case 7:
					$sf = 'S/C/'.$row[1].'/';
					break;
														
					}
					
					
					if($row[0]=='')
					{
					$sf =$sf.'1';
					}
					else 
					{
					$x = $row[0]+1;
					$sf =$sf.$x;
					}
					*/
				
				?>
		 <form id="form1" name="form1" method="post" action="controller/vote.controller.php?mode=savesup">
          <table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
                    	
						<th class="full" colspan="2">Register New Supplier</th>
					</tr>
				  <?php /*?><tr>
						<td width="172" class="first"><strong>Supplier code</strong></td>
					    <td class="last">
					    <label>
                          <input name="regiment_name" readonly="readonly"  type="text" class="textBoxces" id="regiment_name" size="20" value="<?php echo $sf ?>"  />
                      </label>
</td>
			</tr>
            
       <?php */?>  <tr>
						<td width="198" class="first" ><strong>Is Vehicle</strong></td>
					 	
                        <td width="550" class="last">
                        <label>
                         
		<select name="isveh" style="width:150px" id="isveh" onchange="vehstatus(this.value)">
		<option value="0" <?php if("0" == $isveh ){ echo "selected=selected"; }?>>Not a Vehicle</option>
        <option value="1" <?php if("1" == $isveh ){ echo "selected=selected"; }?>>Yes Its a Vehicle</option>
                 
						  
				</select>
				     </label>
                          
                       
			          </td>
					</tr>
                    
                    <?php  if($isveh==1){  ?>
                    <tr class="bg">
						<td class="first"><strong>Civil Vehicle Number <span class="last"></span></strong></td>
						<td class="last"><span id="sprytextfield2">
						  <label>
						    <select name="pro" class="ComboBoxcesSmall" id="pro" style="width:60px;">
                            <option value="NP">NP</option>
                            <option value="EP">EP</option>
                            <option value="SP">SP</option>
                            <option value="WP">WP</option>
                            <option value="CP">CP</option>
                            <option value="NW">NW</option>
                            <option value="NC">NC</option>
                            <option value="UP">UP</option>
                            <option value="SG">SG</option>
                            </select> 
                            
                            
                            <span class="textfieldRequiredMsg">*</span>
					    </label>
                        
                          <label>
						    <input type="text"  size="3" name="engnum" id="engnum" /> <span class="textfieldRequiredMsg">*</span>
					    </label>
                        
                          <label>
						    <input type="text"  size="10" name="veh_number" id="veh_number" /> <span class="textfieldRequiredMsg">*</span>
					    </label>
					   </span>
                       
                       <b>Ex :- WP CAK 4435</b>
                       
                       </td>
					</tr>
                    
                      

                    
                   
                   
                      <tr class="bg">
						<td class="first"><strong>NIC Number</strong></td>
						<td class="last">
                        
                        <span id="sprytextfield7">
				<label>
                      <input name="nic" type="text" pattern="^(?:19|20)?\d{2}[0-9]{10}|[0-9]{9}[X|V]$" />
                      <span class="textfieldRequiredMsg">*</span>
					    </label>
					   </span> 
                
              <b>Ex :- 881033831V or 198810303831</b>
                       </td>
					</tr> 
                    
                     
                      <tr class="bg">
						<td class="first"><strong>Veh Running Place</strong></td>
						<td><label>                        
                         
                         <select name="vrp" class="ComboBoxcesSmall" id="vrp" style="width:250px;">
						   
							 <?php 							
							$bankname = Projects::get_VehRunPlace($sfhq_id);
							
							foreach ($bankname as $rowbank) {?>
						     <option value="<?php echo $rowbank[0];  ?>" > <?php echo $rowbank[1]; ?></option>
						     <?php }?>
	          </select>
	    </label> </td>
					</tr> 
                    
                    
                    
      <!--   $reg  /^([0-9]{9}[x|X|v|V]|[0-9]{12})$/m   -->
                    
                    
                    
            <?php } ?>
            
					<tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
                    
					<tr class="bg">
						<td class="first"><strong>Supplier Name</strong></td>
						<td class="last"><span id="sprytextfield1">
						  <label>
						    <input type="text"  size="50" name="txtdescription" id="txtdescription" /> 
                            <span class="textfieldRequiredMsg">*</span>
					    </label>
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
						    <input type="text"  size="30" name="line1" id="line1"  /> <span class="textfieldRequiredMsg">*</span>
					    </label>
					   </span></td>
					</tr>
                    
                    <tr class="bg">
						<td class="first"><strong>Address Line 2</strong></td>
						<td class="last"><span id="sprytextfield3">
						  <label>
						    <input type="text"  size="30" name="line2" id="line2"  /> <span class="textfieldRequiredMsg">*</span>
					    </label>
					   </span></td>
					</tr>
                    
                    <tr class="bg">
						<td class="first"><strong>Address Line 3</strong></td>
						<td class="last"><span id="sprytextfield4">
						  <label>
						    <input type="text"  size="30" name="line3" id="line3" /> <span class="textfieldRequiredMsg">*</span>
					    </label>
					   </span></td>
					</tr>
                    
                    <tr class="bg">
						<td class="first"><strong>Address Line 4</strong></td>
						<td class="last"><span id="sprytextfield5">
						  <label>
						    <input type="text"  size="30" name="line4" id="line4"  /> <span class="textfieldRequiredMsg">*</span>
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
						   <b> +94 </b><input type="text" pattern="^7[0|1|2|4|5|6|7|8]\d{7}$" title="Nine numbers with leading 7. No zero at the beginning. Mbile numbers only." max="999999999" min="700000000" name="mobile" id="mobile" /> <span class="textfieldRequiredMsg">*</span>
					    </label>
					   </span>
					   <b>Ex :- 711231234</b>
					   </td>
					</tr>
                    
                     <tr class="bg">
						<td class="first"><strong>Land Phone No</strong></td>
						<td class="last">
						  <label>
						    <b> +94 </b><input type="text" pattern="^((11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|91)(0|2|3|4|5|7|9)|7(0|1|2|4|5|6|7|8)\d)\d{6}$" title="Nine numbers. No zero at the beginning. Mobile or landline numbers" max="999999999"  min="100000000"   name="contactNo" id="contactNo" /> 
					    </label>
					 <b>Ex :- 114012345 or 711231234</b>
					   </td>
					</tr>
                    
                  
                    
                    
                    
                    
                    
                      <tr class="bg">
						<td class="first"><strong>Email Address</strong></td>
						<td class="last">
						  <label>
						    <input type="text" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$"  size="30" name="email" id="email" /> 
					    </label>
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
						    <input type="text"  size="20" name="vatNo" id="vatNo" />
					    </label>
					  </td>
					</tr>
                    
                    <tr class="bg">
					  <td class="first">&nbsp;</td>
					  <td class="last">&nbsp;</td>
		    		</tr>
                    
                     <tr>
						<td ><strong>Bank Name</strong></td>
					     <td><label>
                         
                         
                         <select name="bank_id" class="ComboBoxcesSmall" id="bank_id" style="width:260px;">
						   <option value=0>--Select Bank--</option>
							 <?php 							
							$bankname = Projects::get_all_BankDetails();
							
							foreach ($bankname as $rowbank) {?>
						     <option value="<?php echo $rowbank[0];  ?>" > <?php echo $rowbank[1]; ?></option>
						     <?php }?>
	          </select>
	    </label> </td>
       
					</tr>
                    
                    
                    
                    
                     <?php /*?> <tr>
						<td ><strong>Bank Branch</strong></td>
					     <td><label><select name="bnk_branch_id" class="ComboBoxcesSmall" id="bnk_branch_id" style="width:260px;">
						    <option value=0>--Select Branch--</option>
							 <?php 							
							$bankloc = Projects::get_all_Banklocation();
							
							while($banklocation = mysql_fetch_array($bankloc)){?>
						    <option value="<?php echo $banklocation[0];  ?>" > <?php echo $banklocation[1]; ?></option>
						    <?php }?>
	          </select>
	    </label> </td>
       
					</tr><?php */?>
                    
                    
                    
                         
                    <tr class="bg">
						<td class="first"><strong>Bank Branch</strong></td>
						<td class="last">
						  <label>
						    <input type="text"  name="bnk_branch_id" id="bnk_branch_id" /> 
					    </label>
					   </td>
					</tr>
                    
                    
                    
                    
                    <tr class="bg">
						<td class="first"><strong>Account No</strong></td>
						<td class="last">
						  <label>
						    <input type="number"  name="txtacctNo" id="txtacctNo" /> 
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
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");



//-->
</script>
</body>
</html>

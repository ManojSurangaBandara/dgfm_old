<?php
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/progress_report.class.php');



	$project_id = $_GET['q']; 
	$resultproject 	= ProjectsProgress :: GetProjectData($project_id);
	$rowproject	= mysql_fetch_array($resultproject);
	
	 
	if($rowproject[9]==2)
	{		
	$resultrunc_tembill 	= ProjectsProgress :: Truncate_tembill();
	
?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />


<table cellpadding="0" cellspacing="0">
<tr >
<td class="first" width="190"><strong>Job Number</strong></td>
						<td class="last"><label>
						  <input type="text" name="txtjobnumber" disabled="disabled" id="txtjobnumber" value="<?php echo $rowproject[16]; ?>" />
					    </label></td>
					</tr>
                  
<tr class="bg">
<td class="first" width="190"><strong>Location</strong></td>
						<td class="last"><label>
						  <input type="text" name="txtprlocation" disabled="disabled" id="txtprlocation" value="<?php echo $rowproject[3]; ?>" />
					    </label></td>
					</tr>
					<tr >
						<td class="first"><strong>Start Date<span class="last"></span></strong></td>
						<td class="last"><label>
						  <input type="text" name="txtprstartdate" disabled="disabled" id="txtprstartdate" value="<?php echo $rowproject[4]; ?>" />
					    </label></td>
					</tr>
					<tr class="bg" >
						<td class="first"><strong>End  Date</strong></td>
						<td class="last"><label>
						  <input type="text" name="txtprenddate" disabled="disabled" id="txtprenddate" value="<?php echo $rowproject[5]; ?>" />
					    </label></td>
					</tr>
					<tr >
					  <td class="first"><strong>Remarks</strong></td>
					  <td class="last"><textarea name="txaproject_description" disabled="disabled" cols="45" rows="5" class="textArea" id="txaproject_description"><?php echo $rowproject[6]; ?></textarea></td>
		    </tr>
					<?php /*?><!--<tr class="bg">
					  <td class="first"><strong>Allocated ESS </strong></td>
					  <td class="last">
                      <select name="cmb_gecentre[]" size="5" multiple="multiple" disabled="disabled" class="LisrBoxces" id="cmb_gecentre">
					    <?php 
							$gecen = explode(",", $rowproject[7]);
							$gecentre = ProjectsProgress :: GetGEName($_SESSION['unitID']);
							while($rowgecentre=mysql_fetch_array($gecentre)){
								$sel = "";
								for ($i=0; $i < sizeof($gecen); $i++) {
									if ($gecen[$i] == $rowgecentre[0]){
									$sel = " selected";
									}
								}	
							?>
					    <option value="<?php echo $rowgecentre[0]; ?>" <?php echo $sel; ?>><?php echo $rowgecentre[1]; ?></option>
					    <?php } ?>
				      </select>
            </td>
		    </tr>--><?php */?>
					<tr class="bg">
					  <td class="first"><strong> Name of Contractor</strong></td>
					  <td class="last"><label>
					    <input type="text" name="txtprnameofcontractor" disabled="disabled" id="txtprnameofcontractor" value="<?php echo $rowproject[8]; ?>"  />
				      </label></td>
		    </tr>
            
            
              <tr >
					  <td valign="top"  class="first"><strong>Awarded Sum Rs:</strong></td>
					  <td class="last"><span id="sprytextfield1">
                      <label>
                        <input type="text" name="txtawardsum" id="txtawardsum" />
                      </label>
                      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
		    </tr>
            
<tr >
					  <td valign="top"  class="first"><strong>Allocated Amount In 
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
					    <input type="text" name="txtallocatedamount" id="txtallocatedamount" />
		      </label></td>
		    </tr>
					<tr class="bg" >
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
					    <input type="text" name="txtamountpaid" id="txtamountpaid" />
					  </label></td>
		    </tr>
	
			
            <tr >
					  <td height="27" valign="top" class="first"><strong>Bills Paid</strong></td>
					  <td class="last"><a href="#"  onclick="window.open('BillsDetails.php?id=id','Windowname','width=800,top=200,left=250,resizable,scrollbars,height=300');  return false;">Add bills</a></td>
		    </tr>
            
           
			 </table>

<?php } else {  ?>

<table cellpadding="0" cellspacing="0">


<tr >
<td class="first" width="190"><strong>Job Number</strong></td>
						<td class="last"><label>
						  <input type="text" name="txtjobnumber" disabled="disabled" id="txtjobnumber" value="<?php echo $rowproject[16]; ?>" />
					    </label></td>
					</tr>
                    


<tr class="bg">
<td class="first" width="190"><strong>Allocated Letter Ref No</strong></td>
						<td class="last"><label>
						  <input type="text" name="txtltRefNo" disabled="disabled" id="txtltRefNo" value="<?php echo $rowproject[10]; ?>" />
					    </label></td>
					</tr>
                    
                    

<tr class="bg">
<td class="first"><strong>Date</strong></td>
						<td class="last"><label>
						  <input type="text" name="txtprdate" disabled="disabled" id="txtprdate" value="<?php echo $rowproject[11]; ?>" />
					    </label></td>
					</tr>
                    
                    


<tr class="bg">
<td class="first"><strong>Location</strong></td>
						<td class="last"><label>
						  <input type="text" name="txtprlocation" disabled="disabled" id="txtprlocation" value="<?php echo $rowproject[3]; ?>" />
					    </label></td>
					</tr>
                    
                    
                    
                    
<tr class="bg">
<td class="first"><strong>Estimated Amount Rs ;</strong></td>
						<td class="last"><label>
						  <input type="text" name="txtesamount" disabled="disabled" id="txtesamount" value="<?php echo number_format($rowproject[12],'2','.',',') ; ?>" />
					    </label></td>
					</tr>
                    
                          
<tr class="bg">
<td class="first"><strong>Allocated Amount Rs :</strong></td>
						<td class="last"><label>
						  <input type="text" name="txtalamount" disabled="disabled" id="txtalamount" value="<?php echo number_format($rowproject[2],'2','.',',') ; ?>" />
					    </label></td>
					</tr>
                    
                    
                                         
<tr class="bg">
<td class="first"><strong>G 69 No</strong></td>
						<td class="last"><label>						
<textarea name="txtg69no" cols="20" rows="5" disabled="disabled" class="textArea" id="txtg69no" ><?php echo $rowproject[13]; ?></textarea>
                        </label></td>
					</tr>
                    
                   
                    
					
					<tr class="bg">
						<td class="first"><strong>Dates</strong></td>
						<td class="last"><label>					    
     <textarea name="txtdates" cols="20" rows="5" disabled="disabled" class="textArea" id="txtdates" ><?php echo $rowproject[14]; ?></textarea>
                        </label></td>
					</tr>
                    
                    
                    
                    
                    
					<tr>
					  <td class="first" ><strong>T/B Approval Yes/No</strong></td>
					  <td class="last"><textarea name="txttbapproval" cols="20" rows="1" class="textArea" id="txttbapproval"></textarea></td>
		    </tr>
            		
					<tr class="bg">
					  <td height="27" valign="top" class="first"><strong>Dates of Approval By T/B </strong></td>
					  <td class="last"><label>					   
                         <textarea name="txtdateoftbaproval" cols="20" rows="5"  class="textArea" id="txtdateoftbaproval" ></textarea>
				      </label></td>
		    </tr>
			 </table>
<?php } ?>
<input name="txt_project_type" type="hidden" value="<?php echo $rowproject[9]; ?>" />




<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "currency");
//-->
</script>

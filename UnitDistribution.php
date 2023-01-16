
    
   
                      
                      
                      
                      
                      
  <?php
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/progress_report.class.php');
require_once('classes/Bills.php');
require_once('classes/projects.class.php');


	$brach_id = $_GET['q']; 
	$sfhq_id  = $_GET['r'];
	$unit  	  = $_GET['s'];
	
	
	
?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />





<table cellpadding="0" cellspacing="0">

	<tr class="bg">
   <?php if($brach_id != 5 ){?> 
	<td class="last">
	
    <select name="allocated_regiment">
                        <?php $result = Projects::get_all_regiment_namesDGFM1($brach_id,$sfhq_id); ?>
                        <?php 
						while($row1 = mysql_fetch_array($result))
						{
						?>
                      
                  <option value='<?php echo $row1[0]; ?>' <?php if($row1[0] == $unit ){ echo "selected=selected"; }?> ><?php echo $row1[5]; ?></option>
                            
                       
                        <?php } ?>
                      </select>
					
    </td>
	   <?php } ?>
	  <td width="77%" >	  
	  <?php if($brach_id == 5 ){?> 
	<input type="text" style="width:350px" name="details"  id="details"  />
	
	
	
					 <?php $result = Projects::get_all_regiment_namesDGFM($sfhq_id,$brach_id); ?>
                        <?php 
						while($row2 = mysql_fetch_array($result))
						{
						$unit = $row2[0];
						   
						}
						
					 ?>
					<input type="hidden"  name="unit" style="width:350px"   id="unit" value="<?php echo $unit;  ?>"  />
	
	
	  <?php } ?>
	  </td>
                  
	</tr>
					
 </table>
             

<?php  /*?><input name="txt_project_type" type="hidden" value="<?php echo $rowproject[9]; ?>" /><?php */?>


        
        
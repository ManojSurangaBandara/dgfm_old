<?php
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/progress_report.class.php');
require_once('classes/Bills.php');




	$vote_id = $_GET['q'] ?? 0; 
	$arr = $_GET['ar'] ?? "";
	$resultproject 	= Bills :: GetVoteData($vote_id);
	$rowproject = $resultproject[0] ?? array();
	
	 
	
	
?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />





<table cellpadding="0" cellspacing="0">

	<tr class="bg">

	<td class="last">
    <label>
	<input type="text" name="vote_name3"  id="vote_name3" style="width:430px" value="<?php if(isset($rowproject[0])) echo $rowproject[0]." : Rs:  ".number_format($rowproject[1],'2','.',''); ?>" />
	</label>
    </td>
                        
    <td class="last">
    <label>
	<input type="text" name="amount3"  id="amount3" style="width:80px" value="<?php echo $arr; ?>" />
	</label>
    </td>
                        
	</tr>
					
 </table>
             

<?php /*?><input name="txt_project_type" type="hidden" value="<?php echo $rowproject[9]; ?>" /><?php */?>




<script type="text/javascript">
<!--

//-->
</script>

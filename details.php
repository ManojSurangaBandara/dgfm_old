<?php
	error_reporting (0);
	$brach_id = $_GET['q']; 
	$details = $_GET['r'];
	if($brach_id == 5){
	
?>
	<input type="text" style="width:350px" name="details"  id="details" value="<?php echo $details; ?>" />
<?php }?>
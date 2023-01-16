<?php 
$msg	=	isset( $_GET['msg'] )?$_GET['msg']:'';
$msg	=	isset( $_POST['msg'])?$_POST['msg']:$msg;

$display_msg = '';

switch($msg)
{
	
	case '1':
	$display_msg = "Inserted successfuly.";
	break;
	
	case '2':
	$display_msg = "Cannot insert the details.";
	break;
	
	case '3':
	$display_msg = "Unit details successfuly updated.";
	break;
	
	case '4':
	$display_msg = "Cannot update unit details.";
	break;
	
	case '5':
	$display_msg = "Successfully deleted the unit.";
	break;
	
	case '6':
	$display_msg = "Cannot delete unit.";
	break;

	case '7':
	$display_msg = "Successfuly Assigned the Votes.";
	break;
	
	case '8':
	$display_msg = "Cannot Assign the Votes.";
	break;
	
	case '9':
	$display_msg = "Mobile & Contact number 9 digits & numeric only";
	break;
	
}
echo "<b>".$display_msg."</b>";
?>
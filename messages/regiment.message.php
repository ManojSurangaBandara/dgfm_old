<?php 
$msg	=	isset( $_GET['msg'] )?$_GET['msg']:'';
$msg	=	isset( $_POST['msg'])?$_POST['msg']:$msg;

$display_msg = '';

switch($msg)
{
	
	case '1':
	$display_msg = "Regiment inserted successfuly.";
	break;
	
	case '2':
	$display_msg = "Cannot insert Regiment details.";
	break;
	
	case '3':
	$display_msg = "Regiment details successfuly updated.";
	break;
	
	case '4':
	$display_msg = "Cannot update Regiment details.";
	break;
	
	case '5':
	$display_msg = "Successfully deleted the Regiment.";
	break;
	
	case '6':
	$display_msg = "Cannot delete Regiment.";
	break;

}
echo "<b>".$display_msg."</b>";
?>
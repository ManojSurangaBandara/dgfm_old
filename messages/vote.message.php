<?php 
$msg	=	isset( $_GET['msg'] )?$_GET['msg']:'';
$msg	=	isset( $_POST['msg'])?$_POST['msg']:$msg;

$display_msg = '';

switch($msg)
{
	
	case '1':
	$display_msg = "Vote inserted successfully.";
	break;
	
	case '2':
	$display_msg = "Cannot insert Vote details.";
	break;
	
	case '3':
	$display_msg = "Vote details successfully updated.";
	break;
	
	case '4':
	$display_msg = "Cannot update Vote details.";
	break;
	
	case '5':
	$display_msg = "Successfully deleted the Vote.";
	break;
	
	case '6':
	$display_msg = "Cannot delete Vote.";
	break;
	
	
	case '7':
	$display_msg = "Supplier details successfully updated.";
	break;
	
	case '8':
	$display_msg = "Cannot update Supplier details.";
	break;
	
	
	case '9':
	$display_msg = "Successfully deleted the Supplier.";
	break;
	
	case '10':
	$display_msg = "Cannot delete the Supplier.";
	break;
	
	case '11':
	$display_msg = "Supplier inserted successfully.";
	break;
	
	case '12':
	$display_msg = "Cannot insert Supplier details.";
	break;

}
echo "<b>".$display_msg."</b>";
?>
<?php 
$msg	=	isset( $_GET['msg'] )?$_GET['msg']:'';
$msg	=	isset( $_POST['msg'])?$_POST['msg']:$msg;

$display_msg = '';

switch($msg)
{
	
	case '1':
	$display_msg = "ESS Cannot Be empty.";
	break;
	
	case '2':
	$display_msg = "ESS inserted successfuly.";
	break;
	
	case '3':
	$display_msg = "Cannot insert ESS details.";
	break;
	
	case '4':
	$display_msg = "ESS details successfuly updated.";
	break;
	
	case '5':
	$display_msg = "Cannot update ESS details.";
	break;
	
	case '6':
	$display_msg = "Successfully deleted the ESS.";
	break;
	
	case '7':
	$display_msg = "Cannot delete the ESS.";
	break;
	
	case '8':
	$display_msg = "Successfully inserted money allocation.";
	break;
	
	case '9':
	$display_msg = "Cannot insert money allocation.";
	break;
	
	case '10':
	$display_msg = "Successfully updated money allocation.";
	break;
	
	case '11':
	$display_msg = "Cannot update money allocation.";
	break;


	case '12':
	$display_msg = "Successfully deleted money allocation.";
	break;
	
	case '13':
	$display_msg = "Cannot delete money allocation.";
	break;

	case '14':
	$display_msg = "Fund has been not allocated for this vote";
	break;

	case '15':
	$display_msg = "Your allocation is exceeding the Budget & Finance allocation";
	break;


}

echo "<b>".$display_msg."</b>";
?>
<?php 
$msg	=	isset( $_GET['msg'] )?$_GET['msg']:'';
$msg	=	isset( $_POST['msg'])?$_POST['msg']:$msg;

$display_msg = '';

switch($msg)
{
	
	case '1':
	$display_msg = "Bill Details inserted successfully.";	
	break;
	
	case '2':
	$display_msg = "Cannot insert Bill details.";
	break;
	
	case '3':
	$display_msg = "Project details successfully updated.";
	break;
	
	case '4':
	$display_msg = "Cannot update project details.";
	break;
	
	case '5':
	$display_msg = "Successfully deleted the project.";
	break;
	
	case '6':
	$display_msg = "Cannot delete the project.";
	break;
	
	case '7':
	$display_msg = "Successfully saved the project progress report.";
	break;
	
	case '8':
	$display_msg = "Cannot saved the project progress report.";
	break;
	
	case '9':
	$display_msg = "Successfully deleted the Progress report.";
	break;
	
	case '10':
	$display_msg = "Cannot delete the project report.";
	break;
	
	case '11':
	$display_msg = "Successfully sent the project report.";
	break;
	
	case '12':
	$display_msg = "Cannot send the project report.";
	break;
	
	case '13':
	$display_msg = "Successfully canceled the project.";
	break;
	
	case '14':
	$display_msg = "Cannot cancel the project.";
	break;
	
	case '15':
	$display_msg = "You have not privilege to send reports.";
	break;

}
echo "<b>".$display_msg."</b>";
?>
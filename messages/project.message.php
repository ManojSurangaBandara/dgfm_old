<?php 
$msg	=	isset( $_GET['msg'] )?$_GET['msg']:'';
$msg	=	isset( $_POST['msg'])?$_POST['msg']:$msg;

$display_msg = '';

switch($msg)
{
	
	case '1':
	$display_msg = "Bill inserted successfully.";	
	break;
	
	case '2':
	$display_msg = "Cannot inserted Bill details.";
	break;
	
	case '3':
	$display_msg = "Deactivated successfully.";
	break;
	
	case '4':
	$display_msg = "Cannot Deactivate the Account.";
	break;
	
	case '5':
	$display_msg = "Successfully deleted the Bill.";
	break;
	
	case '6':
	$display_msg = "Cannot delete the Bill.";
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
	$display_msg = "Successfully canceled the bill.";
	break;
	
	case '14':
	$display_msg = "Cannot cancel the Voucher.";
	break;
	
	case '15':
	$display_msg = "You have not privilege to send reports.";
	break;
	
	case '16':
	$display_msg = "Voucher details successfully activated.";
	break;
	
	case '17':
	$display_msg = "Voucher details not activated.";
	break;
	
	case '18':
	$display_msg = "Voucher can't settle with this Login.";
	break;
	
	case '19':
	$display_msg = "Successfully settled the bill.";
	break;
	
	
	
	case '20':
	$display_msg = "Bills can't settle now.";
	break;
	
	
	case '21':
	$display_msg = "Successfully returned the voucher.";
	break;
	
	case '22':
	$display_msg = "Cannot return the voucher.";
	break;
	
	case '23':
	$display_msg = "You have not done any voucher updates.";
	break;
	
	case '24':
	$display_msg = "Successfully activated the voucher.";
	break;
	
	case '25':
	$display_msg = "You have not done any voucher updates.";
	break;
	
	case '26':
	$display_msg = "You have not done any voucher updates.";
	break;
	
	case '27':
	$display_msg = "Invoice date cannot be greater than received date.";
	break;

	case '28':
	$display_msg = "Successfully Unsettled the bill.";
	break;
	
	case '29':
	$display_msg = "Successfully Updated the Details.";
	break;
	
	case '30':
	$display_msg = "Updation failed.";
	break;
	
	case '31':
	$display_msg = "Cannot Update Check Details";
	break;
	
	case '32':
	$display_msg = "Password Reset successful";
	break;
	
	case '33':
	$display_msg = "Cannot Reset Password";
	break;

	case '34':
	$display_msg = "Duplicate Vote Codes";
	break;
	
	case '35':
	$display_msg = "Incorrect Operational Controller";
	break;

	case '36':
	$display_msg = "Invoice Number Exist";
	break;
}
echo "<b>".$display_msg."</b>";
?>
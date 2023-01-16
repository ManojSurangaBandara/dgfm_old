<?php 
$msg	=	isset( $_GET['msg'] )?$_GET['msg']:'';
$msg	=	isset( $_POST['msg'])?$_POST['msg']:$msg;

$display_msg = '';

switch($msg)
{
	
	case '1':
	$display_msg = "New user inserted successfully.";
	echo "<b>".$display_msg."</b>";
	break;
	
	case '2':
	$display_msg = "Cannot insert new user.";
	echo "<b>".$display_msg."</b>";
	break;
	
	case '3':
	$display_msg = "User details successfully updated.";
	echo "<b>".$display_msg."</b>";
	break;
	
	case '4':
	$display_msg = "Cannot update user details.";
	echo "<b>".$display_msg."</b>";
	break;
	
	case '5':
	$display_msg = "Successfully edited user details.";
	echo "<b>".$display_msg."</b>";
	break;
	
	case '6':
	$display_msg = "Cannot edit user details.";
	echo "<b>".$display_msg."</b>";
	break;
	
	case '7':
	$display_msg = "Deleted user details.";
	echo "<b>".$display_msg."</b>";
	break;
	
	case '8':
	$display_msg = "Cannot delete user details.";
	echo "<b>".$display_msg."</b>";
	break;

	case '9':
	$display_msg = "User name exist please select another user name.";
	echo "<b>".$display_msg."</b>";
	break;
	
	case '10':
	$display_msg = "You have no authority to create new account.";
	echo "<b>".$display_msg."</b>";
	break;


}
//echo "<b>".$display_msg."</b>";
?>

<?php 
$msg	=	isset( $_GET['msg'] )?$_GET['msg']:'';
$msg	=	isset( $_POST['msg'])?$_POST['msg']:$msg;

$display_msg = '';

switch($msg)
{
	
	case '1':
	$display_msg = "Required field cannot be left blank.";
	break;
	
	case '2':
	$display_msg = "The username or password you entered is incorrect.";
	break;
	
	case '3':
	$display_msg = "Session has been expired , please login to the system.";
	break;

}
echo "<span class='error'>".$display_msg."</span>";
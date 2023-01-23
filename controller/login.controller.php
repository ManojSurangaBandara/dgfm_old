<?php 
@session_start(); 

include("Firewall.php");

require_once('../classes/login.class.php');
require_once('../classes/login.class.php');
require_once('../classes/login_details.class.php');


$mode	=	isset( $_GET['mode'] )?$_GET['mode']:'';
$mode	=	isset( $_POST['mode'])?$_POST['mode']:$mode;

switch($mode)
{
	case 'login':
	 	$user			=	isset( $_POST['user'])?$_POST['user']:$user;
		$pass			=	isset( $_POST['pass'])?$_POST['pass']:$pass;
		$usertype		=   isset( $_POST['cmb_type'])?$_POST['cmb_type']:$usertype;        //1 2 3 4 
		$sfhq_id		=	isset( $_POST['cmb_sfhq'])?$_POST['cmb_sfhq']:0; 
		$branch_id		=   isset( $_POST['cmb_branch'])?$_POST['cmb_branch']:0; 		
		$thisYear       =   date('Y');
		
		
		$log_year		=   isset( $_POST['cmb_allocated_year'])?$_POST['cmb_allocated_year']:$log_year;
		
		
		$_SESSION['log_year'] = $log_year; 	
		
		require_once('../includes/config.php');
		require_once('../classes/db_con.php');
		
		$Firewall = new Firewall(); 
		$Firewall->SecureUris();
		$usertype = $Firewall->getClean($usertype);
		$user = $Firewall->getClean($user);
		
			
		
		$pass			=	base64_encode($pass);
		
		if(($user=='') || ($pass=='')){
			header("Location:../index.php?msg=1");	
		}
		if(!is_numeric($usertype) ){
			header("Location:../index.php?msg=1");	
		}
	
			$tests = array($user);
		
		$illegal = "#$%^&*()+=-[]';,/{}|:<>?~";
		
		foreach ($tests as $test) {
			if(strpbrk($test, $illegal)=== true){
				header("Location:../index.php?msg=1");	
			}
			else 
			{
				$authorised = Login :: getRecord($user,$pass,$usertype,$sfhq_id,$branch_id);
			}
			
		}
		
		//print_r($authorised); die();
		
			if($authorised==true)
			{
				
				$_SESSION['userID'] 	= $authorised['user_id'];
				$_SESSION['username'] 	= $authorised['user_name'];
				$_SESSION['userType'] 	= $authorised['user_type'];
				$_SESSION['sfhqID']		= $authorised['sfhq_id'];
				$_SESSION['branchID']	= $authorised['branch_id'];
				$_SESSION['Isprivilege_user']	= $authorised['Isprivilege_user'];
				$_SESSION['name']		= $authorised['name'];				
				$_SESSION['log_year'] 	= $log_year;
				
				
				$log_year	= $_SESSION['log_year'];					
				$username 	= $_SESSION['username'];
				$user_id 	= $_SESSION['userID'];
				$sfhq_id 	= $_SESSION['sfhqID'];
				$branch_id  = $_SESSION['branchID'];
				$user_type_id = $_SESSION['userType'];
				$Isprivilege_user = $_SESSION['Isprivilege_user'];
				
				############# LOGIN DETAILS ############################
				
				if($authorised['user_type'] == 1)
				{
					//login_details::insert_username_logintime($username, $user_id, $unit_id, $user_type);
					//header("Location:../admin_home.php");
					header("Location:../ViewAllUsers.php");		
				}
				else if($authorised['user_type'] == 2)
				{
					//login_details::insert_username_logintime($username, $user_id, $unit_id, $user_type);
					header("Location:../units.php");	
				}
				else if($authorised['user_type'] == 3)
				{
					
				//	login_details::insert_username_logintime($username, $user_id, $unit_id, $user_type);
					header("Location:../projects.php");	
				}
				else if($authorised['user_type'] == 4)
				{
					///login_details::insert_username_logintime($username, $user_id, $unit_id, $user_type);
					header("Location:../projects.php");	
				}
				else if($authorised['user_type'] == 5)
				{
				//echo $unit_id;
					//login_details::insert_username_logintime($username, $user_id, $unit_id, $user_type);
					header("Location:../Chiefacc.php");	
				}
				
				else if($authorised['user_type'] == 6)
				{
				//echo $unit_id;
					//login_details::insert_username_logintime($username, $user_id, $unit_id, $user_type);
					header("Location:../displaymoneyallocation.php");	
				}
				
				else if($authorised['user_type'] == 7)
				{
					//login_details::insert_username_logintime($username, $user_id, $unit_id, $user_type);
					header("Location:../PsoView.php");	
				}
				
				else if($authorised['user_type'] == 8)
				{
					
					header("Location:../ProContView.php");	
				}
				
				else if($authorised['user_type'] == 9)
				{
					
					header("Location:../PrintSection.php");	
				}
				
				else if($authorised['user_type'] == 10)
				{
					
					header("Location:../SFHQPrintSec.php");	
				}
				
				############# LOGIN DETAILS ############################
				
			}
			elseif($authorised==false)
			{
				unset($_SESSION['log_year']);
				//session_destroy($_SESSION['log_year']);
				header("Location:../index.php?msg=2");	
			}
	break;
	
	case 'logout':
	
		//login_details::insert_logouttime();
		if(isset($_SESSION['userID']))
		{
			session_unset();
			session_destroy();
			unset($_SESSION['log_year']);
			//session_destroy($_SESSION['log_year']);
			header("Location:../index.php");		
		}
	
	break;
}

?>
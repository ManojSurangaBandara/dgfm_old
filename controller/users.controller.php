<?php 
require_once('../includes/config.php');
require_once('../classes/db_con.php');
require_once('../classes/users.class.php');

$mode	=	isset( $_GET['mode'] )?$_GET['mode']:'';
$mode	=	isset( $_POST['mode'])?$_POST['mode']:$mode;

switch($mode)
{
	case 'login':
	 	$user	=	isset( $_POST['user'])?$_POST['user']:$user;
		$pass	=	isset( $_POST['pass'])?$_POST['pass']:$pass;
		$usertype = isset( $_POST['cmb_type'])?$_POST['cmb_type']:$usertype;
		$pass	=	base64_encode($pass);
		
		if(($user=='') || ($pass=='')){
			header("Location:../index.php?msg=1");	
		}
	
		$authorised = Login :: getRecord($user,$pass,$usertype);
			if($authorised==true)
			{
				//echo base64_decode($authorised['pas']); exit;
				//$lastlogin = User :: LastLOgindate($user,$pass);
				$_SESSION['userID'] 	= $authorised['user_id'];
				$_SESSION['username'] 	= $authorised['user_name'];
				$_SESSION['userType'] 	= $authorised['user_type'];	
				
				header("Location:../home.php");	
			}
			elseif($authorised==false)
			{
				header("Location:../index.php?msg=2");	
			}
	break;
	
	case 'logout':
	
		if(isset($_SESSION['userID']))
		{
			session_unset();
			session_destroy();
			header("Location:../index.php");		
		}
	
	break;
	
	
		case 'saveUser':
		  		 
		$isprivilege	=	isset( $_POST['isprivilege'])?$_POST['isprivilege']:$isprivilege;	
		$typeid	  		=	isset( $_POST['typeid'])?$_POST['typeid']:$typeid;
		$branchsfhq	  	=	isset( $_POST['branchsfhq'])?$_POST['branchsfhq']:$branchsfhq;
		$txtusername	=	isset( $_POST['txtusername'])?$_POST['txtusername']:$txtusername;			
		$txtpassword	=	isset( $_POST['txtpassword'])?$_POST['txtpassword']:$txtpassword;		
		$myname			=	isset( $_POST['myname'])?$_POST['myname']:$myname;			
		$nic 	  		= 	isset( $_POST['nic'])?$_POST['nic']:$nic;	
		$tele 	  		= 	isset( $_POST['tele'])?$_POST['tele']:$tele;
		$email 	  		= 	isset( $_POST['email'])?$_POST['email']:$email;	
		
		$pass			=	base64_encode($txtpassword);
		
		$user_id		= $_SESSION['userID'];
		$today        	= date("Y-m-d"); 
	
		$userresult = Users :: CheckUsername($txtusername);	
		
		if($userresult['user_name'] != "") {		
			header("Location:../NewAccountCreation.php?msg=9");			
		}
		else
		{
		  
		   
		//	$Authoresult = Users :: CheckAuthorityUserCreation($authoUser,$authoPass,$user_type);		
			    
		 
		//	if($Authoresult['user_id'] !="")			
			//{	
			//   if($user_id =="")
			//	{	
					 
$result = Users :: SaveUserCreation($typeid, $branchsfhq,$txtusername,$pass,$myname	,$nic,$tele	,$email,$user_id,$today,$isprivilege);
							 
							if($result==true)
							{ 
								header("Location:../NewAccountCreation.php?msg=1");	
								
							}
							else
							{
								header("Location:../NewAccountCreation.php?msg=2");	
								 
							}
			//	}
				//else
				//{
				//	$result= Users :: UpdateUserCreation($user_id,$user_name,$pass,$location,$user_type,$unit_id,$ge_id);
				//	if($result==true)
				//	{
					//	header("Location:../NewAccountCreation.php?msg=3");	
						
					//}
					//elseif($result==false)
					//{
					//	header("Location:../NewAccountCreation.php?msg=4");	
						
					//}
				//}			
			//}		
			//else 
			//{
			//	header("Location:../NewAccountCreation.php?msg=10");			
				
			//}
			
        }			
		
	break;
	
	
	case 'save':
	 	
		$user_id	 	=	isset( $_GET['userid'])?$_GET['userid']:$user_id;
		$user_name	  	=	isset( $_POST['txtusername'])?$_POST['txtusername']:$user_name;
		$pass	  		=	isset( $_POST['txtpassword'])?$_POST['txtpassword']:$pass;
		$confirmpass	=	isset( $_POST['txtconfirmpassword'])?$_POST['txtconfirmpassword']:$confirmpass;
		$location 	  	= 	isset( $_POST['txtlocation'])?$_POST['txtlocation']:$location;
		$user_type  	= 	isset( $_POST['user_type'])?$_POST['user_type']:1;
		$sfhq_id 		= 	isset( $_POST['sfhq_id'])?$_POST['sfhq_id']:0;
		$ge_id	 		= 	isset( $_POST['ge_branch'])?$_POST['ge_branch']:0;
		
		
		$Pers_name	  	=	isset( $_POST['Pers_name'])?$_POST['Pers_name']:$Pers_name;
		$nic	  		=	isset( $_POST['nic'])?$_POST['nic']:$nic;
		$telephone	  		=	isset( $_POST['telephone'])?$_POST['telephone']:$telephone;
		$emailadd   	=	isset( $_POST['emailadd'])?$_POST['emailadd']:$emailadd;
		
		  
		$pass			=	base64_encode($pass);
		$AuthoUser		=   'Admin';
		$Is_Privilege	= 	isset( $_POST['chk_privilege'])?$_POST['chk_privilege']:$Is_Privilege;
		
		$privilege="";
		if($Is_Privilege=='privilege')
		{
			
			$privilege=1;
		}
		else 
		{
			
			$privilege=0;
		}
		
		
		if($user_name == ""){
			header("Location:../new_user.php?msg=1");	
		}
		elseif($pass == "")
		{
			header("Location:../new_user.php?msg=2");
		}
		
		
		
		$userresult = Users :: CheckUsername($user_name);	
		if($userresult['user_name'] != "") {		
			header("Location:../new_user.php?msg=9");			
		}
		else
		{			
		
			if($user_id ==""){
				$result = Users :: SaveUser($user_name,$pass,$location,$user_type,$sfhq_id,$ge_id,$AuthoUser,$privilege,$Pers_name,$nic,$telephone,$emailadd);
				if($result==true)
				{
					header("Location:../users.php?msg=1");	
				}
				elseif($result==false)
				{
					header("Location:../new_user.php?msg=4");	
				}
			}
			else{
				$result= Users :: UpdateUser($user_id,$user_name,$pass,$location,$user_type,$unit_id,$ge_id,$privilege);
				if($result==true)
				{
					header("Location:../users.php?msg=3");	
				}
				elseif($result==false)
				{
					header("Location:../new_user.php?msg=6");	
				}
			}
		}
		
	break;
	
	
	case 'edit':
	 	
		$user_id	 	=	isset( $_GET['userid'])?$_GET['userid']:$user_id;
		$user_name	  	=	isset( $_POST['txtusername'])?$_POST['txtusername']:$user_name;
		$pass	  		=	isset( $_POST['txtpassword'])?$_POST['txtpassword']:$pass;
		$confirmpass	=	isset( $_POST['txtconfirmpassword'])?$_POST['txtconfirmpassword']:$confirmpass;
		$location 	  	= 	isset( $_POST['unit_name'])?$_POST['unit_name']:$location;
		$user_type  	= 	isset( $_POST['force_type'])?$_POST['force_type']:$user_type;
		$unit_id 		= 	isset( $_POST['unit_name'])?$_POST['unit_name']:$unit_id;
		$ge_id	 		= 	isset( $_POST['ge_branch'])?$_POST['ge_branch']:$ge_id;
		$pass	=	base64_encode($pass);
		
		$Is_Privilege	= 	isset( $_POST['chk_privilege'])?$_POST['chk_privilege']:$Is_Privilege;
		
		
		
		$privilege="";
		if($Is_Privilege=='on')
		{
			
			$privilege=1;
		}
		else 
		{
			
			$privilege=0;
		}
		
		
		
		if($user_name == ""){
			header("Location:../new_user.php?msg=1");	
		}
		elseif($pass == "")
		{
			header("Location:../new_user.php?msg=2");
		}
		
			if($ge_id ==""){
				$result = Users :: SaveUser($user_name,$pass,$location,$user_type,$unit_id,$ge_id,$privilege);
				if($result==true)
				{
					header("Location:../users.php?msg=3");	
				}
				elseif($result==false)
				{
					header("Location:../new_user.php?msg=4");	
				}
			}
			else{
				$result= Users :: UpdateUser($user_id,$user_name,$pass,$user_type,$unit_id,$ge_id,$privilege);
				if($result==true)
				{
					header("Location:../users.php?msg=5");	
				}
				elseif($result==false)
				{
					header("Location:../new_user.php?msg=6");	
				}
			}
		
	break;
	
	
	
	
	
	
	
	case 'editaccount':
	 	
		$user_id	 	=	isset( $_GET['userid'])?$_GET['userid']:$user_id;
		//$user_name	  	=	isset( $_POST['txtusername'])?$_POST['txtusername']:$user_name;
		$pass	  		=	isset( $_POST['txtpassword'])?$_POST['txtpassword']:$pass;
		//$confirmpass	=	isset( $_POST['txtconfirmpassword'])?$_POST['txtconfirmpassword']:$confirmpass;
		//$location 	  	= 	isset( $_POST['unit_name'])?$_POST['unit_name']:$location;
		//$user_type  	= 	isset( $_POST['force_type'])?$_POST['force_type']:$user_type;
		//$unit_id 		= 	isset( $_POST['unit_name'])?$_POST['unit_name']:$unit_id;
		//$ge_id	 		= 	isset( $_POST['ge_branch'])?$_POST['ge_branch']:$ge_id;
		$pass	=	base64_encode($pass);
		
		
		
				
			
				$result= Users :: UpdateOtherUserAccount($user_id,$pass);
				if($result==true)
				{
					header("Location:../users.php?msg=5");	
				}
				elseif($result==false)
				{
					header("Location:../new_user.php?msg=6");	
				}
			
		
	break;
	
	case 'delete':
	
	//die();
	
		$user_id	 	=	isset( $_GET['userid'])?$_GET['userid']:$user_id;
		
		$resultdelete = Users :: UserDelete($user_id);
		if($resultdelete==true)
		  {
			  header("Location:../users.php?msg=3");	
		  }
		  elseif($resultdelete==false)
		  {
			  header("Location:../users.php?msg=4");	
		  }
	
	break;
	
	case 'deactive':
	$id	 	=	isset( $_GET['id'])?$_GET['id']:$id;
		
		$resultdelete = Users :: DeactivateUser($id);
		if($resultdelete==true)
		  {
			  header("Location:../ViewAllUsers.php?msg=3");	
		  }
		  elseif($resultdelete==false)
		  {
			  header("Location:../ViewAllUsers.php?msg=4");	
		  }
	
	break;
	
	case 'deleteotherAccount':
		$user_id	 	=	isset( $_GET['userid'])?$_GET['userid']:$user_id;
		$type	 		=	isset( $_GET['type'])?$_GET['type']:$type;
		$url	 		=	isset( $_GET['url'])?$_GET['url']:$url;
		
		
		$resultdelete = Users :: UserDelete($user_id);
		if($resultdelete==true)
		  {
			  header("Location:../$url?msg=7");	
		  }
		  elseif($resultdelete==false)
		  {
			  header("Location:../users.php?msg=8");	
		  }
	
	break;
	
	
}

?>
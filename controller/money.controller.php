<?php 
require_once('../includes/config.php');
require_once('../classes/db_con.php');
require_once('../classes/units.class.php');
require_once('../classes/money.class.php');

$mode	=	isset( $_GET['mode'] )?$_GET['mode']:'';
$mode	=	isset( $_POST['mode'])?$_POST['mode']:$mode;

$user_type_id 	= $_SESSION['userType'];

switch($mode)
{
	case 'save':
	 	//$allocationid	=	isset( $_GET['allocationid'])?$_GET['allocationid']:$allocationid;			
		$year			=	isset( $_POST['cmb_allocated_year'])?$_POST['cmb_allocated_year']:$year;	
		$vote			=	isset( $_POST['vote'])?$_POST['vote']:$vote;	
		$brach_id		=	isset( $_POST['brach_id'])?$_POST['brach_id']:$brach_id;
		$amount 		= 	isset( $_POST['amount'])?$_POST['amount']:$amount;
		$description 	= 	isset( $_POST['txtdescription'])?$_POST['txtdescription']:$description;		
		$user_id 		=   isset( $_SESSION['userID'])?$_SESSION['userID']:loguserid;
		$today 			= 	date('Y-m-d');   
		
	
				$result = Money :: SaveMoneyAllocation($year,$vote,$amount,$description,$user_id,$today,$brach_id);
				if($result==true)
				{
					header("Location:../newmoneyallocation.php?msg=8");	
				}
				elseif($result==false)
				{
					header("Location:../newmoneyallocation.php?msg=9");	
				}
			
	break;
	
	case 'saveSFHQLevel':
	 		
		$year			=	isset( $_POST['cmb_allocated_year'])?$_POST['cmb_allocated_year']:$year;
		$brach_id		=	isset( $_POST['brach_id'])?$_POST['brach_id']:$brach_id;	
		$vote			=	isset( $_POST['vote'])?$_POST['vote']:$vote;	
		$sfhq_id		=	isset( $_POST['AccountOffice'])?$_POST['AccountOffice']:$sfhq_id;
		$amount 		= 	isset( $_POST['amount'])?$_POST['amount']:$amount;
		$description 	= 	isset( $_POST['txtdescription'])?$_POST['txtdescription']:$description;		
		$user_id 		=   isset( $_SESSION['userID'])?$_SESSION['userID']:loguserid;
		$today 			= 	date('Y-m-d');   
		
		$budget = Money :: ChecktheAllocationCondition($year,$brach_id,$vote,$sfhq_id,$amount);
		while($value=mysql_fetch_array($budget)){
			
						
			if ($value[0]==0)
			{				
				header("Location:../DirstributetoSFHQLevel.php?msg=14");	
				die();
				
			}
			
			elseif (($value[1]+$amount) > $value[0])
			{
				header("Location:../DirstributetoSFHQLevel.php?msg=15");
				die();
			}
			
			
		}
		
	
		$result = Money :: SaveSFHQlevelAllocation($year,$brach_id,$vote,$sfhq_id,$amount,$description,$user_id,$today);
				if($result==true)
				{
					
					header("Location:../DirstributetoSFHQLevel.php?msg=8");	
				}
				elseif($result==false)
				{
					
					header("Location:../DirstributetoSFHQLevel.php?msg=9");	
				}
			
	break;
	
	
	case 'EditAlloc':
	 	$allocationid	=	isset( $_GET['allocationid'])?$_GET['allocationid']:$allocationid;			
		$year			=	isset( $_POST['cmb_allocated_year'])?$_POST['cmb_allocated_year']:$year;	
		$vote			=	isset( $_POST['vote'])?$_POST['vote']:$vote;	
		$brach_id		=	isset( $_POST['brach_id'])?$_POST['brach_id']:$brach_id;
		$amount 		= 	isset( $_POST['amount'])?$_POST['amount']:$amount;
		$description 	= 	isset( $_POST['txtdescription'])?$_POST['txtdescription']:$description;		
		$user_id 		=   isset( $_SESSION['userID'])?$_SESSION['userID']:loguserid;
		$today 			= 	date('Y-m-d');
		$AccountOffice 	= 	isset( $_POST['AccountOffice'])?$_POST['AccountOffice']:0;	   
		
	
		$result= Money ::MoneyAllocationUpdate($year,$vote,$brach_id,$amount,$description,$allocationid,$user_id,$today,$AccountOffice);
				if($result==true)
				{
					if($user_type_id!=7)
					{
					header("Location:../displaymoneyallocation.php?msg=10");	
					}
					else{
						header("Location:../EditSFHQLevelAllocation.php?msg=10");
					}
				}
				elseif($result==false)
				{
					 if($user_type_id!=7){
					header("Location:../displaymoneyallocation.php?msg=11");
					 }
					 else {
						 header("Location:../EditSFHQLevelAllocation.php?msg=11");
					 }
				}
			
		
	break;
	
	case 'delete':
		$allocationid	 	=	isset( $_GET['allocationid'])?$_GET['allocationid']:$allocationid;
		
		$resultdelete = Money :: DeleteMoneyAllocation($allocationid);
		if($resultdelete==true)
		  {
			  if($user_type_id!=7){
			  header("Location:../displaymoneyallocation.php?msg=12");	
			  }
			  else {
			  
			    header("Location:../EditSFHQLevelAllocation.php?msg=12");
			  }
		  }
		  elseif($resultdelete==false)
		  {
			  if($user_type_id!=7){
			  
			   header("Location:../displaymoneyallocation.php?msg=13");
			  }
			  else {
				  header("Location:../EditSFHQLevelAllocation.php?msg=13");	
			  }
		  }
	
	break;
}

?>
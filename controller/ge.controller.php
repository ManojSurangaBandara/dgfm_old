<?php 
require_once('../includes/config.php');
require_once('../classes/db_con.php');
require_once('../classes/ge.class.php');

$mode	=	isset( $_GET['mode'] )?$_GET['mode']:'';
$mode	=	isset( $_POST['mode'])?$_POST['mode']:$mode;

switch($mode)
{
	case 'save':
	 	$ge_id		  =	isset( $_GET['geid'])?$_GET['geid']:$ge_id;
		$ge_name	  =	isset( $_POST['ge_name'])?$_POST['ge_name']:$ge_name;
		$location	  =	isset( $_POST['location'])?$_POST['location']:$location;
		$unit_id 	  = isset( $_POST['unit_name'])?$_POST['unit_name']:$unit_id;
		$description  = isset( $_POST['txtdescription'])?$_POST['txtdescription']:$description;
		
		if($ge_name == ""){
			header("Location:../units.php?msg=1");	
		}
	
			if($ge_id ==""){
				$result = GEBranch :: SaveGEUnit($ge_name, $location, $description, $unit_id);
				if($result==true)
				{
					header("Location:../ge_branch.php?msg=2");	
				}
				elseif($result==false)
				{
					header("Location:../new_ge_unit.php?msg=3");	
				}
			}
			else{
				$result= GEBranch :: UpdateGEUnit($ge_id,$ge_name, $location, $description, $unit_id);
				if($result==true)
				{
					header("Location:../ge_branch.php?msg=4");	
				}
				elseif($result==false)
				{
					header("Location:../new_ge_unit.php?msg=5");	
				}
			}
		
	break;
	
	case 'delete':
		$ge_id	 	=	isset( $_GET['geid'])?$_GET['geid']:$ge_id;
		
		$resultdelete = GEBranch :: DeleteGECenter($ge_id);
		if($resultdelete==true)
		  {
			  header("Location:../ge_branch.php?msg=6");	
		  }
		  elseif($resultdelete==false)
		  {
			  header("Location:../ge_branch.php?msg=7");	
		  }
	
	break;
}

?>
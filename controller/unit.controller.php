<?php 
require_once('../includes/config.php');
require_once('../classes/db_con.php');
require_once('../classes/units.class.php');

$mode	=	isset( $_GET['mode'] )?$_GET['mode']:'';
$mode	=	isset( $_POST['mode'])?$_POST['mode']:$mode;

switch($mode)
{
	case 'save':
	 	$unit_id	=	isset( $_GET['unitid'])?$_GET['unitid']:$unit_id;
		$unit_name	=	isset( $_POST['unit_name'])?$_POST['unit_name']:$unit_name;
		$location	=	isset( $_POST['location'])?$_POST['location']:$location;
		$force_type = isset( $_POST['force_type'])?$_POST['force_type']:$force_type;
		$description = isset( $_POST['txtdescription'])?$_POST['txtdescription']:$description;
		
		if($unit_name == ""){
			header("Location:../units.php?msg=1");	
		}
	
			if($unit_id ==""){
				$result = Units :: SaveUnit($unit_name, $location, $force_type, $description);
				if($result==true)
				{
					header("Location:../units.php?msg=1");	
				}
				elseif($result==false)
				{
					header("Location:../new_units.php?msg=2");	
				}
			}
			else{
				$result= Units ::UnitUpdate($unit_name, $location, $force_type, $description, $unit_id);
				if($result==true)
				{
					header("Location:../units.php?msg=3");	
				}
				elseif($result==false)
				{
					header("Location:../new_units.php?msg=4");	
				}
			}
		
	break;
	
	case 'delete':
		$unit_id	 	=	isset( $_GET['unitid'])?$_GET['unitid']:$unit_id;
		
		$resultdelete = Units :: UnitDelete($unit_id);
		if($resultdelete==true)
		  {
			  header("Location:../units.php?msg=5");	
		  }
		  elseif($resultdelete==false)
		  {
			  header("Location:../units.php?msg=6");	
		  }
	
	break;
}

?>
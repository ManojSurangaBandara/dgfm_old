<?php 
require_once('../includes/config.php');
require_once('../classes/db_con.php');
require_once('../classes/regiment.class.php');

$mode	=	isset( $_GET['mode'] )?$_GET['mode']:'';
$mode	=	isset( $_POST['mode'])?$_POST['mode']:$mode;

switch($mode)
{
	case 'save':
	 	
		$regiment_name	=	isset( $_POST['regiment_name'])?$_POST['regiment_name']:$regiment_name;		
		$description    = 	isset( $_POST['txtdescription'])?$_POST['txtdescription']:$description;
	
				$result = Regiment :: SaveRegiment($regiment_name, $description);
				if($result==true)
				{
					header("Location:../regiments.php?msg=1");	
				}
				elseif($result==false)
				{
					header("Location:../new_regiment.php?msg=2");	
				}
			
	break;
			case 'edit':
			
			$regiment_id	=	isset( $_POST['regiment_id'])?$_POST['regiment_id']:$regiment_id;
			$regiment_name	=	isset( $_POST['regiment_name'])?$_POST['regiment_name']:$regiment_name;			
			$description    =   isset( $_POST['txtdescription'])?$_POST['txtdescription']:$description;

				$result= Regiment ::Regiment_Update($regiment_name, $description, $regiment_id);
				if($result==true)
				{
					
					header("Location:../regiments.php?msg=3");	
					exit;
					
				}
				elseif($result==false)
				{
					header("Location:../new_regiment.php?msg=4");	
					exit;
				}
			
		
	break;
	
	case 'delete':
		$regiment_id	 	=	isset( $_GET['regiment_id'])?$_GET['regiment_id']:$regiment_id;
		
		$resultdelete = Regiment :: Regiment_Delete($regiment_id);
		if($resultdelete==true)
		  {
			  header("Location:../regiments.php?msg=5");	
		  }
		  elseif($resultdelete==false)
		  {
			  header("Location:../regiments.php?msg=6");	
		  }
	
	break;
}

?>
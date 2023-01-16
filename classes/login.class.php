<?php 
class Login{
	
	
	
//constructor
	private function __construct()
	{
		
	}
	
	function getRecord($username,$password,$usertype,$sfhq,$branch){
		
	
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM users WHERE user_name='$username' AND pass='$password' 
		AND user_type=$usertype AND sfhq_id = $sfhq AND isactive=1";
		
		//print_r($db1);
		//echo $sqlselect;
		//die();
		
		$data = $db1->Getrow($sqlselect);
		return $data;	
	}
	
	
	
	
	function getUserType()
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM user_type where act=1 ";		
		$data = $db1->GetAll($sqlselect);	
		
		return $data;		
	}
	
	
	
	//function getFirstBranch($id)
//	{
	//	$db1 = new db_con();
	///	$sqlselect = "SELECT * FROM Pro_Ope_ControllerChart where Proc_Con_Id=$id LIMIT 1";		
		//$data = $db1->GetAll($sqlselect);	
	//	echo $sqlselect;
	//	return $data;		
	//}
	
	
	
	function getBranches()
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM m_branches";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	function getSFHQ()
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM m_sfhq";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
}

?>
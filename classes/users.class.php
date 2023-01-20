<?php 

class Users{
	
	public $userid	 = NULL;
	public $username = NULL;
	public $password = NULL;
	public $location = NULL;
	public $usertype = NULL;
	public $unitId 	 = NULL;
	public $geid 	 = NULL;
	public $Authousername = NULL;
	public $Authopassword = NULL;
	
	
	
//constructor
	private function __construct()
	{
		
	}
	
	public static function getUser($username,$usertype,$unitID){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM users WHERE user_name='$username' AND unit_id='$unitID' AND user_type='$usertype'";
		$data = $db1->Getrow($sqlselect);
		return $data;	
	}
	
	
	public static function SaveUserCreation($typeid, $branchsfhq,$txtusername,$pass,$myname,$nic,$tele,$email,$user_id,$today,$isprivilege)
	{    
	
	
	if($isprivilege=='false'){
		$privi=1;
		
	} else {
		$privi=0;
		
	}
	
				
	//echo $isprivilege; die();
	
		$db1 = new db_con();
		
		if ($typeid==3){
			
		$sqlselect = "insert into users (user_name,pass,location,user_type,unit_id,ge_id,AuthorityUser
		,Isprivilege_user,branch_id,sfhq_id,Name,NIC,Telephone,Email,isactive,active_date,act_by) 
		values ('$txtusername','$pass',(select Name from m_sfhq where ID=$branchsfhq),$typeid,0,0,'Admin',$privi,0,$branchsfhq,'$myname'
		,'$nic','$tele','$email',1,'$today',$user_id)";
			
		}
		
		else {
		
		$sqlselect = "insert into users (user_name,pass,location,user_type,unit_id,ge_id,AuthorityUser
		,Isprivilege_user,branch_id,sfhq_id,Name,NIC,Telephone,Email,isactive,active_date,act_by) 
		values ('$txtusername','$pass',(select branch_name from m_branches where branch_id=$branchsfhq),$typeid,0,0,'Admin',$privi,$branchsfhq,0,'$myname'
		,'$nic','$tele','$email',1,'$today',$user_id)";
		}
		
		$data = $db1->GetAll($sqlselect);
	
		//echo $sqlselect;
		//die();
		
		
		return $data;		
		
	}
	
	
	public static function CheckAuthorityUserCreation($Authousername,$Authopassword,$user_type)
	{
		
		$db1 = new db_con();		
		$sqlselect = "SELECT user_id,location  FROM users WHERE user_name = '$Authousername' 
		              and pass = '$Authopassword' and user_type = '$user_type' and Isprivilege_user=1";	
		$data = $db1->GetRow($sqlselect);
		//echo $sqlselect;
		return $data;	
		
	}
	
	
	public static function CheckUsername($username)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT user_name FROM users WHERE user_name = '$username' ";	
		$data = $db1->GetRow($sqlselect);
		//echo $sqlselect;
		return $data;	
	}

	
	
	
	
	public static function SaveUser($username,$password,$location,$usertype,$sfhq_id,$geid,$Authousername,$Is_Privilege,$Pers_name,$nic,$Tele,$emailadd)	              
	{
	$db1 = new db_con();
	$sqlselect = "INSERT INTO users(user_name,pass,location,user_type,sfhq_id,ge_id,AuthorityUser,Isprivilege_user,Name,NIC,Telephone,Email) 
				VALUES ('$username','$password','$location','$usertype','$sfhq_id','$geid','$Authousername',$Is_Privilege,'$Pers_name','$nic','$Tele','$emailadd')";
				
				
				$data = $db1->GetAll($sqlselect);
				return $data;		
	}
	
	
	
	
	public static function UpdateUserCreation($userid,$username,$password,$location,$usertype,$unitId,$geid)
	{
		$db1 = new db_con();
		$sqlupdate = "UPDATE users SET 
								user_name ='$username',
								pass = '$password',
								location = '$location',
								user_type = '$usertype',
								unit_id = '$unitId',
								ge_id = '$geid' WHERE user_id = '$userid'";
		$data = $db1->GetAll($sqlupdate);
		//echo $sqlupdate;
		return $data;		
	}
	
	
	
	public static function UpdateUser($userid,$username,$password,$usertype,$unitId,$geid,$privilege)
	{
		
		$db1 = new db_con();
		$sqlupdate = "UPDATE users SET 
								user_name ='$username',
								pass = '$password',								
								user_type = '$usertype',
								unit_id = '$unitId',
								ge_id = '$geid',
								Isprivilege_user = '$privilege'
								
								WHERE user_id = $userid";
		$data = $db1->GetAll($sqlupdate);
		//echo $sqlupdate;
		return $data;		
	}
	
	
	public static function UpdateOtherUserAccount($userid,$password)
	{
		$db1 = new db_con();
		$sqlupdate = "UPDATE users SET 	pass = '$password'
								WHERE user_id = $userid";
		$data = $db1->GetAll($sqlupdate);
		//echo $sqlupdate ; die();
		return $data;		
	}
	
	public static function getAllUsers(){
		$db1 = new db_con();
		$sqlselect = "SELECT t1.user_id,t1.user_name,t1.location ,t1.user_type,t1.unit_id,t2.type_name,t3.unit_name,t4.ge_name
		                    FROM users AS t1 
							INNER JOIN user_type AS t2 ON  t1.user_type  = t2.user_type_id 
							LEFT OUTER JOIN units AS t3 ON t1.unit_id = t3.esr_unit_id
							LEFT OUTER JOIN ge AS t4 ON t1.ge_id = t4.ge_id ORDER BY t1.user_id";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function getAllUsersForUserType($usertype,$userid){		
		
		$db1 = new db_con();
		$sqlselect = "SELECT t1.user_id,t1.user_name,t1.location,t1.user_type
		              ,t1.branch_id,t1.sfhq_id,t2.type_name,t1.Isprivilege_user,t1.AuthorityUser
		                    FROM users AS t1 
							INNER JOIN user_type AS t2 ON  t1.user_type  = t2.user_type_id 							
							WHERE t1.user_type =$usertype and t1.user_id = $userid 
							ORDER BY t1.user_id";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}
	
	public static function getAllUsersForUserTypePagination($usertype,$userid,$start,$length){		
		
		$db1 = new db_con();
		$sqlselect = "SELECT t1.user_id,t1.user_name,t1.location,t1.user_type
		              ,t1.branch_id,t1.sfhq_id,t2.type_name,t1.Isprivilege_user,t1.AuthorityUser,S.Name,t1.Name,t1.NIC,t1.Telephone,t1.Email
		                    FROM users AS t1 
							INNER JOIN user_type AS t2 ON  t1.user_type  = t2.user_type_id 		
							LEFT OUTER JOIN m_sfhq AS S ON S.ID = t1.sfhq_id
							WHERE t1.user_type =$usertype and t1.user_id = $userid 
							
							ORDER BY t1.user_id limit $start, $length ";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	
	}
	
	

	
	public static function getUserData($userid)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM users WHERE user_id='$userid'";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function UserDelete($id)
	{
		$db1 = new db_con();
		$sqldelete = "DELETE FROM users WHERE user_id = $id";
		$data = $db1->Execute($sqldelete);
		return $data;

	}
	
	public static function DeactivateUser($id)
	{
		$today = date('Y-m-d');
		$db1 = new db_con();
		$sqldelete = "update users set isactive=0,deactive_date='$today' WHERE user_id = $id";
	//	echo $sqldelete;
		//die();
		
		$data = $db1->Execute($sqldelete);
		return $data;

	}
	
}

?>
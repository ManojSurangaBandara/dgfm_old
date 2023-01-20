<?php
class  login_details{
public static function insert_username_logintime($username, $user_id, $unit_id, $user_type)
{
$db1 = new db_con();

$today= date("y-m-d");
//$row_date = NOW();
//list($date,$time) = explode(' ',$row_date);

		$sqlselect = "INSERT INTO login_details( id, user_id, unit_id, user_name, user_type, login_time, log_out_time,login_date )
						VALUES (
						'', '$user_id', '1', '$username', '$user_type', NOW(),'','$today'
						)
						";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
}
public static function get_max_id()
{
$db1 = new db_con();
		$sqlselect = "select max(id) from login_details";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;
		//exit;
		//return;	
}

public static function insert_logouttime()
{
$ob1 = new login_details();
$last_id = $ob1->get_max_id();
//echo $last_id;
foreach ($last_id as $row) {
	$last_idd[] = $row;
}
//print_r($last_idd);
///echo "</br>";
//echo $last_idd[0][0];
 $final_id = $last_idd[0][0];
//echo "</br>";
$db1 = new db_con();
		$sqlselect = "UPDATE login_details SET log_out_time = NOW() WHERE id =$final_id";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;

		//exit;
		//return;	
}
public static function get_all_from_login_details()
{
$db1 = new db_con();
		$sqlselect = "select * from login_details";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	
}
public static function get_all_from_login_details_pagination($start, $length)
{
$db1 = new db_con();
		$sqlselect = "select * from login_details limit $start, $length";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	
}
public static function unit_wise_login_details($unit_id)
{
		$db1 = new db_con();
		$sqlselect = "select * from login_details where unit_id = $unit_id";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}
public static function unit_wise_login_details_page($unit_id, $limit, $start)
{
		$db1 = new db_con();
		$sqlselect = "select * from login_details where unit_id = $unit_id limit $start,$limit";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}

public static function user_type_wise_login_details($unit_id, $user_type)
{
		$db1 = new db_con();
		//echo $user_type;
		$sqlselect = "select * from login_details where unit_id = $unit_id and user_type = $user_type";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}
public static function user_type_wise_login_details_page($unit_id, $user_type, $limit, $start)
{
		$db1 = new db_con();
		//echo $user_type;
		$sqlselect = "select * from login_details where unit_id = $unit_id and user_type = $user_type limit $start,$limit";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}

public static function get_user_types()
{
        $db1 = new db_con();
		$sqlselect = "select * from user_type";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;
}


public static function user_type_wise_login_des($user_type)
{
		//$disabled = 'disabled';
		$db1 = new db_con();
		//echo "hi".$user_type;
		$sqlselect = "select * from login_details where user_type = 2";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}
public static function user_type_wise_login_des_page($user_type, $limit, $start)
{
		//$disabled = 'disabled';
		$db1 = new db_con();
		//echo "hi".$user_type;
		$sqlselect = "select * from login_details where user_type = 2 limit $start,$limit";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}
//-------------------------------------------------------------------------------------------------------------------------------------
public static function user_type_wise_login_admin()
{
		//$disabled = 'disabled';
		$db1 = new db_con();
		//echo "hi".$user_type;
		$sqlselect = "SELECT *
							FROM login_details
							WHERE user_type =1";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}
public static function user_type_wise_login_admin_menu($user_type)
{
		//$disabled = 'disabled';
		$db1 = new db_con();
		//echo "hi".$user_type;
		$sqlselect = "SELECT *
							FROM users
							WHERE user_type ='$user_type'
							GROUP BY user_id";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}
public static function unit_wise_user_names($user_type, $unit_id)
{
		//$disabled = 'disabled';
		$db1 = new db_con();
		//echo "hi".$user_type;
		$sqlselect = "SELECT *
							FROM users
							WHERE user_type ='$user_type' and unit_id = '$unit_id'";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}
public static function get_admin_user_names($user_type)
{
		//$disabled = 'disabled';
		$db1 = new db_con();
		//echo "hi".$user_type;
		$sqlselect = "SELECT *
							FROM users
							WHERE user_type ='$user_type'";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}

public static function user_type_wise_login_admin_page($user_type,$limit, $start)
{
		//$disabled = 'disabled';
		$db1 = new db_con();
		//echo "hi".$user_type;
		$sqlselect = "select * from login_details where user_type = 1 limit $start,$limit";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}

public static function display_login_details($user_name, $login_time, $log_out_time)
{
		//$disabled = 'disabled';
		$db1 = new db_con();
		//echo "hi".$user_type;
		$sqlselect = "select * from login_details where 
						user_name = '$user_name'  and login_time = '$login_time' and log_out_time = '$log_out_time'";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}
public static function display_login_details_page($user_name, $login_time, $log_out_time, $start, $limit)
{
		//$disabled = 'disabled';
		$db1 = new db_con();
		//echo "hi".$user_type;
		$sqlselect = "select * from login_details where 
						user_name = '$user_name'  and login_time = '$login_time' and log_out_time = '$log_out_time' 
						limit $start,$limit";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	

}
public static function display_login_details_2($user_name, $from_date_two, $to_date_two, $unit_id, $user_type, $today)
{
		//$disabled = 'disabled';
		$db1 = new db_con();
		
		//echo "hi".$user_type;
		if(($user_type==1)||($user_type==2))
			{	
							
				  if($from_date_two== $to_date_two)
				  	{
					
				  	if($user_name=='ALL')
						{
						$user_name = 'user_name';
						 $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name=$user_name and login_date = 	'$today'";
					
					    }
						else
						{
				
					 $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name='$user_name' and login_date = 	'$today'";
						}
				    	
				  }//-------------------------------------end of $from_date_two== $to_date_two------------------------------------ 
				  if(($user_name=='ALL')&&($from_date_two!= $to_date_two))
				  
				  	{
				  $user_name = 'user_name';
				   $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name=$user_name and login_time  BETWEEN 					'$from_date_two' and '$to_date_two'";
				  
					}
					 else if($from_date_two!= $to_date_two)
				    {
				   $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name='$user_name' and login_time  BETWEEN 					'$from_date_two' and '$to_date_two' ";
				  }
				  
				  
			
		}//-----------------------------------------------------end of Admin and DES part-------------------------------------
			else
			{// --------------------------------------------------$user_type != des or Admin part----------------------------------
			if($from_date_two== $to_date_two)
				  {
				  		if($user_name=='ALL')
						{
						$user_name = 'user_name';
						 $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name=$user_name and
						unit_id = '$unit_id' and login_date = '$today'";
					
						}
						
						else 
						{
					 $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name='$user_name' and unit_id = '$unit_id' and login_date = '$today'";
					    }
				 }//-------------------------------------end of $from_date_two==$to_date_two------------------------------------ 
				  
				  if(($user_name=='ALL')&&($from_date_two!= $to_date_two))
				  		{
				  $user_name = 'user_name';
				   $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name=$user_name and unit_id = '$unit_id' and login_time  BETWEEN 					'$from_date_two' and '$to_date_two'";
						}
				else if(($from_date_two!= $to_date_two)&&($user_name!='ALL'))

						{
				
				   $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name='$user_name' and unit_id = '$unit_id' and login_time  BETWEEN 					'$from_date_two' and '$to_date_two'";
						}
				//
				}
		//}
			$data = $db1->GetAll($sqlselect);
		//	echo $sqlselect;
			return $data;	

}
public static function display_login_details_2_page($user_name, $from_date_two, $to_date_two, $start, $limit, $unit_id, $user_type, $today)
{
		//$disabled = 'disabled';
		$db1 = new db_con();
		 $from_date_two;
		//echo "hi".$user_type;
		if(($user_type==1)||($user_type==2))
			{					
				  if($from_date_two== $to_date_two)
				  	{
				  	if($user_name=='ALL')
						{
						$user_name = 'user_name';
						 $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name=$user_name and login_date = 	'$today' limit $start, $limit";
					
					
						}
						else
						{
					 $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name='$user_name' and login_date = 	'$today' limit $start, $limit";
						}
				    	
				  }//-------------------------------------end of $from_date_two== $to_date_two------------------------------------ 
				  if(($user_name=='ALL')&&($from_date_two!= $to_date_two))
				  
				  	{
				  $user_name = 'user_name';
				    $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name=$user_name and login_time  BETWEEN 					'$from_date_two' and '$to_date_two' limit $start, $limit";
				  
				  	}
				  else if($from_date_two!= $to_date_two)
				    {
				   $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name='$user_name' and login_time  BETWEEN 					'$from_date_two' and '$to_date_two' limit $start, $limit";
				    }
				  
				  
			
		}//-----------------------------------------------------end of Admin and DES part-------------------------------------
			else
			{// --------------------------------------------------$user_type != des or Admin part----------------------------------
			if($from_date_two== $to_date_two)
				  {
				  		if($user_name=='ALL')
						{
						$user_name = 'user_name';
						 $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name=$user_name and unit_id = '$unit_id' and login_date = '$today' limit $start, $limit";
					
						}
						else 
						{
					 $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name='$user_name' and unit_id = '$unit_id' and login_date = '$today' limit $start, $limit";
						}
				 }//-------------------------------------end of $from_date_two==$to_date_two------------------------------------ 
				  
				  if(($user_name=='ALL')&&($from_date_two!= $to_date_two))
				  		{
				  $user_name = 'user_name';
				   $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name=$user_name and unit_id = '$unit_id' and login_time  BETWEEN 					'$from_date_two' and '$to_date_two' limit $start, $limit";
						}
				else if(($from_date_two!= $to_date_two)&&($user_name!='ALL'))

						{
				
				   $sqlselect = "SELECT * FROM  login_details WHERE user_type = '$user_type' and user_name='$user_name' and unit_id = '$unit_id' and login_time  BETWEEN 					'$from_date_two' and '$to_date_two' limit $start, $limit";
						}
				//
			}
		//}
			$data = $db1->GetAll($sqlselect);
			//echo $sqlselect;
			return $data;	

}

public static function login_duration($login_time, $log_out_time)
{
	  $db1 = new db_con();
      echo $sqlselect = "select TIMEDIFF('$login_time', '$log_out_time')";
	  $data = $db1->GetAll($sqlselect);
	  return $data;
}

public static function getDifference($startDate,$endDate,$format = 1)
{
    list($date,$time) = explode(' ',$startDate);
    $startdate = explode("-",$date);
    $starttime = explode(":",$time);

    list($date,$time) = explode(' ',$endDate);
    $enddate = explode("-",$date);
    $endtime = explode(":",$time);

    $secondsDifference = mktime($endtime[0],$endtime[1],$endtime[2],
        $enddate[1],$enddate[2],$enddate[0]) - mktime($starttime[0],
            $starttime[1],$starttime[2],$startdate[1],$startdate[2],$startdate[0]);
    
    switch($format){
        // Difference in Minutes
        case 1: 
            return $secondsDifference/60;
        // Difference in Hours    
        case 2:
            return floor($secondsDifference/60/60);
        // Difference in Days    
        case 3:
            return floor($secondsDifference/60/60/24);
        // Difference in Weeks    
        case 4:
            return floor($secondsDifference/60/60/24/7);
        // Difference in Months    
        case 5:
            return floor($secondsDifference/60/60/24/7/4);
        // Difference in Years    
        default:
            return floor($secondsDifference/365/60/60/24);
    }                
} 



}
?>
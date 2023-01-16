<?php 
class db_con{
	
	
	
	var $hostname;
	var $username;
	var $password;
	var $db_name;
	
	var $lasterror;
	var $lasterror_id;





	function __construct(){
		$this->hostname =DB_HOST;
		$this->username = DB_USER;
		$this->password = DB_PWD;
		$this->db_name = DB_DB;
		
		$this->lasterror ="";
		$this->lasterror_id =0;
	}
	
	function getlasterror(){
		$this->lasterror;
	}
	function getlasterror_id(){
		$this->lasterror_id();
	}
	
	function halt(){
		echo "<hr/>";
		echo $this->lasterror_id;
		echo $this->lasterror;
		echo "<hr/>";
		//exit();
		return false;
	}
	
	function Getrow($sql)
	{
		$result =false;
		
		$conn = mysql_pconnect($this->hostname,$this->username,$this->password);
		
		if(!$conn){
			$this->lasterror_id = mysql_errno();
			$this->lasterror = mysql_error();
			//$this->halt();
			
		}
		$db = mysql_select_db($this->db_name,$conn);
		if(!$db){
			$this->lasterror_id =mysql_errno();
			$this->lasterror = mysql_error();
			//$this->halt();
		}
		
		$result =mysql_query($sql,$conn);
		if(!$result){
			$this->lasterror_id = mysql_errno();
			$this->lasterror = mysql_error();
			//$this->halt();
		}
		$row =mysql_fetch_array($result);
		if(!$row){
			$this->lasterror = mysql_error();
			$this->lasterrorid = mysql_errno();
			//$this->halt();
		}
		mysql_close($conn);
		$this->lasterror_id =0;
		$this->lasterror = "Execution was Successful ";
		return $row;
	}
	
	
	function GetAll($sql){
		$result =false;
		
		$conn =mysql_pconnect($this->hostname,$this->username,$this->password);
		if(!$conn){
			$this->lasterror = mysql_error();
			$this->lasterrorid = mysql_errno();
			$this->halt();
		}
		
		$db = mysql_select_db($this->db_name,$conn);
		if(!$db){
			$this->lasterror = mysql_error();
			$this->lasterrorid = mysql_errno();
			$this->halt();
		}
		
		$result = mysql_query($sql,$conn);
		if(!$result){
			$this->lasterror = mysql_error();
			$this->lasterrorid = mysql_errno();
			$this->halt();
		}
		
		mysql_close($conn);
		$this->lasterror = 'Execution Successful';
		$this->lasterrorid = 0;
		return $result;
	}
	
	function Execute($sql){
				$result =false;
		
		$conn =mysql_pconnect($this->hostname,$this->username,$this->password);
		if(!$conn){
			$this->lasterror = mysql_error();
			$this->lasterrorid = mysql_errno();
			$this->halt();
		}
		
		$db = mysql_select_db($this->db_name,$conn);
		if(!$db){
			$this->lasterror = mysql_error();
			$this->lasterrorid = mysql_errno();
			$this->halt();
		}
		
		$result = mysql_query($sql,$conn);
		if(!$result){
			$this->lasterror = mysql_error();
			$this->lasterrorid = mysql_errno();
			$this->halt();
		}
		
		mysql_close($conn);
		$this->lasterror = 'Execution Successful';
		$this->lasterrorid = 0;
		return $result;
	}
}

?>

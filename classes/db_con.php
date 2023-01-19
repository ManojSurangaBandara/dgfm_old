<?php 
class db_con{
	
	public $hostname, $dbname, $username, $password, $conn;

	function __construct(){
		$this->hostname = DB_HOST;
		$this->dbname = DB_DB;
		$this->username = DB_USER;
		$this->password = DB_PWD;
		try {
			$this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}
	
	function Getrow($sql)
	{
		$result =false;
		try {
			$statement = $this->conn->prepare($sql);
			$statement->execute();
			$result = $statement->fetch();
			$statement->closeCursor();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
		}
		return $result;
	}
	
	function GetAll($sql){
		$result =false;
		try {
			$statement = $this->conn->prepare($sql);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
		return $result;
	}
	
	function Execute($sql){
		$result=false;
		try {
			$statement = $this->conn->prepare($sql);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
		return $result;
	}
}

?>

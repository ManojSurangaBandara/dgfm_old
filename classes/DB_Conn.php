<?php 
class DB_Conn{
	
	var $hostname;
	var $username;
	var $passowrd;
	var $db_name;
	
	var $lasterror;
	var $lasterror_id;

	/**
	 * @return unknown
	 */
	public function getDb_name () { return $this->db_name; }

	/**
	 * @return unknown
	 */
	public function getHostname () { return $this->hostname; }

	/**
	 * @return unknown
	 */
	public function getLasterror () { return $this->lasterror; }

	/**
	 * @return unknown
	 */
	public function getLasterror_id () { return $this->lasterror_id; }

	/**
	 * @return unknown
	 */
	public function getPassowrd () { return $this->passowrd; }

	/**
	 * @return unknown
	 */
	public function getUsername () { return $this->username; }

	/**
	 * @param unknown_type $db_name
	 */
	public function setDb_name ($db_name) { $this->db_name = $db_name; }

	/**
	 * @param unknown_type $hostname
	 */
	public function setHostname ($hostname) { $this->hostname = $hostname; }

	/**
	 * @param unknown_type $lasterror
	 */
	public function setLasterror ($lasterror) { $this->lasterror = $lasterror; }

	/**
	 * @param unknown_type $lasterror_id
	 */
	public function setLasterror_id ($lasterror_id) { $this->lasterror_id = $lasterror_id; }

	/**
	 * @param unknown_type $passowrd
	 */
	public function setPassowrd ($passowrd) { $this->passowrd = $passowrd; }

	/**
	 * @param unknown_type $username
	 */
	public function setUsername ($username) { $this->username = $username; }

	
	
	function __construct(){
		$this->hostname =DB_HOST;
		$this->username = DB_USER;
		$this->passowrd = DB_PWD;
		$this->db_name = DB_DB;
		
		$this->lasterror ="";
		$this->lasterror_id =0;
	}
	
	function halt(){
		echo "<hr/>";
		echo $this->lasterror_id;
		echo $this->lasterror;
		echo "<hr/>";
		//exit();
		return false;
	}
	
	
}


?>
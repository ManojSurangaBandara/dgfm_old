<?php 
class GEBranch{
	
	public $ge_id = NULL;
	public $ge_name  = NULL;
	public $location  = NULL;
	public $description = NULL;
	public $esr_unit_id =NULL;
	
//constructor
	private function __construct()
	{
		
	}
	
	public static function SaveGEUnit($ge_name, $location, $description, $esr_unit_id){
		$db1 = new db_con();
		$sqlinsert = "INSERT INTO ge (ge_name,location ,description ,Esr_unit_id ) 
						VALUES ('$ge_name','$location',  '$description', '$esr_unit_id');";
		//echo $sqlinsert; exit;
		$data = $db1->Execute($sqlinsert);
		return $data;	
	}
	
	public static function getGEUnit()
	{
		$db1 = new db_con();
		$sqlselect = "SELECT t1.*,t2.unit_name FROM ge AS t1 INNER JOIN units AS t2 ON t1.Esr_unit_id = t2. esr_unit_id";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	public static function getGEUnitforGE($esr_unit_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT t1.*,t2.unit_name FROM ge AS t1 
					  INNER JOIN units AS t2 ON t1.Esr_unit_id = t2. esr_unit_id 
					  WHERE t2.esr_unit_id = '$esr_unit_id'";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;		
	}
	
	public static function getGEUnitforGEPagination($esr_unit_id,$start,$length)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT t1.*,t2.unit_name FROM ge AS t1 
					  INNER JOIN units AS t2 ON t1.Esr_unit_id = t2. esr_unit_id 
					  WHERE t2.esr_unit_id = '$esr_unit_id' limit $start, $length ";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;		
	}
	
	
	
	public static function GetUnitDetails()
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM units";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	public static function SelectGEUnitDetailRow($id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM ge WHERE  ge_id =$id";
		$data = $db1->GetAll($sqlselect);
		return $data;
	}
	public static function UpdateGEUnit($geunit_id,$ge_name, $location, $description, $esr_unit_id)
	{
		$db1 = new db_con();
		$sqlupdate = "UPDATE ge SET 
							ge_name  = '$ge_name',
							location = '$location',
							description = '$description',
							Esr_unit_id = ' $esr_unit_id' WHERE ge_id =$geunit_id";
		//echo $sqlupdate;
					
		$data = $db1->Execute($sqlupdate);
		return $data;
	}
	
	public static function DeleteGECenter($id)
	{
		$db1 = new db_con();
		$sqldelete = "DELETE FROM ge WHERE ge_id = $id";
		$data = $db1->Execute($sqldelete);
		return $data;

	}
	
	
}

?>
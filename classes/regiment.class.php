<?php 
class Regiment{
	
	public $regiment_name = NULL;	
	public $Description = NULL;
	
//constructor
	private function __construct()
	{
		
	}
	
	public static function SaveRegiment($regiment_name, $Description){
		$db1 = new db_con();
		$sqlinsert = "INSERT INTO  all_army_regiments (regiment_name,description) 
						VALUES ('$regiment_name','$Description')";
		//echo $sqlinsert; 
		$data = $db1->Execute($sqlinsert);
		return $data;	
	}
	
	
	public static function GetRegimentDetails()
	{
		$db1 = new db_con();
		$sqlselect = "select * from all_army_regiments";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
		
	public static function SelectRegimentDetailRow($id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM all_army_regiments WHERE  id =$id";
		$data = $db1->GetAll($sqlselect);
		return $data;
	}
	public static function Regiment_Update($regiment_name, $description, $id)
	{
		$db1 = new db_con();		
		
		$sqlupdate = "UPDATE all_army_regiments SET
												regiment_name = '$regiment_name',
												description   = '$description'
												WHERE id ='$id'";
		
				//echo $sqlupdate;
				$data = $db1->Execute($sqlupdate);
				return $data;
	}

	public static function Regiment_Delete($id)
	{
		$db1 = new db_con();
		$sqldelete = "DELETE  FROM all_army_regiments WHERE id = '$id'";
		$data = $db1->Execute($sqldelete);
		return $data;

	}
	public static function GetRegimentDetails_pagination($start, $length)
	{
		$db1 = new db_con();
		$sqlselect = "select * from all_army_regiments limit $start, $length";		
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
}

?>
<?php 
class Units{
	
	public $unit_name = NULL;
	public $location = NULL;
	public $force_type_id = NULL;
	public $Description = NULL;
	
//constructor
	private function __construct()
	{
		
	}
	
	function SaveUnit($unit_name, $location, $force_type_id, $Description){
		$db1 = new db_con();
		$sqlinsert = "INSERT INTO  units (unit_name,location,force_type_id,Description) 
						VALUES ('$unit_name','$location',  '$force_type_id', '$Description');";
		//echo $sqlinsert; exit;
		$data = $db1->Execute($sqlinsert);
		return $data;	
	}
	
	function getUserType()
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM user_type";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	function GetUnitDetails()
	{
		$db1 = new db_con();
		$sqlselect = "SELECT u.ID,u.Name,u.Description,
(select IFNULL(COUNT(pd.Bill_Id),0) from sfhq_bill_details as pd where u.ID=pd.Sfhq_Id AND EXTRACT(YEAR FROM pd.Invoice_date) = EXTRACT(YEAR FROM CURDATE())  ) as AllCounter,
(Select IFNULL(COUNT(pdc.Bill_Id),0) from sfhq_bill_details as pdc WHERE pdc.Bill_Status = 1 and u.ID=pdc.Sfhq_Id AND EXTRACT(YEAR FROM pdc.Recieved_Date) = EXTRACT(YEAR FROM CURDATE()) ) AS Settled,
(Select IFNULL(COUNT(pdr.Bill_Id),0) from sfhq_bill_details as pdr WHERE pdr.Bill_Status = 0 and u.ID=pdr.Sfhq_Id AND EXTRACT(YEAR FROM pdr.Recieved_Date) = EXTRACT(YEAR FROM CURDATE()) ) AS NotSettled,
(Select IFNULL(COUNT(pdr.Bill_Id),0) from sfhq_bill_details as pdr WHERE pdr.Bill_Status = 2 and u.ID=pdr.Sfhq_Id AND EXTRACT(YEAR FROM pdr.Recieved_Date) = EXTRACT(YEAR FROM CURDATE()) ) AS Canceled,
(Select IFNULL(COUNT(pdr.Bill_Id),0) from sfhq_bill_details as pdr WHERE pdr.Bill_Status = 3 and u.ID=pdr.Sfhq_Id  AND EXTRACT(YEAR FROM pdr.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())) AS RTN
					
FROM m_sfhq as u ";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	function GetUnitDetailsPagination($start,$length)
	{
		$log_year	= $_SESSION['log_year'];	
		
		
		$db1 = new db_con();
		$sqlselect = "SELECT u.ID,u.Name,u.Description,
(select IFNULL(COUNT(pd.Bill_Id),0) from sfhq_bill_details as pd where u.ID=pd.Sfhq_Id AND EXTRACT(YEAR FROM pd.Recieved_Date) = $log_year) as AllCounter,
(Select IFNULL(COUNT(pdc.Bill_Id),0) from sfhq_bill_details as pdc WHERE pdc.Bill_Status = 1 and u.ID=pdc.Sfhq_Id AND EXTRACT(YEAR FROM pdc.Recieved_Date) = $log_year) AS Settled,
(Select IFNULL(COUNT(pdr.Bill_Id),0) from sfhq_bill_details as pdr WHERE pdr.Bill_Status = 0 and u.ID=pdr.Sfhq_Id AND EXTRACT(YEAR FROM pdr.Recieved_Date) = $log_year ) AS NotSettled,
(Select IFNULL(COUNT(pdr.Bill_Id),0) from sfhq_bill_details as pdr WHERE pdr.Bill_Status = 2 and u.ID=pdr.Sfhq_Id AND EXTRACT(YEAR FROM pdr.Recieved_Date) = $log_year ) AS Canceled,
(Select IFNULL(COUNT(pdr.Bill_Id),0) from sfhq_bill_details as pdr WHERE pdr.Bill_Status = 3 and u.ID=pdr.Sfhq_Id  AND EXTRACT(YEAR FROM pdr.Recieved_Date) = $log_year) AS RTN
					
FROM m_sfhq as u limit $start, $length  ";

 // echo $sqlselect;
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	
	function GetVoucherDetailstodgfm()
	{
		$log_year	= $_SESSION['log_year'];	
		
		$db1 = new db_con();
		$sqlselect = "SELECT 
 (SELECT IFNULL(COUNT(Bill_Id),0)  FROM txt_bill_details WHERE EXTRACT(YEAR FROM Recieved_Date) = $log_year) AS  AllCount
,(SELECT IFNULL(COUNT(Bill_Id),0)  FROM txt_bill_details WHERE Bill_Status = 0 AND EXTRACT(YEAR FROM Recieved_Date) = $log_year) AS  NOTSETTLED
,(SELECT IFNULL(COUNT(Bill_Id),0)  FROM txt_bill_details WHERE Bill_Status = 1 AND EXTRACT(YEAR FROM Recieved_Date) = $log_year) AS SETTLED
,(SELECT IFNULL(COUNT(Bill_Id),0)  FROM txt_bill_details WHERE Bill_Status = 2 AND EXTRACT(YEAR FROM Recieved_Date) = $log_year) AS CANCELED
,(SELECT IFNULL(COUNT(Bill_Id),0)  FROM txt_bill_details WHERE Bill_Status = 3 AND EXTRACT(YEAR FROM Recieved_Date) = $log_year) AS RTN  ";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
    
    
    
    
    
	
	

	function GetMaxidforGroupbySFHQ($id)
	{
	
		$db1 = new db_con();
		$sqlselect = "SELECT COUNT(Sup_id),max(Sup_id) as maxSupId FROM m_supplier_list 
					  WHERE  Related_sfhq_id =$id 
					  GROUP BY Related_sfhq_id ";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;
	}
	
	
	
	function SelectUnitDetailRow($id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM units WHERE  esr_unit_id =$id";
		$data = $db1->GetAll($sqlselect);
		return $data;
	}
	function UnitUpdate($unit_name, $location, $force_type, $description, $id)
	{
		$db1 = new db_con();
		//echo "from update";
		$sqlupdate = "UPDATE units SET 
					unit_name = '$unit_name',
					location = '$location',
					force_type_id = '$force_type',
					Description = ' $description' WHERE esr_unit_id =$id";
					
				//echo $sqlupdate;
					
		$data = $db1->Execute($sqlupdate);
		return $data;
	}

	function UnitDelete($id)
	{
		$db1 = new db_con();
		$sqldelete = "DELETE FROM units WHERE esr_unit_id = $id";
		$data = $db1->Execute($sqldelete);
		return $data;

	}
	
}

?>
<?php 
class Common{
	
	public $username 		= NULL;
	public $password 		= NULL;
	public $usertype 		= NULL;
	public $progressID 		= NULL;	
	public $unit_id 		= NULL;
	public $gecenter 		= NULL;
	public $cmbproject 		= NULL;
	public $txt_as_at_date 	= NULL;
	public $year		 	= NULL;
	public $txt		 		= NULL;
	public $projType	 	= NULL;
	
	
	
	
//constructor
	private function __construct()
	{
		
	}

	///////////////////////////////////////////////////////////////////////////     DGFM           
	
	
	public static function GetDGFMBillDetails($projType,$sfhq_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM txt_bill_details 							
							 WHERE Bill_Status ='$projType' and Sfhq_Id ='$sfhq_id' ";			
								
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}
	/////54544646
	public static function GetDGFMBillDetailsToBigUser($billstatus,$branch_id,$user_t_id,$log_year)
	{
		if($branch_id==6)
		{
			$branch_id = 'branch_id';
		}
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM txt_bill_details 							
							 WHERE Bill_Status ='$billstatus' and branch_id=$branch_id AND EXTRACT(YEAR FROM Recieved_Date) = $log_year";		
							 
							 //and UserTypeId ='$user_t_id' 
								
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}
	
	public static function GetAllUserAccount()
	{
		
		$db1 = new db_con();
		$sqlselect = "select * from m_sfhq order by ID";		
							 
							 //and UserTypeId ='$user_t_id' 
								
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}
	
	public static function GetBranchNametoPsoView($branch_id)	
	{
		$db1 = new db_con();
		$sqlselect = "select branch_name from m_branches WHERE branch_id = $branch_id";			
		$data = $db1->Getrow($sqlselect);
		return $data;	
				
	}
	
	public static function GetAllAcountType()	
	{
	
		
		$db1 = new db_con();			
		$sqlselect = "select * from user_type where act=1";									
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
				
	}
	
	public static function GetUserType($typeid)	
	{
		//echo $typeid;
		//die();
		
		$db1 = new db_con();
		
		switch($typeid){
			
			case 2:
			$sqlselect = "select * from m_branches where branch_id=21";
			break;
			
			case 3:
			$sqlselect = "select * from m_sfhq";
			break;
			
			case 5:
			$sqlselect = "select * from m_branches where branch_id=44";
			break;
			
			case 6:
			$sqlselect = "select * from m_branches where branch_id=67";
			break;
			
			case 7:
			$sqlselect = "select * from m_branches where IsController=1";
			break;
			
			case 8:
			$sqlselect = "select * from m_branches where IsPosCon=1";
			break;
			
			default:
			$sqlselect = "select * from m_sfhq";
			break;
			
		}
						
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
				
	}
	
	public static function GetDGFMSearchChiefAccValue($text)
	{
		
		$db1 = new db_con();
		$sqlselect = "SELECT d.* FROM txt_bill_details as d
						INNER JOIN m_supplier_list as s on s.Sup_id =d.Bill_Name 							
							 WHERE d.Bill_No like '%$txt%' or s.Sup_Name like '%$txt%'  ";		
							 
							 //and UserTypeId ='$user_t_id' 
								
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}
	
	
	
	
	
	
	public static function GetDGFMBillDetailsToviewDgfm($billstatus,$sfhq_id,$unit_dis_id)
	{
		if($unit_dis_id == 0)
		{
			$unit_dis_id = 'Unit_Id';
		}
		
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM sfhq_bill_details 							
					WHERE Bill_Status ='$billstatus' and Sfhq_Id =$sfhq_id 
					and Unit_Id =  $unit_dis_id
				 AND EXTRACT(YEAR FROM Recieved_Date) = EXTRACT(YEAR FROM CURDATE())  ";		
							 
							 //and UserTypeId ='$user_t_id' 
								
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}
	
	
	public static function GetBillNoforPSOView($billstatus,$branch_id,$vote_id,$log_year)
	{
			
		$db1 = new db_con();
		$sqlselect = "SELECT  b.Bill_No
					from txt_bill_details as b
					INNER JOIN vote_bill_amount as v on v.Bill_Id=b.Bill_Id and v.Bill_No=b.Bill_No 
					and v.Vote_ID=$vote_id AND v.Bill_Staus=$billstatus  					 
					LEFT OUTER JOIN return_details as t on t.Bill_Id = b.Bill_Id
					INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id 
					where b.Bill_Status=$billstatus 									
					
					and b.branch_Id=$branch_id
					and v.Vote_ID=$vote_id	
					AND EXTRACT(YEAR FROM b.Recieved_Date)=$log_year							
					 
					 UNION ALL
					 
					SELECT b.Bill_No
					FROM sfhq_bill_details as b 
					INNER JOIN sfhq_vote_bill_amount as v on v.bill_no=b.bill_no 
					and v.sfhq_id=b.sfhq_id and v.bill_id=b.bill_id and v.Vote_ID=$vote_id and v.Bill_Staus=$billstatus		 
					LEFT OUTER JOIN sfhq_return_details as t on t.Bill_Id=b.Bill_Id	
					INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 				  
					where b.Bill_Status=$billstatus 									
					
					and b.branch_Id=$branch_id
					and v.vote_id=$vote_id
					AND EXTRACT(YEAR FROM b.Recieved_Date)=$log_year";		
							 
							 //and UserTypeId ='$user_t_id' 
								
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		//die();
		return $data;	
	}
	
	
	public static function GetDGFMBillDetailsToSFHQ($billstatus,$branch_id,$user_t_id,$sfhq_id,$log_year)
	{
		if($branch_id==6)
		{
			$branch_id = 'branch_id';
		}
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM sfhq_bill_details 							
				      WHERE Bill_Status ='$billstatus' and branch_id =$branch_id 
					  AND EXTRACT(YEAR FROM Recieved_Date) = $log_year
					  and UserTypeId ='$user_t_id' and Sfhq_Id = $sfhq_id  ";			
								
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		//die ();
		return $data;	
	}
	
	
	public static function GetBillDetailstoDGFM($branch_id,$sfhq_id,$bill_status)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM txt_bill_details 							
							 WHERE Bill_Status ='$bill_status' and Sfhq_Id ='$sfhq_id' and branch_id ='$branch_id' ";			
								
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}
	
	
	
		public static function GetDGFMHomePage($branch_id,$sfhq_id,$txt,$bill_status){
	//echo $ProjStatus;
				$db1 = new db_con();
				$sqlselect = "SELECT  d.Bill_Id
				,d.Bill_No
				,d.Bill_Name
				,d.Amount
				,c.Unit
				,d.Recieved_Date 
				,d.Picture
				,d.Bill_Status
				,d.remarks
				,c.Branch
				,d.Bill_Settled_Date
				,v.vote_number
				FROM txt_bill_details as d
				INNER JOIN m_unit_distribution_chart as c on d.Unit_Id=c.Distribution_Id 
				INNER JOIN votes as v on d.Settled_Vote_ID=v.vote_id 	 
				WHERE  d.branch_id=$branch_id and d.Sfhq_Id=$sfhq_id and d.Bill_Status=$bill_status and d.Bill_No like '%$txt%' ";
				$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	
	}
	
	
	public static function GetDGFMHomePagePagination($branch_id,$sfhq_id,$txt,$bill_status,$start, $length){
		$db1 = new db_con();
	//	echo $ProjStatus;
		
		$sqlselect = "SELECT  d.Bill_Id
				,d.Bill_No
				,d.Bill_Name
				,d.Amount
				,c.Unit
				,d.Recieved_Date 
				,d.Picture
				,d.Bill_Status
				,d.remarks
				,c.Branch
				,d.Bill_Settled_Date
				,v.vote_number
				FROM txt_bill_details as d
				INNER JOIN m_unit_distribution_chart as c on d.Unit_Id=c.Distribution_Id 
				INNER JOIN votes as v on d.Settled_Vote_ID=v.vote_id 	 
				WHERE d.branch_id=$branch_id and d.Sfhq_Id=$sfhq_id and d.Bill_Status=$bill_status and d.Bill_No like '%$txt%'  limit $start, $length ";		
		
		$data = $db1->GetAll($sqlselect);	
	//	echo $sqlselect;
		return $data;	
		}
	
	
	public static function GetDteDetailsToPsoView($billId,$user_type_id){
		$db1 = new db_con();
		$sqlselect = "SELECT  d.Bill_Id
		,d.Bill_No
		,d.Bill_Name		
		,d.Recieved_Date as Recieved_Date
		,d.Invoice_date as Invoice_date		
		,d.Bill_Status
		,d.remarks
		,b.branch_name
		,d.Bill_Settled_Date as Bill_Settled_Date
		,s.Sup_Name
		,d.Bill_ref_no
		,rt.rtn_reason_detail
		,r.rtn_date as rtn_date
		,d.Invoice_No
		,d.G35_No
		,d.G35_Date as G35_Date
		,s.Hm_address
		,s.Contact_no
		,s.Vat_No
		
		FROM txt_bill_details as d
		INNER JOIN m_supplier_list as s on s.Sup_id =d.Bill_Name
		INNER JOIN  m_branches as b on d.branch_id=b.branch_id 
		LEFT OUTER JOIN return_details AS r on r.Bill_Id=d.Bill_Id and r.act_date='1000-01-01'		
		LEFT OUTER JOIN m_return AS rt on rt.rtn_id = r.rtn_reason 
		 
		where d.Bill_Id = $billId ";
		
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
		//die ();
		return $data;	
	}
	
		
	public static function GetBiguserBillDetailsToView($billId,$user_type_id){
		$db1 = new db_con();
		$sqlselect = "SELECT  d.Bill_Id
		,d.Bill_No
		,d.Bill_Name		
		,d.Recieved_Date 
		,d.Invoice_date		
		,d.Bill_Status
		,d.remarks
		,b.branch_name
		,d.Bill_Settled_Date
		,s.Sup_Name
		,d.Bill_ref_no
		,rt.rtn_reason_detail
		,r.Auto_id
		,r.rtn_date
		,r.act_date
		,d.Invoice_No
		,d.G35_No
		,d.G35_Date
		,s.address_line1
		,s.Contact_no
		,s.Vat_No
		,d.Cheque_No
		,d.Cheque_Date
		,s.address_line2
		,s.address_line3
		,s.address_line4
		,d.bill_period_from
		,d.bill_period_to
		
		FROM txt_bill_details as d
		INNER JOIN m_supplier_list as s on s.Sup_id =d.Bill_Name
		INNER JOIN  m_branches as b on d.branch_id=b.branch_id 
		LEFT OUTER JOIN return_details AS r on r.Bill_Id=d.Bill_Id		
		LEFT OUTER JOIN m_return AS rt on rt.rtn_id = r.rtn_reason 
		 
		where d.Bill_Id = $billId 
		ORDER BY r.Auto_id DESC";
		//and UserTypeId =$user_type_id  
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
		//die ();
		return $data;	
	}
	
	public static function GetAddress($billId){
		$db1 = new db_con();
		$sqlselect = "select Sup_Name,address_line1,address_line2,address_line3,address_line4
		,(select Cheque_No from txt_bill_details where Bill_Id=$billId) as chkno
		,(select file_ref from txt_bill_details where Bill_Id=$billId) as fileref
		from m_supplier_list 
		where Sup_id = (select Bill_Name from txt_bill_details where Bill_Id=$billId )";
		
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
		//die ();
		return $data;	
	}
	
	public static function SupDetailstoSMS($billId){
		$db1 = new db_con();
		$sqlselect = "SELECT s.is_vehicle,
		CONCAT('Trf Credit ','Rs. ',(SELECT Amount FROM vote_bill_amount WHERE Bill_Id = $billId),' on ',
(SELECT Bill_Settled_Date FROM txt_bill_details WHERE Bill_Id = $billId ),' To A/C No ',s.Act_No,' ',b.Bnk_Code,' - ',s.bnk_loc_id
,' of ',s.Sup_Name,' As the Veh Bill Payment for '
,(SELECT bill_period_from FROM txt_bill_details WHERE Bill_Id = $billId),'/'
,(SELECT RIGHT(bill_period_to,2) FROM txt_bill_details WHERE Bill_Id = $billId)
,' Directorate of Finance - SL Army'
) as smsbody,IFNULL(s.mobile,'0') as mob
		
		FROM m_supplier_list as s
		INNER JOIN m_bank as b on b.bnk_Auto_id=s.Bank_id  
		WHERE s.Sup_id = (SELECT Bill_Name FROM txt_bill_details WHERE Bill_Id = $billId )";
		
			//echo $sqlselect; die();
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
	//	die ();
		return $data;	
	}
	
	public static function CfAccSupDetSMSbyFeed($sup_id){
		
		//echo '12'; die();
 		
		$db1 = new db_con();		
		$get_max = "SELECT MAX(Bill_Id) as b_id FROM txt_bill_details where Bill_Name=$sup_id";
		$max = $db1->Getrow($get_max);		
		$bil_id=$max['b_id'];
		
		
		$sqlselect = "SELECT s.is_vehicle,
		CONCAT('Details of Vehicle Bill Received to Directorate of Finance SL Army. Vehicle No : ',s.civil_veh_no,' ,Vehicle Owner : ' ,s.Sup_Name, ' ,Bill Period : '
,(SELECT bill_period_from FROM txt_bill_details WHERE Bill_Id = $bil_id ),'/'
,(SELECT RIGHT(bill_period_to,2) FROM txt_bill_details WHERE Bill_Id = $bil_id)
, ' ,Bill Amount : '
,'Rs. ',(SELECT Amount FROM vote_bill_amount WHERE Bill_Id = $bil_id)
,' ,Bill Received Date : '
,(SELECT Recieved_Date FROM txt_bill_details WHERE Bill_Id = $bil_id)
,' ,Total Unsettled Amount for this year : '
,(SELECT sum(Amount) FROM vote_bill_amount WHERE Sup_Code=(SELECT Bill_Name FROM txt_bill_details WHERE Bill_Id = $bil_id) and (Bill_Staus=0 || Bill_Staus=3 ))
) as smsbody
,IFNULL(s.mobile,'0') as mob		
FROM m_supplier_list as s
WHERE s.Sup_id = (SELECT Bill_Name FROM txt_bill_details WHERE Bill_Id = $bil_id)";
		
	//	echo $sqlselect; die();
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
	//	die ();
		return $data;	
	}
	
		public static function SendSMStoSFHQ($billId){
		$db1 = new db_con();
		$sqlselect = "SELECT s.is_vehicle,
		CONCAT('Trf Credit ','Rs. ',(SELECT Amount FROM sfhq_vote_bill_amount WHERE Bill_Id = $billId),' on ',
(SELECT Bill_Settled_Date FROM sfhq_bill_details WHERE Bill_Id = $billId ),' To A/C No ',s.Act_No,' ',b.Bnk_Code,' - ',s.bnk_loc_id
,' of ',s.Sup_Name,' As the Veh Bill Payment for '
,(SELECT bill_period_from FROM sfhq_bill_details WHERE Bill_Id = $billId),'/'
,(SELECT RIGHT(bill_period_to,2) FROM sfhq_bill_details WHERE Bill_Id = $billId)
,' Regional Accounts Office '
, m.Description ,' - SL Army'
) as smsbody,IFNULL(s.mobile,'0') as mob
		
		FROM m_supplier_list as s
		INNER JOIN m_bank as b on b.bnk_Auto_id=s.Bank_id  
		INNER JOIN m_sfhq as m on m.ID=((SELECT Sfhq_ID FROM sfhq_bill_details WHERE Bill_Id = $billId ))
		WHERE s.Sup_id = (SELECT Sup_Code FROM sfhq_bill_details WHERE Bill_Id = $billId )";
		
			
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
	//	die ();
		return $data;	
	}
	
	
	
	public static function GetRegAccAddress($billId){
		$db1 = new db_con();
		$sqlselect = "select Sup_Name,address_line1,address_line2,address_line3,address_line4 
		,(select Cheque_No from sfhq_bill_details where Bill_Id=$billId) as chkno
		,(select file_ref from sfhq_bill_details where Bill_Id=$billId) as fileref
		from m_supplier_list 
		where Sup_id = (select Sup_Code from sfhq_bill_details where Bill_Id=$billId )";
		
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
		//die ();
		return $data;	
	}
	
	////View Supplier all details
		public static function GetAllSupplierDetails($SupId){
			
		$db1 = new db_con();
		
		$sqlselect = "SELECT s.Sup_Code,s.Sup_Name, s.Act_No,s.vat_no
		,s.address_line1,s.address_line2,s.address_line3,s.address_line4,s.Contact_no ,b.Bnk_Code ,s.bnk_loc_id,s.Email_Add,s.mobile,s.is_vehicle,s.civil_veh_no,u.Name,u.sfhq_id,s.nic,v.veh_Place
		
		FROM m_supplier_list as s
		LEFT OUTER JOIN  m_bank as b on s.Bank_id = b.bnk_Auto_id 
		
		LEFT OUTER JOIN users as u on u.user_id=s.create_userid
        LEFT OUTER JOIN m_veh_run_place as v on v.Veh_Run_Place_Id = s.veh_run_pl
						
		where s.Sup_id = $SupId ";
		
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
		//LEFT OUTER JOIN tbllocation as l on s.bnk_loc_id = l.id
		return $data;	
	}
	//
	
	public static function GetSFHQBillDetailsToPSOView($billId,$user_type_id){
		$db1 = new db_con();
		$sqlselect = "SELECT  d.Bill_Id
		,d.Bill_No
		,d.Sup_Code		
		,d.Recieved_Date as Recieved_Date
		,d.Invoice_date as Invoice_date	
		,d.Bill_Status
		,d.remarks
		,b.branch_name
		,u.Unit
		,d.Bill_Settled_Date as Bill_Settled_Date
		,s.Sup_Name
		,d.	Bill_ref_no
		,d.details
		,rt.rtn_reason_detail
		,r.rtn_date as rtn_date
		,d.Invoice_No
		,d.G35_No
		,d.G35_Date as G35_Date
		,s.Hm_address
		,s.Contact_no
		,s.Vat_No
		,d.Cheque_No
		,d.Cheque_Date as Cheque_Date
		,d.Cheque_Ent_Date as Cheque_Ent_Date
		,sf.Name
		
		
		
		FROM sfhq_bill_details as d
		INNER JOIN m_supplier_list as s on s.Sup_id =d.Sup_Code
		INNER JOIN  m_branches as b on d.branch_id=b.branch_id 		
		INNER JOIN  m_unit_distribution_chart as u on d.Unit_Id=u.Distribution_Id 	
		INNER JOIN m_sfhq as sf on sf.ID=d.sfhq_id		
		LEFT OUTER JOIN sfhq_return_details AS 	r ON r.Bill_Id= d.Bill_Id AND r.act_date='1000-01-01'
		LEFT OUTER JOIN m_return AS rt on rt.rtn_id = r.rtn_reason 
	
		where d.Bill_Id = $billId ";
		
		$data = $db1->Getrow($sqlselect);
	//	echo $sqlselect;
		//die();
		return $data;	
	}
	
	public static function GetSumofSFHQBillstoPSOView($status,$search,$branch_id,$vote_id,$log_year){
		$db1 = new db_con();
		$sqlselect = "SELECT sum(b.Amount) as amount,t.vote_number as voteName
					 FROM sfhq_vote_bill_amount as b 
					  INNER JOIN sfhq_bill_details as v on v.bill_no = b.bill_no 
					  and v.sfhq_id=b.sfhq_id and v.bill_id=b.bill_id	
					  inner join votes as t on t.vote_id=$vote_id
					  LEFT OUTER JOIN sfhq_return_details as x on x.Bill_Id=b.Bill_Id
					  
					 where v.Bill_Status=$status 			
					and v.branch_Id=$branch_id
					and b.vote_id=$vote_id
					AND b.Current_Year=$log_year";
		
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
		//die ();
		
		return $data;	
	}
	
		
	public static function GetVtCode($vote_id){
		$db1 = new db_con();
		$sqlselect = "SELECT vote_number as voteName FROM votes where vote_id=$vote_id";
		
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
		//die ();
		
		return $data;	
	}
	
	public static function GetSumofDirectoratebillstoPSOView($status,$search,$branch_id,$vote_id,$log_year){
		$db1 = new db_con();
		$sqlselect = "SELECT sum(b.Amount) as Amt
					 FROM vote_bill_amount as b 
					 INNER JOIN txt_bill_details as v on v.bill_no = b.bill_no 
					 and v.bill_id=b.bill_id	
					 inner join votes as t on t.vote_id=b.Vote_ID
					 LEFT OUTER JOIN return_details as x on x.Bill_Id = b.Bill_Id
					where v.Bill_Status=$status 			
					and v.branch_Id=$branch_id
					and b.Vote_ID=$vote_id
					AND b.Current_Year=$log_year";
		
		$data = $db1->Getrow($sqlselect);
	//echo $sqlselect;
	//die();
		return $data;	
	}
	
	
	
	public static function GetSFHQTotalValueofStatus($status,$search,$branch_id,$vote_id){
		$db1 = new db_con();
		$sqlselect = "SELECT  d.Bill_Id
		,d.Bill_No
		,d.Sup_Code		
		,d.Recieved_Date 
		,d.Invoice_date		
		,d.Bill_Status
		,d.remarks
		,b.branch_name
		,u.Unit
		,d.Bill_Settled_Date
		,s.Sup_Name
		,d.Bill_ref_no
		,d.details
		,rt.rtn_reason_detail
		,r.rtn_date
		,d.Invoice_No
		,d.G35_No
		,d.G35_Date
		,s.Hm_address
		,s.Contact_no
		,s.Vat_No
		,d.Cheque_No
		,d.Cheque_Date
		,d.Cheque_Ent_Date
		,h.Name
		
		
		FROM sfhq_bill_details as d
		INNER JOIN m_supplier_list as s on s.Sup_id =d.Sup_Code
		INNER JOIN  m_branches as b on d.branch_id=b.branch_id 		
		INNER JOIN  m_unit_distribution_chart as u on d.Unit_Id=u.Distribution_Id 			
		INNER JOIN m_sfhq as h on h.Id = d.Sfhq_Id
		LEFT OUTER JOIN sfhq_return_details AS 	r ON r.Bill_Id= d.Bill_Id AND r.act_date='1000-01-01'
		LEFT OUTER JOIN m_return AS rt on rt.rtn_id = r.rtn_reason 
	
		where d.Bill_Id = $billId  ";
		
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
		//die();
		return $data;	
	}
	
	public static function GetSFHQBillDetailsToView($billId,$user_type_id){
		$db1 = new db_con();
		$sqlselect = "SELECT  d.Bill_Id
		,d.Bill_No
		,d.Sup_Code		
		,d.Recieved_Date 
		,d.Invoice_date		
		,d.Bill_Status
		,d.remarks
		,b.branch_name
		,u.Unit
		,d.Bill_Settled_Date
		,s.Sup_Name
		,d.Bill_ref_no
		,d.details
		,rt.rtn_reason_detail
		,r.Auto_id
		,r.rtn_date
		,r.act_date
		,d.Invoice_No
		,d.G35_No
		,d.G35_Date
		,s.address_line1
		,s.Contact_no
		,s.Vat_No
		,d.Cheque_No
		,d.Cheque_Date
		,d.Cheque_Ent_Date
		,s.address_line2
		,s.address_line3
		,s.address_line4
		,d.bill_period_from
		,d.bill_period_to
		,s.mobile
		
		
		FROM sfhq_bill_details as d
		INNER JOIN m_supplier_list as s on s.Sup_id =d.Sup_Code
		INNER JOIN  m_branches as b on d.branch_id=b.branch_id 		
		INNER JOIN  m_unit_distribution_chart as u on d.Unit_Id=u.Distribution_Id 			
		LEFT OUTER JOIN sfhq_return_details AS 	r ON r.Bill_Id= d.Bill_Id
		LEFT OUTER JOIN m_return AS rt on rt.rtn_id = r.rtn_reason 
	
		where d.Bill_Id = $billId  ";
		
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
		//die();
		return $data;	
	}
	
	public static function GetBillDetailsToView($billId){
		$db1 = new db_con();
		$sqlselect = "SELECT  d.Bill_Id
		,d.Bill_No
		,d.Bill_Name
		,d.Amount
		,c.Unit
		,d.Recieved_Date 
		,d.Picture
		,d.Bill_Status
		,d.remarks
		,c.Branch
		,d.Bill_Settled_Date
		,v.vote_number
		FROM txt_bill_details as d
		INNER JOIN m_unit_distribution_chart as c on d.Unit_Id=c.Distribution_Id 
		INNER JOIN votes as v on d.Settled_Vote_ID=v.vote_id 	 
		where d.Bill_Id = $billId ";
		
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
		return $data;	
	}
	
	
	public static function GetVotesName(){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM votes ORDER BY vote_number ASC";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	
	}
	
		public static function GetTypeofVotes(){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM vote_type ";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	
	}
	
	
	
	
	public static function GetReleventVotesName($branch_Id){
		$db1 = new db_con();
		$sqlselect = "SELECT v.vote_id,v.vote_number,v.description FROM pso_view_chart as vc
		INNER JOIN votes as v on v.vote_id=vc.Vote_ID
		WHERE vc.Branch_ID=$branch_Id
		ORDER BY v.vote_number ASC ";
		
		//echo $sqlselect;
		//die();
		
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
		public static function GetBranchName(){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM m_branches";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetSHGQName(){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM m_sfhq";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	////////////////////////////////////////////////////////////////////////////////////////////     DGFM        
	


	public static function GetMenu($logingID){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM menus WHERE login_type='$logingID' AND active =1";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetSubMenu($submenuID,$logingID){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM menus WHERE Sub_menu_type =$submenuID AND login_type=$logingID AND active =1";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}
	
	
	
	public static function GetForceType(){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM force_type";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	
	
	public static function GetSFHQName(){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM m_sfhq";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	
	
	public static function GetGEName(){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM ge";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	
	
	
	public static function UserTypeName(){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM user_type where act=1";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	//and pd.project_name LIKE 
	
	public static function GetDesHomePage($unit_id,$txt,$ProjStatus){
	//echo $ProjStatus;
		$db1 = new db_con();
		$sqlselect 	= "SELECT  	pd.project_id,
								pd.project_name,
								pd.project_location,
								pd.project_start_date,
								pd.project_end_date,
								ft.project_type_name,
								pd.project_Description,
								'view',
								ft.project_type_id,
								pd.Job_number
								FROM m_project_details as pd
								inner join project_type as ft on pd.project_type=ft.project_type_id
								where pd.esr_unit_id=$unit_id  
								and pd.proj_completing_status = $ProjStatus
								and (pd.project_name like '%$txt%' or pd.Job_number like '%$txt%' )						
								ORDER BY ft.project_type_name ";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	
	}
	
	
	
	
	
	public static function GetDesHomePagePagination($unit_id,$txt,$ProjStatus,$start, $length){
		$db1 = new db_con();
	//	echo $ProjStatus;
		
		$sqlselect = "SELECT  	pd.project_id,
								pd.project_name ,
								pd.project_location,
								pd.project_start_date,
								pd.project_end_date,
								ft.project_type_name,
								pd.project_Description,
								'view',
								ft.project_type_id,
								pd.Job_number
								FROM m_project_details as pd
								inner join project_type as ft on pd.project_type=ft.project_type_id
								where pd.esr_unit_id=$unit_id 
								and pd.proj_completing_status = $ProjStatus
								and (pd.project_name like '%$txt%' or pd.Job_number like '%$txt%' )									
								ORDER BY ft.project_type_name limit $start, $length ";		
		
		$data = $db1->GetAll($sqlselect);	
	//	echo $sqlselect;
		return $data;	
		}
	
	
	
	
	
	public static function GetSentprojectReports($projectID,$sendstatus){
		$db1 = new db_con();
		$sqlselect = "SELECT  
							proj_pro_report_id ,
							report_date,
							allocated_ammount_year ,
							allocated_ammount,
							paid_year,
							paid_amount,
							bills_paid,
							completing_state_as_percentage,
							remarks,
							report_file 								
							FROM project_progress_report WHERE proj_id  = $projectID							
							and sending_status = $sendstatus and report_status=1 order by report_date desc ";
		
	//	echo $sqlselect;
		$data = $db1->GetAll($sqlselect);
		
		return $data;	
	}	
	
	
	
	public static function GetSentprojectReportsPagination($projectID,$sendstatus,$start,$length){
		$db1 = new db_con();
		$sqlselect = "SELECT  
							proj_pro_report_id ,
							report_date,
							allocated_ammount_year ,
							allocated_ammount,
							paid_year,
							paid_amount,
							bills_paid,
							completing_state_as_percentage,
							remarks,
							report_file 								
							FROM project_progress_report WHERE proj_id  = $projectID							
							and sending_status = $sendstatus and report_status=1 order by report_date desc limit $start, $length ";
			
		$data = $db1->GetAll($sqlselect);
		
		return $data;	
	}	
	
	
	public static function GetProject($project_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT t1.project_id,
							 t1.project_reference_id,
							 t1.project_name,
							 t1.project_allocated_amount,
							 t1.project_start_date,
							 t1.project_end_date,
							 t1.project_location,
							 t1.project_type,
							 t1.date_of_tender_called,
							 t1.date_of_tender_opened,
							 t1.date_of_tec_appointed,
							 t1.date_of_tb_appointed,
							 t1.name_of_contractor,
							 t1.awarded_date,
							 t1.extension_given,
							 t1.proj_allocated_stations,
							 t1.project_Description,
							 t2.project_type_name,
							 t3.unit_name,
							 t1.RefDate,
							 t1.Estimated_Amount,
							 t1.G69_No,
							 t1.Dates,
							 t1.Vote_Number,
							 t1.ge_center_id,
							 t1.allocated_regiment,
							 t1.Job_number
							 
							 FROM m_project_details AS t1
							 INNER JOIN project_type AS t2 ON t1.project_type = t2.project_type_id
							 INNER JOIN units AS t3 ON t1.esr_unit_id = t3.esr_unit_id			
							 WHERE project_id = $project_id  and t1.project_status = 1";
			
				
				
		$data = $db1->Getrow($sqlselect);
		return $data;	
	}
	
	

	
	public static function GetProjectNames($unit_id,$projType)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT project_id,
							 project_name,
							 Job_number
							 FROM m_project_details 							
							 WHERE esr_unit_id = '$unit_id' and proj_completing_status ='$projType' ";			
								
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}
	public static function GetAllprojectReports($projectID){
		$db1 = new db_con();
		$sqlselect = "SELECT  
							proj_pro_report_id ,
							report_date,
							allocated_ammount_year ,
							allocated_ammount,
							paid_year,
							paid_amount,
							bills_paid,
							completing_state_as_percentage,
							remarks,
							report_file 								
							FROM project_progress_report WHERE proj_id  = $projectID							
							and report_status=1 order by report_date desc ";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}	
	
	
	
	
	public static function GetAllprojectReportsPagination($projectID,$start,$length){
		$db1 = new db_con();
		$sqlselect = "SELECT  
							proj_pro_report_id ,
							report_date,
							allocated_ammount_year ,
							allocated_ammount,
							paid_year,
							paid_amount,
							bills_paid,
							completing_state_as_percentage,
							remarks,
							report_file 								
							FROM project_progress_report WHERE proj_id  = $projectID							
							and report_status=1 order by report_date desc limit $start, $length ";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}	
	
	
	
	public static function GetProgressReportDetails($progressID){
		$db1 = new db_con();
		$sqlselect = "SELECT  
				            ppr.proj_pro_report_id,
							ppr.proj_id,
							pd.project_name,
							ppr.report_date,
							ppr.allocated_ammount_year,
							ppr.allocated_ammount,
							ppr.paid_year,
							ppr.paid_amount,
							ppr.bills_paid,
							ppr.completing_state_as_percentage,
							ppr.report_status,
							ppr.sending_status,
							ppr.create_user_id,
							ppr.create_date,
							ppr.modified_user_id,
							ppr.modified_date,
							ppr.report_file,
							ppr.remarks,	
							ppr.report_file1,
							ppr.report_file2,
							ppr.IsTBapproval,
							ppr.Aproval_Date,
							ppr.report_file3,
							ppr.Award_sum
							FROM project_progress_report as ppr
							INNER JOIN m_project_details AS pd ON ppr.proj_id = pd.project_id
							WHERE ppr.proj_pro_report_id  = $progressID	and ppr.report_status = 1						
							order by ppr.report_date desc ";
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
		return $data;	
	}	
	
	public static function getallbilldetails($billno){
	$db1 = new db_con();
		$sqlselect = "SELECT  t1.*,t2.description FROM vote_bill_amount as t1 INNER JOIN votes as t2 ON t1.Vote_ID = t2.vote_id WHERE t1.Bill_No=$billno";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		//die();
		return $data;	
	}
	
	
	public static function getallbilldetailstosfhq($billno,$billid){
	$db1 = new db_con();
		$sqlselect = "SELECT  t1.*,t2.description FROM sfhq_vote_bill_amount as t1 INNER JOIN votes as t2 ON t1.Vote_ID = t2.vote_id WHERE t1.Bill_No=$billno and t1.Bill_Id = $billid";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		//die();
		return $data;	
	}
	
}

?>
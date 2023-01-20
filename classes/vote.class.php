<?php 
	


class Vote{
	
	public $vote_number = NULL;
	public $Description = NULL;
	

	
//constructor
	private function __construct()
	{
		
	}
	
	public static function SaveVote($vote_number, $description,$vttype,$user_id,$create_date){
		$db1 = new db_con();
		
		$sqlinsert = "INSERT INTO votes (vote_number,description,vt_type,create_user_id,Create_date) 
						VALUES ('$vote_number','$description',$vttype,$user_id,'$create_date')";
		//echo $sqlinsert; 
		//die();
		
		$data = $db1->Execute($sqlinsert);
		return $data;	
	}
	
	
	public static function SaveAssignVote($opcon_id,$vote_number,$user_id,$create_date){
		$db1 = new db_con();
		$sqlinsert = "INSERT INTO pso_view_chart (Branch_ID,Vote_ID,User_ID,In_Date) 
		VALUES 	($opcon_id,$vote_number,$user_id,'$create_date')";
	//	echo $sqlinsert; 
	//	die();
		$data = $db1->Execute($sqlinsert);
		return $data;	
	}
	
	
	public static function GetMaxsupid()
	{
	
		$db1 = new db_con();
		$sqlselect = "SELECT max(Sup_id) as id FROM m_supplier_list ";
		$data = $db1->Execute($sqlselect);
	//	echo $sqlselect;
		return $data;
	}
	
	
	
	public static function SaveSupplier($description,$sfhq_id,$bank_id ,$txtacctNo,$bnk_branch_id
		,$vatNo,$line1,$line2,$line3,$line4,$contactNo,$email,$user_id,$today,$fin_vehno,$isveh,$mobile,$nic,$vrp){
		
		//echo $mobile; die();
		
		$db1 = new db_con();
		
		$sqlinsert = "INSERT INTO  m_supplier_list (Sup_Name,Sup_Code,Related_sfhq_id,Bank_id, Act_No
		, bnk_loc_id,vat_no, address_line1,address_line2,address_line3,address_line4
		, Contact_no,Email_Add,create_userid,create_date,is_vehicle,civil_veh_no,mobile,nic,veh_run_pl) 
		VALUES ('$description','m',$sfhq_id,$bank_id,'$txtacctNo','$bnk_branch_id','$vatNo','line1'
		,'line2','line3','line4','$contactNo','$email',$user_id,'$today',$isveh,'$fin_vehno','$mobile','$nic',$vrp)";
		//echo $sqlinsert; die(); 
		$data = $db1->Execute($sqlinsert);
		return $data;	
	}
	
	public static function Supplier_Update($vote_number, $description, $sup_id,$bank_id ,$txtacctNo
		,$bnk_branch_id,$vatNo,$contactNo,$line1,$line2,$line3,$line4,$user_id,$today,$mobile,$nic,$email,$vehno,$vrp)
	{
		$db1 = new db_con();		
		$sqlupdate = "UPDATE m_supplier_list SET 
										 
					Bank_id=$bank_id, 
					Act_No='$txtacctNo', 
					bnk_loc_id='$bnk_branch_id',
					vat_no='$vatNo', 					
					Contact_no='$contactNo',
					address_line1='$line1', 
					address_line2='$line2',
					address_line3='$line3',
					address_line4='$line4',
					mobile='$mobile',
					Email_Add='$email',					
					nic='$nic',				
					edit_by=$user_id,
					edit_date='$today',	
					civil_veh_no='$vehno',
					veh_run_pl=$vrp
					WHERE Sup_id=$sup_id";
					
				//echo $sqlupdate; die();
				//Sup_Name='$description',
					
		$data = $db1->Execute($sqlupdate);
		return $data;
	}    
	

	
	public static function GetSupplierDetails($search,$veh_type)
	{
		$sfhq_id 	= $_SESSION['sfhqID'];
		
		if($veh_type==2){
		$veh_type = 'is_vehicle';	
		}
		
		$db1 = new db_con();
		
		$sqlselect = "select Sup_id,Sup_Name from m_supplier_list 
		WHERE Sup_Name LIKE '%$search%'  AND is_vehicle=$veh_type
		ORDER BY Sup_Name ASC";
		
	    //$sqlselect = "select * from m_supplier_list 
		//WHERE m_supplier_list.Related_sfhq_id =$sfhq_id and m_supplier_list.Sup_Name LIKE '%$search%'
		//ORDER BY m_supplier_list.Sup_Name ASC";
		
		
		
		//echo $sqlselect; die();
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	
	
	
	public static function GetSupplierDetailstoTripoli() // this is now same to all sfhq and dfin since supplier common to all
	{
		//$sfhq_id 	= $_SESSION['sfhqID'];
//		$db1 = new db_con();
//		$sqlselect = "select * from m_supplier_list 
//		WHERE m_supplier_list.Related_sfhq_id =0  
//		ORDER BY m_supplier_list.Sup_Name ASC";
//		$data = $db1->GetAll($sqlselect);
//		return $data;
            
                //Changed public static function to load all supppliers to supplier list for sfhq_id  0 user accounts
                $db1 = new db_con();
		$sqlselect = "select * from m_supplier_list 
		ORDER BY m_supplier_list.Sup_Name ASC";
		$data = $db1->GetAll($sqlselect);
		return $data;
	}
	
	
	
	
	
	public static function SelectVoteDetailRow($vote_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT v.*,t.vt_type_name FROM votes as v
		INNER JOIN vote_type as t on t.vt_type_id=v.vt_type		
		WHERE  v.vote_id =$vote_id";
		$data = $db1->GetAll($sqlselect);
		return $data;
	}
	
	public static function SelectSupplierDetailRow($sup_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT s.Sup_id,
		s.Sup_Code,
		s.Sup_Name, 
		s.Contact_no,
		s.vat_no,
		b.Bnk_Code,
		s.bnk_loc_id,
		s.Act_No,
		s.mobile,
		s.Email_Add,
		s.address_line1,
		s.address_line2,
		s.address_line3,
		s.address_line4,		
		s.civil_veh_no,
		s.is_vehicle,
		s.nic,
        s.veh_run_pl
		
		FROM m_supplier_list as s
		LEFT OUTER JOIN  m_bank as b on s.Bank_id=b.bnk_Auto_id 
		
						
		where s.Sup_id = $sup_id";
		
		
		
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;
	}
	
	
	public static function SelectSupplierDetailForCorrection($sup_id)
	{
		$db1 = new db_con();
		$sqlselect = "select * from temp_all_modsupplier WHERE id =$sup_id ";
		
		
		
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		//die ();
		return $data;
		//return $sqlselect;
	}
	
	
	public static function Vote_Update($vote_number,$description,$vttype,$vote_id,$create_user_id,$Create_date)
	{
		$db1 = new db_con();		
		$sqlupdate = "UPDATE votes SET 
					vote_number='$vote_number',
					description='$description',
					vt_type=$vttype,
					create_user_id=$create_user_id,
					Create_date='$Create_date'
					WHERE vote_id=$vote_id";
					
			//	echo $sqlupdate;
			//	die();
				
					
		$data = $db1->Execute($sqlupdate);
		return $data;
	}
	
	
		
	

	public static function Vote_Delete($vote_id)
	{
		$db1 = new db_con();
		$sqldelete = "DELETE  FROM votes WHERE vote_id = '$vote_id'";	
		$data = $db1->Execute($sqldelete);
	//	echo $sqldelete;
		return $data;

	}
	
	public static function Suppplier_Delete($vote_id)
	{
		$db1 = new db_con();
		$sqldelete = "DELETE  FROM m_supplier_list WHERE Sup_id = '$vote_id'";	
		$data = $db1->Execute($sqldelete);
	//	echo $sqldelete;
		return $data;

	}
	
	
	public static function GetVoteDetails()
	{
		$db1 = new db_con();
		$sqlselect = "select v.*,t.vt_type_name from votes as v
		INNER JOIN vote_type as t on t.vt_type_id=v.vt_type
		ORDER BY v.vote_number";	
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	
	
	public static function VotesreltoBranch($branch_id)
	{
		$db1 = new db_con();
		$sqlselect = "select v.vote_id,v.vote_number from pso_view_chart as p 
		INNER JOIN votes as v on v.vote_id=p.Vote_ID
		where p.Branch_ID=$branch_id
		ORDER BY v.vote_number";	
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	public static function GetVoteDetails_pagination($start, $length)
	{
		$db1 = new db_con();
		$sqlselect = "select v.*,t.vt_type_name from votes as v
		INNER JOIN vote_type as t on t.vt_type_id=v.vt_type
		ORDER BY v.vote_number ASC limit $start, $length";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	
	
	public static function GetVoteDetailstoPsoViewRecurrent($branch_id,$log_year)
	{
		$db1 = new db_con();
		$sqlselect = "select b.branch_name,v.vote_number,v.description,v.vt_type,v.vote_id 
		,(select SUM(amount) from m_money_allocation 
		where year=$log_year and Vot_Number=vc.Vote_ID AND branch_id = $branch_id AND from_branch = 0) as Alloc
		
		, (select SUM(b.Amount) from vote_bill_amount as b 
		
		INNER JOIN txt_bill_details as t on t.Bill_No=b.Bill_No and t.Bill_Id=b.Bill_Id
		AND b.Bill_Staus=1 
		LEFT OUTER JOIN return_details as rt on rt.Bill_Id = b.Bill_Id	
		where b.Vote_ID=vc.Vote_ID and b.Current_Year=$log_year 
		and b.Bill_Staus=1 and t.branch_id=$branch_id group by b.Vote_ID) as exp1
		
		,(select SUM(ab.Amount) from sfhq_vote_bill_amount as ab 
		INNER JOIN sfhq_bill_details as a on a.Bill_No=ab.Bill_No and a.Bill_Id=ab.Bill_Id 
		and a.sfhq_id=ab.sfhq_id and ab.Bill_Staus=1 		
		LEFT OUTER JOIN sfhq_return_details as rrt on rrt.Bill_Id=ab.Bill_Id		
		where ab.Vote_ID=vc.Vote_ID and ab.Current_Year=$log_year and ab.Bill_Staus=1 and a.branch_id=$branch_id  group by ab.Vote_ID )  as exp2
		
		
		from pso_view_chart as vc 
		INNER JOIN votes AS v on v.vote_id = vc.Vote_ID 
		INNER JOIN m_branches AS b on b.branch_id = vc.Branch_ID
		WHERE vc.Branch_ID=$branch_id and v.vt_type=1 ORDER BY v.vt_type";
		
	//	echo $sqlselect;
	//	die();
			
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	public static function GetVoteDetailstoPsoViewCapital($branch_id,$log_year)
	{
		$db1 = new db_con();
		$sqlselect = "select b.branch_name,v.vote_number,v.description,v.vt_type,v.vote_id 
		,(select SUM(a.amount) from m_money_allocation as a 
		where a.year=$log_year and a.Vot_Number=vc.Vote_ID AND a.branch_id = $branch_id AND a.from_branch = 0) as Alloc
						
		,(select SUM(b.Amount) from vote_bill_amount as b 		
		INNER JOIN txt_bill_details as t on t.Bill_No=b.Bill_No and t.Bill_Id=b.Bill_Id
		AND b.Bill_Staus=1 
		LEFT OUTER JOIN return_details as rt on rt.Bill_Id = b.Bill_Id		
		where b.Vote_ID=vc.Vote_ID and b.Current_Year=$log_year 
		and b.Bill_Staus=1		
		group by b.Vote_ID ) as exp1
		
		
		
		,(select SUM(ab.Amount) from sfhq_vote_bill_amount as ab 		
		INNER JOIN sfhq_bill_details as a on a.Bill_No=ab.Bill_No and a.Bill_Id=ab.Bill_Id 
		and a.sfhq_id=ab.sfhq_id and ab.Bill_Staus=1 		
		LEFT OUTER JOIN sfhq_return_details as rrt on rrt.Bill_Id=ab.Bill_Id		
		where ab.Vote_ID=vc.Vote_ID and ab.Current_Year=$log_year and ab.Bill_Staus=1 and a.branch_id=$branch_id group by ab.Vote_ID ) as exp2,
		ty.vt_type_name
		
		
				
		from pso_view_chart as vc 		
		INNER JOIN votes AS v on v.vote_id = vc.Vote_ID 
		INNER JOIN m_branches AS b on b.branch_id = vc.Branch_ID
		INNER JOIN vote_type as ty on ty.vt_type_id=v.vt_type
		WHERE vc.Branch_ID=$branch_id  ORDER BY v.vt_type";
		//and v.vt_type=2
	//	echo $sqlselect;
		//die();
			
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	public static function GetExpenditureDetailsReporttoPsoview($year,$branch_id,$status,$vote_id){
		$db1 = new db_con();
		$sqlselect = "SELECT 0 AS Sfhq_Id ,SUM(b.Amount) as Exp
		,(select SUM(amount) from m_money_allocation where sfhq_id=0 and year=$year and Vot_Number=$vote_id ) as Alloc
		,'DTE OF FIN' as Sfhq_Name
		FROM vote_bill_amount as b
		INNER JOIN txt_bill_details as t on t.Bill_No=b.Bill_No and t.Bill_Id=b.Bill_Id
		and b.Vote_ID=$vote_id AND b.Bill_Staus=1 
		LEFT OUTER JOIN return_details as rt on rt.Bill_Id = b.Bill_Id
		WHERE b.Current_Year =$year AND b.Bill_Staus=1 and t.Branch_id=$branch_id 
		GROUP BY b.Current_Year
		
		UNION ALL
		
		SELECT b.Sfhq_Id as Sfhq_Id ,SUM(b.Amount) as Exp		
		,(select SUM(amount) from m_money_allocation where sfhq_id=b.sfhq_id and year=$year and Vot_Number=$vote_id ) as Alloc
		,s.Name
		FROM sfhq_vote_bill_amount as b	
		INNER JOIN sfhq_bill_details as a on a.Bill_No=b.Bill_No and a.Bill_Id=b.Bill_Id and a.sfhq_id=b.sfhq_id
		and b.Vote_ID=$vote_id and b.Bill_Staus=1 
		INNER JOIN m_sfhq as s on s.ID=a.sfhq_id
		LEFT OUTER JOIN sfhq_return_details as rrt on rrt.Bill_Id=b.Bill_Id
		WHERE b.Bill_Staus=1  and a.Branch_id=$branch_id
		
		GROUP BY a.Sfhq_Id 
		ORDER BY Sfhq_Id";
		
		
		//echo $sqlselect;
	  //  die();
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	public static function GetBranchNametoPsoView($branch_id)	
	{
		$db1 = new db_con();
		$sqlselect = "select branch_name from m_branches WHERE branch_id = $branch_id";			
		//echo $sqlselect; die();
		
		
		$data = $db1->Getrow($sqlselect);
		return $data;	
				
	}
	
	public static function GetSupplierDetails_pagination($seatch,$veh_type,$start, $length)
	{
		$sfhq_id 	= $_SESSION['sfhqID'];
		
		if($veh_type==2){
			
			$veh_type='is_vehicle';
			
		}
		
		
		$db1 = new db_con();
		
		//$sqlselect = "select * from m_supplier_list 
	//	WHERE m_supplier_list.Related_sfhq_id ='$sfhq_id'  and m_supplier_list.Sup_Name LIKE '%$seatch%' 
		//ORDER BY m_supplier_list.Sup_Name ASC limit $start, $length";
		
		
		$sqlselect = "select * from m_supplier_list 
		WHERE Sup_Name LIKE '%$seatch%' AND is_vehicle=$veh_type
		ORDER BY Sup_Name ASC limit $start, $length";
	
						
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;		
	}
	
	
}

?>
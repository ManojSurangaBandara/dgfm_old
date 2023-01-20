<?php 
class ProjectsProgress{
	
	
	public $proj_pro_report_id			 	 = NULL;
	public $proj_id 	 					 = NULL;
	public $allocated_ammount_year 			 = NULL;
	public $allocated_ammount 			 	 = NULL;
	public $paid_year 						 = NULL;
	public $paid_amount 		 			 = NULL;
	public $bills_paid 		 				 = NULL;
	public $completing_state_as_percentage 	 = NULL;
	public $report_file 			 		 = NULL;
	public $report_file1 			 		 = NULL;
	public $report_file2 			 		 = NULL;
	public $remarks		 			 		 = NULL;	
	public $report_date	 			 		 = NULL;
	public $create_user_id 			 		 = NULL;
	public $create_date 			 		 = NULL;
	public $modified_user_id		 		 = NULL;
	public $modified_date 			 		 = NULL;
	public $sending_states 			 		 = NULL;
	public $progress_id 			 		 = NULL;
	public $total_complete 			 		 = NULL;
	
	
	
	
	
//constructor
	private function __construct()
	{
		
	}
	
	///////////////////////////////////////////DGFM
	
	public static function GetBillAmountandVotes($id,$Bill_No){
		$db1 = new db_con();
		$sqlselect = "SELECT v.Bill_No,v.Vote_ID, v.Amount,T.vote_number,T.description 
		
, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = v.Vote_ID) ,0)
- IFNULL((SELECT SUM(vb.Amount) FROM vote_bill_amount as vb 
		INNER JOIN txt_bill_details as b  ON b.Bill_No = vb.Bill_No AND b.Bill_Id = vb.Bill_Id AND b.Bill_Status = 1		
		WHERE vb.Vote_ID = v.Vote_ID AND vb.Bill_Staus = 1),0) 
- IFNULL((SELECT SUM(Amount) FROM sfhq_vote_bill_amount AS ab
		INNER JOIN sfhq_bill_details AS a ON a.Bill_No = ab.Bill_No AND a.Bill_Id = ab.Bill_Id AND a.sfhq_id = ab.sfhq_id 
AND ab.Bill_Staus = 1 WHERE ab.Vote_ID = v.Vote_ID AND ab.Bill_Staus = 1),0)
) as remain
		FROM vote_bill_amount as v
		INNER JOIN votes T ON v.Vote_ID = T.vote_id 
		WHERE v.Bill_Id = $id and v.Bill_No = $Bill_No ";
		
		//echo $sqlselect; die();
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}

	
	
	
	public static function GetBillAmountandVotesToSfhq($id,$bill_no ){
		$db1 = new db_con();
		$sqlselect = "SELECT v.Bill_No,v.Vote_ID, v.Amount,T.vote_number,T.description 
		, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = v.Vote_ID) ,0)
- IFNULL((SELECT SUM(vb.Amount) FROM vote_bill_amount as vb 
		INNER JOIN txt_bill_details as b  ON b.Bill_No = vb.Bill_No AND b.Bill_Id = vb.Bill_Id AND b.Bill_Status = 1		
		WHERE vb.Vote_ID = v.Vote_ID AND vb.Bill_Staus = 1),0) 
- IFNULL((SELECT SUM(Amount) FROM sfhq_vote_bill_amount AS ab
		INNER JOIN sfhq_bill_details AS a ON a.Bill_No = ab.Bill_No AND a.Bill_Id = ab.Bill_Id AND a.sfhq_id = ab.sfhq_id 
AND ab.Bill_Staus = 1 WHERE ab.Vote_ID = v.Vote_ID AND ab.Bill_Staus = 1),0)
) as remain
		FROM sfhq_vote_bill_amount as v
		INNER JOIN votes T ON v.Vote_ID = T.vote_id 
		WHERE v.Bill_Id = $id and v.Bill_No = $bill_no ";
		
	//	echo $sqlselect;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
		public static function GetBillAmountandVoteswithname($id){
		$db1 = new db_con();
		$sqlselect = "SELECT Bill_No,Vote_ID, Amount FROM vote_bill_amount WHERE Bill_No = $id";
		
	///	echo $sqlselect;
		$data = $db1->Getrow($sqlselect);
		//echo $sqlselect;
		return $data;	
	}
		
	
	/////////////////////////////////////////// DGFM
	
	public static function GetAllProjects($unitid,$ge_id){
		$db1 = new db_con();
		$sqlselect = "SELECT project_id,project_name,project_type 
						FROM m_project_details WHERE project_status =1 and proj_completing_status =0
						and esr_unit_id = $unitid and ge_center_id = $ge_id ";
		//echo $sqlinsert; exit;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	
	
	public static function GetMaxID(){
		$db1 = new db_con();
		$sqlselect = "SELECT MAX(proj_pro_report_id) as max FROM project_progress_report";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
		
	public static function Truncate_tembill(){
		$db1 = new db_con();
		$sqltruncate = "TRUNCATE TABLE temp_billdetails";
		$data = $db1->GetAll($sqltruncate);
	//	echo $sqltruncate;
		return $data;	
		
		
	}
	
	
	
	
	public static function GetTembillDetails($id){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM temp_billdetails WHERE id = $id";
		
	///	echo $sqlselect;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	public static function GetBillDetails($id){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM billdetails WHERE Progress_id = $id";
		
	///	echo $sqlselect;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
		
	
	public static function GetProjectData($projectID){
		$db1 = new db_con();
		$sqlselect = "SELECT 
		project_id,
		project_name,
		project_allocated_amount,
		project_location,
		project_start_date,
		project_end_date,
		project_Description, 
		proj_allocated_stations,
		name_of_contractor,
		project_type,          
		project_reference_id,
		RefDate,
		Estimated_Amount,
		G69_No,
		Dates,
		Vote_Number,
		Job_number
		FROM m_project_details WHERE project_id = $projectID and project_status =1";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetprojectReports($projectID){
		$db1 = new db_con();
		$sqlselect = "SELECT  
							proj_pro_report_id ,
							report_date,
							allocated_ammount_year ,
							allocated_ammount,
							paid_year,
							paid_amount,
							bills_paid,
							sending_status,
							completing_state_as_percentage,
							remarks,
							report_file 								
							FROM project_progress_report WHERE proj_id  = $projectID							
							and report_status=1 order by report_date desc ";	
									
									
									
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}	
	
	
	public static function GetprojectReportsPagination($projectID,$start,$length){
		$db1 = new db_con();
		$sqlselect = "SELECT  
							proj_pro_report_id ,
							report_date,
							allocated_ammount_year ,
							allocated_ammount,
							paid_year,
							paid_amount,							
							sending_status,
							completing_state_as_percentage,
							remarks,
							report_file 								
							FROM project_progress_report WHERE proj_id  = $projectID							
							and report_status=1 order by report_date desc limit $start, $length  ";	
									
									
									
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}	
	
	
	
	
	public static function saveProjectReport($proj_id,$allocated_ammount_year,$allocated_ammount,$paid_year,$paid_amount,$completing_state_as_percentage,$report_file,$report_file1,$report_file2,$report_file3,$remarks,$report_date,$create_user_id,$create_date,$sending_states,$report_states,$total_complete,$IsTBapproval,$Aproval_Date,$award_sum)
	{
		
		$db1 = new db_con();
		
	$sqlinsert1 = "UPDATE m_project_details SET proj_completing_status = '$total_complete' WHERE project_id = '$proj_id' ";
		$data1 = $db1->Execute($sqlinsert1);
		
		$sqlinsert = "INSERT INTO project_progress_report(   
						proj_id,
						allocated_ammount_year,
						allocated_ammount,
						paid_year ,
						paid_amount,						
						completing_state_as_percentage,
						report_file,
						report_file1,
						report_file2 ,
						report_file3 ,
						remarks,
						report_date,
						create_user_id,
						create_date,
						sending_status,
						report_status,
						IsTBapproval,
						Aproval_Date,
						Award_sum)
						VALUES (
						'$proj_id',
						'$allocated_ammount_year',
						'$allocated_ammount',
						'$paid_year',
						'$paid_amount',						
						'$completing_state_as_percentage',
						'$report_file',
						'$report_file1',
						'$report_file2',
						'$report_file3',
						'$remarks',
						'$report_date',
						'$create_user_id',
						'$create_date',
						'$sending_states',
						'$report_states',
						'$IsTBapproval',
						'$Aproval_Date',
						'$award_sum')";
		$data = $db1->Execute($sqlinsert);
		//echo $sqlinsert;
		//echo $sqlinsert1;
		return $data;
	}
	
	
	
	
	
	
	
	public static function GetProjectType()
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM project_type";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	public static function editProject($project_id,
						   $project_reference_id,
						   $project_name,
						   $project_status,
						   $project_allocated_amount,
						   $project_start_date,
						   $project_end_date,
						   $project_location,
						   $project_type,
						   $date_of_tender_called,
						   $date_of_tender_opened,
						   $date_of_tec_appointed,
						   $date_of_tb_appointed,                           
						   $name_of_contractor,
						   $awarded_date,
						   $extension_given,
						   $proj_allocated_stations,
						   $proj_created_date ,
						   $proj_created_user,
						   $project_Description)
	{
		$db1 = new db_con();
		 $sqlinsert = "UPDATE m_project_details SET	   
									project_reference_id = '$project_reference_id',
									project_name = '$project_name',
									project_status = '$project_status',
									project_allocated_amount = '$project_allocated_amount',
									project_start_date = '$project_start_date',
									project_end_date = '$project_end_date',
									project_location = '$project_location',
									project_type = '$project_type',						
									date_of_tender_called = '$date_of_tender_called',
									date_of_tender_opened = '$date_of_tender_opened',
									date_of_tec_appointed = '$date_of_tec_appointed',
									date_of_tb_appointed = '$date_of_tb_appointed',
									name_of_contractor = '$name_of_contractor',
									awarded_date = '$awarded_date',
									extension_given = '$extension_given',				
									proj_allocated_stations = '$proj_allocated_stations',
									proj_created_date = '$proj_created_date',
									proj_created_user = '$proj_created_user',						
									project_Description = '$project_Description'
									WHERE project_id = '$project_id'";
		$data = $db1->Execute($sqlinsert);
		//echo $sqlinsert;
		return $data;
	}
	
	public static function GetGEName($esrid){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM ge WHERE  Esr_unit_id= '$esrid'";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function DeleteProjectReport($id)
	{
		$db1 = new db_con();
		$sqldelete = "DELETE FROM project_progress_report WHERE proj_pro_report_id = $id";
		$sqlbilldelete = "DELETE FROM billdetails WHERE Progress_id = $id";
		
		//echo $sqldelete;
		//echo $sqlbilldelete;		
		$data1 = $db1->Execute($sqlbilldelete);
		$data = $db1->Execute($sqldelete);
		return $data;
	}
	public static function DeleteToEditBillDetails($id)
	{
		$db1 = new db_con();
		$sqldelete = "DELETE FROM billdetails WHERE Progress_id = $id";
		
		//echo $sqldelete;				
		$data = $db1->Execute($sqldelete);
		return $data;
	}
	
	
	
	public static function DeleteTempBillsDetails($id)
	{
		$db1 = new db_con();
		$sqldelete = "DELETE FROM temp_billdetails WHERE Id = $id";
		$data = $db1->Execute($sqldelete);
		return $data;

	}
	
	public static function CheckIsPrivilege($uid)
	{
		$db1 = new db_con();
		$sqlcheck = "SELECT Isprivilege_user FROM users WHERE user_id = $uid";
		$data = $db1->GetAll($sqlcheck);
		return $data;	

	}
	
	
	
	
	
	public static function UpdateStatusProjectReport($id)
	{
		$db1 = new db_con();
		$sqldelete = "Update project_progress_report SET sending_status = 1 WHERE proj_pro_report_id = $id";
		$data = $db1->Execute($sqldelete);
		return $data;

	}
	
	public static function TemporysaveBillDetails($description,$amount)
	{
		$db1 = new db_con();
		$sqltempsave = "INSERT INTO temp_billdetails (Description,Amount) VALUES ('$description','$amount') ";
		//echo $sqltempsave ;
		$data = $db1->Execute($sqltempsave);
		return $data;

	}
	
	public static function TemporyUpdateBillDetails($rowid,$description,$amount)
	{
		
		
		$db1 = new db_con();
		$sqltempsave = "UPDATE temp_billdetails SET Description ='$description',
													Amount ='$amount' WHERE Id = '$rowid'";
		//echo $sqltempsave ;
		$data = $db1->Execute($sqltempsave);
		return $data;

	}
	
	
	public static function saveBillDetails($progid)
	{
		$db1 = new db_con();
		$sqlbilsave = "INSERT INTO billdetails (Progress_id,Description,Amount) SELECT $progid, Description, Amount
						FROM temp_billdetails";		
		//echo $sqltempsave ;
		$data = $db1->Execute($sqlbilsave);
		return $data;

	}
	
	
	
	public static function InsertIntoBillsToTempTable($progid)
	{
		$db1 = new db_con();
		
		$sqlbilinsert = "INSERT INTO temp_billdetails (Description,Amount) SELECT Description,Amount FROM billdetails WHERE 		                         Progress_id = $progid";		
		//echo $sqlbilinsert ;
		$data = $db1->Execute($sqlbilinsert);
		return $data;

	}
	
	
	
	
	
	
	
	public static function GetprogressReport($progress_id){
		$db1 = new db_con();
		$sqlselect =   "SELECT  ppr.proj_pro_report_id,
								ppr.proj_id,
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
								pd.project_name,
								ppr.report_file1,
								ppr.report_file2,
								ppr.IsTBapproval,
								ppr.Aproval_Date,
								ppr.report_file3,
								ppr.Award_sum
								FROM project_progress_report ppr
								INNER JOIN m_project_details pd ON ppr.proj_id=pd.project_id		
								WHERE ppr.proj_pro_report_id = $progress_id 
								and pd.project_status =1 and ppr.report_status = 1  ";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;	
	}
	
            
	
	public static function editProjectProgressreport( $proj_pro_report_id,
										$report_date,
										$allocated_ammount_year,
										$allocated_ammount,
										$paid_year,
										$paid_amount,										
										$completing_state_as_percentage,
										$remarks,
										$report_file,
										$report_file1,
										$report_file2,
										$report_file3,
										$modified_user_id,
										$modified_date,
										$total_complete,
										$proj_id,
										$IsTBapproval,
										$Aproval_Date,
										$Award_sum)
	{
		$db1 = new db_con();
		
				
		
	
		
		$sqlinsert1 = "UPDATE m_project_details SET proj_completing_status = '$total_complete' 
					   WHERE project_id = '$proj_id' ";
		$data1 = $db1->Execute($sqlinsert1);
		
		
		
		
		$sqlbillInsert = "INSERT INTO  billdetails (Progress_id,Description,Amount) 
		                   SELECT $proj_pro_report_id,Description,Amount FROM temp_billdetails";
		$data2 = $db1->Execute($sqlbillInsert);
		
		
		
		
		 $sqlinsert = "UPDATE project_progress_report SET	 		
							report_date='$report_date',
							allocated_ammount_year='$allocated_ammount_year',
							allocated_ammount='$allocated_ammount',
							paid_year='$paid_year',
							paid_amount='$paid_amount',							
							completing_state_as_percentage='$completing_state_as_percentage',
							remarks='$remarks',
							report_file='$report_file',
							report_file1='$report_file1',
							report_file2='$report_file2',
							report_file3='$report_file3',
							modified_user_id='$modified_user_id',
							modified_date='$modified_date',		
							IsTBapproval='$IsTBapproval',
							Aproval_Date='$Aproval_Date',
							Award_sum='$Award_sum'
							WHERE proj_pro_report_id = '$proj_pro_report_id'";
		$data = $db1->Execute($sqlinsert);
		//echo $sqlinsert;
		return $data;
	}
	
	
	
	
	
	
}

?>
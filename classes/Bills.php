<?php 

include "ESMSWS.php";
class Bills{
	
	
	public $project_id			 	 = NULL;
	public $project_reference_id 	 = NULL;
	public $project_name 			 = NULL;
	public $project_status 			 = true;
	public $project_allocated_amount = 0.0;
	public $project_start_date 		= NULL;
	public $project_end_date 		= NULL;
	public $project_location 		= NULL;
	public $project_type 			= NULL;
	public $date_of_tender_called 	= NULL;
	public $date_of_tender_opened  	= NULL;
	public $date_of_tec_appointed 	= NULL;
	public $date_of_tb_appointed 	= NULL;
	public $name_of_contractor 		= NULL;
	public $awarded_date 			= NULL;
	public $extension_given  		= NULL;
	public $proj_allocated_stations = NULL;	
	public $proj_created_date 		= NULL;
	public $proj_created_user 		= NULL;
	public $project_Description 	= NULL;
	public $esr_unit_id			 	= NULL;
	public $ge_id			 		= NULL;
	public $projType		 		= NULL;
	
	
	
//constructor
	private function __construct()
	{
		
	}
	
	////////////////////////////////////////////////////////////// DGFM
	
	public static function GetVoteData($id)
	{
		$db1 = new db_con();
		//$sqlselect = "SELECT * FROM votes WHERE vote_id =$id";
		
		
		$sqlselect = "select v.description, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = $id) ,0)
- IFNULL((SELECT SUM(vb.Amount) FROM vote_bill_amount as vb 
		INNER JOIN txt_bill_details as b  ON b.Bill_No = vb.Bill_No AND b.Bill_Id = vb.Bill_Id AND b.Bill_Status = 1		
		WHERE vb.Vote_ID = $id AND vb.Bill_Staus = 1),0) 
- IFNULL((SELECT SUM(Amount) FROM sfhq_vote_bill_amount AS ab
		INNER JOIN sfhq_bill_details AS a ON a.Bill_No = ab.Bill_No AND a.Bill_Id = ab.Bill_Id AND a.sfhq_id = ab.sfhq_id AND ab.Bill_Staus = 1 WHERE ab.Vote_ID = $id AND ab.Bill_Staus = 1),0)
) as remain from votes as v where vote_id=$id";		
		
		
		$data = $db1->GetAll($sqlselect);
		return $data;
	}
	
	
	public static function CheckIsPrivilege($uid)
	{
		$db1 = new db_con();
		$sqlcheck = "SELECT Isprivilege_user FROM users WHERE user_id = $uid";
		$data = $db1->GetAll($sqlcheck);
		return $data;

	}
	public static function saveNewSfhqBill(		   $brach_id,	
									   $sfhq_id, 
									   $allocated_regiment,
						          	   $bill_ref_no,
						   			   $Payee_name,
						   			   $recieved_date,
						   			   $invoice_date,
									   $remarks,
									   $vote_id1,
									   $vote_id2,
									   $vote_id3,
									   $amount1,
									   $amount2,
									   $amount3,
									   $user_type_id,
									   $ststus,
						   			   $created_date,
						               $created_user,
						   			   $modified_date,
						   			   $modified_user,
									   $details,									   
						 			   $Invoice_no,
									   $g35_no,
									   $g35_date,
									   $from_period,
									   $to_period,
                                       $ledger_date)
	{
		
		
		
			
			
		$db = new db_con();	
		$get_max = "SELECT MAX(Bill_No) as maxbillno 
					  FROM sfhq_bill_details WHERE Sfhq_Id=$sfhq_id ";
		$max = $db->GetAll($get_max);		
		
		$num_rows = count($max);
					
					if ($num_rows >0 ) { 
					
					foreach ($max as $rowmax) {
									
					$bill_no = $rowmax[0];			
						
						$bill_no = $bill_no+1;		
						
						
						switch (strlen($bill_no)) {
							case 1:
								$bill_no = '0000'.$bill_no;
								break;
							case 2:
								$bill_no = '000'.$bill_no;
								break;
							case 3:
								$bill_no = '00'.$bill_no;
								break;
							case 4:
								$bill_no = '0'.$bill_no;
								break;
							case 5:
								$bill_no = $bill_no;
								break;
							default:
								$bill_no = '00001';
						}
					}
					
					}
					
						
		$sqlinsert = "INSERT INTO sfhq_bill_details(   
						Bill_No,
						Sup_Code,
						Sfhq_Id,
						Unit_Id,
						Recieved_Date,
						Invoice_date,	
						Bill_Status,
						branch_id,
						UserTypeId,
						remarks,						
						Bill_ref_no,
						Create_Date,
						Create_User_ID ,
						Modified_Date ,						
						Modified_User_ID,
						details,
						Invoice_No,
						G35_No,
						G35_Date,
						bill_period_from,
						bill_period_to,
                        veh_run_pl_id,
                        ledger_date
						)
						
						VALUES ( '$bill_no',
						  	 	 '$Payee_name',	
								 '$sfhq_id', 
								 '$allocated_regiment',
								 '$recieved_date',
								 '$invoice_date',
								 '$ststus',
								 '$brach_id',
								 '$user_type_id',
								 '$remarks',								
								 '$bill_ref_no',
						  		 '$created_date',
						         '$created_user',
						   		 '$modified_date',
						   		 '$modified_user',
								 '$details',
								 '$Invoice_no',
								 '$g35_no',
								 '$g35_date',
								 '$from_period',
								 '$to_period',
                                 (select veh_run_pl from m_supplier_list where Sup_id=$Payee_name),
                                 '$ledger_date'	)";
						
      //  echo $sqlinsert;die();
        
						$data = $db->Execute($sqlinsert);
						$Invoiceyear = date("Y", strtotime($invoice_date));
						
						
						
						if(($amount1>0)&&($amount2>0)&&($amount3>0)){							
							$sqlinser1 = "INSERT INTO  sfhq_vote_bill_amount(Bill_No,Vote_ID,Amount,Current_Year,Bill_Id,	Recieved_Month,Bill_Staus,Sup_Code,Sfhq_Id,Invoice_Year) VALUES 
('$bill_no',$vote_id1,'$amount1',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM sfhq_bill_details AS MaxID where sfhq_id=$sfhq_id) , MONTH('$recieved_date') ,0, $Payee_name,$sfhq_id,'$Invoiceyear'),
('$bill_no',$vote_id2,'$amount2',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM sfhq_bill_details AS MaxID where sfhq_id=$sfhq_id) , MONTH('$recieved_date') ,0, $Payee_name,$sfhq_id,'$Invoiceyear'),
('$bill_no',$vote_id3,'$amount3',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM sfhq_bill_details AS MaxID where sfhq_id=$sfhq_id) , MONTH('$recieved_date') ,0, $Payee_name,$sfhq_id,'$Invoiceyear')";
						$data1 = $db->Execute($sqlinser1);	
						}
						elseif (($amount1>0)&&($amount2>0)){							
							$sqlinser1 = "INSERT INTO  sfhq_vote_bill_amount(Bill_No,Vote_ID,Amount,Current_Year,Bill_Id,	Recieved_Month,Bill_Staus,Sup_Code,Sfhq_Id,Invoice_Year) VALUES
('$bill_no',$vote_id1,'$amount1',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM sfhq_bill_details AS MaxID where sfhq_id=$sfhq_id) , MONTH('$recieved_date') ,0, $Payee_name,$sfhq_id,'$Invoiceyear'),
('$bill_no',$vote_id2,'$amount2',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM sfhq_bill_details AS MaxID where sfhq_id=$sfhq_id) , MONTH('$recieved_date') ,0, $Payee_name,$sfhq_id,'$Invoiceyear')";
						$data1 = $db->Execute($sqlinser1);	
						}
						else {
							$sqlinser1 = "INSERT INTO  sfhq_vote_bill_amount(Bill_No,Vote_ID,Amount,Current_Year,Bill_Id,	Recieved_Month,Bill_Staus,Sup_Code,Sfhq_Id,Invoice_Year) VALUES 
('$bill_no',$vote_id1,'$amount1',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM sfhq_bill_details AS MaxID where sfhq_id=$sfhq_id) , MONTH('$recieved_date') ,0, $Payee_name,$sfhq_id,'$Invoiceyear')";
								
						$data1 = $db->Execute($sqlinser1);								
						}
						
						
				if($data==true && $data1==true)				
				{		
				
		header("Location:../SfhqAddBills.php?msg=1&brach_id=".$brach_id."&maxresult=".$bill_no."&sup_id=".$Payee_name."&vote_id1=".$vote_id1."&vote_id2=".$vote_id2."&vote_id3=".$vote_id3."&votename=".$_POST['vote_name1']."&votename2=".$_POST['vote_name2']."&votename3=".$_POST['vote_name3']."&re_date=".$_POST['txtstart_date']."&in_date=".$_POST['invoice_date']."&details1=".$_POST['details']);
		
				}
				elseif($result==false)
				{
					header("Location:../SfhqAddBills.php?msg=2");	
				}		
						
												/*	$db1 = new db_con();
													$sqlinser1 = "INSERT INTO  sfhq_vote_bill_amount(Bill_No,Vote_ID,Amount,Current_Year,Bill_Id,	Recieved_Month,Bill_Staus,Sup_Code,Sfhq_Id,Invoice_Year)
					VALUES ('$bill_no','$vote_id1','$amount1',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM sfhq_bill_details AS MaxID) , MONTH('$recieved_date') ,0, '$Payee_name','$sfhq_id','$Invoiceyear')";
													$data1 = $db1->Execute($sqlinser1);
													//echo $sqlinser1;
													if($amount2|='')
													{
													$db2 = new db_con();
													$sqlinser2 = "INSERT INTO  sfhq_vote_bill_amount(Bill_No,Vote_ID,Amount,Current_Year,Bill_Id,	Recieved_Month,Bill_Staus,Sup_Code,Sfhq_Id,Invoice_Year)
				VALUES ('$bill_no','$vote_id2','$amount2',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM sfhq_bill_details AS MaxID),MONTH('$recieved_date'),0, '$Payee_name','$sfhq_id','$Invoiceyear')";
													$data2 = $db2->Execute($sqlinser2);
												//	echo $sqlinser2;
													}
													
													if($amount3|='')
													{
													$db3 = new db_con();
													$sqlinser3 = "INSERT INTO  sfhq_vote_bill_amount(Bill_No,Vote_ID,Amount,Current_Year,Bill_Id,	Recieved_Month,Bill_Staus,Sup_Code,Sfhq_Id,Invoice_Year)
				VALUES ('$bill_no','$vote_id3','$amount3',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM sfhq_bill_details AS MaxID) ,MONTH('$recieved_date'),0, '$Payee_name','$sfhq_id' ,'$Invoiceyear')";
													
													$data3 = $db3->Execute($sqlinser3);
													}				*/									
									
		//echo $sqlinsert;  exit;		
		//return $data;
	}


	public static function saveNewBigUserBill(
									   $brach_id,			   
						          	   $bill_ref_no,
						   			   $Payee_name,
						   			   $recieved_date,
						   			   $invoice_date,
									   $remarks,
									   $vote_id1,
									   $vote_id2,
									   $vote_id3,
									   $amount1,
									   $amount2,
									   $amount3,
									   $user_type_id,
									   $ststus,
						   			   $created_date,
						               $created_user,
						   			   $modified_date,
						   			   $modified_user,
									   $details,
									   $Invoice_no,
									   $g35_no,
									   $g35_date,
									   $from_period,
									   $to_period,
                                       $ledger_date
						  )
	{
		
		
	
			
		$db = new db_con();	
		$get_max = "SELECT MAX(Bill_No) as maxbillno FROM txt_bill_details";
		$max = $db->GetAll($get_max);	
		$num_rows = count($max);
					
					if ($num_rows >0 ) { 
							
					foreach ($max as $rowmax) {
						$bill_no = $rowmax[0];			
						$bill_no = $bill_no+1;		
						
						switch (strlen($bill_no)) {
							case 1:
								$bill_no = '0000'.$bill_no;
								break;
							case 2:
								$bill_no = '000'.$bill_no;
								break;
							case 3:
								$bill_no = '00'.$bill_no;
								break;
							case 4:
								$bill_no = '0'.$bill_no;
								break;
							case 5:
								$bill_no = $bill_no;
								break;
							default:
								$bill_no = '00001';
						}
					}
					
					}
		
		
		
		
		
		$db = new db_con();
		$sqlinsert = "INSERT INTO txt_bill_details (   
						Bill_No,
						Bill_Name,
						Amount,
						Amount2,
						Amount3,						
						Recieved_Date,
						Invoice_date,	
						Bill_Status,
						branch_id,
						UserTypeId,
						remarks,
						Settled_Vote_ID,
						Vote_Id2,
						Vote_Id3,	
						Bill_ref_no,
						Create_Date,
						Create_User_ID ,
						Modified_Date ,						
						Modified_User_ID,
						details,
						Invoice_No,
						G35_No,
						G35_Date,
						bill_period_from,
						bill_period_to,
                        veh_run_pl_id,
                        ledger_date
						)
						VALUES ( '$bill_no',
						  	 	 '$Payee_name',
						  		 '$amount1',
								 '$amount2',
								 '$amount3',
								 '$recieved_date',
								 '$invoice_date',
								 '$ststus',
								  $brach_id,
								 '$user_type_id',
								 '$remarks',
								  $vote_id1,
								  $vote_id2,
								  $vote_id3,
								 '$bill_ref_no',
						  		 '$created_date',
						         '$created_user',
						   		 '$modified_date',
						   		 '$modified_user',
								 '$details',
								 '$Invoice_no',
								 '$g35_no',
								 '$g35_date',
								 '$from_period',
								 '$to_period',
                                 (select veh_run_pl from m_supplier_list where Sup_id=$Payee_name),
                                 '$ledger_date'
                                 )";
						
		//echo $sqlinsert; die();				
        $data = $db->Execute($sqlinsert);
						$Invoiceyear = date("Y", strtotime($invoice_date));
													
							
						if(($amount1>0)&&($amount2>0)&&($amount3>0)){							
							$sqlinser1 = "INSERT INTO  vote_bill_amount(Bill_No,Vote_ID,Amount,Current_Year,Bill_Id,Bill_Staus,Recieved_Month,Sup_Code,Invoice_Year)
VALUES ('$bill_no',$vote_id1,'$amount1',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM txt_bill_details AS MaxID) ,0,MONTH('$recieved_date'),$Payee_name,'$Invoiceyear')
,('$bill_no',$vote_id2,'$amount2',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM txt_bill_details AS MaxID) ,0,MONTH('$recieved_date'),$Payee_name,'$Invoiceyear'),
('$bill_no',$vote_id3,'$amount3',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM txt_bill_details AS MaxID) ,0,MONTH('$recieved_date'),$Payee_name,'$Invoiceyear')";
						$data1 = $db->Execute($sqlinser1);	
						}
						elseif (($amount1>0)&&($amount2>0)){							
							$sqlinser1 = "INSERT INTO  vote_bill_amount(Bill_No,Vote_ID,Amount,Current_Year,Bill_Id,Bill_Staus,Recieved_Month,Sup_Code,Invoice_Year)
VALUES ('$bill_no',$vote_id1,'$amount1',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM txt_bill_details AS MaxID) ,0,MONTH('$recieved_date'),$Payee_name,'$Invoiceyear')
,('$bill_no',$vote_id2,'$amount2',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM txt_bill_details AS MaxID) ,0,MONTH('$recieved_date'),$Payee_name,'$Invoiceyear')";
						$data1 = $db->Execute($sqlinser1);	
						}
						else {
							$sqlinser1 = "INSERT INTO  vote_bill_amount(Bill_No,Vote_ID,Amount,Current_Year,Bill_Id,Bill_Staus,Recieved_Month,Sup_Code,Invoice_Year)
VALUES ('$bill_no',$vote_id1,'$amount1',EXTRACT(YEAR FROM CURDATE()),(SELECT MAX(Bill_Id) FROM txt_bill_details AS MaxID) ,0,MONTH('$recieved_date'),$Payee_name,'$Invoiceyear')";
								
						$data1 = $db->Execute($sqlinser1);								
						}
						
				if($data==true && $data1==true)				
				{
						
										
				//$dt 	= Common :: CfAccSupDetSMSbyFeed($Payee_name);				
				
				//if($dt['is_vehicle']=1){
				//$username = 'esmsusr_280';
				//$password = '2d6egs3';
				//$session= createSession('', $username, $password,'');
				//sendMessages($session,'SL ARMY FIN',$dt['smsbody'],$dt['mob'],0);
				//closeSession($session);
						
				//}
					
				
					
					header("Location:../ChiefAccAddbills.php?msg=1&brach_id=".$brach_id."&maxresult=".$bill_no."&sup_id=".$Payee_name."&vote_id1=".$vote_id1."&vote_id2=".$vote_id2."&vote_id3=".$vote_id3."&votename=".$_POST['vote_name1']."&votename2=".$_POST['vote_name2']."&votename3=".$_POST['vote_name3']."&re_date=".$_POST['txtstart_date']."&in_date=".$_POST['invoice_date']."&details1=".$_POST['details']);
		
				}
				elseif($result==false)
				{
					header("Location:../ChiefAccAddbills.php?msg=2");	
				}
					
						
			
	}
	
									
	public static function saveNewBill($billno,
									   $bill_name,			   
						          	   $amount,
						   			   $allocated_regiment,
						   			   $bill_date,						   			   
									   $ststus,
									   $brach_id,
									   $Sfhq_Id,
									   $remarks,
						   			   $created_date,
						               $created_user,
						   			   $modified_date,
						   			   $modified_user
						  )
	{
		
		$db1 = new db_con();
	
		 $sqlinsert = "INSERT INTO txt_bill_details (   
						Bill_No,
						Bill_Name,
						Amount ,
						Unit_Id ,
						Recieved_Date ,						
						Bill_Status,
						Sfhq_Id,
						branch_id,
						remarks,
						Create_Date,
						Create_User_ID ,
						Modified_Date ,						
						Modified_User_ID					
						)
						VALUES ('$billno',
						  	 	'$bill_name',
						  		 '$amount',
						 		 '$allocated_regiment',
						   		 '$bill_date',						   		
						  		 '$ststus',
								 '$Sfhq_Id',
								 '$brach_id',
								 '$remarks',
						  		 '$created_date',
						         '$created_user',
						   		 '$modified_date',
						   		 '$modified_user'
						)";
						//echo $sqlinsert;  exit;
		$data = $db1->Execute($sqlinsert);
		return $data;
	}
	
	
	public static function EditBillsDetails($billno,$bill_name,$amount,
											   $allocated_regiment,
											   $bill_date,
											   $up_file,
											   $ststus,
											   $brach_id,
											   $Sfhq_Id,
											   $remarks,						   			  
											   $modified_date,
											   $modified_user,
											   $bill_id)
	{
		$db1 = new db_con();
		 $sqlinsert = "UPDATE txt_bill_details SET	Bill_No='$billno',
													 Bill_Name='$bill_name',
													 Amount='$amount',
													 Unit_Id='$allocated_regiment',
													 Recieved_Date='$bill_date',
													 Picture='$up_file',
													 Bill_Status= '$ststus',
													 Sfhq_Id='$Sfhq_Id',
													 branch_id='$brach_id',
													 remarks='$remarks',
													 Modified_Date='$modified_date',
													 Modified_User_ID='$modified_user'
													 WHERE Bill_Id = '$bill_id'";
		$data = $db1->Execute($sqlinsert);
		//echo $sqlinsert;
		return $data;
	}
	
	public static function EditBillsDetailsSFHQ($bill_no ,
									   $brach_id,			   
						          	   $bill_ref_no,
						   			   $Payee_name,
						   			   $recieved_date,
						   			   $invoice_date,
									   $remarks,
									   $modified_date,
						   			   $modified_user,
									   $bill_id,
									   $unit_dis_id,
									   $details,
									   $sfhq_id,
									   $Invoice_no,
									   $g35_no,
									   $g35_date,
									   $from_period,
									   $to_period,$ledger_date	
									   ){
										  
										   
										  
		
		$db1 = new db_con();
		 $sqlinsert = "UPDATE sfhq_bill_details SET	 Sup_Code='$Payee_name',
													 Recieved_Date='$recieved_date',
													 Invoice_date ='$invoice_date',
													 Bill_ref_no ='$bill_ref_no',
                                                     ledger_date ='$ledger_date',
													 branch_id='$brach_id',
													 Unit_Id='$unit_dis_id',
													 remarks='$remarks',
													 Modified_Date='$modified_date',
													 Modified_User_ID='$modified_user',
													 details='$details',
													 Invoice_No = '$Invoice_no',
													 G35_No	= '$g35_no',
													 G35_Date = '$g35_date'	,
													 bill_period_from='$from_period',
													 bill_period_to='$to_period'
													 				 									 
													 WHERE Bill_Id = $bill_id and Sfhq_Id = $sfhq_id  ";
													 
													// echo $sqlinsert;
													// die();
		$data = $db1->Execute($sqlinsert);
		//return $sqlinsert;
		
		
		
		$Invoiceyear = date("Y", strtotime($invoice_date));						
		$db1 = new db_con();
		
		$sqlinser1 = "UPDATE  sfhq_vote_bill_amount 
		SET Current_Year=EXTRACT(YEAR FROM CURDATE()),		
		Recieved_Month= MONTH('$recieved_date'),		
		Sup_Code='$Payee_name',
		Invoice_Year=YEAR('$invoice_date')
		WHERE Bill_Id = '$bill_id' AND Bill_No='$bill_no' AND Sfhq_Id='$sfhq_id'";		
		$data1 = $db1->Execute($sqlinser1);	
		
		//return $sqlinser1;
		return $data;
	}
	
	
	
	
	public static function EditBillsDetailsBigUser($bill_no ,
									   $brach_id,			   
						          	   $bill_ref_no,
						   			   $Payee_name,
						   			   $recieved_date,
						   			   $invoice_date,
									   $remarks,
									   $modified_date,
						   			   $modified_user,
									   $bill_id,
									   $details,
									   $Invoice_no,
								 	   $g35_no,
								 	   $g35_date,
									   $log_year,
									   $from_period,
									   $to_period,$ledger_date									   
									   ){
	
		
		$db1 = new db_con();
		
	
		$sqlinsert = "update txt_bill_details as t,vote_bill_amount as v
		set t.Bill_Name=$Payee_name,
		t.Recieved_Date='$recieved_date',
		t.Invoice_date ='$invoice_date',
		t.Bill_ref_no ='$bill_ref_no',
        t.ledger_date ='$ledger_date',
		t.branch_id=$brach_id,
		t.remarks='$remarks',
		t.Modified_Date='$modified_date',
		t.Modified_User_ID=$modified_user,
		t.details='$details',											 
		t.Invoice_No='$Invoice_no',
		t.G35_No='$g35_no',
		t.G35_Date='$g35_date',
		t.bill_period_from='$from_period',
		t.bill_period_to='$to_period',		
		v.Current_Year='$log_year',		
		v.Recieved_Month= MONTH('$recieved_date'),		
		v.Sup_Code=$Payee_name,
		v.Invoice_Year=YEAR('$invoice_date')
		WHERE t.Bill_Id = $bill_id and v.Bill_Id = $bill_id 
		AND  t.Bill_No='$bill_no' and v.Bill_No='$bill_no' ";
		$data = $db1->Execute($sqlinsert);
		
	}
	
	
	///////////////////////////////////////////////////////DGFM
	public static function UpdateBillAmountDetails($id,$billno,$voteid,$amount){
		$db1 = new db_con();
		 $sqlinsert = "UPDATE vote_bill_amount SET	 
													 Vote_ID=$voteid,
													 Amount ='$amount'
													 WHERE id = $id";
		$data = $db1->Execute($sqlinsert);
		//echo $sqlinsert;
		return $data;
	}
	
	
	public static function UpdateBillAmountDetailsToSfhq($id,$billno,$voteid,$amount){
		$db1 = new db_con();
		 $sqlinsert = "UPDATE sfhq_vote_bill_amount SET	 
													 Vote_ID=$voteid,
													 Amount ='$amount'
													 WHERE id = $id";
		$data = $db1->Execute($sqlinsert);
		//echo $sqlinsert;
		return $data;
	}
	
	public static function InsertbillAmountDetails($bill_no,$vote_id1,$amount1,$billid){
		$db1 = new db_con();
												$sqlinsert = "INSERT INTO  vote_bill_amount(Bill_No,Bill_Id,Vote_ID,Amount)
												VALUES ('$bill_no',$billid,$vote_id1,'$amount1' )";
											//	echo $sqlinsert;
											//	die();
												$data1 = $db1->Execute($sqlinsert);	 
												return $data1;
												
		}
		
		
	public static function InsertbillAmountDetailsToSfhq($bill_no,$vote_id1,$amount1,$billid){
		$db1 = new db_con();
		$sqlinsert = "INSERT INTO  sfhq_vote_bill_amount(Bill_No,Bill_Id,Vote_ID,Amount)
					VALUES ('$bill_no',$billid,$vote_id1,'$amount1' )";
					//echo $sqlinsert;
					$data1 = $db1->Execute($sqlinsert);
					return $data1;
												
		}
		
	public static function GetMaxID(){
		$db1 = new db_con();
		$sqlselect = "SELECT MAX(Bill_Id) as max FROM txt_bill_details";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	
	
	public static function GetAllProjects($unitid,$ge_id,$projType,$txt){
		$db1 = new db_con();
		$sqlselect = "SELECT project_reference_id,
										project_name,
										project_allocated_amount,
										project_start_date,
										project_end_date,
										project_location,
										project_type,
										project_id,
										Job_number
										FROM m_project_details 
									where proj_completing_status = $projType 
									and esr_unit_id = $unitid 
									and project_name like '%$txt%' 	
									and ge_center_id = $ge_id ";
		//echo $sqlselect; 
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	
	public static function GetAllProjectsPagination($unitid,$ge_id,$projType,$txt,$start,$length){
		$db1 = new db_con();
		$sqlselect = "SELECT project_reference_id,
										project_name,
										project_allocated_amount,
										project_start_date,
										project_end_date,
										project_location,
										project_type,
										project_id,
										Job_number
										FROM m_project_details 
									where proj_completing_status = $projType  
									and esr_unit_id = $unitid 
									and (project_name like '%$txt%' or Job_number like '%$txt%')
									and ge_center_id = $ge_id 
									limit $start, $length  ";
		//echo $sqlselect; 
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetProjectType()
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM project_type";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	
	public static function GetProjectData($id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM m_project_details WHERE project_id =$id";
		$data = $db1->GetAll($sqlselect);
		return $data;
	}
	
	
	
		public static function editProject($project_id,
						   $project_reference_id,
						   $project_name,
						   $job_number,		
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
						   $project_Description,
						   $dateref,
						   $estimatedamount,
						   $G69No,
						   $Dates,
						   $txt_vote_no,
						    $allocated_regiment,
						   $ge_id
						   )
	{
		$db1 = new db_con();
		 $sqlinsert = "UPDATE m_project_details SET	   
									project_reference_id = '$project_reference_id',
									project_name = '$project_name',
									Job_number = '$job_number',
									project_status = '$project_status',
									project_allocated_amount = '$project_allocated_amount',
									project_start_date = '$project_start_date',
									project_type = '$project_type',
									project_end_date = '$project_end_date',
									project_location = '$project_location',														
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
									project_Description = '$project_Description',									
									RefDate = '$dateref',
						  			Estimated_Amount ='$estimatedamount',
						   			G69_No ='$G69No',
						 			Dates ='$Dates',
									Vote_Number = '$txt_vote_no',
									allocated_regiment = '$allocated_regiment',
									ge_center_id = '$ge_id'
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
	
	public static function DeleteProject($id)
	{
		$db1 = new db_con();
		$sqldelete2 = "DELETE FROM billdetails WHERE Progress_id IN 
					  (SELECT proj_pro_report_id FROM project_progress_report WHERE proj_id = $id)";
		$sqldelete1 = "DELETE FROM project_progress_report WHERE proj_id = $id";
		$sqldelete  = "DELETE FROM m_project_details WHERE project_id = $id";
	
		$data2 = $db1->Execute($sqldelete2);
		$data1 = $db1->Execute($sqldelete1);		
		$data = $db1->Execute($sqldelete);
		
		
		//echo $sqldelete2;
		//echo $sqldelete1;
		//echo $sqldelete;
		
		return $data;

	}
	
	public static function CancelProject($id,$status,$com_status)
	{
		$db1 = new db_con();
		$sqlcancel = "UPDATE  m_project_details SET project_status = $status , 
		cancel_date = ".date('y-m-d').",proj_completing_status=$com_status WHERE project_id = $id";
		//echo $sqlcancel;
		$data = $db1->Execute($sqlcancel);
		return $data;

	}

	
	
}

?>
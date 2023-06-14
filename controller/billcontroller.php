<?php 
require_once('../includes/config.php');
require_once('../classes/db_con.php');
require_once('../classes/Bills.php');
require_once('../classes/projects.class.php');
require_once('../classes/common.class.php');

$mode	=	isset( $_GET['mode'] )?$_GET['mode']:'';
$mode	=	isset( $_POST['mode'])?$_POST['mode']:$mode;



switch($mode)
{
	case 'save':	
	
	$billno 			= 	isset( $_POST['bill_no'])?$_POST['bill_no']:$txt_bill_number;	
	$bill_name			=	isset( $_POST['bill_name'])?$_POST['bill_name']:$bill_name;
	$bill_date			=	isset( $_POST['txtstart_date'])?$_POST['txtstart_date']:$bill_date;
	$brach_id			=	isset( $_POST['brach_id'])?$_POST['brach_id']:$brach_id;
	$allocated_regiment	=	isset( $_POST['allocated_regiment'])?$_POST['allocated_regiment']:$allocated_regiment;
	$amount				=	isset( $_POST['txt_bill_amount'])?$_POST['txt_bill_amount']:$amount;
	$remarks			=	isset( $_POST['remarks'])?$_POST['remarks']:$remarks;
	$Sfhq_Id			=	isset( $_GET['sfhq_id'])?$_GET['sfhq_id']:$sfhq_id;	
	//$upfile				=	isset( $_POST['upfile'])?$_POST['upfile']:$upfile;
	$ststus				= 0;
	
	//	$max = Bills :: GetMaxID();
	//	while($rowmax=mysql_fetch_array($max)){	
		
	//	$val = $rowmax[0] +1;
		 
	//	}    
		
		/*if($_FILES['upfile']['name'] !=""){
		//Upload image file
		$up_file =isset($_FILES['upfile']['name']) && $_FILES['upfile']['name']!="" ? $_FILES['upfile']['name'] : '';
		move_uploaded_file ($_FILES['upfile']['tmp_name'],"../uploads/".$val.$_FILES['upfile']['name']);	

         $up_file = $val.$up_file;

		}*/
		
		
			
	$created_date 		= 	date('Y-m-d');
	$created_user 		= 	$_SESSION['userID'];
	$modified_date		=	isset( $_POST['modified_date'])?$_POST['modified_date']:$created_date;	
	$modified_user		= 	$_SESSION['userID'];
					
		
	
		$result = Bills :: saveNewBill($billno,
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
						   			   $modified_user);
				if($result==true)				
				{
					
					header("Location:../projects.php?msg=1");	
				}
				elseif($result==false)
				{
					header("Location:../new_project.php?msg=2");	
				}
		
	break;
	
	
	
	
	case 'reportdgfm':	
	
	
	$accoffice 			= 	isset( $_POST['accoffice'])?$_POST['accoffice']:$accoffice;	
	$rtptype			=	isset( $_POST['rtptype'])?$_POST['rtptype']:$rtptype;
	
	
	
	////////	 This is for tripoli reports
				if(($accoffice==0) && ($rtptype==1))				
				{
					$_SESSION['sfhqID'] = 0;
					header("Location:../rptSuplierList.php");	
				}
				if(($accoffice==0) && ($rtptype==2))				
				{
					$_SESSION['sfhqID'] = 0;
					header("Location:../VoteStatmentReprt.php");	
				}
				if(($accoffice==0) && ($rtptype==3))				
				{
					$_SESSION['sfhqID'] = 0;
					header("Location:../SupOutstandReciDate.php");	
				}
				if(($accoffice==0) && ($rtptype==4))				
				{
					$_SESSION['sfhqID'] = 0;
					header("Location:../SupAgeAnalysisonlyreport.php");	
				}
				if(($accoffice==0) && ($rtptype==5))				
				{
					$_SESSION['sfhqID'] = 0;
					header("Location:../AgeAnalysisofOutStanding.php");	
				}
				if(($accoffice==0) && ($rtptype==6))				
				{
					$_SESSION['sfhqID'] = 0;
					header("Location:../DirSummeryRpt.php");	
					
				}
				
				if(($accoffice==0) && ($rtptype==7))				
				{
					$_SESSION['sfhqID'] = 0;
					header("Location:../dailyreport.php");	
					
				}
				
				////////	 This is for Sfhqs reports
				
				if(($accoffice > 0) && ($rtptype==1))				
				{
				
					$_SESSION['sfhqID'] = $accoffice;						
					header("Location:../SupplierStatment.php");	
				}
				if(($accoffice > 0) && ($rtptype==2))				
				{
					$_SESSION['sfhqID'] = $accoffice;
					header("Location:../VoteStatmentReprt.php");	
				}
				if(($accoffice > 0) && ($rtptype==3))				
				{
					$_SESSION['sfhqID'] = $accoffice;
					header("Location:../SupOutstandReciDate.php");	
				}
				if(($accoffice > 0) && ($rtptype==4))				
				{
					$_SESSION['sfhqID'] = $accoffice;
					header("Location:../SupAgeAnalysisonlyreport.php");	
				}
				if(($accoffice > 0) && ($rtptype==5))				
				{
					$_SESSION['sfhqID'] = $accoffice;
					header("Location:../AgeAnalysisofOutStanding.php");	
				}
				if(($accoffice > 0) && ($rtptype==6))				
				{
					$_SESSION['sfhqID'] = $accoffice;
					header("Location:../DirSummeryRpt.php");	
				}
				
				if(($accoffice > 0) && ($rtptype==7))				
				{
					$_SESSION['sfhqID'] = $accoffice;
					header("Location:../dailyreport.php");	
				}
			
	break;
	
	
	
	
	case 'savesfhq':	
	
	
	//$bill_no 			= 	isset( $_GET['bill_no'])?$_GET['bill_no']:$bill_no;	
	$sfhq_id 			= 	isset( $_GET['sfhq_id'])?$_GET['sfhq_id']:$sfhq_id;	
	$user_id			=	isset( $_GET['user_id'])?$_GET['user_id']:$user_id;	
	$user_type_id		=	isset( $_GET['user_type_id'])?$_GET['user_type_id']:$user_type_id;	
	
	$Invoice_no			=	isset( $_POST['Invoice_no'])?$_POST['Invoice_no']:$Invoice_no;
	$invoice_date		=	isset( $_POST['invoice_date'])?$_POST['invoice_date']:$invoice_date;
	$g35_no				=	isset( $_POST['g35_no'])?$_POST['g35_no']:$g35_no;	
	$g35_date			=	isset( $_POST['g35_date'])?$_POST['g35_date']:$g35_date;
	
	$unit_id           =	isset( $_POST['unit'])?$_POST['unit']:0;	
	$allocated_regiment	=	isset( $_POST['allocated_regiment'])?$_POST['allocated_regiment']:0;		
	$brach_id			=	isset( $_POST['brach_id'])?$_POST['brach_id']:$brach_id;		
	$bill_ref_no		=	isset( $_POST['bill_ref_no'])?$_POST['bill_ref_no']:$bill_ref_no;
	$Payee_name			=	isset( $_POST['Payee_name'])?$_POST['Payee_name']:$Payee_name;	
	$recieved_date		=	isset( $_POST['txtstart_date'])?$_POST['txtstart_date']:$txtstart_date;
    $ledger_date		=	isset( $_POST['ledger_date'])?$_POST['ledger_date']:$ledger_date;
	$from_period		=	isset( $_POST['from_period'])?$_POST['from_period']:$from_period;
	$to_period			=	isset( $_POST['to_period'])?$_POST['to_period']:$to_period;
	
	$remarks			=	isset( $_POST['remarks'])?$_POST['remarks']:$remarks;
	$vote_id1			=	isset( $_POST['vote_id1'])?$_POST['vote_id1']:$vote_id1;
	$vote_id2			=	isset( $_POST['vote_id2'])?$_POST['vote_id2']:0;
	$vote_id3			=	isset( $_POST['vote_id3'])?$_POST['vote_id3']:0;	
	$amount1			=	isset( $_POST['amount1'])?$_POST['amount1']:$amount1;
	$amount2			=	isset( $_POST['amount2'])?$_POST['amount2']:0;
	$amount3			=	isset( $_POST['amount3'])?$_POST['amount3']:0;
	$details			=	isset( $_POST['details'])?$_POST['details']:'';	
	
	$ststus				= 0;			
	$created_date 		= 	date('Y-m-d');
	$created_user 		= 	$_SESSION['userID'];
	$modified_date		=	date('Y-m-d');
	$modified_user		= 	$_SESSION['userID'];
	$unit_id 			=	isset( $_POST['unit'])?$_POST['unit']:0;		
	$log_year	= $_SESSION['log_year'];
	

				
	if($unit_id==0)
	{
	$allocated_regiment = $allocated_regiment;
	}
	else 
	{
	$allocated_regiment=$unit_id;
	}
	
	
	if( $recieved_date < $invoice_date)
	{
		header("Location:../SfhqAddBills.php?msg=27");	
	}
	else
	{

	
	$result = Bills :: saveNewSfhqBill($brach_id,
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
                                       $ledger_date);
						
	}
		
	break;
	
	case 'savebigUser':	
         
	
	//$bill_no1 			= 	isset( $_GET['bill_no'])?$_GET['bill_no']:$bill_no;	
	
	$brach_id			=	isset( $_POST['brach_id'])?$_POST['brach_id']:$brach_id;		
	$bill_ref_no		=	isset( $_POST['bill_ref_no'])?$_POST['bill_ref_no']:$bill_ref_no;
	$Payee_name			=	isset( $_POST['Payee_name'])?$_POST['Payee_name']:$Payee_name;	
	$recieved_date		=	isset( $_POST['txtstart_date'])?$_POST['txtstart_date']:$txtstart_date;
    $ledger_date		=	isset( $_POST['ledger_date'])?$_POST['ledger_date']:$ledger_date;
	
	$from_period		=	isset( $_POST['from_period'])?$_POST['from_period']:$from_period;
	$to_period			=	isset( $_POST['to_period'])?$_POST['to_period']:$to_period;
	
	$Invoice_no			=	isset( $_POST['Invoice_no'])?$_POST['Invoice_no']:$Invoice_no;
	$invoice_date		=	isset( $_POST['invoice_date'])?$_POST['invoice_date']:$invoice_date;
	$g35_no				=	isset( $_POST['g35_no'])?$_POST['g35_no']:$g35_no;	
	$g35_date			=	isset( $_POST['g35_date'])?$_POST['g35_date']:$g35_date;
	
	
		
	$remarks			=	isset( $_POST['remarks'])?$_POST['remarks']:$remarks;
	$vote_id1			=	isset( $_POST['vote_id1'])?$_POST['vote_id1']:$vote_id1;
	$vote_id2			=	isset( $_POST['vote_id2'])?$_POST['vote_id2']:0;
	$vote_id3			=	isset( $_POST['vote_id3'])?$_POST['vote_id3']:0;	
	$amount1			=	isset( $_POST['amount1'])?$_POST['amount1']:$amount1;
	$amount2			=	isset( $_POST['amount2'])?$_POST['amount2']:0;
	$amount3			=	isset( $_POST['amount3'])?$_POST['amount3']:0;
	$details			=	isset( $_POST['details'])?$_POST['details']:'';

	$user_id			=	isset( $_GET['user_id'])?$_GET['user_id']:$user_id;	
	$user_type_id		=	isset( $_GET['user_type_id'])?$_GET['user_type_id']:$user_type_id;	
	
	$ststus				= 0;
	
	
			
	$created_date 		= 	date('Y-m-d');
	$created_user 		= 	$_SESSION['userID'];
	$modified_date		=	date('Y-m-d');
	$modified_user		= 	$_SESSION['userID'];
					
			
		
	if( ($invoice_date > $recieved_date) || ($from_period > $to_period) )
	{
		header("Location:../ChiefAccAddbills.php?msg=27");
	}
	else
	{		
	
	$result = Bills :: saveNewBigUserBill(
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
                                       $ledger_date);
				
		
	}
		
		
	break;
	
	case 'settle':
		$bill_id	 	=	isset( $_GET['projrepid'])?$_GET['projrepid']:$project_rep_id;
	//	$project_id		 	=	isset( $_GET['proID'])?$_GET['proID']:$project_id;
		$user_id		 	=	isset( $_GET['uid'])?$_GET['uid']:$user_id;
		
		$resultcheck = Bills :: CheckIsPrivilege($user_id);
		$val="";
		
		foreach ($resultcheck as $row) {
			
				$val=$row[0];
			}
				if($val==1)
				{
				//	$resultdelete = ProjectsProgress :: UpdateStatusProjectReport($project_rep_id);
				//	if($resultdelete==true)
					//  {
						  header("Location:../Settle_Bills.php?billID=".$bill_id);	
						 // Settle_Bills.php?projectid=<?php echo $row[0]; 
					//  }
					//  elseif($resultdelete==false)
					//  {
					//	  header("Location:../project_reports.php?msg=12&projectID=".$project_id);	
					//  }
				}
				
				if($val==0)
				{
					 header("Location:../projects.php?msg=18");	
					
				}

			break;
			
			
		case 'settlebiguser':
		$bill_id	 	=	isset( $_GET['projrepid'])?$_GET['projrepid']:$project_rep_id;
		$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
		$user_id		 	=	isset( $_GET['uid'])?$_GET['uid']:$user_id;
		
		$resultcheck = Bills :: CheckIsPrivilege($user_id);
		$val="";

		foreach ($resultcheck as $row) {

				$val=$row[0];
			}
				//if($val==1)
				//{				
						  header("Location:../Settlebiguserbill.php?billID=".$bill_id."&branch_id=".$branch_id);	
						 
				//}
				
				//if($val==0)
				//{
				//	 header("Location:../Chiefacc.php?msg=18");	
					
				//}
				
					
				
			
		break;
			
			
			/// Un Settle DF bills
		case 'unsettlebiguser':
		$bill_id	 	=	isset( $_GET['projrepid'])?$_GET['projrepid']:$project_rep_id;
		$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
		$user_id		 	=	isset( $_GET['uid'])?$_GET['uid']:$user_id;
		
		$resultcheck = Bills :: CheckIsPrivilege($user_id);
		$val="";
	
		foreach ($resultcheck as $row) {
			
				$val=$row[0];
			}
				//if($val==1)
				//{				
						  header("Location:../UnSettleDFBills.php?billID=".$bill_id."&branch_id=".$branch_id);	
						 
				//}
				
				//if($val==0)
				//{
				//	 header("Location:../Chiefacc.php?msg=18");	
					
				//}
				
					
				
			
			break;
			//
			
			
			
		case 'settlesfhqbil':
		$bill_id	 	=	isset( $_GET['projrepid'])?$_GET['projrepid']:$project_rep_id;	
		$user_id		 	=	isset( $_GET['uid'])?$_GET['uid']:$user_id;
		$branch_id		 	=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
		
		//$resultcheck = Bills :: CheckIsPrivilege($user_id);
		//$val="";
		//while($row = mysql_fetch_array($resultcheck))
		//	{
		//		$val=$row[0];
		//	}
								
			header("Location:../SettleSfhqBill.php?billID=".$bill_id."&branch_id=".$branch_id);	
				
				
			break;
			
			
			////////////////////Un Settle bills
			
				
		case 'unsettlesfhqbil':
		$bill_id	 		=	isset( $_GET['projrepid'])?$_GET['projrepid']:$project_rep_id;	
		$user_id		 	=	isset( $_GET['uid'])?$_GET['uid']:$user_id;
		$branch_id		 	=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
		
		//$resultcheck = Bills :: CheckIsPrivilege($user_id);
		//$val="";
		//while($row = mysql_fetch_array($resultcheck))
		//	{
		//		$val=$row[0];
		//	}
								
			header("Location:../UnSettleSFHQBills.php?billID=".$bill_id."&branch_id=".$branch_id);	
				
				
			break;
			/////////////
			
			
			
			
			
		case 'Returnbiguser':
		
		$bill_id	 	=	isset( $_GET['projrepid'])?$_GET['projrepid']:$project_rep_id;	
		$user_id		 	=	isset( $_GET['uid'])?$_GET['uid']:$user_id;
		
		$resultcheck = Bills :: CheckIsPrivilege($user_id);
		$val="";
		
		foreach ($resultcheck as $row) {
			
				$val=$row[0];
			}
							
			header("Location:../Returnbill.php?billID=".$bill_id);		
			
			break;
			
			
	case 'editBigUser':	
	
	$bill_no 			= 	isset( $_POST['bill_no'])?$_POST['bill_no']:$bill_no;	
	$bill_id			= 	isset( $_GET['projectid'])?$_GET['projectid']:$bill_id;	
	
	$branch_id		 	=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;  // this branch used to load previouse details in the project page
	$brach_id			=	isset( $_POST['brach_id'])?$_POST['brach_id']:$brach_id;		
	$bill_ref_no		=	isset( $_POST['bill_ref_no'])?$_POST['bill_ref_no']:$bill_ref_no;
	$ledger_date		=	isset( $_POST['ledger_date'])?$_POST['ledger_date']:$ledger_date;
    
    $Payee_name			=	isset( $_POST['Payee_name'])?$_POST['Payee_name']:$Payee_name;	
	$recieved_date		=	isset( $_POST['txtstart_date'])?$_POST['txtstart_date']:$txtstart_date;	
	$Invoice_no			=	isset( $_POST['Invoice_no'])?$_POST['Invoice_no']:$Invoice_no;
	$invoice_date		=	isset( $_POST['invoice_date'])?$_POST['invoice_date']:$invoice_date;
	$g35_no				=	isset( $_POST['g35_no'])?$_POST['g35_no']:$g35_no;	
	$g35_date			=	isset( $_POST['g35_date'])?$_POST['g35_date']:$g35_date;	
	$remarks			=	isset( $_POST['remarks'])?$_POST['remarks']:$remarks;
	$details			=	isset( $_POST['details'])?$_POST['details']:'';
	
	$from_period		=	isset( $_POST['from_period'])?$_POST['from_period']:$from_period;
	$to_period			=	isset( $_POST['to_period'])?$_POST['to_period']:$to_period;
	$vote_id1			=	isset( $_POST['vote_id1'])?$_POST['vote_id1']:$vote_id1;
	$vote_id2			=	isset( $_POST['vote_id2'])?$_POST['vote_id2']:0;
	$vote_id3			=	isset( $_POST['vote_id3'])?$_POST['vote_id3']:0;	
	$amount1			=	isset( $_POST['amount1'])?$_POST['amount1']:$amount1;
	$amount2			=	isset( $_POST['amount2'])?$_POST['amount2']:0;
	$amount3			=	isset( $_POST['amount3'])?$_POST['amount3']:0;	
	$billidxx1			=	isset( $_POST['hdnbill_id1'])?$_POST['hdnbill_id1']:0;
	$billidxx2			=	isset( $_POST['hdnbill_id2'])?$_POST['hdnbill_id2']:0;
	$billidxx3			=	isset( $_POST['hdnbill_id3'])?$_POST['hdnbill_id3']:0;
	$user_id			=	isset( $_GET['user_id'])?$_GET['user_id']:$user_id;	
	$user_type_id		=	isset( $_GET['user_type_id'])?$_GET['user_type_id']:$user_type_id;	
	$ststus				= 0;		
	$modified_date		=	date('Y-m-d');
	$modified_user		= 	$_SESSION['userID'];
	$log_year			= $_SESSION['log_year'];	
		
	$result =  Bills :: EditBillsDetailsBigUser($bill_no,
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
									   );
		
		//echo 'sssssssssssssssssssssssssssssssssss'; exit;
		
		if($billidxx1 != 0 ){
			$result =  Bills :: UpdateBillAmountDetails($billidxx1,$bill_no,$vote_id1,$amount1);
		}
		elseif($vote_id1 != 0){
			$result =  Bills :: InsertbillAmountDetails($bill_no,$vote_id1,$amount1,$bill_id);
		}
		if($billidxx2 != 0){
			$result =  Bills :: UpdateBillAmountDetails($billidxx2,$bill_no,$vote_id2,$amount2);
		}
		elseif($vote_id2 != 0){
			$result =  Bills :: InsertbillAmountDetails($bill_no,$vote_id2,$amount2,$bill_id);
		}
		if($billidxx3 != 0){
			$result =  Bills :: UpdateBillAmountDetails($billidxx3,$bill_no,$vote_id3,$amount3);
		}
		elseif($vote_id3 != 0){
			$result =  Bills :: InsertbillAmountDetails($bill_no,$vote_id3,$amount3,$bill_id);
		}
		
		
				if($result==true)
				
				{
					header("Location:../Chiefacc.php?msg=29&branch_id=6");	
				}
				elseif($result==false)
				{
					header("Location:../EditBigUserBill.php?msg=30&branch_id=6");		
				}
		
	break;
	
	
	case 'editSFHQ':	

	$bill_no 			= 	isset( $_POST['bill_no'])?$_POST['bill_no']:$bill_no;	
	$bill_id			= 	isset( $_GET['projectid'])?$_GET['projectid']:$bill_id;	
	$sfhq_id			= 	isset( $_GET['sfhq_id'])?$_GET['sfhq_id']:$sfhq_id;		
	
	
	
	$brach_id			=	isset( $_POST['brach_id'])?$_POST['brach_id']:$brach_id;		
	$allocated_regiment	=	isset( $_POST['allocated_regiment'])?$_POST['allocated_regiment']:$allocated_regiment;	
	$bill_ref_no		=	isset( $_POST['bill_ref_no'])?$_POST['bill_ref_no']:$bill_ref_no;
	$ledger_date		=	isset( $_POST['ledger_date'])?$_POST['ledger_date']:$ledger_date;
        
    $Payee_name			=	isset( $_POST['Payee_name'])?$_POST['Payee_name']:$Payee_name;	
	$recieved_date		=	isset( $_POST['txtstart_date'])?$_POST['txtstart_date']:$txtstart_date;
	
	$from_period		=	isset( $_POST['from_period'])?$_POST['from_period']:$from_period;
	$to_period		=	isset( $_POST['to_period'])?$_POST['to_period']:$to_period;
	
	$Invoice_no			=	isset( $_POST['Invoice_no'])?$_POST['Invoice_no']:$Invoice_no;
	$invoice_date		=	isset( $_POST['invoice_date'])?$_POST['invoice_date']:$invoice_date;
	$g35_no				=	isset( $_POST['g35_no'])?$_POST['g35_no']:$g35_no;	
	$g35_date			=	isset( $_POST['g35_date'])?$_POST['g35_date']:$g35_date;
	
	
	$remarks			=	isset( $_POST['remarks'])?$_POST['remarks']:$remarks;
	$vote_id1			=	isset( $_POST['vote_id1'])?$_POST['vote_id1']:$vote_id1;
	$vote_id2			=	isset( $_POST['vote_id2'])?$_POST['vote_id2']:$vote_id2;
	$vote_id3			=	isset( $_POST['vote_id3'])?$_POST['vote_id3']:$vote_id3;	
	$amount1			=	isset( $_POST['amount1'])?$_POST['amount1']:$amount1;
	$amount2			=	isset( $_POST['amount2'])?$_POST['amount2']:$amount2;
	$amount3			=	isset( $_POST['amount3'])?$_POST['amount3']:$amount3;
	$details			=	isset( $_POST['details'])?$_POST['details']:'';
	
	$billidxx1			=	isset( $_POST['hdnbill_id1'])?$_POST['hdnbill_id1']:0;
	$billidxx2			=	isset( $_POST['hdnbill_id2'])?$_POST['hdnbill_id2']:0;
	$billidxx3			=	isset( $_POST['hdnbill_id3'])?$_POST['hdnbill_id3']:0;

//	$user_id			=	isset( $_GET['user_id'])?$_GET['user_id']:$user_id;	
	$user_type_id		=	isset( $_GET['user_type_id'])?$_GET['user_type_id']:$user_type_id;	
	
	$ststus				= 0;

	$branch_id		 	=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;  // this branch used to load previouse details in the project page
	$modified_date		=	date('Y-m-d');
	$modified_user		= 	$_SESSION['userID'];
					
	$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		
	$unit_id =	isset( $_POST['unit'])?$_POST['unit']:0;					
	if($unit_id==0)
	{
	$allocated_regiment = $allocated_regiment;
	}
	else 
	{
	$allocated_regiment=$unit_id;
	}
	

	if($allocated_regiment==0){
		header("Location:../EditSfhqBills.php?msg=35&projectid=".$project_id."&branch_id=".$branch_id);
		break;
	}
		
		$result =  Bills :: EditBillsDetailsSFHQ($bill_no,
									   $brach_id,			   
						          	   $bill_ref_no,
						   			   $Payee_name,
						   			   $recieved_date,
						   			   $invoice_date,
									   $remarks,
									   $modified_date,
						   			   $modified_user,
									   $bill_id,
									   $allocated_regiment,
									   $details,
									   $sfhq_id,
									   $Invoice_no,
								 	   $g35_no,
								 	   $g35_date,
									   $from_period,
									   $to_period,$ledger_date									   
									   );
									   
									 //  echo $result;
									 //  die ();
		
		//echo 'sssssssssssssssssssssssssssssssssss'; exit;
		
		if(is_numeric(trim($billidxx1)) && $billidxx1 != 0){
			
			if($vote_id1 !=0){
				$result =  Bills :: UpdateBillAmountDetailsToSfhq($billidxx1,$bill_no,$vote_id1,$amount1);
			}
			
		}
		elseif($vote_id1 != 0){

			$result =  Bills :: InsertbillAmountDetailsToSfhq($bill_no,$vote_id1,$amount1,$bill_id);
		}
		if(is_numeric(trim($billidxx2)) && $billidxx2 != 0){

			if($vote_id2 !=0 && $vote_id1 != $vote_id2){
				
				$result =  Bills :: UpdateBillAmountDetailsToSfhq($billidxx2,$bill_no,$vote_id2,$amount2);
			}elseif($vote_id2 !=0){
				
				header("Location:../EditSfhqBills.php?msg=34&projectid=".$project_id."&branch_id=".$branch_id);	
				break;
			}
			
		}
		elseif($vote_id2 != 0){
			
			if($vote_id1 != $vote_id2){
				$result =  Bills :: InsertbillAmountDetailsToSfhq($bill_no,$vote_id2,$amount2,$bill_id);
			}else{
				header("Location:../EditSfhqBills.php?msg=34&projectid=".$project_id."&branch_id=".$branch_id);	
				break;
			}
		
		}
		if(is_numeric(trim($billidxx3)) && $billidxx3 != 0){
			
			if($vote_id3 !=0 && $vote_id1 != $vote_id3 && $vote_id2 != $vote_id3){
				
				$result =  Bills :: UpdateBillAmountDetailsToSfhq($billidxx3,$bill_no,$vote_id3,$amount3);
				
			}elseif($vote_id3 !=0){
				
				header("Location:../EditSfhqBills.php?msg=34&projectid=".$project_id."&branch_id=".$branch_id);	
				break;
			}
			
		}
		elseif($vote_id3 != 0){
		
			if($vote_id1 != $vote_id3 && $vote_id2 != $vote_id3){
				$result =  Bills :: InsertbillAmountDetailsToSfhq($bill_no,$vote_id3,$amount3,$bill_id);
			}else{
				header("Location:../EditSfhqBills.php?msg=34&projectid=".$project_id."&branch_id=".$branch_id);	
				break;
			}
		}
		
		if($result==true)
		{
			header("Location:../projects.php?msg=3&branch_id=6");	
		}
		elseif($result==false)
		{
			header("Location:../EditSfhqBills.php?msg=4&branch_id=6");		
		}
		
	break;
	
	
	case 'edit':
	
		$billno 			= 	isset( $_POST['bill_no'])?$_POST['bill_no']:$txt_bill_number;	
		$bill_name			=	isset( $_POST['bill_name'])?$_POST['bill_name']:$bill_name;
		$bill_date			=	isset( $_POST['txtstart_date'])?$_POST['txtstart_date']:$bill_date;
		$branch_id			=	isset( $_POST['brach_id'])?$_POST['brach_id']:$brach_id;
		$allocated_regiment	=	isset( $_POST['allocated_regiment'])?$_POST['allocated_regiment']:$allocated_regiment;
		$amount				=	isset( $_POST['txt_bill_amount'])?$_POST['txt_bill_amount']:$amount;
		$remarks			=	isset( $_POST['remarks'])?$_POST['remarks']:$remarks;
		$Sfhq_Id			=	isset( $_GET['sfhq_id'])?$_GET['sfhq_id']:$sfhq_id;	
		$bill_id			=	isset( $_GET['projectid'])?$_GET['projectid']:$bill_id;	
		$upfile				=	isset( $_POST['upfile'])?$_POST['upfile']:$upfile;
		$imagefile			=	isset( $_POST['txt_updoc'])?$_POST['txt_updoc']:$imagefile;
		
		$ststus				= 0;
		
		$max = Bills :: GetMaxID();
		
		foreach ($max as $rowmax) {
			$val = $rowmax[0] +1;
		 
		}    
		
		if($_FILES['upfile']['name'] !=""){
		//Upload image file
		$up_file =isset($_FILES['upfile']['name']) && $_FILES['upfile']['name']!="" ? $_FILES['upfile']['name'] : '';
		move_uploaded_file ($_FILES['upfile']['tmp_name'],"../uploads/".$val.$_FILES['upfile']['name']);	

         $up_file = $val.$up_file;

		}
		else{
			$up_file = $imagefile;
		}
		
	$modified_date		=	date('Y-m-d');
	$modified_user		= 	$_SESSION['userID'];
					
		
		
		$result =  Bills :: EditBillsDetails($billno,
											   $bill_name,			   
											   $amount,
											   $allocated_regiment,
											   $bill_date,
											   $up_file,
											   $ststus,
											   $branch_id,
											   $Sfhq_Id,
											   $remarks,						   			  
											   $modified_date,
											   $modified_user,
											   $bill_id);
				if($result==true)
				
				{
					header("Location:../projects.php?msg=3");	
				}
				elseif($result==false)
				{
					header("Location:../edit_project.php?msg=4");	
				}
		
	break;
	
	case 'delete':
		$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		
		$resultdelete = Projects :: DeleteProject($project_id);
		if($resultdelete==true)
		  {
			  header("Location:../projects.php?msg=5");	
		  }
		  elseif($resultdelete==false)
		  {
			  header("Location:../projects.php?msg=6");	
		  }
	
	break;
	
	
	
	
}

?>
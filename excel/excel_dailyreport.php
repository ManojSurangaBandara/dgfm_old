<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");

	    	
	$today = date("m.d.y");
	$totalReport = $_SESSION['totalReport'] ?? 0;
	$accoffice = $_POST['accoffice'] ?? 0;
	if ($accoffice == 1) {
		$totalReport = 1;
	}				

	if ($totalReport == 0) {
		$sfhq_id = $_SESSION['sfhqID'];
	} else {
		$sfhq_id = -1;
	}

	$excel=new ExcelWriter($sfhq_id."Daily_Report.xls");	
	
	if($excel==false){
		echo $excel->error;
	}
	else {
			
	
		$billstatus		=	isset( $_POST['billstatus'])?$_POST['billstatus']:$billstatus;				
		$txt_as_at_date =	isset( $_POST['txt_as_at_date'])?$_POST['txt_as_at_date']:$today;
		$txt_to_date 	=	isset( $_POST['txt_to_date'])?$_POST['txt_to_date']:$today;
		$sup_type 		=	isset( $_POST['sup_type'])?$_POST['sup_type']:$sup_type;
		$vttype 		=	isset( $_POST['vttype'])?$_POST['vttype']:0;
		$trans_vote = 0;
		
		//echo $vttype ; 
		
		if($sfhq_id==0){			
			
			$sfhq_name='Dte of Fin ';
			$trans_vote = isset( $_POST['trans_vote'])?$_POST['trans_vote']:$trans_vote;
			
			if($trans_vote==0){
			$vttype='vt_type_id';						
			$sup_type_id='s.sup_type_id'; 
			$veh_type = "All Type of Supplier";
			}
			else {
				$sup_type_id=1;
				$vttype='vt_type_id and vt_type_id != 13';  // hard corded to remove unwanted votes
				$trns_title = "Removed Transferble Votes and Supplier";
			}
		} elseif ($sfhq_id > 0) {
			$sfname = Projects :: GetSFHQName($sfhq_id);
			foreach ($sfname as $sftitle) {
				$sfhq_name = $sftitle[0];
			}
		} elseif ($sfhq_id == -1) {
			$sfhq_name = "Dte of Fin & all SFHQ";
		}
		
		
		switch($billstatus)
		{
			case 0:
			$type ="NOT SETTLE";
			$dtrange = 'b.Create_Date';
			break;
			
			case 1:
			$type ="SETTLED";
			$dtrange = 'b.Bill_Settled_Date';
			break;
			
			case 3:
			$type ="RETURNED";
			$dtrange = 'rt.rtn_date';
			break;
			
			case 4:
			$type ="ALL";
			$dtrange = 'b.Create_Date';
			break;
			
			default:
			$type ="WRONG";
			$dtrange = 'b.Create_Date';
		}
		
		
		
		
		//echo $vttype; die();
		
		if ($vttype==0 && $trans_vote==0) {			
			$vttype='vt_type_id';
			$vt_title='All';			
			$sup_type_id='s.sup_type_id';  // thiis requirement is only for Chief acc rporting 5 suppliers have been made 0 for getting this report manualy 
			
		} else {
			$sup_type_id=1;   // thiis requirement is only for Chief acc rporting 5 suppliers have been made 0 for getting this report manualy 	
			$vttitle = Projects :: GetTypesofVotes($vttype);
			foreach ($vttitle as $title) {
				$vt_title = $title[0];
			}
		}
		
		
		switch($sup_type)
		{
			case 0:
			$veh_type ="WITHOUT VEHICLE SUPPLIER";
			$veh_val = 0;
			break;
			
			case 1:
			$veh_type ="VEHICLE SUPPLIER";
			$veh_val = 1;
			break;
			
			case 2:
			$veh_type ="ALL TYPE OF SUPPLIER";
			$veh_val = "s.is_vehicle";
			break;		
			
			default:
			$veh_type ="WRONG";
			$veh_val = "s.is_vehicle";
		}
		
		
		
		
		
		
		
		$myArrtitle=array("<strong>".($trns_title ?? "")." ".$sfhq_name." - ".$vt_title." VOTES DAILY REPORT OF ".$veh_type." ".$type." BILLS FROM  ".$txt_as_at_date."  TO ".$txt_to_date." </strong>");
		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
		
		if($billstatus==0){
		
		$myArr=array("<strong>No</strong>"
					 ,"<strong>Bill No</strong>"
					 ,"<strong>Directorate Name</strong>"
					 ,"<strong>Supplier Name</strong>"					  
					 ,"<strong>Supplier Address</strong>"
					 ,"<strong>Supplier Mobile No</strong>"
					 ,"<strong>VAT Reg Number</strong>"		
					 ,"<strong>Bill Period</strong>"				 
					,"<strong>Vote Code</strong>"
					,"<strong>Vote Type</strong>"
					,"<strong>Amount</strong>"
					,"<strong>Invoice Date</strong>"
					 ,"<strong>Invoice No</strong>"
					 ,"<strong>G-35 Date</strong>"
					 ,"<strong>G-35 No</strong>"
					,"<strong>Received Date</strong>"
					,"<strong>Received Month</strong>"
					,"<strong>Reference No</strong>"
					,"<strong>Remarks</strong>"	
					,"<strong>Entered Date</strong>"
                    ,"<strong>Ledgered Date</strong>"
					,"<strong>Vehicle No</strong>"	
                    ,"<strong>Vehicle Running Place</strong>"	
						
						,"");
		}
		
		if($billstatus==1){
		
		$myArr=array("<strong>No</strong>"
					 ,"<strong>Bill No</strong>"
					 ,"<strong>Directorate Name</strong>"
					 ,"<strong>Supplier Name</strong>"					  
					 ,"<strong>Supplier Address</strong>"
					 ,"<strong>Supplier Mobile No</strong>"
					 ,"<strong>VAT Reg Number</strong>"	
					  ,"<strong>Bill Period</strong>"				 
					 ,"<strong>Vote Code</strong>"
					 ,"<strong>Vote Type</strong>"
					 ,"<strong>Amount</strong>"
					 ,"<strong>Invoice Date</strong>"						
					,"<strong>Invoice No</strong>"
					 ,"<strong>G-35 Date</strong>"
					 ,"<strong>G-35 No</strong>"						
					,"<strong>Received Date</strong>"
					,"<strong>Received Month</strong>"
					,"<strong>Reference No</strong>"
					,"<strong>Remarks</strong>"	
					,"<strong>Entered Date</strong>"
                    ,"<strong>Ledgered Date</strong>"
					,"<strong>Vehicle No</strong>"
                    ,"<strong>Vehicle Running Place</strong>"	
												
					,"<strong>Settled Date</strong>"						
					,"<strong>Check No</strong>"
					,"<strong>Check Date</strong>"
					,"<strong>File Reference</strong>"
					
						
					,"");
		}
		
		if($billstatus==3){
		
		$myArr=array("<strong>No</strong>"
					 ,"<strong>Bill No</strong>"
					 ,"<strong>Directorate Name</strong>"
					 ,"<strong>Supplier Name</strong>"					  
					 ,"<strong>Supplier Address</strong>"
					 ,"<strong>Supplier Mobile No</strong>"
					 ,"<strong>VAT Reg Number</strong>"	
					  ,"<strong>Bill Period</strong>"				 
					,"<strong>Vote Code</strong>"
					,"<strong>Vote Type</strong>"
					,"<strong>Amount</strong>"
					,"<strong>Invoice Date</strong>"
					,"<strong>Invoice No</strong>"
					,"<strong>G-35 Date</strong>"
					,"<strong>G-35 No</strong>"
					,"<strong>Received Date</strong>"
					,"<strong>Received Month</strong>"
					,"<strong>Reference No</strong>"
					,"<strong>Remarks</strong>"		
					,"<strong>Entered Date</strong>"
                    ,"<strong>Ledgered Date</strong>"
					,"<strong>Vehicle No</strong>"	
                    ,"<strong>Vehicle Running Place</strong>"
											
					,"<strong>Return Date</strong>"	
					,"<strong>Return Reason</strong>"
					
					,"");
		}
		
		
		if($billstatus==4){
		$billstatus='b.Bill_Status';
		
		$myArr=array("<strong>No</strong>"
					 ,"<strong>Bill No</strong>"
					 ,"<strong>Directorate Name</strong>"
					 ,"<strong>Supplier Name</strong>"					 
					 ,"<strong>Supplier Address</strong>"
					 ,"<strong>Supplier Mobile No</strong>"
					 ,"<strong>VAT Reg Number</strong>"	
					  ,"<strong>Bill Period</strong>"				 
					 ,"<strong>Vote Code</strong>"
					 ,"<strong>Vote Type</strong>"
					 ,"<strong>Amount</strong>"					 
					 ,"<strong>Invoice Date</strong>"					 
					 ,"<strong>Invoice No</strong>"
					 ,"<strong>G-35 Date</strong>"
					 ,"<strong>G-35 No</strong>"				 
					 ,"<strong>Received Date</strong>"
					 ,"<strong>Received Month</strong>"
					 ,"<strong>Reference No</strong>"
					 ,"<strong>Remarks</strong>"		
					 ,"<strong>Entered Date</strong>"
                     ,"<strong>Ledgered Date</strong>"
					 ,"<strong>Vehicle No</strong>"
                     ,"<strong>Vehicle Running Place</strong>"
					  					
					 ,"<strong>Settled Date</strong>"	
					 ,"<strong>Check No</strong>"
					 ,"<strong>Check Date</strong>"
					 ,"<strong>Return Date</strong>"	
					 ,"<strong>Return Reason</strong>"
					
					 ,"");
		}
		
		
		
		$excel->writeLine($myArr);	
		
		
		if($sfhq_id > 0){		
			
		$esrunit = Projects :: GetDailyReportforSfhq($billstatus,$txt_as_at_date,$txt_to_date,$sfhq_id,$dtrange,$veh_val,$vttype,$sup_type_id );	
		}
		
		elseif ($sfhq_id == 0)
		{
			$esrunit = Projects :: GetDailyReportforTripoli($billstatus,$txt_as_at_date,$txt_to_date,$dtrange,$veh_val,$vttype,$sup_type_id);	
		} elseif ($sfhq_id == -1) {

			$esrunit_1 = Projects :: GetDailyReportforSfhq($billstatus,$txt_as_at_date,$txt_to_date, 1 ,$dtrange,$veh_val,$vttype,$sup_type_id );	
			$esrunit_2 = Projects :: GetDailyReportforSfhq($billstatus,$txt_as_at_date,$txt_to_date, 2 ,$dtrange,$veh_val,$vttype,$sup_type_id );	
			$esrunit_3 = Projects :: GetDailyReportforSfhq($billstatus,$txt_as_at_date,$txt_to_date, 3 ,$dtrange,$veh_val,$vttype,$sup_type_id );	
			$esrunit_4 = Projects :: GetDailyReportforSfhq($billstatus,$txt_as_at_date,$txt_to_date, 4 ,$dtrange,$veh_val,$vttype,$sup_type_id );	
			$esrunit_5 = Projects :: GetDailyReportforSfhq($billstatus,$txt_as_at_date,$txt_to_date, 5 ,$dtrange,$veh_val,$vttype,$sup_type_id );	
			$esrunit_6 = Projects :: GetDailyReportforSfhq($billstatus,$txt_as_at_date,$txt_to_date, 6 ,$dtrange,$veh_val,$vttype,$sup_type_id );	
			$esrunit_7 = Projects :: GetDailyReportforSfhq($billstatus,$txt_as_at_date,$txt_to_date, 7 ,$dtrange,$veh_val,$vttype,$sup_type_id );	
			$esrunit_8 = Projects :: GetDailyReportforTripoli($billstatus,$txt_as_at_date,$txt_to_date,$dtrange,$veh_val,$vttype,$sup_type_id);
		
			$esrunit = array_merge($esrunit_1, $esrunit_2, $esrunit_3, $esrunit_4, $esrunit_5, $esrunit_6, $esrunit_7, $esrunit_8);
			
			$_SESSION['totalReport'] = 0;
		}
		$i=1;		
		
		$total=0;
		// echo $esrunit;
					
	foreach ($esrunit as $rowesrunit) {
				$excel->writeCol($i);	
				$excel->writeCol($rowesrunit[1]);
				$excel->writeCol($rowesrunit[2]);	
				$excel->writeCol($rowesrunit[3]);				
				$excel->writeCol($rowesrunit[22].", ".$rowesrunit[23].", ".$rowesrunit[24].", ".$rowesrunit[25]);
				$excel->writeCol($rowesrunit[32]);	
				$excel->writeCol($rowesrunit[18]);	
				$excel->writeCol($rowesrunit[26]." - ".$rowesrunit[27]);								
				$excel->writeCol($rowesrunit[4]);
				$excel->writeCol($rowesrunit[28]);				
				$excel->writeCol(number_format($rowesrunit[5],'2','.',',')); 
				$total=$total+$rowesrunit[5];				
				$excel->writeCol($rowesrunit[6]);				
				$excel->writeCol($rowesrunit[14]);
				$excel->writeCol($rowesrunit[16]);
				$excel->writeCol($rowesrunit[15]);				
				$excel->writeCol($rowesrunit[7]);
				$excel->writeCol(date('m', strtotime($rowesrunit[7])));
				$excel->writeCol($rowesrunit[8]);
				$excel->writeCol($rowesrunit[9]);				
				$excel->writeCol($rowesrunit[10]);
                $excel->writeCol($rowesrunit[31]);
				$excel->writeCol($rowesrunit[29]);
                $excel->writeCol($rowesrunit[30]);
				
								
				//if($billstatus==0){			
				//}
				
				if($billstatus==1){				
				$excel->writeCol($rowesrunit[11]);				
				$excel->writeCol($rowesrunit[19]);
				$excel->writeCol($rowesrunit[20]);
				$excel->writeCol($rowesrunit[21]);
				
				
				}
				
				if($billstatus==3){				
				$excel->writeCol($rowesrunit[12]);
				$excel->writeCol($rowesrunit[13]);
				
				}
				
				
				
				if($billstatus=='b.Bill_Status'){
				$excel->writeCol($rowesrunit[11]);
				$excel->writeCol($rowesrunit[19]);
				$excel->writeCol($rowesrunit[20]);					
				$excel->writeCol($rowesrunit[12]);
				$excel->writeCol($rowesrunit[13]);
				
				}
				
				$i +=1;				
				$excel->writeRow();
			}
				
		$excel->writeRow();
		$excel->writeRow();
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');		
		$excel->writeCol('<strong>Total </strong>');
		$excel->writeCol('');	
		$excel->writeCol('');
		$excel->writeCol('');	
		$excel->writeCol('');			
		$excel->writeCol(number_format($total,'2','.',','));	
		$excel->writeRow();
		
		
		
	
	$excel->close();		
	//code for download  file 	
	$document = $sfhq_id."Daily_Report.xls"; 
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

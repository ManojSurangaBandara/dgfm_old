<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");


	    	
	$today = date("y.m.d");	
	$sfhq_id 	= $_SESSION['sfhqID'];	
	$excel=new ExcelWriter($sfhq_id."RtnIn_Report.xls");	
	
	
	
	if($excel==false){
		echo $excel->error;
	}
	else {
			
		$rtnin_from 	=	isset( $_POST['rtnin_from'])?$_POST['rtnin_from']:$today;
		$rtnin_to 		=	isset( $_POST['rtnin_to'])?$_POST['rtnin_to']:$today;
		$received_asat 	=	isset( $_POST['received_asat'])?$_POST['received_asat']:$today;
				
		$myArrtitle=array("<strong> RETURN IN REPORT - VOUCHERS RECEIVED UP TO ".$received_asat." AND RETURN IN FROM ".$rtnin_from."  TO ".$rtnin_to." </strong>");
		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
						
		$myArr=array("<strong>No</strong>"
					 ,"<strong>Bill No</strong>"
					 ,"<strong>Directorate Name</strong>"
					 ,"<strong>Supplier Name</strong>" 
					,"<strong>Vote Code</strong>"
					,"<strong>Amount</strong>"
					,"<strong>Return In Date</strong>"
					,"<strong>Invoice Date</strong>"
					,"<strong>Received Date</strong>"
					,"<strong>Entered Date</strong>"
					,"<strong>Invoice No</strong>"
					,"<strong>G-35 Date</strong>"
					,"<strong>G-35 No</strong>"
					,"<strong>Reference No</strong>"
					,"<strong>Remarks</strong>"		
						
					,"");
				
		
		$excel->writeLine($myArr);	
		
		//if($sfhq_id>0){
	//	$esrunit = Projects :: GetDailyReportforSfhq($billstatus,$txt_as_at_date,$txt_to_date,$sfhq_id,$dtrange );	
	//	}
		
	//	else 
	//	{
			$esrunit = Projects :: GetRtnReportforDte($rtnin_from,$rtnin_to,$received_asat);	
	//	}
		$i=1;		
		
		$total=0;
		//echo $esrunit;
		//die();
		
	foreach ($esrunit as $rowesrunit) {		
	
				$excel->writeCol($i);	
				$excel->writeCol($rowesrunit[1]);
				$excel->writeCol($rowesrunit[2]);	
				$excel->writeCol($rowesrunit[3]);				
				$excel->writeCol($rowesrunit[4]);	
				$excel->writeCol(number_format($rowesrunit[5],'2','.',','));	
				$excel->writeCol($rowesrunit[14]);				
				$excel->writeCol($rowesrunit[6]);
				$excel->writeCol($rowesrunit[7]);
				$excel->writeCol($rowesrunit[8]);
				$excel->writeCol($rowesrunit[9]);
				$excel->writeCol($rowesrunit[10]);
				$excel->writeCol($rowesrunit[11]);
				$excel->writeCol($rowesrunit[12]);
				$excel->writeCol($rowesrunit[13]);
				 
				$total=$total+$rowesrunit[5];
				
					
				$i +=1;				
				$excel->writeRow();
			}
				
		$excel->writeRow();
		$excel->writeRow();
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');		
		$excel->writeCol('<strong>Total </strong>');	
		$excel->writeCol('');					
		$excel->writeCol(number_format($total,'2','.',','));
		$excel->writeCol('');	
		$excel->writeCol('');
		$excel->writeCol('');	
		$excel->writeCol('');	
		$excel->writeCol('');	
		$excel->writeCol('');
		$excel->writeCol('');	
		$excel->writeCol('');	
		$excel->writeCol('');
		$excel->writeRow();
		
		
		
	
	$excel->close();		
	//code for download  file 	
	$document = $sfhq_id."RtnIn_Report.xls"; 
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

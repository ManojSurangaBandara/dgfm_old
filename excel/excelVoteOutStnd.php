<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");

	

    $sfhq_id 	= $_SESSION['sfhqID'];
	$today = date("m.d.y");	
	$excel=new ExcelWriter($sfhq_id."VoteOutStanding_Report.xls");	
	
	
	if($excel==false){
		echo $excel->error;
	}
	else {
			
	
		//$sup_id				=	isset( $_POST['sup_id'])?$_POST['sup_id']:$sup_id;
		//$sup_name;		
		$txt_as_at_date 	=	isset( $_POST['txt_as_at_date'])?$_POST['txt_as_at_date']:$today;
		
		$sfhq_id 	= $_SESSION['sfhqID'];
		$branch_id  = $_SESSION['branchID'];
		$user_type_id = $_SESSION['userType'];
		
		
		//$txt_to_date 		=	isset( $_POST['txt_to_date'])?$_POST['txt_to_date']:$today;
		
		//$supname = Projects :: GetSupplierName($sup_id);
		//while($newsupname=mysql_fetch_array($supname))
	//	{
		//	$sup_name = $newsupname[0];
	//	}
		
		$myArrtitle=array("<strong> VOTE OUT STANDING STATESMENT AS AT  ". $txt_as_at_date." </strong>");
		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
		
		
			

		
		$myArr=array("<strong>No</strong>"
						,"<strong>Supplier</strong>"						
						,"<strong>B/F</strong>"
						,"<strong>Jan </strong>"
						,"<strong>Feb</strong>"
						,"<strong>March</strong>"
						,"<strong>April</strong>"
						,"<strong>May</strong>"
						,"<strong>June</strong>"
						,"<strong>July</strong>"
						,"<strong>Aug </strong>"
						,"<strong>Sep</strong>"
						,"<strong>Oct</strong>"
						,"<strong>Nov</strong>"
						,"<strong>Dec</strong>"
						,"<strong>Total</strong>"
						,"");
		
		$excel->writeLine($myArr);	
		
		$esrunit = Projects :: GetVoteOutStandingforSfhq($txt_as_at_date);	
		
		$i=1;		
		$totPaid="";
		$totOutStd="";
		
		
	foreach ($esrunit as $rowesrunit) {		
	
				$excel->writeCol($i);	
				$excel->writeCol($rowesrunit[2]);					
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
			 
				
			/*	if($rowesrunit[5]=='0000-00-00'){
				$excel->writeCol('Not Settled');
				$totOutStd = $totOutStd+$rowesrunit[6];
				}
				else {
				$excel->writeCol($rowesrunit[5]);
				$totPaid = $totPaid+$rowesrunit[6];
				}*/
				
				
				
			//	$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
				
								
				
				$i +=1;				
				$excel->writeRow();
			}
				
		
/*		
		$excel->writeRow();
		$excel->writeCol('');	
		$excel->writeCol('');	
		$excel->writeCol('<strong>Total Payment</strong>');
		$excel->writeCol('');	
		$excel->writeCol('');
		$excel->writeCol(number_format($totPaid,'2','.',','));	
		
		$excel->writeRow();
		$excel->writeCol('');	
		$excel->writeCol('');
		$excel->writeCol('<strong>Total OutStnding</strong>');
		$excel->writeCol('');	
		$excel->writeCol('');
		$excel->writeCol(number_format($totOutStd,'2','.',','));	
		*/
		////////////////////
		
	
	$excel->close();		
	//code for download  file 
	$document = $sfhq_id."VoteOutStanding_Report.xls"; 	
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");

	

    	
	$today = date("m.d.y");	
	$sfhq_id 	= $_SESSION['sfhqID'];
	//$excel=new ExcelWriter($today."SupplierStatment_Report.xls");	
	$excel=new ExcelWriter($sfhq_id."G34Creation_Report.xls");	
	
	
	
	if($excel==false){
		echo $excel->error;
	}
	else {
			
	
		$sup_id				=	isset( $_POST['sup_id'])?$_POST['sup_id']:$sup_id;				
		$txt_as_at_date 	=	isset( $_POST['txt_as_at_date'])?$_POST['txt_as_at_date']:$today;
		$txt_to_date 		=	isset( $_POST['txt_to_date'])?$_POST['txt_to_date']:$today;
		
		$supname = Projects :: GetSupplierName($sup_id);
		foreach ($supname as $newsupname) 
		{
		$sup_name = $newsupname[0];
		}
		
		
		
		if($sfhq_id>0){
		$esrunit = Projects :: GetSupplierOutstandingInLieu34forSfhq($sup_id,$txt_as_at_date,$txt_to_date,$sfhq_id );	
		$voteSum = Projects :: GetVotewiseSumforG34forSfhq($sup_id,$txt_as_at_date,$txt_to_date,$sfhq_id );
		
		}
		
		else 
		{
			$esrunit = Projects :: GetSupplierOUtstandingTripoliG34($sup_id,$txt_as_at_date,$txt_to_date);	
			$voteSum = Projects :: GetVotewiseSumforG34forTripoli($sup_id,$txt_as_at_date,$txt_to_date);
		}
		$i=1;		
		
		
		
				
		$myArrtitle=array("<strong>".$sup_name."  </strong>");
		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
		$totvote=0;
		foreach ($voteSum as $voteArray) 
		{
		$excel->writeCol('');	
		$excel->writeCol('');	
		$excel->writeCol('');	
		$excel->writeCol('');	
		$excel->writeCol('');			
		$excel->writeCol($voteArray[0]);
		$excel->writeCol($voteArray[1]);
		$totvote = $totvote+$voteArray[1];	
		$excel->writeRow();
		}
		$excel->writeCol('');	
		$excel->writeCol('');	
		$excel->writeCol('');	
		$excel->writeCol('');	
		$excel->writeCol('');			
		$excel->writeCol('<strong>TOTAL<strong>');
		$excel->writeCol('<strong>'.$totvote.'<strong>');
		$excel->writeRow();
		
		$excel->writeCol('<strong>From : '.$txt_as_at_date.'</strong>');
		$excel->writeRow();	
		$excel->writeCol('<strong>To &nbsp;&nbsp;&nbsp; : '.$txt_to_date.'</strong>');
		$excel->writeRow();			
		
		$myArr=array("<strong>No</strong>"
					 ,"<strong>Bill No</strong>"	
					 ,"<strong>Ref No</strong>"
					 ,"<strong>Vote Code</strong>"
					 ,"<strong>Amount</strong>"
					 ,"");
		
		$excel->writeLine($myArr);		
		
		$totOutStd=0;
		foreach ($esrunit as $rowesrunit) 
		{			
	
				$excel->writeCol($i);	
				$excel->writeCol($rowesrunit[1]);
				$excel->writeCol($rowesrunit[2]);
				$excel->writeCol($rowesrunit[4]);
				$excel->writeCol(number_format($rowesrunit[3],'2','.',',')); 
				$totOutStd = $totOutStd+$rowesrunit[3];			
				$i +=1;				
				$excel->writeRow();
		}
				
		$word = Projects :: convertNumber($totOutStd);
		
		
		$excel->writeRow();		
		$excel->writeCol('<strong>TOTAL</strong>');
		$excel->writeCol('');	
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('<strong>'.number_format($totOutStd,'2','.',',').'</strong>');			
		$excel->writeRow();
		$excel->writeRow();
		$excel->writeRow();
		
		
		$excel->writeCol($_SESSION['name']);		
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('......................');
		$excel->writeRow();
		
		
		$excel->writeCol('<strong>Prepared By</strong>');		
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('<strong>Checked By </strong>');
		$excel->writeRow();
		$excel->writeRow();
		
		$excel->writeCol('I hereby certify that the charges in this Shedule aggregating Rs : <strong> '.$word.'</strong> have been duly authorised by Government that the services have been actually and Bona fide performed , and that payments have been properly made to individuals whose acquittanses are annexed.');
		
		$excel->writeRow();
		$excel->writeRow();
		$excel->writeRow();
		$excel->writeRow();
		$excel->writeRow();
		
		$day = date("d.m.Y");			
		$excel->writeCol(' '.$day.' ');		
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('......................');
		$excel->writeRow();
		
		
		$excel->writeCol('<strong>Date</strong>');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('<strong>Signature</strong>');
		$excel->writeRow();
	
	$excel->close();		
	//code for download  file 
	//$document = $today."SupplierStatment_Report.xls"; 
	$document = $sfhq_id."G34Creation_Report.xls"; 
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

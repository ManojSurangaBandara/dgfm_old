<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");
	include('../classes/vote.class.php');


	    	
	$today = date("m.d.y");	
	$branch_id  	= $_SESSION['branchID'];
	$log_year		= $_SESSION['log_year'];	
	$excel=new ExcelWriter("DownloadPsoView_Report.xls");	
	
	
	
	if($excel==false){
		echo $excel->error;
	}
	else {
				
		$Branch = Vote :: GetBranchNametoPsoView($branch_id);	
		$myArrtitle=array("<strong> VOTES CONTROL BY ".$Branch['branch_name']." </strong>");
		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
		
		
		
		$result = Vote :: GetVoteDetailstoPsoViewCapital($branch_id,$log_year);	
		//$result2 = Vote :: GetVoteDetailstoPsoViewRecurrent($branch_id,$log_year);
		$myArrti=array("<strong>ALLOCATED VOTES</strong>","");		
		$excel->writeLine($myArrti);	
		$excel->writeRow();
		$myArr=array("<strong>No</strong>"
					 ,"<strong>Vote No</strong>"					 
					 ,"<strong>Description</strong>"
					  ,"<strong>Vote Type</strong>"	
					 ,"<strong>Allocation</strong>"
					 ,"<strong>Expenditure</strong>"
					 ,"<strong>Remaining</strong>"					 
					,"");
		
		$excel->writeLine($myArr);	
		
		
		
	$i=1;			
	while($rowesrunit=mysql_fetch_array($result))
	{			
				$val1 = $rowesrunit[5]-($rowesrunit[6]+$rowesrunit[7]);
	
				$excel->writeCol($i);	
				$excel->writeCol($rowesrunit[1]);				
				$excel->writeCol($rowesrunit[2]);
				$excel->writeCol($rowesrunit[8]);
				$excel->writeCol( number_format($rowesrunit[5],'2','.',',')); 
				$excel->writeCol(number_format($rowesrunit[6]+$rowesrunit[7],'2','.',',')); 
				$excel->writeCol(number_format($val1,'2','.',',')); 
											
				$i +=1;				
				$excel->writeRow();
	}
			
		$excel->writeRow();		
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');	
		$excel->writeCol('');			
		$excel->writeCol('');		
		$excel->writeCol('');
		$excel->writeCol('');
	
	
	/// Print Recurent votes 
	
	
		//$result2 = Vote :: GetVoteDetailstoPsoViewRecurrent($branch_id,$log_year);
//		$myArrti=array("<strong>RECURRENT VOTES</strong>","");		
//		$excel->writeLine($myArrti);	
//		$excel->writeRow();
//		$myArr=array("<strong>No</strong>"
//					 ,"<strong>Vote No</strong>"					 
//					 ,"<strong>Description</strong>"
//					 ,"<strong>Allocation</strong>"
//					 ,"<strong>Expenditure</strong>"
//					 ,"<strong>Remaining</strong>"					 
//					,"");
//		
//		$excel->writeLine($myArr);	
//		
//		
//		
//	$i=1;			
//	while($rowesrunit=mysql_fetch_array($result2))
//	{			
//				$val12 = $rowesrunit[5]-($rowesrunit[6]+$rowesrunit[7]);
//	
//				$excel->writeCol($i);	
//				$excel->writeCol($rowesrunit[1]);				
//				$excel->writeCol($rowesrunit[2]);
//				$excel->writeCol(number_format($rowesrunit[5],'2','.',',')); 
//				$excel->writeCol(number_format($rowesrunit[6]+$rowesrunit[7],'2','.',',')); 
//				$excel->writeCol(number_format($val12,'2','.',',')); 
//											
//				$i +=1;				
//				$excel->writeRow();
//	}
//			
//		$excel->writeRow();
//		
//		$excel->writeCol('');
//		$excel->writeCol('');
//		$excel->writeCol('');			
//		$excel->writeCol('');		
//		$excel->writeCol('');
//		$excel->writeCol('');
//	
	
	
	$excel->close();		
	//code for download  file 	
	$document ="DownloadPsoView_Report.xls"; 
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

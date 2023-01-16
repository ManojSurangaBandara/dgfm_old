<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");

	

    	
	$today = date("m.d.y");	
	$sfhq_id 	= $_SESSION['sfhqID'];
	//$excel=new ExcelWriter($today."SupplierStatment_Report.xls");	
	$excel=new ExcelWriter($sfhq_id."DirSummery_Report.xls");	
	
	
	
	if($excel==false){
		echo $excel->error;
	}
	else {
			
	
		$branch_id				=	isset( $_POST['branch_id'])?$_POST['branch_id']:$branch_id;		
		$billstatus				=	isset( $_POST['billstatus'])?$_POST['billstatus']:$billstatus;
		$txt_as_at_date 		=	isset( $_POST['txt_as_at_date'])?$_POST['txt_as_at_date']:$today;
		$txt_to_date 			=	isset( $_POST['txt_to_date'])?$_POST['txt_to_date']:$today;
		
		$Br_name;		
		
		
		
		$Vote= Projects :: GetBranchName($branch_id);
		while($newsupname=mysql_fetch_array($Vote))
		{
			$Br_name = $newsupname[1];
		}
		
		
		
		
		switch($billstatus)
		{
			case 0:
			$rptname = 'NOT SETTLED';	
			$myArr=array("<strong>Ser No</strong>"
					 ,"<strong>Bill No</strong>"
						,"<strong>Supplier Name</strong>"						
						,"<strong>Supplier Address</strong>"
						,"<strong>VAT Reg No</strong>"
						,"<strong>Received Date</strong>"
						,"<strong>Invoice Date</strong>"
						,"<strong>Invoice No</strong>"
						,"<strong>G-35 Date</strong>"
						,"<strong>G-35 No</strong>"
						,"<strong>Reference No</strong>"
						,"<strong>Remarks</strong>"
						,"<strong>Vote Code</strong>"
						,"<strong>Amount</strong>");
			break;
			
			case 1:
			$rptname = 'SETTLED';	
			$myArr=array("<strong>Ser No</strong>"
					 ,"<strong>Bill No</strong>"
						,"<strong>Supplier Name</strong>"
						,"<strong>Supplier Address</strong>"
						,"<strong>VAT Reg No</strong>"	
						,"<strong>Received Date</strong>"
						,"<strong>Invoice Date</strong>"
						,"<strong>Invoice No</strong>"
						,"<strong>G-35 Date</strong>"
						,"<strong>G-35 No</strong>"
						,"<strong>Reference No</strong>"
						,"<strong>Remarks</strong>"
						,"<strong>Vote Code</strong>"
						,"<strong>Settled Date</strong>"						
						,"<strong>Amount</strong>");
			break;
			
			case 3:
			$rptname = 'RETURN';	
			$myArr=array("<strong>Ser No</strong>"
					 ,"<strong>Bill No</strong>"
						,"<strong>Supplier Name</strong>"	
						,"<strong>Supplier Address</strong>"
						,"<strong>VAT Reg No</strong>"
						,"<strong>Received Date</strong>"
						,"<strong>Invoice Date</strong>"
						
						,"<strong>Invoice No</strong>"
						,"<strong>G-35 Date</strong>"
						,"<strong>G-35 No</strong>"
						
						
						,"<strong>Reference No</strong>"
						,"<strong>Remarks</strong>"
						,"<strong>Vote Code</strong>"
						,"<strong>Return Date</strong>"
						,"<strong>Reason</strong>"						
						,"<strong>Amount</strong>");
			break;
			
			default:
			$rptname = 'CANCEL';	
			break;
				
		}
		
		
		
		

		
		
		
		$myArrtitle=array("<strong>  ".$Br_name." - ".$rptname ." BILLS STATEMENT FROM ".$txt_as_at_date."  TO  ".$txt_to_date." </strong>");
		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
		
		///////////////
		
		$excel->writeLine($myArr);	
		
		if($sfhq_id>0){
		$esrunit = Projects :: GetDirSummeryforSfhq($branch_id,$billstatus,$sfhq_id,$txt_as_at_date,$txt_to_date );	
		}
		
		else 
		{
			
			$esrunit = Projects :: GetDirectorateSummeryforTripoli($branch_id,$billstatus,$txt_as_at_date,$txt_to_date );	
		}
		$i=1;		
		$tot="";
		
		
		
	while($rowesrunit=mysql_fetch_array($esrunit))
	{			
	
				$excel->writeCol($i);				
				$excel->writeCol($rowesrunit[1]);
				$excel->writeCol($rowesrunit[2]);
				
				$excel->writeCol($rowesrunit[15]);	
				$excel->writeCol($rowesrunit[16]);
					
				$excel->writeCol($rowesrunit[3]);	
				$excel->writeCol($rowesrunit[8]);
				
				$excel->writeCol($rowesrunit[12]);	
				$excel->writeCol($rowesrunit[14]);
				$excel->writeCol($rowesrunit[13]);
				
				
				
				$excel->writeCol($rowesrunit[9]);
				$excel->writeCol($rowesrunit[10]);
				$excel->writeCol($rowesrunit[11]);
				if($billstatus==0)
				{
					$excel->writeCol(number_format($rowesrunit[4],'2','.',','));	
				}
				if($billstatus==1)
				{
					$excel->writeCol($rowesrunit[5]);	
					$excel->writeCol(number_format($rowesrunit[4],'2','.',','));	
				}
				if($billstatus==3)
				{
					$excel->writeCol($rowesrunit[6]);	
					$excel->writeCol($rowesrunit[7]);
					$excel->writeCol(number_format($rowesrunit[4],'2','.',','));
				}
				
				
				
				
				$i +=1;	
				$tot=$tot+$rowesrunit[4];
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
		$excel->writeCol('');
		$excel->writeCol('<strong>Total</storng>');	
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		if($billstatus==0)
		{
			$excel->writeCol('<stong>'.number_format($tot,'2','.',',').'</strong>');
		}
		if($billstatus==1)
		{
			$excel->writeCol('');
			$excel->writeCol('<stong>'.number_format($tot,'2','.',',').'</strong>');
		}
		if($billstatus==3)
		{
			$excel->writeCol('');
			$excel->writeCol('');
			$excel->writeCol('<stong>'.number_format($tot,'2','.',',').'</strong>');
		}
		
		
		$excel->writeRow();
		
		
		////////////////////
		
	
	$excel->close();		
	//code for download  file 
	//$document = $today."SupplierStatment_Report.xls"; 
	$document = $sfhq_id."DirSummery_Report.xls"; 
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");


	    	
	$today = date("m.d.y");	
	$sfhq_id 	= $_SESSION['sfhqID'];	
	$excel=new ExcelWriter($sfhq_id."SupplierStatment_Report.xls");	
	
	
	
	if($excel==false){
		echo $excel->error;
	}
	else {
			
	
		$sup_id				=	isset( $_POST['sup_id'])?$_POST['sup_id']:$sup_id;
		$sup_name;
        $Supplier_sfhq_id;
		$txt_as_at_date 	=	isset( $_POST['txt_as_at_date'])?$_POST['txt_as_at_date']:$today;
		$txt_to_date 		=	isset( $_POST['txt_to_date'])?$_POST['txt_to_date']:$today;
		
		$supname = Projects :: GetSupplierName($sup_id);
		while($newsupname=mysql_fetch_array($supname))
		{
			$sup_name = $newsupname[0];
            $Supplier_sfhq_id = $newsupsfhq[1];
            
		}
     
                
                //Get supplier related sfhq id
      //  $supsfhq = Projects :: GetSupplierSfhq($sup_id);
      //  while($newsupsfhq=mysql_fetch_array($supsfhq))
		//{
		//	$Supplier_sfhq_id = $newsupsfhq[0]; 
		//}
		
		$sfhqname;		
		switch($sfhq_id)
		{
			case 0:
			$sfhqname=="DIRECTORATE OF FINANCE";
			break;
			
			case 1:
			$sfhqname=="SFHQ (WEST)";
			break;
			
			case 2:
			$sfhqname=="SFHQ (W)";
			break;
			
			case 3:
			$sfhqname="SFHQ (E)";
			break;
			
			case 4:
			$sfhqname="SFHQ (J)";
			break;
			
			case 5:
			$sfhqname="SFHQ (KLN)";
			break;
			
			case 6:
			$sfhqname="SFHQ (MLT)";
			break;
			
			case 7:
			$sfhqname="SFHQ (C)";
			break;
			
			default:
			$sfhqname="Wrong";
		}
		
		
		
		
		$myArrtitle=array("<strong>".$sfhqname." - SUPPLIER STATEMENT OF ".$sup_name." - FROM  ".$txt_as_at_date."  TO ".$txt_to_date." </strong>");
		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
		
		$myArr=array("<strong>No</strong>"
					 ,"<strong>Bill No</strong>"
					 ,"<strong>Bill Period From</strong>"
					 ,"<strong>Bill Period To</strong>"					 
					 ,"<strong>Invoice No</strong>"
					 ,"<strong>Invoice Date</strong>"
					 ,"<strong>G35 No</strong>"
					 ,"<strong>G35 Date</strong>"					 
					 ,"<strong>Reference No</strong>"
					 ,"<strong>Received Date</strong>"						
					,"<strong>Remarks</strong>"					 
					,"<strong>Vote</strong>"
					,"<strong>Description</strong>"						
					,"<strong>Paid Date </strong>"					
					,"<strong>Cheque No </strong>"	
					,"<strong>Cheque Date </strong>"	
				//	,"<strong>Cheque Signed Date </strong>"						
					,"<strong>Amount</strong>"
					,"");
		
		$excel->writeLine($myArr);	
		
		if($sfhq_id>0){
		$esrunit = Projects :: GetSupplierStatementforSfhq($sup_id,$txt_as_at_date,$txt_to_date,$sfhq_id );	
		}
		
		else 
		{
			$esrunit = Projects :: GetSupplierStatementforTripoli($Supplier_sfhq_id,$sup_id,$txt_as_at_date,$txt_to_date);	
		}
		$i=1;		
		$totPaid="";
		$totOutStd="";
		$totrtn="";
		
		
	while($rowesrunit=mysql_fetch_array($esrunit))
	{			
	
				$excel->writeCol($i);	
				$excel->writeCol($rowesrunit[1]);
				$excel->writeCol($rowesrunit[20]);
				$excel->writeCol($rowesrunit[21]);
				
				$excel->writeCol($rowesrunit[12]);
				$excel->writeCol($rowesrunit[11]);
				$excel->writeCol($rowesrunit[13]);	
				$excel->writeCol($rowesrunit[14]);	
				
				$excel->writeCol($rowesrunit[8]);
				$excel->writeCol($rowesrunit[4]);					
				$excel->writeCol($rowesrunit[9]);
				
				$excel->writeCol($rowesrunit[2]);					
				$excel->writeCol($rowesrunit[3]);	
				
				
				/*if($rowesrunit[5]=='0000-00-00'){
				$excel->writeCol('Not Settled');
				$totOutStd = $totOutStd+$rowesrunit[6];
				
				}*/
				
				if($rowesrunit[10]=='0'){
				$excel->writeCol('Not Settled');
				$totOutStd = $totOutStd+$rowesrunit[6];
				}
				if($rowesrunit[10]=='1'){
				$excel->writeCol($rowesrunit[5]);
				$totPaid = $totPaid+$rowesrunit[6];
				}
				if($rowesrunit[10]=='2'){
				$excel->writeCol('Cancel');
				$totOutStd = $totOutStd+$rowesrunit[6];
				}
				if($rowesrunit[10]=='3'){
				$excel->writeCol('RTN');
				$totrtn = $totrtn+$rowesrunit[6];
				}
				
				/*else {
				$excel->writeCol($rowesrunit[5]);
				$totPaid = $totPaid+$rowesrunit[6];
				}*/
				
				$excel->writeCol($rowesrunit[17]);
				$excel->writeCol($rowesrunit[18]);
			//	$excel->writeCol($rowesrunit[19]);
				
				
				$excel->writeCol(number_format($rowesrunit[6],'2','.',',')); 
							
				$i +=1;				
				$excel->writeRow();
			}
				
		
		
		$excel->writeRow();
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');		
		$excel->writeCol('<strong>Total Payment</strong>');
		$excel->writeCol('');	
		
		
		$excel->writeCol('');
		$excel->writeCol('');	
		$excel->writeCol('');
		$excel->writeCol(number_format($totPaid,'2','.',','));	
		
		$excel->writeRow();
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');	
		$excel->writeCol('<strong>Total OutStnding</strong>');
		
		$excel->writeCol('');	
		$excel->writeCol('');
		$excel->writeCol('');
		
		$excel->writeCol('');
		$excel->writeCol(number_format($totOutStd,'2','.',','));	
		
		$excel->writeRow();
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');	
		$excel->writeCol('<strong>Total Return Bills</strong>');
		
		$excel->writeCol('');	
		$excel->writeCol('');
		$excel->writeCol('');
		
		$excel->writeCol('');
		$excel->writeCol(number_format($totrtn,'2','.',','));	
		
		
	
	$excel->close();		
	//code for download  file 	
	$document = $sfhq_id."SupplierStatment_Report.xls"; 
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

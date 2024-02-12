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
		
		foreach ($supname as $newsupname) {
			$sup_name = $newsupname[0];
            $Supplier_sfhq_id = $newsupname[1];
            
		}
     
                
                //Get supplier related sfhq id
      //  $supsfhq = Projects :: GetSupplierSfhq($sup_id);
      //  while($newsupsfhq=mysql_fetch_array($supsfhq))
		//{
		//	$Supplier_sfhq_id = $newsupsfhq[0]; 
		//}
		
		$sfhqname = "";		
		switch($sfhq_id)
		{
			case 0:
			$sfhqname="DIRECTORATE OF FINANCE";
			break;
			
			case 1:
			$sfhqname="SFHQ (WEST)";
			break;
			
			case 2:
			$sfhqname="SFHQ (W)";
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
					 ,"<strong>Supplier Name</strong>"
					 ,"<strong>SFHQ</strong>"
					 ,"<strong>Mobile Number</strong>"
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
		$totPaid=0;
		$totOutStd=0;
		$totrtn=0;
		
		

		
	foreach ($esrunit as $rowesrunit) {
				$excel->writeCol($i);
				$excel->writeCol($rowesrunit[1]);
				$excel->writeCol($rowesrunit[20]);
				$excel->writeCol($rowesrunit[21]);
				
				
				$i +=1;				
				$excel->writeRow();
			}
				
		
		
		
	
	$excel->close();		
	//code for download  file 	
	$document = $sfhq_id."SupplierMobileNumbers.xls"; 
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

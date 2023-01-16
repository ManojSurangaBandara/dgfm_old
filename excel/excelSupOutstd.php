<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");

	

    $sfhq_id 	= $_SESSION['sfhqID'];
	$today = date("m.d.y");	
	$excel=new ExcelWriter($sfhq_id."SupOutstd_Report.xls");	
	
	
	if($excel==false){
		echo $excel->error;
	}
	else {
			
	
		//$sup_id				=	isset( $_POST['sup_id'])?$_POST['sup_id']:$sup_id;
		//$sup_name;		
		$txt_as_at_date 	=	isset( $_POST['txt_as_at_date'])?$_POST['txt_as_at_date']:$today;
		$rtptype 			=	isset( $_POST['rtptype'])?$_POST['rtptype']:$rtptype;
		
		
		//$sfhq_id 	= $_SESSION['sfhqID'];
		//$branch_id  = $_SESSION['branchID'];
		//$user_type_id = $_SESSION['userType'];
		
	switch ($rtptype) {
    case 0:
        $val = 'NOT SETTLE';
        break;
    case 1:
        $val = 'SETTLED';
        break;
    case 3:
        $val = 'RETURNED';
        break;
	case 4:
        $val = 'OUTSTANDING';
        break;
    default:
        $val = 'Wrong!';
}
		
	/*switch ($sfhq_id) {
     case 0:
        $sf = 'DTE OF FIN';
        break;
	case 1:
        $sf = 'SFHQ (WEST)';
        break;
    case 2:
        $sf = 'SFHQ (W)';
        break;
	case 3:
        $sf = 'SFHQ (E)';
        break;
	case 4:
        $sf = 'SFHQ (J)';
        break;
	case 5:
        $sf = 'SFHQ (KLN)';
        break;
	case 6:
        $sf = 'SFHQ (MLT)';
        break;
	case 7:
        $sf = 'SFHQ (CEN)';
        break;
    default:
        $sf = 'Wrong!';
}	*/
		
	//if($sfhq_id >0){
		//	$myArrtitle=array("<strong>SRI LANKA ARMY - SUPPLIERS ".$val." BILLS OF ".$sf. " AS AT ". $txt_as_at_date." </strong>");	//
	//}
	//else {
		
		$myArrtitle=array("<strong>SRI LANKA ARMY - DIRECTORATE OF FINANCE - SUPPLIERS ".$val." BILLS AS AT ". $txt_as_at_date." </strong>");
	//}
		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
		
		$myArr=array("<strong>No</strong>"
						,"<strong>Supplier Name</strong>"
						,"<strong>Total Amount</strong>"
					    ,"");
		
		$excel->writeLine($myArr);	
		
		// this is for SFHQ'S
	//	if($sfhq_id >0){
		
	//	$esrunit = Projects :: GetSupplierOutstandforSfhq($txt_as_at_date,$sfhq_id,$rtptype );	
	//	}
		//else  // THIS IS FOR TRIPOLI
		//{
			$esrunit = Projects :: GetSupOutsForTripoli($txt_as_at_date,$rtptype );
                        
                       
                      //  $allsfhqesrunit = Projects :: GetAllSupplierOutstandforSfhq($txt_as_at_date,$rtptype );	
		//}
		$i=1;	
		$outsum=0;
		$presum=0;
		
	while($rowesrunit=mysql_fetch_array($esrunit))
	{			
				$excel->writeCol($i);	
				//$excel->writeCol($sfhq_id);	
				$excel->writeCol($rowesrunit[1]);	
				$excel->writeCol(number_format($rowesrunit[2],'2','.',',')); 						
			//	$excel->writeCol(number_format($rowesrunit[3],'2','.',',')); 							
				
				$i +=1;			
				$outsum=$outsum + $rowesrunit[2] ;
				//$presum=$presum + $rowesrunit[3];
				$excel->writeRow();
	}
        
        /*if(!$sfhq_id >0){
            //Print all sfhq supplier outstanding data to SFHQ type 0 login
            
            //print excel row to seperate sfhq data from sfhq 0 type data
            $excel->writeRow();
            $title_2 = array("<strong>SFHQ SUPPLIERS ".$val."  BILLS</strong>");
            $excel->writeLine($title_2);
                    
            while($rowessfhqrunit=mysql_fetch_array($allsfhqesrunit))
            {			

                $excel->writeCol($i);	
                $excel->writeCol($rowessfhqrunit[1]);	
                $excel->writeCol(number_format($rowessfhqrunit[2],'2','.',',')); 						
                //	$excel->writeCol(number_format($rowesrunit[3],'2','.',',')); 							

                $i +=1;			
                $outsum=$outsum + $rowessfhqrunit[2] ;
                //$presum=$presum + $rowesrunit[3];
                $excel->writeRow();
            }
        }*/
			
		$excel->writeCol('');	
		$excel->writeCol('<strong>Total</strong>');	
		$excel->writeCol('<strong>'.number_format($outsum,'2','.',',').'</strong>');	
		//$excel->writeCol('<strong>'.number_format($presum,'2','.',',').'</strong>');	
				
		////////////////////
		//  $_SESSION['sfhqID']=0;
	
	$excel->close();		
	//code for download  file 
	$document = $sfhq_id."SupOutstd_Report.xls"; 	
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
	
    fpassthru($fp);
	}
		   
			
		

?>

<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");

	

    	
	$today = date("m.d.y");	
	$sfhq_id 	= $_SESSION['sfhqID'];
	//$excel=new ExcelWriter($today."SupplierStatment_Report.xls");	
	$excel=new ExcelWriter($sfhq_id."SuppList.xls");	
	
	
	
	if($excel==false){
		echo $excel->error;
	}
	else {
			
	
		//$vote_id				=	isset( $_POST['vote_id'])?$_POST['vote_id']:$vote_id;		
		//$rtptype				=	isset( $_POST['rtptype'])?$_POST['rtptype']:$rtptype;
		//$Vote_name;		
		//$txt_as_at_date 		=	isset( $_POST['txt_as_at_date'])?$_POST['txt_as_at_date']:$today;
		//$txt_to_date 			=	isset( $_POST['txt_to_date'])?$_POST['txt_to_date']:$today;
		
		
		/*$Vote= Projects :: GetVoteName($vote_id);
		while($newsupname=mysql_fetch_array($Vote))
		{
			$Vote_name = $newsupname[0];
		}*/
	
	//$sfhqname;
		
		
		
	//	if($rtptype==0)
		//{
		//	$dtrange = 'D.Recieved_Date';
		//	$rptname = 'OUTSTANDING';
			
				$myArr=array("<strong>Ser No</strong>"
					 ,"<strong>Sup Name</strong>"
					 ,"<strong>Address</strong>"	
					,"<strong>Bank Name</strong>"							
					,"<strong>Bank Location</strong>"
					,"<strong>Account Number</strong>"
					,"<strong>Vat No</strong>"						
					,"<strong>Land Phone</strong>"
					,"<strong>Mobile</strong>"	
					,"<strong>Email</strong>"										
					,"<strong>NIC</strong>"
					,"");
			
	//	}
		
		
		
	$myArrtitle=array("<strong> ALL SUPPLIER DETAIL LIST </strong>");
		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
		
	
		
		$excel->writeLine($myArr);			
		
$esrunit = Projects :: Getsupplieralllist();	
		
		$i=1;		
		$tot="";
		
		
	while($rowesrunit=mysql_fetch_array($esrunit))
	{			
	
	
	
	
                $excel->writeCol($i);	                
                $excel->writeCol($rowesrunit[1]);				
				$excel->writeCol($rowesrunit[13].", ".$rowesrunit[14].", ".$rowesrunit[15].", ".$rowesrunit[16]);	
				$excel->writeCol($rowesrunit[23]);
				$excel->writeCol($rowesrunit[6]);		
				$excel->writeCol($rowesrunit[5]);
				$excel->writeCol($rowesrunit[7]);
                $excel->writeCol($rowesrunit[9]);	
				$excel->writeCol($rowesrunit[19]);		
				$excel->writeCol($rowesrunit[10]);
				$excel->writeCol($rowesrunit[22]);
                

                

                $i +=1;				
                $excel->writeRow();
        }

		////////////////////
		
	
	$excel->close();		
	//code for download  file 
	//$document = $today."SupplierStatment_Report.xls"; 
	$document = $sfhq_id."SuppList.xls"; 
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

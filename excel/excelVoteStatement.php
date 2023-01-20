<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");

	

    	
	$today = date("m.d.y");	
	$sfhq_id 	= $_SESSION['sfhqID'];
	//$excel=new ExcelWriter($today."SupplierStatment_Report.xls");	
	$excel=new ExcelWriter($sfhq_id."VoteStatment_Report.xls");	
	
	
	
	if($excel==false){
		echo $excel->error;
	}
	else {
			
	
		$vote_id				=	isset( $_POST['vote_id'])?$_POST['vote_id']:$vote_id;
		//$Vote_name				=	isset( $_GET['Vote_name'])?$_GET['Vote_name']:$Vote_name;
		$rtptype				=	isset( $_POST['rtptype'])?$_POST['rtptype']:$rtptype;
		$Vote_name;		
		$txt_as_at_date 		=	isset( $_POST['txt_as_at_date'])?$_POST['txt_as_at_date']:$today;
		$txt_to_date 			=	isset( $_POST['txt_to_date'])?$_POST['txt_to_date']:$today;
		
		
		$Vote= Projects :: GetVoteName($vote_id);
		foreach ($Vote as $newsupname) {
			$Vote_name = $newsupname[0];
		}
	
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
		
		if($rtptype==0)
		{
			$dtrange = 'D.Recieved_Date';
			$rptname = 'OUTSTANDING';
			
				$myArr=array("<strong>Ser No</strong>"
					 ,"<strong>Bill No</strong>"
						,"<strong>Supplier Name</strong>"						
						,"<strong>Supplier Address</strong>"
						,"<strong>VAT Reg No</strong>"
						,"<strong>Amount</strong>"						
						,"<strong>Invoice Date</strong>"
						
						,"<strong>Invoice No</strong>"
						,"<strong>G-35 Date</strong>"
						,"<strong>G-35 No</strong>"
						
						,"<strong>Received Date</strong>"
						,"<strong>Remarks</strong>"
						,"");
			
		}
		if($rtptype==1)
		{
			$dtrange = 'D.Bill_Settled_Date';
			$rptname = 'PAYMENT';
			
				$myArr=array("<strong>Ser No</strong>"
					 ,"<strong>Bill No</strong>"
						,"<strong>Supplier Name</strong>"
						,"<strong>Supplier Address</strong>"
						,"<strong>VAT Reg No</strong>"	
						,"<strong>Amount</strong>"						
						,"<strong>Invoice Date</strong>"
						,"<strong>Invoice No</strong>"
						,"<strong>G-35 Date</strong>"
						,"<strong>G-35 No</strong>"
						,"<strong>Received Date</strong>"	
						,"<strong>Remarks</strong>"
						,"<strong>Paid Date </strong>"	
						
						,"");
		}
		
		
		
		if($rtptype==2)
		{
			$dtrange = 'D.Recieved_Date';
			$rptname = 'NOT SETTLED';
			
				$myArr=array("<strong>Ser No</strong>"
					 ,"<strong>Bill No</strong>"
						,"<strong>Supplier Name</strong>"						
						,"<strong>Supplier Address</strong>"
						,"<strong>VAT Reg No</strong>"
						,"<strong>Amount</strong>"						
						,"<strong>Invoice Date</strong>"
						
						,"<strong>Invoice No</strong>"
						,"<strong>G-35 Date</strong>"
						,"<strong>G-35 No</strong>"
						
						,"<strong>Received Date</strong>"
						,"<strong>Remarks</strong>"
						,"");
			
		}
		
		
		
	$myArrtitle=array("<strong>".$sfhqname." -".$Vote_name."-".$rptname ." STATEMENT FROM  ". $txt_as_at_date."  TO ". $txt_to_date." </strong>");
		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
		
	
		
		$excel->writeLine($myArr);	
		
		if($sfhq_id>0){
		$esrunit = Projects :: GetVoteStatementforSfhq($vote_id,$rtptype,$txt_as_at_date,$txt_to_date,$sfhq_id,$dtrange );	
		}
		
		else 
		{
			
			$esrunit = Projects :: GetVoteStatementforTripoli($vote_id,$rtptype,$txt_as_at_date,$txt_to_date,$dtrange);
                        
                        //Get all sfhq vote statement data to sfhq 0type login
			$sfhqesrunit = Projects :: GetVoteStatementforAllSfhq($vote_id,$rtptype,$txt_as_at_date,$txt_to_date);	
		}
		$i=1;		
		
		$tot="";
		
		
	foreach ($esrunit as $rowesrunit) {		
	
                $excel->writeCol($i);					 
				
                $excel->writeCol($rowesrunit[0]);
                $excel->writeCol($rowesrunit[1]);
				
				$excel->writeCol($rowesrunit[10]);	
                $excel->writeCol($rowesrunit[11]);
				
                $excel->writeCol(number_format($rowesrunit[2],'2','.',','));	
                $tot=$tot+$rowesrunit[2];
                $excel->writeCol($rowesrunit[3]);	
				
				$excel->writeCol($rowesrunit[7]);
                $excel->writeCol($rowesrunit[9]);
				$excel->writeCol($rowesrunit[8]);
				
                $excel->writeCol($rowesrunit[5]);
                $excel->writeCol($rowesrunit[6]);

                if($rtptype=='1'){
                $excel->writeCol($rowesrunit[4]);
                }

                $i +=1;				
                $excel->writeRow();
        }
				
		if(!$sfhq_id >0){
                    //Print all SFHQ supplier age data to excel sheet for sfhq type 0 login
                    $excel->writeRow();

                    $title_2 = array("<strong>SFHQ ".$Vote_name."-".$rptname ." STATEMENT FROM  ". $txt_as_at_date."  TO ". $txt_to_date." </strong>");

                    $excel->writeLine($title_2);
                    
                    foreach ($sfhqesrunit as $sfhqrowesrunit) {
							
					
										
					       	$excel->writeCol($i);							
                            $excel->writeCol($sfhqrowesrunit[0]);
                            $excel->writeCol($sfhqrowesrunit[1]);							
							$excel->writeCol($rowesrunit[10]);	
                			$excel->writeCol($rowesrunit[11]);							
                            $excel->writeCol(number_format($sfhqrowesrunit[2],'2','.',','));	
                            $tot=$tot+$sfhqrowesrunit[2];
                            $excel->writeCol($sfhqrowesrunit[3]);
							$excel->writeCol($rowesrunit[7]);
							$excel->writeCol($rowesrunit[9]);
							$excel->writeCol($rowesrunit[8]);	
                            $excel->writeCol($sfhqrowesrunit[5]);
                            $excel->writeCol($sfhqrowesrunit[6]);
                            if($rtptype=='1'){
                            $excel->writeCol($sfhqrowesrunit[4]);
                            }
                            $i +=1;				
                            $excel->writeRow();							
							
							
					
                    }					
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
		$excel->writeCol('');
		$excel->writeCol('');	
		$excel->writeCol('');	
		
		$excel->writeRow();
		$excel->writeCol('');
		$excel->writeCol('Total');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol('');
		$excel->writeCol($tot);
		$excel->writeCol('');
		$excel->writeCol('');	
		$excel->writeCol('');
		$excel->writeCol('');	
		$excel->writeCol('');
		////////////////////
		
	
	$excel->close();		
	//code for download  file 
	//$document = $today."SupplierStatment_Report.xls"; 
	$document = $sfhq_id."VoteStatment_Report.xls"; 
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

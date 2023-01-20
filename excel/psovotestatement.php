<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");
	include('../classes/vote.class.php');

	
    	
	$today = date("m.d.y");	
	$branch_id  	= $_SESSION['branchID'];
	

	
	$Branch = Vote :: GetBranchNametoPsoView($branch_id);
	$branchName= $Branch['branch_name'];
	//$excel=new ExcelWriter($today."SupplierStatment_Report.xls");	
	$excel=new ExcelWriter($branch_id."VoteStatment_Report.xls");	
	
	
	
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
	

		
		if($rtptype==3)
		{
			$dtrange = 'D.Recieved_Date';
			$rptname = 'RETURNED';
			
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
						,"<strong>Bill H/O</strong>"
						,"<strong>Received Date</strong>"
						,"<strong>Remarks</strong>"
						,"");
			
		}
		if($rtptype==1)
		{
            $dtrange = 'D.Recieved_Date';
			$rptname = 'SETTLED';
			
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
						,"<strong>Bill H/O</strong>"
						,"<strong>Received Date</strong>"	
						,"<strong>Remarks</strong>"
						,"<strong>Paid Date </strong>"	
						
						,"");
		}
		
		
		
		if($rtptype==0)
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
						,"<strong>Bill H/O</strong>"
						,"<strong>Received Date</strong>"
						,"<strong>Remarks</strong>"
						,"");
			
		}
        
        if($rtptype==4)
		{
			$dtrange = 'D.Recieved_Date';
			$rptname = 'All';
			
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
						,"<strong>Bill H/O</strong>"
						,"<strong>Received Date</strong>"
						,"<strong>Remarks</strong>"
                       ,"<strong>Bill_Status</strong>"
						,"");
			
		}
		
		
		
	$myArrtitle=array("<strong>".$branchName." - ".$Vote_name." - ".$rptname ." STATEMENT FROM  ". $txt_as_at_date."  TO ". $txt_to_date." </strong>");
		$excel->writeLine($myArrtitle);
		$excel->writeRow();			
	
		
		$excel->writeLine($myArr);	
		
		
			
			$esrunit = Projects :: Psoviewfromallstation($vote_id,$rtptype,$txt_as_at_date,$txt_to_date,$dtrange);
		
		//echo $esrunit; die();
                        
                        //Get all sfhq vote statement data to sfhq 0type login
			//$sfhqesrunit = Projects :: GetVoteStatementforAllSfhq($vote_id,$rtptype,$txt_as_at_date,$txt_to_date);	
		
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
				 $excel->writeCol($rowesrunit[12]);
                $excel->writeCol($rowesrunit[5]);
                $excel->writeCol($rowesrunit[6]);
				

                if($rtptype=='1'){
                $excel->writeCol($rowesrunit[4]);
                }
                if($rtptype=='4'){
                $excel->writeCol($rowesrunit[13]);
                }

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
	$document = $branch_id."VoteStatment_Report.xls"; 
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

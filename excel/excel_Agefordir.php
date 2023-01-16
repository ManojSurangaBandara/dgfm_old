<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");

	

    $sfhq_id=$_SESSION['sfhqID'];
	$today=date("y.m.d");	
	$excel=new ExcelWriter($sfhq_id."Agefordir_Report.xls");	
	
	
	if($excel==false){
		echo $excel->error;
	}
	else {
			
		$log_year=$_SESSION['log_year'];
		$received_asat=isset( $_POST['received_asat'])?$_POST['received_asat']:$today;
		$rtptype=isset( $_POST['rtptype'])?$_POST['rtptype']:$rtptype;	
		$group=isset( $_POST['group'])?$_POST['group']:$group;
			
		$sfhq_id=$_SESSION['sfhqID'];
		
		
		if($rtptype ==0 && $group ==0 ) {
		$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS REPORT - ALL NOT SETTLE BILLS OF YEAR ". $log_year." </strong>");
		}
		if($rtptype ==0 && $group ==1 ) {
		$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS REPORT - NOT SETTLE BILLS OF DIRECTORATE OF FINANCE FOR THE YEAR OF ". $log_year." </strong>");
		}
		if($rtptype ==0 && $group ==2 ) {
		$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS REPORT - NOT SETTLE BILLS OF REGIONAL ACCOUNT OFFICE FOR THE YEAR OF ". $log_year." </strong>");
		}
		
		
		if($rtptype ==1 && $group ==0 ) {
		$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS REPORT - ALL SETTLED BILLS OF YEAR ". $log_year." </strong>");
		}
		if($rtptype ==1 && $group ==1 ) {
		$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS REPORT - SETTLED BILLS OF DIRECTORATE OF FINANCE FOR THE YEAR OF ". $log_year." </strong>");
		}
		if($rtptype ==1 && $group ==2 ) {
		$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS REPORT - SETTLED BILLS OF REGIONAL ACCOUNT OFFICE FOR THE YEAR OF ". $log_year." </strong>");
		}
		
		
		if($rtptype ==3 && $group ==0 ) {
		$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS REPORT - ALL RETURNED BILLS OF YEAR ". $log_year." </strong>");
		}
		if($rtptype ==3 && $group ==1 ) {
		$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS REPORT - RETURNED BILLS OF DIRECTORATE OF FINANCE FOR THE YEAR OF ". $log_year." </strong>");
		}
		if($rtptype ==3 && $group ==2 ) {
		$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS REPORT - RETURNED BILLS OF REGIONAL ACCOUNT OFFICE FOR THE YEAR OF ". $log_year." </strong>");
		}
		
		
		
		if($rtptype ==4 && $group ==0) {
$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS REPORT - ALL OUTSTANDING BILLS OF YEAR ". $log_year." </strong>");
		}
		if($rtptype ==4 && $group ==1) {
$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS REPORT - DIRECTORATE OF FINNACE OUTSTANDING BILLS OF YEAR ". $log_year." </strong>");
		}
		if($rtptype ==4 && $group ==2) {
$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS REPORT - REGIONAL ACCOUNT OFFICE OUTSTANDING BILLS OF YEAR ". $log_year." </strong>");
		}
		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
		$myArr=array("<strong>No</strong>"
						,"<strong>Vote</strong>"
						,"<strong>Description</strong>"	
						,"<strong>Allocation (LKR)</strong>"
						,"<strong>Remaining (LKR) </strong>"					   
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
		
		if($group ==0 ) {
			$esrunit = Projects :: GetAllAgeAna_DFin($received_asat,$rtptype,$group);
		}
		if($group ==1 ) {
			$esrunit = Projects :: GetDteAgeAna_DFin($received_asat,$rtptype,$group);
		}
		if($group ==2 ) {
			$esrunit = Projects :: GetAccAgeAna_DFin($received_asat,$rtptype,$group);
		}
		
		
		
    //  $esrunit = Projects :: GetAgeAnalysisfortRIPOLI($txt_as_at_date,$rtptype );
    //  $sfhq_result = Projects :: GetAllAgeAnalysisforSfhq($txt_as_at_date,$rtptype );
	
            
	while($rowesrunit=mysql_fetch_array($esrunit))
	{			
				if($id==''){
				$i +=1;	
				$excel->writeRow();
				$excel->writeCol($i);	
				
				$excel->writeCol($rowesrunit[1]);	
				$excel->writeCol($rowesrunit[2]);
				$excel->writeCol(number_format($rowesrunit[6],'2','.',','));
				$excel->writeCol(number_format($rowesrunit[7],'2','.',','));
				       
				
				$monthreal=$rowesrunit[4];
				$value=1;
				}
				
				if($id!='' && $rowesrunit[0]!=$id )
				{
				$i +=1;				
				$excel->writeRow();
				$excel->writeCol($i);	
				
				$excel->writeCol($rowesrunit[1]);	
				$excel->writeCol($rowesrunit[2]);
				$excel->writeCol(number_format($rowesrunit[6],'2','.',','));
				$excel->writeCol(number_format($rowesrunit[7],'2','.',','));
				
				$monthreal=$rowesrunit[4];
				$value=1;
				}			
				
				if($id!='' && $rowesrunit[0]==$id )
				{
					if($value==1)
					{
						$mon=$rowesrunit[4]; 
						$rowesrunit[4] = $rowesrunit[4] - $monthreal ;
						$monthreal =   $rowesrunit[4];
						
						$value=0;
					}
					else
					{
						$x=$rowesrunit[4];
						$rowesrunit[4] = $rowesrunit[4] - $mon ;
						$value==0;
						$mon=$x;
					}
				}
									
						$id=$rowesrunit[0];	
					
					
					switch ($rowesrunit[4])
						{							
							
						case 1:
						  $excel->writeCol(number_format($rowesrunit[5],'2','.',',')); 
						  break;
						case 2:
						  $excel->writeCol('');	
						  $excel->writeCol(number_format($rowesrunit[5],'2','.',','));
						  break;
						case 3:
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol(number_format($rowesrunit[5],'2','.',','));
						  break;
						 case 4:
						  $excel->writeCol('');
						  $excel->writeCol('');						  
						  $excel->writeCol('');
						  $excel->writeCol(number_format($rowesrunit[5],'2','.',','));
						  break;
						 case 5:
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol(number_format($rowesrunit[5],'2','.',','));
						  break;
						 case 6:
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');						 
						  $excel->writeCol(number_format($rowesrunit[5],'2','.',','));
						  break;
						 case 7:
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol(number_format($rowesrunit[5],'2','.',','));
						  break;
						 case 8:
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');						  
						  $excel->writeCol(number_format($rowesrunit[5],'2','.',','));
						  break;
						 case 9:
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol(number_format($rowesrunit[5],'2','.',','));
						  break;
						 case 10:
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');
						  $excel->writeCol('');						  
						  $excel->writeCol(number_format($rowesrunit[5],'2','.',','));
						  break;
						 case 11:
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
						  $excel->writeCol(number_format($rowesrunit[5],'2','.',','));
						  break;
						 case 12:
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
						  $excel->writeCol(number_format($rowesrunit[5],'2','.',','));
						  break;
						default:
						  $excel->writeCol('No Result');
						}
						
					
			    
				
	 }
        
				
	$excel->close();		
	$document = $sfhq_id."Agefordir_Report.xls"; 	
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

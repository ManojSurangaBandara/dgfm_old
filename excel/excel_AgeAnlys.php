<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");

	

    $sfhq_id 	= $_SESSION['sfhqID'];
	$today = date("m.d.y");	
	$excel=new ExcelWriter($sfhq_id."AgeAnalys_Report.xls");	
	
	
	if($excel==false){
		echo $excel->error;
	}
	else {

		
		//$log_year	= $_SESSION['log_year'];		
		//$txt_as_at_date = $log_year;		
		$rtptype 			=	isset( $_POST['rtptype'])?$_POST['rtptype']:$rtptype;		
		$sfhq_id 			= $_SESSION['sfhqID'];
		$received_asat		=isset( $_POST['received_asat'])?$_POST['received_asat']:$today;
		//$branch_id  = $_SESSION['branchID'];
		//$user_type_id = $_SESSION['userType'];
		
		
		
		//$txt_to_date 		=	isset( $_POST['txt_to_date'])?$_POST['txt_to_date']:$today;
		
		//$supname = Projects :: GetSupplierName($sup_id);
		//while($newsupname=mysql_fetch_array($supname))
	//	{
		//	$sup_name = $newsupname[0];
	//	}
	
	switch($rtptype) {
	case 0;
	$rptvalue = "NOT SETTLED";
	break;
	
	case 1;
	$rptvalue = "SETTLED";
	break;
	case 3;
	$rptvalue = "RETURNED";
	break;
	case 4;
	$rptvalue = "OUTSTANDING";
	break;
	default;
	$rptvalue = "WRONG!";
	break;
}

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

	
	$myArrtitle=array("<strong>SRI LANKA ARMY - VOTE AGE ANALYSIS FOR ".$rptvalue." BILLS OF ".$sfhqname." AS AT ".$received_asat." </strong>");

		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
		
			

		
		$myArr=array("<strong>No</strong>"
						,"<strong>Vote</strong>"
						,"<strong>Description</strong>"
						,"<strong>Allocation (LKR)</strong>"
						,"<strong>Remaining (LKR) </strong>"	
					   // ,"<strong>B/F</strong>"  
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
		
		// this is for SFHQ'S
		//if($sfhq_id >0){
		
		$esrunit = Projects :: GetAgeAnalysisforSfhq($received_asat,$sfhq_id,$rtptype );	
	//	}
	//	else  // THIS IS FOR TRIPOLI
	//	{
			//Get tripoli vote age results(sfhq type 0 data)
      //  $esrunit = Projects :: GetAgeAnalysisfortRIPOLI($received_asat,$rtptype );
                        
                        //Get sfhq related vote age results(sfhq type not 0 data)
                    //    $sfhq_result = Projects :: GetAllAgeAnalysisforSfhq($received_asat,$rtptype );
	//	}     
		$i=1;		
		
                //$row_count = mysql_num_rows($esrunit)+mysql_num_rows($sfhq_result);
                //echo $row_count;exit;
                
	while($rowesrunit=mysql_fetch_array($esrunit))
	{			
	
				
				
	
				if($id==''){
				
				$excel->writeRow();
				$excel->writeCol($i);	
				$i +=1;	
				$excel->writeCol($rowesrunit[1]);	
				$excel->writeCol($rowesrunit[2]);
				$excel->writeCol(number_format($rowesrunit[6],'2','.',','));
				$excel->writeCol(number_format($rowesrunit[7],'2','.',','));
				//$excel->writeCol(number_format($rowesrunit[3],'2','.',','));        
				
				$monthreal=$rowesrunit[4];
				$value=1;
				}
				
			
			
				if($id!='' && $rowesrunit[0]!=$id )
				{
								
				$excel->writeRow();
				$excel->writeCol($i);	
				$i +=1;
				$excel->writeCol($rowesrunit[1]);	
				$excel->writeCol($rowesrunit[2]);
				$excel->writeCol(number_format($rowesrunit[6],'2','.',','));
				$excel->writeCol(number_format($rowesrunit[7],'2','.',','));
				//$excel->writeCol(number_format($rowesrunit[3],'2','.',',')); 
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
         
         if(!$sfhq_id >0){
             //Print all SFHQ vote age data to excel sheet for sfhq type 0 login
                    $excel->writeRow();
                    if($rtptype ==1) {
                        //$title_2 = array("<strong>SFHQ VOTE AGE ANALYSIS FOR SETTLE BILLS</strong>");
                    }
                    
                    if($rtptype ==0) {
                       // $title_2 = array("<strong>SFHQ VOTE AGE ANALYSIS FOR OUTSTANDING BILLS</strong>");
                    }
                    
                    $excel->writeLine($title_2);

                    //11-12-2015 added
                    while($rowsfhqesrunit=mysql_fetch_array($sfhq_result))
                   {			



                        //print_r($rowsfhqesrunit);
                                           if($id1==''){

                                           $excel->writeRow();
                                           $excel->writeCol($i);	
                                           $i +=1;	
                                           $excel->writeCol($rowsfhqesrunit[1]);	
                                           $excel->writeCol($rowsfhqesrunit[2]);
                                           //$excel->writeCol(number_format($rowesrunit[3],'2','.',','));        

                                           $monthreal=$rowsfhqesrunit[4];
                                           $value=1;
                                           }



                                           if($id1!='' && $rowsfhqesrunit[0]!=$id1 )
                                           {

                                           $excel->writeRow();
                                           $excel->writeCol($i);	
                                           $i +=1;
                                           $excel->writeCol($rowsfhqesrunit[1]);	
                                           $excel->writeCol($rowsfhqesrunit[2]);
                                           //$excel->writeCol(number_format($rowesrunit[3],'2','.',',')); 
                                           $monthreal=$rowsfhqesrunit[4];
                                           $value=1;
                                           }			





                                           if($id1!='' && $rowsfhqesrunit[0]==$id1 )
                                           {
                                                   if($value==1)
                                                   {
                                                           $mon=$rowsfhqesrunit[4]; 
                                                           $rowsfhqesrunit[4] = $rowsfhqesrunit[4] - $monthreal ;
                                                           $monthreal =   $rowsfhqesrunit[4];

                                                           $value=0;
                                                   }
                                                   else
                                                   {
                                                           $x=$rowsfhqesrunit[4];
                                                           $rowsfhqesrunit[4] = $rowsfhqesrunit[4] - $mon ;
                                                           $value==0;
                                                           $mon=$x;
                                                   }
                                           }

                                                                   $id1=$rowsfhqesrunit[0];	


                                                   switch ($rowsfhqesrunit[4])
                                                           {							

                                                           case 1:
                                                             $excel->writeCol(number_format($rowsfhqesrunit[5],'2','.',',')); 
                                                             break;
                                                           case 2:
                                                             $excel->writeCol('');	
                                                             $excel->writeCol(number_format($rowsfhqesrunit[5],'2','.',','));
                                                             break;
                                                           case 3:
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol(number_format($rowsfhqesrunit[5],'2','.',','));
                                                             break;
                                                            case 4:
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');						  
                                                             $excel->writeCol('');
                                                             $excel->writeCol(number_format($rowsfhqesrunit[5],'2','.',','));
                                                             break;
                                                            case 5:
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol(number_format($rowsfhqesrunit[5],'2','.',','));
                                                             break;
                                                            case 6:
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');						 
                                                             $excel->writeCol(number_format($rowsfhqesrunit[5],'2','.',','));
                                                             break;
                                                            case 7:
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol(number_format($rowsfhqesrunit[5],'2','.',','));
                                                             break;
                                                            case 8:
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');
                                                             $excel->writeCol('');						  
                                                             $excel->writeCol(number_format($rowsfhqesrunit[5],'2','.',','));
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
                                                             $excel->writeCol(number_format($rowsfhqesrunit[5],'2','.',','));
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
                                                             $excel->writeCol(number_format($rowsfhqesrunit[5],'2','.',','));
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
                                                             $excel->writeCol(number_format($rowsfhqesrunit[5],'2','.',','));
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
                                                             $excel->writeCol(number_format($rowsfhqesrunit[5],'2','.',','));
                                                             break;
                                                           default:
                                                             $excel->writeCol('No Result');
                                                           }




                    }
                    //11-12-2015 end
         }
	//$_SESSION['sfhqID']=0;    2020.04.22 commented this line
				
		////////////////////
		
	$excel->close();		
	//code for download  file 
	$document = $sfhq_id."AgeAnalys_Report.xls"; 	
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

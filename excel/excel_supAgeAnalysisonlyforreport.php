<?php

	include('../includes/config.php');
	include('../classes/db_con.php');	
	include('../classes/projects.class.php');	
	include("excelwriter.inc.php");

	

    $sfhq_id = $_SESSION['sfhqID'];
	$today = date("m.d.y");	
	$excel=new ExcelWriter($sfhq_id."SupAgeAnalys_Report.xls");	
	
	
	if($excel==false){
		echo $excel->error;
	}
	else {			
		
		//$txt_as_at_date 	=	isset( $_POST['txt_as_at_date'])?$_POST['txt_as_at_date']:2012;
		$log_year	= $_SESSION['log_year'];
		$txt_as_at_date = $log_year;
		$sfhq_id 	= $_SESSION['sfhqID'];
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
	
	
		
$myArrtitle=array("<strong>SRI LANKA ARMY - ".$sfhqname."- SUPPLIER AGE ANALYSIS OUTSTANDINGS OF YEAR ".$txt_as_at_date." </strong>");
		$excel->writeLine($myArrtitle);
		$excel->writeRow();	
		
			

		
		$myArr=array("<strong>No</strong>"
						// ,"<strong>Supplier Code</strong>"
						,"<strong>Supplier Name</strong>"						
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
		if($sfhq_id >0){
		
		$esrunit = Projects :: GetSupplierAgeAnalysisforSfhq($txt_as_at_date,$sfhq_id);	
		}
		else  // THIS IS FOR TRIPOLI
		{
			$esrunit = Projects :: GetSupplierAgeAnalysisfortRIPOLI($txt_as_at_date);	
			
                        $sfhqesrunit = Projects :: GetAllSupplierAgeAnalysisforSfhq($txt_as_at_date);	
		}
		$i=1;		
		
	while($rowesrunit=mysql_fetch_array($esrunit))
	{			
	
				
				
	
				if($id==''){
				
				$excel->writeRow();
				$excel->writeCol($i);	
				$i +=1;	
				//$excel->writeCol($rowesrunit[1]);	
				$excel->writeCol($rowesrunit[2]);
				//$excel->writeCol(number_format($rowesrunit[3],'2','.',','));        
				
				$monthreal=$rowesrunit[4];
				$value=1;
				}
				
			
			
				if($id!='' && $rowesrunit[0]!=$id )
				{
								
				$excel->writeRow();
				$excel->writeCol($i);	
				$i +=1;
				//$excel->writeCol($rowesrunit[1]);	
				$excel->writeCol($rowesrunit[2]);
			//	$excel->writeCol(number_format($rowesrunit[3],'2','.',',')); 
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
            //Print all SFHQ supplier age data to excel sheet for sfhq type 0 login
            $excel->writeRow();
            
            $title_2 = array("<strong>SFHQ SUPPLIER AGE ANALYSIS OUTSTANDINGS</strong>");
            
            $excel->writeLine($title_2);
            
            while($sfhqrowesrunit=mysql_fetch_array($sfhqesrunit))
            {			



                
                                    if($id1==''){

                                    $excel->writeRow();
                                    $excel->writeCol($i);	
                                    $i +=1;	
                                    //$excel->writeCol($rowesrunit[1]);	
                                    $excel->writeCol($sfhqrowesrunit[2]);
                                    //$excel->writeCol(number_format($rowesrunit[3],'2','.',','));        

                                    $monthreal=$sfhqrowesrunit[4];
                                    $value=1;
                                    }



                                    if($id1!='' && $sfhqrowesrunit[0]!=$id1 )
                                    {

                                    $excel->writeRow();
                                    $excel->writeCol($i);	
                                    $i +=1;
                                    //$excel->writeCol($rowesrunit[1]);	
                                    $excel->writeCol($sfhqrowesrunit[2]);
                            //	$excel->writeCol(number_format($rowesrunit[3],'2','.',',')); 
                                    $monthreal=$sfhqrowesrunit[4];
                                    $value=1;
                                    }			





                                    if($id1!='' && $sfhqrowesrunit[0]==$id1 )
                                    {
                                            if($value==1)
                                            {
                                                    $mon=$sfhqrowesrunit[4]; 
                                                    $sfhqrowesrunit[4] = $sfhqrowesrunit[4] - $monthreal ;
                                                    $monthreal =   $sfhqrowesrunit[4];

                                                    $value=0;
                                            }
                                            else
                                            {
                                                    $x=$sfhqrowesrunit[4];
                                                    $rowesrunit[4] = $sfhqrowesrunit[4] - $mon ;
                                                    $value==0;
                                                    $mon=$x;
                                            }
                                    }

                                                            $id1=$sfhqrowesrunit[0];	


                                            switch ($sfhqrowesrunit[4])
                                                    {							

                                                    case 1:
                                                      $excel->writeCol(number_format($sfhqrowesrunit[5],'2','.',',')); 
                                                      break;
                                                    case 2:
                                                      $excel->writeCol('');	
                                                      $excel->writeCol(number_format($sfhqrowesrunit[5],'2','.',','));
                                                      break;
                                                    case 3:
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol(number_format($sfhqrowesrunit[5],'2','.',','));
                                                      break;
                                                     case 4:
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');						  
                                                      $excel->writeCol('');
                                                      $excel->writeCol(number_format($sfhqrowesrunit[5],'2','.',','));
                                                      break;
                                                     case 5:
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol(number_format($sfhqrowesrunit[5],'2','.',','));
                                                      break;
                                                     case 6:
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');						 
                                                      $excel->writeCol(number_format($sfhqrowesrunit[5],'2','.',','));
                                                      break;
                                                     case 7:
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol(number_format($sfhqrowesrunit[5],'2','.',','));
                                                      break;
                                                     case 8:
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');
                                                      $excel->writeCol('');						  
                                                      $excel->writeCol(number_format($sfhqrowesrunit[5],'2','.',','));
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
                                                      $excel->writeCol(number_format($sfhqrowesrunit[5],'2','.',','));
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
                                                      $excel->writeCol(number_format($sfhqrowesrunit[5],'2','.',','));
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
                                                      $excel->writeCol(number_format($sfhqrowesrunit[5],'2','.',','));
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
                                                      $excel->writeCol(number_format($sfhqrowesrunit[5],'2','.',','));
                                                      break;
                                                    default:
                                                      $excel->writeCol('No Result');
                                                    }




             }
        }	
				
		////////////////////
		
	
	$excel->close();		
	//code for download  file 
	$document = $sfhq_id."SupAgeAnalys_Report.xls"; 	
	$fp = fopen($document, 'r');   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	}
		   
			
		

?>

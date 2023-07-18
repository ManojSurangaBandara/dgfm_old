<?php 
require_once('../includes/config.php');
require_once('../classes/db_con.php');
require_once('../classes/projects.class.php');
require_once('../classes/common.class.php');
include "ESMSWS.php";



//<?php echo $data['Sup_Name'];


$mode	=	isset( $_GET['mode'] )?$_GET['mode']:'';
$mode	=	isset( $_POST['mode'])?$_POST['mode']:$mode;



switch($mode)
{
	case 'save':
	
$project_type 			= 	isset( $_POST['cmb_project_type'])?$_POST['cmb_project_type']:$project_type;		
$project_name			=	isset( $_POST['txtproject_name'])?$_POST['txtproject_name']:$project_name;
$job_number				=	isset( $_POST['txtjob_number'])?$_POST['txtjob_number']:$job_number	;
$project_status			=	true;
$project_allocated_amount 	= isset( $_POST['txtallocated_amount'])?$_POST['txtallocated_amount']:$project_allocated_amount;
$project_Description 		= 	isset( $_POST['txaproject_description'])?$_POST['txaproject_description']:$project_Description;
	$project_location		=	isset( $_POST['txtlocation'])?$_POST['txtlocation']:$project_location;		
	$project_start_date 	= 	isset( $_POST['txtstart_date'])?$_POST['txtstart_date']:$project_start_date;
	$project_end_date		=	isset( $_POST['txtend_date'])?$_POST['txtend_date']:$project_end_date;		
	$txt_vote_no			=	isset( $_POST['txt_vote_no'])?$_POST['txt_vote_no']:$txt_vote_no;			
	$proj_created_date 		= 	date('Y-m-d');
	$proj_created_user 		= 	$_SESSION['userID'];
	$esr_unit_id			=	$_SESSION['unitID'];
	$allocated_regiment		= 	$_POST['allocated_regiment'];
	$ge_id					=	$_POST['allocated_ess'];

	
		
	
	if($project_type ==2)
	{
		
		$date_of_tender_called 	= 	isset( $_POST['txttendercalled'])?$_POST['txttendercalled']:$date_of_tender_called;
$date_of_tender_opened	=	isset( $_POST['txtdateofTenderopen'])?$_POST['txtdateofTenderopen']:$date_of_tender_opened;
$date_of_tec_appointed	=	isset( $_POST['txtdateoftechappointed'])?$_POST['txtdateoftechappointed']:$date_of_tec_appointed;
		$date_of_tb_appointed	=	isset( $_POST['txttbappinted'])?$_POST['txttbappinted']:$date_of_tb_appointed;
		$name_of_contractor 	= 	isset( $_POST['txtnameofcontractor'])?$_POST['txtnameofcontractor']:$name_of_contractor;
		$awarded_date 			= 	isset( $_POST['txtawardeddate'])?$_POST['txtawardeddate']:$awarded_date;
		$extension_given		=	isset( $_POST['txtextensiongiven'])?$_POST['txtextensiongiven']:$extension_given;
		$project_station 		= 	isset( $_POST['cmb_gecentre'])?$_POST['cmb_gecentre']:$project_station;
		$ge_station ='';
			for ($i=0; $i < count($project_station); $i++){
				$ge_station .= $project_station[$i].",";
			}
		
	}
	else 
	{
		
		$project_reference_id	=	isset( $_POST['txtrefid'])?$_POST['txtrefid']:$project_reference_id;
		$dateref				=	isset( $_POST['dateref'])?$_POST['dateref']:$dateref;
		$estimatedamount		=	isset( $_POST['estimatedamount'])?$_POST['estimatedamount']:$estimatedamount;		
		$G69No					=	isset( $_POST['g69no'])?$_POST['g69no']:$G69No;
		$Dates					=	isset( $_POST['txtdates'])?$_POST['txtdates']:$Dates;
		
		
	}
	
	 	
		
		
		
		
		
		
	
		$result = Projects :: saveProject($project_reference_id,
						   $project_name,
						   $job_number,
						   $project_status,
						   $project_allocated_amount,
						   $project_start_date,
						   $project_end_date,
						   $project_location,
						   $project_type,
						   $date_of_tender_called,
						   $date_of_tender_opened,
						   $date_of_tec_appointed,
						   $date_of_tb_appointed,                           
						   $name_of_contractor,
						   $awarded_date,
						   $extension_given,
						   $ge_station,
						   $proj_created_date ,
						   $proj_created_user,
						   $project_Description,
						   $esr_unit_id,
						   $ge_id,
						   $dateref,
						   $estimatedamount,
						   $G69No,
						   $Dates,
						   $txt_vote_no,
						   $allocated_regiment);
				if($result==true)				
				{
					
					header("Location:../projects.php?msg=1");	
				}
				elseif($result==false)
				{
					header("Location:../new_project.php?msg=2");	
				}
		
	break;
	
	
	
	
	case 'edit':
	
	
	//	$project_type 			= 	isset( $_POST['hiddenField'])?$_POST['hiddenField']:$project_type;
		
		
		$project_type 			= 	isset( $_POST['cmb_project_type'])?$_POST['cmb_project_type']:$project_type;
		$job_number				=	isset( $_POST['txtjob_number'])?$_POST['txtjob_number']:$job_number	;
		$project_id				=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		$project_name			=	isset( $_POST['txtproject_name'])?$_POST['txtproject_name']:$project_name;
		$project_status			=	true;
	$project_allocated_amount = isset( $_POST['txtallocated_amount'])?$_POST['txtallocated_amount']:$project_allocated_amount;
		$project_start_date 	= 	isset( $_POST['txtstart_date'])?$_POST['txtstart_date']:$project_start_date;
		$project_end_date		=	isset( $_POST['txtend_date'])?$_POST['txtend_date']:$project_end_date;
		$project_location		=	isset( $_POST['txtlocation'])?$_POST['txtlocation']:$project_location;		
		
$project_Description 	= 	isset( $_POST['txaproject_description'])?$_POST['txaproject_description']:$project_Description;
		$proj_created_date 		= 	date('Y-m-d');
		$proj_created_user 		= 	$_SESSION['userID'];
		$txt_vote_no			=	isset( $_POST['txt_vote_no'])?$_POST['txt_vote_no']:$txt_vote_no;	
		$allocated_regiment		= 	$_POST['allocated_regiment'];
		$ge_id					=	$_POST['allocated_ess'];

	
	if($project_type ==2)
	{
		$date_of_tender_called 	= 	isset( $_POST['txttendercalled'])?$_POST['txttendercalled']:$date_of_tender_called;
	$date_of_tender_opened	=	isset( $_POST['txtdateofTenderopen'])?$_POST['txtdateofTenderopen']:$date_of_tender_opened;
$date_of_tec_appointed	=	isset( $_POST['txtdateoftechappointed'])?$_POST['txtdateoftechappointed']:$date_of_tec_appointed;
		$date_of_tb_appointed	=	isset( $_POST['txttbappinted'])?$_POST['txttbappinted']:$date_of_tb_appointed;
		$name_of_contractor 	= 	isset( $_POST['txtnameofcontractor'])?$_POST['txtnameofcontractor']:$name_of_contractor;
		$awarded_date 			= 	isset( $_POST['txtawardeddate'])?$_POST['txtawardeddate']:$awarded_date;
		$extension_given		=	isset( $_POST['txtextensiongiven'])?$_POST['txtextensiongiven']:$extension_given;
		$project_station 		= 	isset( $_POST['cmb_gecentre'])?$_POST['cmb_gecentre']:$project_station;
		$ge_station ='';
			for ($i=0; $i < count($project_station); $i++){
				$ge_station .= $project_station[$i].",";
			}
	}
	else 
	{
		$project_reference_id	=	isset( $_POST['unit_name'])?$_POST['unit_name']:$project_reference_id;
		$dateref				=	isset( $_POST['dateref'])?$_POST['dateref']:$dateref;
		$estimatedamount		=	isset( $_POST['estimatedamount'])?$_POST['estimatedamount']:$estimatedamount;		
		$G69No					=	isset( $_POST['g69no'])?$_POST['g69no']:$G69No;
		$Dates					=	isset( $_POST['txtdates'])?$_POST['txtdates']:$Dates;
		
	}
	
	
	 	
		
		
		
	
		
		$result = Projects :: editProject($project_id,
						   $project_reference_id,
						   $project_name,
						   $job_number,		
						   $project_status,
						   $project_allocated_amount,
						   $project_start_date,
						   $project_end_date,
						   $project_location,
						   $project_type,
						   $date_of_tender_called,
						   $date_of_tender_opened,
						   $date_of_tec_appointed,
						   $date_of_tb_appointed,                           
						   $name_of_contractor,
						   $awarded_date,
						   $extension_given,
						   $ge_station,
						   $proj_created_date ,
						   $proj_created_user,
						   $project_Description,
						   $dateref,
						   $estimatedamount,
						   $G69No,
						   $Dates,
						   $txt_vote_no,
						   $allocated_regiment,
						   $ge_id
						   );
				if($result==true)
				
				{
					header("Location:../projects.php?msg=3");	
				}
				elseif($result==false)
				{
					header("Location:../edit_project.php?msg=4");	
				}
		
	break;
	
	case 'delete':
		$billid	 	=	isset( $_GET['billid'])?$_GET['billid']:$project_id;
		
		$resultdelete = Projects :: DeleteProject($billid);
		if($resultdelete==true)
		  {
			  header("Location:../projects.php?msg=5");	
		  }
		  elseif($resultdelete==false)
		  {
			  header("Location:../projects.php?msg=6");	
		  }
	
	break;
	
		case 'deleteBigUser':
		$billid	 	=	isset( $_GET['billid'])?$_GET['billid']:$billid;
		$billno	 	=	isset( $_GET['billno'])?$_GET['billno']:$billno;
		
		$resultdelete = Projects :: DeleteProject($billid,$billno);
		if($resultdelete==true)
		  {
			 // header("Location:../Chiefacc.php?msg=5");	
			  header("Location:../Chiefacc.php?msg=5&branch_id=6&status=3");	
		  }
		  elseif($resultdelete==false)
		  {
			 // header("Location:../Chiefacc.php?msg=6");	
			 header("Location:../Chiefacc.php?msg=6&branch_id=6&status=3");
		  }
	
	break;
	
	
	case 'deleteSfhq':
		$billid	 	=	isset( $_GET['billid'])?$_GET['billid']:$billid;
		$billno	 	=	isset( $_GET['billno'])?$_GET['billno']:$billno;
		$sfhqid		=	isset( $_GET['sfhqid'])?$_GET['sfhqid']:$sfhqid;
		
		
		
		$resultdelete = Projects :: DeleteBillDetailsSfhq($billid,$billno,$sfhqid);
		if($resultdelete==true)
		  {
			//  header("Location:../projects.php?msg=5");	
			    header("Location:../projects.php?msg=5&branch_id=6&status=3");	
			
			  
		  }
		  elseif($resultdelete==false)
		  {
			  header("Location:../Projects.php?msg=6");	
			header("Location:../projects.php?msg=6&branch_id=6&status=3");	
		  }
	
	break;
	
	
	case 'settlenowbiguser':
	
		$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		$status 		= 	isset( $_POST['chk_cancel'])?$_POST['chk_cancel']:$status;		
		$today 			= 	date('Y-m-d');
		$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
		
		//$cheque_no 		= 	isset( $_POST['cheque_no'])?$_POST['cheque_no']:$cheque_no;		
		//$chequeDate 	= 	isset( $_POST['chequeDate'])?$_POST['chequeDate']:$chequeDate;
		
			if($status=='false')
			{					
			$com_status=1;
			$msg=19;
			
					
			}
	
			else
			{				
			$com_status=0;
			$msg=25;
			$today='1000-01-01';
			$cheque_no=" ";
			$chequeDate='1000-01-01';
			
			}
		
		$resultcancel = Projects :: SettleThisbillBigUser($project_id,$com_status,$today);
		if($resultcancel==true)		
		  {
			  
			$data 	= Common :: SupDetailstoSMS($project_id);
			  
			if($data['is_vehicle']==1){	
			
			
			
			//$smsbody='Trf Credit. Rs.'.$data['Amnt'].' on '.$data['setldate'].'  To A/C No 165215 – BOC Homagama Of Mr Mal Chandrawathi As the Veh Bill Payment for (1 – 31) -02-2021 Of NC PF 3541 (Pl confirm the receipt of payment within 07 days) Directorate of Finance SL Army';	 
			  
			$username = 'esmsusr_280';
			$password = '2d6egs3';
			$session= createSession('', $username, $password,'');
			sendMessages($session,'SL ARMY FIN',$data['smsbody'],$data['mob'],0);
			closeSession($session);
			}
			  
			  header("Location:../Chiefacc.php?msg=".$msg);		
		  }
		  elseif($resultcancel==false)
		  {
			  header("Location:../Chiefacc.php?msg=".$msg);		
		  }
	
	break;
	
	
	case 'settlenowSfhq':
	
		$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		$status 		= 	isset( $_POST['chk_cancel'])?$_POST['chk_cancel']:$status;		
		$today 			= 	date('Y-m-d');
		$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
		
		$cheque_no 		= 	isset( $_POST['cheque_no'])?$_POST['cheque_no']:$cheque_no;		
		$chequeDate 	= 	isset( $_POST['chequeDate']) && !empty($_POST['chequeDate']) ? $_POST['chequeDate']:'1000-01-01';		
		
			if($status=='false')
			{					
			//$status=1;
			$com_status=1;
			$msg=19;
			
			$resultcancel = Projects :: SettleThisbillSfhq($project_id,$com_status,$today,$cheque_no,$chequeDate);
			/////////////////
			
			if($resultcancel==true)		
		 	{
			  
			$data 	= Common :: SendSMStoSFHQ($project_id);			  
			
			if($data['is_vehicle']==1){			
				
			$username = 'esmsusr_280';
			$password = '2d6egs3';
			$session= createSession('', $username, $password,'');
			sendMessages($session,'SL ARMY FIN',$data['smsbody'],$data['mob'],0);
			closeSession($session);
			
			}
			
			
			///////////////////////////			
			
			header("Location:../projects.php?msg=".$msg."&branch_id=".$branch_id);
			
			} 
			}
	
			else{				
			//$status=0;
			//$com_status=0;
			$msg=26;
			header("Location:../projects.php?msg=".$msg."&branch_id=".$branch_id);
			
			}
		
	
	break;
	
	
	
	case 'Chequeprintdet':
	
		$projectid	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$projectid;			
		$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
		$user_id		= 	$_SESSION['userID'];		
		$cheque_no 		= 	isset( $_POST['cheque_no'])?$_POST['cheque_no']:$cheque_no;	
		$chequeDate		= 	isset( $_POST['chequeDate'])?$_POST['chequeDate']:$chequeDate;	
		$file_ref		= 	isset( $_POST['file_ref'])?$_POST['file_ref']:$file_ref;
		$today 			= 	date('Y-m-d');		
		
	
		
	$resultcancel = Projects :: EnterChequeDetail($projectid,$cheque_no,$chequeDate,$today,$user_id,$file_ref);
		if($resultcancel==true)
		  {
			 // $msg = 29;				
			 //  header("Location:../projects.php?msg=".$msg."&branch_id=".$branch_id."&status=1");	
			 
			   ?>
              
              
              
              <script type="application/javascript" language="javascript"> 
			 // alert('sssss55');
			  window.open('../envelopaccoff.php?id=<?php echo $projectid; ?>','_self');
			  </script>          
              
              <?php
			 
			 
		  }
		  else 
		  {
			   $msg = 30;
			 // header("Location:../projects.php?msg=".$msg."&branch_id=".$branch_id."&status=".$com_status);	
			  header("Location:../projects.php?msg=".$msg."&branch_id=".$branch_id."&status=1");	
		  }
		  	  	
	
	break;
	
	
	
	case 'checkdetails':
	
		$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;			
		$today 			= 	date('Y-m-d');
		$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
		
		$cheque_no 		= 	isset( $_POST['cheque_no'])?$_POST['cheque_no']:$cheque_no;		
		$chequeDate 	= 	isset( $_POST['chequeDate'])?$_POST['chequeDate']:$chequeDate;
		
		$file_ref 	= 	isset( $_POST['file_ref'])?$_POST['file_ref']:$file_ref;
		
		
		
				
		$resultcancel = Projects :: setcheckdetails($project_id,$today,$cheque_no,$chequeDate,$file_ref);
		if($resultcancel==true)
		  {
			  
			  //header("Location:../Chiefacc.php?msg=29");
			//  echo "sssss"; 
			  
			  ?>
              
              
              
              <script type="application/javascript" language="javascript"> 
			 // alert('sssss55');
			  window.open('../envelop.php?id=<?php echo $project_id; ?>','_self');
			  </script>          
              
              <?php
			  
			 // 	header("Location:../Chiefacc.php?msg=29");	
		  }
		  elseif($resultcancel==false)
		  {
			  header("Location:../Chiefacc.php?status=1&msg=31");		
		  }
	
	break;
	
	
	
	
	//Un Settle DF bills
	case 'unsettlenowbiguser':
	
		$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		$status 		= 	isset( $_POST['chk_cancel'])?$_POST['chk_cancel']:$status;			
		$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
		
			if($status=='false')
			{					
			//$status=1;
			$com_status=1;
			$msg=28;
			
			$resultcancel = Projects :: UnSettleThisbillBigUser($project_id,$com_status,$today);
			 header("Location:../Chiefacc.php?msg=".$msg."&status=1&branch_id=".$branch_id);	
			}
	
			else{				
			//$status=0;
			$com_status=0;
			$msg=25;
			 header("Location:../Chiefacc.php?msg=".$msg."&status=1&branch_id=".$branch_id);	
			}
		
		
	
	break;
	
	//
	
	
	/////////Un Settle the bills
	
	case 'UnsettlenowSfhq':
	
		$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		$status 		= 	isset( $_POST['chk_cancel'])?$_POST['chk_cancel']:$status;		
		$today 			= 	date('Y-m-d');
		$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
		$sfhq_id		=	isset( $_GET['sfhq_id'])?$_GET['sfhq_id']:$sfhq_id;
			
			if($status=='false')
			{			
			$com_status=1;
			$msg=28;
					
			
			$resultcancel = Projects :: UnSettleThisbillSfhq($project_id,$today,$sfhq_id);
			
			//echo $resultcancel;
			//die();
			header("Location:../projects.php?msg=".$msg."status=1&branch_id=".$branch_id);	
			}
	
			else
			{			
			$com_status=0;
			$msg=26;
			header("Location:../projects.php?msg=".$msg."status=1&branch_id=".$branch_id);	
			}
		
		
	
	break;
	
	////
	
	case 'Returnnowbiguser':
	
		$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		$status1 		= 	isset( $_POST['chk_cancel'])?$_POST['chk_cancel']:$status1;		
		$rtnreason 		= 	isset( $_POST['rt_reason'])?$_POST['rt_reason']:$rtnreason;	
		$hiddenField 	= 	isset( $_POST['hiddenField'])?$_POST['hiddenField']:$hiddenField;	
		$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
		$status			=	isset( $_GET['status'])?$_GET['status']:$status;
		
		$cval		    = 	isset( $_GET['cval'])?$_GET['cval']:$cval;
		$user_id		= 	$_SESSION['userID'];
		$today 			= 	date('Y-m-d');
		
	if($status1!='')
	{
		
		if($cval=='cancel')
		{
			if($status1=='true')
			{				
			$msg=21;
			$com_status=3;
			$final_status=0;
			}
			else
			{					
			$msg=24;
			$com_status=0;
			$final_status=3;
			}
		}
		
		if($cval=='active')
		{
			
				
			if($status1=='false')
			{					
				$msg=16;
				$com_status=0;
				$final_status=3;
			}
			else
			{					
				$msg=17;
				$com_status=3;
				$final_status=0;
			}
		}
		
		$resultcancel = Projects :: ReturnThisbillBigUser($project_id,$com_status,$today,$rtnreason,$user_id,$hiddenField);
		if($resultcancel==true)
		  {
			 // header("Location:../Chiefacc.php?msg=".$msg."&branch_id=".$branch_id."&status=".$com_status);	
			  header("Location:../Chiefacc.php?msg=".$msg."&status=".$final_status);	
			 
		  }
		  elseif($resultcancel==false)
		  {
			 // header("Location:../Chiefacc.php?msg=".$msg."&branch_id=".$branch_id."&status=".$com_status);	
			  header("Location:../Chiefacc.php?msg=".$msg."&status=".$final_status);	
		  }
	}  	  
	else 
	{
	header("Location:../Chiefacc.php?msg=26&branch_id=".$branch_id);	
	}	
	break;
	
	
	case 'Returnnowsfhq':
	
		$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		$status 		= 	isset( $_POST['chk_cancel'])?$_POST['chk_cancel']:$status;		
		$rtnreason 		= 	isset( $_POST['rtnreason'])?$_POST['rtnreason']:$rtnreason;	
		$hiddenField 	= 	isset( $_POST['hiddenField'])?$_POST['hiddenField']:$hiddenField;	
		$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;

		$cval		    = 	isset( $_GET['cval'])?$_GET['cval']:$$cval;
		$user_id		= 	$_SESSION['userID'];
		$today 			= 	date('Y-m-d');
		
		
		if($status!='')
	{
		echo $cval;
		
		if($cval=='cancel')
		{
			if($status=='true')
			{				
			$msg=21;
			$com_status=3;
			$final_status=0;
			}
			else
			{					
			$msg=23;
			$com_status=0;
			$final_status=3;
			}
		}
		
		if($cval=='active')
		{
			
				
			if($status=='false')
			{					
				$msg=16;
				$com_status=0;
				$final_status=3;
			}
			else
			{					
				$msg=23;
				$com_status=3;
				$final_status=0;
			}
		}
		
		$resultcancel = Projects :: ReturnThisbillSfhq($project_id,$com_status,$today,$rtnreason,$user_id,$hiddenField);
		if($resultcancel==true)
		  {
			//  header("Location:../projects.php?msg=".$msg."&branch_id=".$branch_id."&status=".$com_status);	
			   header("Location:../projects.php?msg=".$msg."&status=".$final_status);	
		  }
		  elseif($resultcancel==false)
		  {
			 // header("Location:../projects.php?msg=".$msg."&branch_id=".$branch_id."&status=".$com_status);	
			  header("Location:../projects.php?msg=".$msg."&status=".$final_status);	
		  }
		  	  	
	}  	  
	else 
	{
	header("Location:../projects.php?msg=26&branch_id=".$branch_id);
	
	}	
	break;
	
	
	
	
	
	
	
	
	
	case 'settlenow':
	
		$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		$status 		= 	isset( $_POST['chk_cancel'])?$_POST['chk_cancel']:$status;
		$vote_id 		= 	isset( $_POST['vote_id'])?$_POST['vote_id']:$vote_id;
		$today 			= 	date('Y-m-d');
		
		
			if($status=='false')
			{					
			//$status=1;
			$com_status=1;
			}
	
			else{				
			//$status=0;
			$com_status=0;
			}
		
		$resultcancel = Projects :: SettleThisbill($project_id,$com_status,$vote_id,$today);
		if($resultcancel==true)
		  {
			  header("Location:../projects.php?msg=19.$msg");	
		  }
		  elseif($resultcancel==false)
		  {
			  header("Location:../projects.php?msg=20");	
		  }
	
	break;
	
	
	
		case 'cancelBiguser':
	
		$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		$status 		= 	isset( $_POST['chk_cancel'])?$_POST['chk_cancel']:$status;
		$cval		    = 	isset( $_GET['cval'])?$_GET['cval']:$$cval;
		
		
		if($cval=='cancel')
		{
			if($status=='true')
			{				
			$msg=13;
			$com_status=2;
			}
			else
			{					
			$msg=14;
			$com_status=0;
			}
		}
		
		if($cval=='active')
		{
			
				
			if($status=='false')
			{					
				$msg=16;
				$com_status=0;
			}
			else
			{					
				$msg=17;
				$com_status=2;
			}
		}
		
		
		
	
		
		
		
		$resultcancel = Projects :: CancelProject($project_id,$status,$com_status);
		if($resultcancel==true)
		  {
			  header("Location:../Chiefacc.php?msg=".$msg);	
		  }
		  elseif($resultcancel==false)
		  {
			  header("Location:../Chiefacc.php?msg=".$msg);	
		  }
	
	break;


case 'cancelSfhq':
	
		$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		$status 		= 	isset( $_POST['chk_cancel'])?$_POST['chk_cancel']:$status;
		$cval		    = 	isset( $_GET['cval'])?$_GET['cval']:$$cval;		
		$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
		
		if($cval=='cancel')
		{
			if($status=='true')
			{				
			$msg=13;
			$com_status=2;
			}
			else
			{					
			$msg=14;
			$com_status=0;
			}
		}
		
		if($cval=='active')
		{
			
				
			if($status=='false')
			{					
				$msg=16;
				$com_status=0;
			}
			else
			{					
				$msg=17;
				$com_status=2;
			}
		}
		
		
		
	
		
		
		
		$resultcancel = Projects :: CancelSfhqBills($project_id,$status,$com_status);
		if($resultcancel==true)
		  {
			  header("Location:../projects.php?msg=".$msg);	
		  }
		  elseif($resultcancel==false)
		  {
			  header("Location:../projects.php?msg=".$msg);	
		  }
	
	break;

	
	case 'cancel':
	
		$project_id	 	=	isset( $_GET['projectid'])?$_GET['projectid']:$project_id;
		$status 		= 	isset( $_POST['chk_cancel'])?$_POST['chk_cancel']:$status;
		$cval		    = 	isset( $_GET['cval'])?$_GET['cval']:$$cval;
		
		
		if($cval=='cancel')
		{
			if($status=='true')
			{				
			$msg=13;
			$com_status=2;
			}
			else
			{					
			$msg=14;
			$com_status=0;
			}
		}
		
		if($cval=='active')
		{
			
				
			if($status=='false')
			{					
				$msg=16;
				$com_status=0;
			}
			else
			{					
				$msg=17;
				$com_status=2;
			}
		}
		
		
		
	
		
		
		
		$resultcancel = Projects :: CancelProject($project_id,$status,$com_status);
		if($resultcancel==true)
		  {
			  header("Location:../projects.php?msg=".$msg);	
		  }
		  elseif($resultcancel==false)
		  {
			  header("Location:../projects.php?msg=".$msg);	
		  }
	
	break;
	
	
}

?>
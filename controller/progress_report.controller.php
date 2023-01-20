<?php 
require_once('../includes/config.php');
require_once('../classes/db_con.php');
require_once('../classes/progress_report.class.php');

$mode	=	isset( $_GET['mode'] )?$_GET['mode']:'';
$mode	=	isset( $_POST['mode'])?$_POST['mode']:$mode;

switch($mode)
{
	case 'save':
	
	
	$txt_project_type		=	isset( $_POST['txt_project_type'])?$_POST['txt_project_type']:$txt_project_type;
	
	
	if($txt_project_type==2)
	{
		$allocated_ammount_year = isset( $_POST['cmb_allocated_year'])?$_POST['cmb_allocated_year']:$allocated_ammount_year;
		$allocated_ammount 		= isset( $_POST['txtallocatedamount'])?$_POST['txtallocatedamount']:$allocated_ammount;
		$paid_year 				= isset( $_POST['cmb_amount_paid_in'])?$_POST['cmb_amount_paid_in']:$paid_year;
		$paid_amount 			= isset( $_POST['txtamountpaid'])?$_POST['txtamountpaid']:$paid_amount;
		$award_sum 				= isset( $_POST['txtawardsum'])?$_POST['txtawardsum']:$award_sum;
		
		
	}
	
	else 
	{
		
		$IsTBapproval 			= isset( $_POST['txttbapproval'])?$_POST['txttbapproval']:$IsTBapproval;
		$Aproval_Date 			= isset( $_POST['txtdateoftbaproval'])?$_POST['txtdateoftbaproval']:$Aproval_Date;
		
		
	}	
		
		$proj_pro_report_id		= isset( $_POST['cmbproject'])?$_POST['cmbproject']:$proj_pro_report_id;
		$proj_id				= isset( $_POST['cmbproject'])?$_POST['cmbproject']:$proj_id;
		$completing_state_as_percentage = isset( $_POST['cmb_percentage'])?$_POST['cmb_percentage']:$completing_state_as_percentage;
		$remarks				= isset( $_POST['txaremarks'])?$_POST['txaremarks']:$remarks;
		$report_file			= isset( $_POST['upfile'])?$_POST['upfile']:$report_file;
		$report_file1			= isset( $_POST['upfile1'])?$_POST['upfile1']:$report_file1;
		$report_file2			= isset( $_POST['upfile2'])?$_POST['upfile2']:$report_file2;	
		$report_file3			= isset( $_POST['upfile3'])?$_POST['upfile3']:$report_file3;	
		
		$report_date			= isset( $_POST['txt_as_at_date'])?$_POST['txt_as_at_date']:$report_date;
		$create_user_id			= isset( $_SESSION['userID'])?$_SESSION['userID']:$create_user_id;
		$create_date			= date('Y-m_d');
		
		$sending_states			= 0;
		$report_states			= 1;
		$total_complete			= isset( $_POST['chkcompleted'])?$_POST['chkcompleted']:$total_complete;
		
		if($completing_state_as_percentage=='100'){
			$total_complete=1;
		}
		else{
		$total_complete=0;
		}
		
		
		
		$max = ProjectsProgress :: GetMaxID();
		foreach ($max as $rowmax) {
			$val = $rowmax[0];
		}       
		
		
		
		
		if($_FILES['upfile']['name'] !=""){
		//Upload image file
		$up_file =isset($_FILES['upfile']['name']) && $_FILES['upfile']['name']!="" ? $_FILES['upfile']['name'] : '';
		move_uploaded_file ($_FILES['upfile']['tmp_name'],"../uploads/"."0".$val.$_FILES['upfile']['name']);	

          $up_file = "0".$val.$up_file;

		}
		
		
		
		if($_FILES['upfile1']['name'] !=""){
		//Upload image file
		$up_file1 =isset($_FILES['upfile1']['name']) && $_FILES['upfile1']['name']!="" ? $_FILES['upfile1']['name'] : '';
		move_uploaded_file ($_FILES['upfile1']['tmp_name'],"../uploads/"."1".$val.$_FILES['upfile1']['name']);	

 		$up_file1 = "1".$val.$up_file1;
		}
		
		
		if($_FILES['upfile2']['name'] !=""){
		//Upload image file
		$up_file2 =isset($_FILES['upfile2']['name']) && $_FILES['upfile2']['name']!="" ? $_FILES['upfile2']['name'] : '';
		move_uploaded_file ($_FILES['upfile2']['tmp_name'],"../uploads/"."2".$val.$_FILES['upfile2']['name']);	

 		$up_file2 = "2".$val.$up_file2;
		}
		
	
		if($_FILES['upfile3']['name'] !=""){
		//Upload a file
		$up_file3 =isset($_FILES['upfile3']['name']) && $_FILES['upfile3']['name']!="" ? $_FILES['upfile3']['name'] : '';
		move_uploaded_file ($_FILES['upfile3']['tmp_name'],"../uploads/"."3".$val.$_FILES['upfile3']['name']);	

 		$up_file3 = "3".$val.$up_file3;
		}
		
		
		
		$result = ProjectsProgress :: saveProjectReport($proj_id,$allocated_ammount_year,$allocated_ammount,$paid_year,$paid_amount,$completing_state_as_percentage,$up_file,$up_file1,$up_file2,$up_file3,$remarks,$report_date,$create_user_id,$create_date,$sending_states,$report_states,$total_complete,$IsTBapproval,$Aproval_Date,$award_sum);
			if($result==true)
			{	
				
			$max = ProjectsProgress :: GetMaxID();
			foreach ($max as $rowmax) {				
				$val = $rowmax[0];			 
			}    
						
			
				$billresult = ProjectsProgress :: saveBillDetails($val);
				if($result==true)
				{
					header("Location:../projects.php?msg=7");	
				}
				
				if($result==false)
				{
				header("Location:../add_progress_report.php?msg=8");	
				}
			}
			elseif($result==false)
			{
				header("Location:../add_progress_report.php?msg=8");	
			}
	break;
	
	
	
	case 'tempsave':
	
	
	$description		=	isset( $_POST['description'])?$_POST['description']:$description;
	$amount				=	isset( $_POST['amount'])?$_POST['amount']:$amount;
	
	$rowid				=	isset( $_GET['rid'])?$_GET['rid']:$rowid;
	
	
	
	
	if($rowid=="")	
	{	
		
		$result = ProjectsProgress :: TemporysaveBillDetails($description,$amount);
			if($result==true)
			{				
				header("Location:../BillsDetails.php?id=id");	
			}
			elseif($result==false)
			{
				header("Location:../BillsDetails.php?id=id");	
			}
	}
	
	else
	{
		
		$result = ProjectsProgress :: TemporyUpdateBillDetails($rowid,$description,$amount);
			if($result==true)
			{				
				header("Location:../BillsDetails.php?id=id");	
			}
			elseif($result==false)
			{
				header("Location:../BillsDetails.php?id=id");	
			}
	}
	break;
	
	
	
	case 'delete':
		$project_rep_id	 	=	isset( $_GET['projrepid'])?$_GET['projrepid']:$project_rep_id;
		$project_id		 	=	isset( $_GET['proID'])?$_GET['proID']:$project_id;
		
		$resultdelete = ProjectsProgress :: DeleteProjectReport($project_rep_id);
		if($resultdelete==true)
		  {
			  header("Location:../project_reports.php?msg=9&projectID=".$project_id);	
		  }
		  elseif($resultdelete==false)
		  {
			  header("Location:../project_reports.php?msg=10&projectID=".$project_id);	
		  }
	
	break;
	
	case 'send':
		$project_rep_id	 	=	isset( $_GET['projrepid'])?$_GET['projrepid']:$project_rep_id;
		$project_id		 	=	isset( $_GET['proID'])?$_GET['proID']:$project_id;
		$user_id		 	=	isset( $_GET['UID'])?$_GET['UID']:$user_id;
		
		$resultcheck = ProjectsProgress :: CheckIsPrivilege($user_id);
		$val="";
		foreach ($resultcheck as $row) {
			
				$val=$row[0];
			}
				if($val==1)
				{
					$resultdelete = ProjectsProgress :: UpdateStatusProjectReport($project_rep_id);
					if($resultdelete==true)
					  {
						  header("Location:../project_reports.php?msg=11&projectID=".$project_id);	
					  }
					  elseif($resultdelete==false)
					  {
						  header("Location:../project_reports.php?msg=12&projectID=".$project_id);	
					  }
				}
				
				else 
				{
					 header("Location:../project_reports.php?msg=15&projectID=".$project_id);	
					
				}
				
				
				
				
			
			break;
			
		case 'edit':
		
		$ptype					=isset( $_GET['ptype'])?$_GET['ptype']:$ptype;
	
		$proj_pro_report_id		=isset( $_GET['proj_pro_report_id'])?$_GET['proj_pro_report_id']:$proj_pro_report_id;
		$report_date			= isset( $_POST['txt_as_at_date'])?$_POST['txt_as_at_date']:$report_date;
		$proj_id				=isset( $_POST['txtprojid'])?$_POST['txtprojid']:$proj_id;
		
		
		if($ptype==2){
		$allocated_ammount_year = isset( $_POST['cmb_allocated_year'])?$_POST['cmb_allocated_year']:$allocated_ammount_year;
		$allocated_ammount 		= isset( $_POST['txtallocatedamount'])?$_POST['txtallocatedamount']:$allocated_ammount;
		$paid_year 				= isset( $_POST['cmb_amount_paid_in'])?$_POST['cmb_amount_paid_in']:$paid_year;
		$paid_amount 			= isset( $_POST['txtamountpaid'])?$_POST['txtamountpaid']:$paid_amount;
		$Award_sum 				= isset( $_POST['txtawardsum'])?$_POST['txtawardsum']:$Award_sum;
		}
		else 		
		{
			$IsTBapproval 			= isset( $_POST['txttbapproval'])?$_POST['txttbapproval']:$IsTBapproval;
			$Aproval_Date 			= isset( $_POST['txtdateoftbaproval'])?$_POST['txtdateoftbaproval']:$Aproval_Date;
		}
		
		
		$completing_state_as_percentage = isset( $_POST['cmb_percentage'])?$_POST['cmb_percentage']:$completing_state_as_percentage;
		$remarks				= isset( $_POST['txaremarks'])?$_POST['txaremarks']:$remarks;
		$report_file			= isset( $_POST['upfile'])?$_POST['upfile']:$report_file;	
		$report_file1			= isset( $_POST['upfile1'])?$_POST['upfile1']:$report_file1;	
		$report_file2			= isset( $_POST['upfile2'])?$_POST['upfile2']:$report_file2;	
		$report_file3			= isset( $_POST['upfile3'])?$_POST['upfile3']:$report_file3;
		
		$hdn_updoc 				= isset ($_POST['$up_file'])?$_POST['$up_file']:$hdn_updoc;
		$hdn_updoc1 			= isset ($_POST['$up_file1'])?$_POST['$up_file1']:$hdn_updoc1;
		$hdn_updoc2 			= isset ($_POST['$up_file2'])?$_POST['$up_file2']:$hdn_updoc2;
		$hdn_updoc3 			= isset ($_POST['$up_file3'])?$_POST['$up_file3']:$hdn_updoc3;
		
		
		$modified_user_id		= isset( $_SESSION['userID'])?$_SESSION['userID']:$create_user_id;
		$modified_date			= date('Y-m_d');
		
		
		if($completing_state_as_percentage=='100'){
			$total_complete=1;
		}
		else{
		$total_complete=0;
		}
		
		
		
		if($_FILES['upfile']['name'] !=""){
		//Upload image file
		$up_file =isset($_FILES['upfile']['name']) && $_FILES['upfile']['name']!="" ? $_FILES['upfile']['name'] : '';
move_uploaded_file ($_FILES['upfile']['tmp_name'],"../uploads/".$_FILES['upfile']['name']);	
		}
		else{
			$up_file =  $hdn_updoc;
		}
		
		
			
		if($_FILES['upfile1']['name'] !=""){
		//Upload image file
		$up_file1 =isset($_FILES['upfile1']['name']) && $_FILES['upfile1']['name']!="" ? $_FILES['upfile1']['name'] : '';
move_uploaded_file ($_FILES['upfile1']['tmp_name'],"../uploads/".$_FILES['upfile1']['name']);	
		}
		else{
			$up_file1 =  $hdn_updoc1;
		}
		
			
		if($_FILES['upfile2']['name'] !=""){
		//Upload image file
		$up_file2 =isset($_FILES['upfile2']['name']) && $_FILES['upfile2']['name']!="" ? $_FILES['upfile2']['name'] : '';
move_uploaded_file ($_FILES['upfile2']['tmp_name'],"../uploads/".$_FILES['upfile2']['name']);	
		}
		else{
			$up_file2 =  $hdn_updoc2;
		}
		
		if($_FILES['upfile3']['name'] !=""){
		//Upload image file
		$up_file3 =isset($_FILES['upfile3']['name']) && $_FILES['upfile3']['name']!="" ? $_FILES['upfile3']['name'] : '';
move_uploaded_file ($_FILES['upfile3']['tmp_name'],"../uploads/".$_FILES['upfile3']['name']);	
		}
		else{
			$up_file3 =  $hdn_updoc3;
		}
		
		
		
		$DeleteBillresult = ProjectsProgress :: DeleteToEditBillDetails($proj_pro_report_id);	
		
		
		$result = ProjectsProgress ::  editProjectProgressreport($proj_pro_report_id,$report_date,$allocated_ammount_year,$allocated_ammount,$paid_year,$paid_amount,$completing_state_as_percentage,$remarks,$up_file,$up_file1,$up_file2,$up_file3,$modified_user_id,$modified_date,$total_complete,$proj_id,$IsTBapproval,$Aproval_Date,$Award_sum);
			if($result==true)
			{				
				header("Location:../project_reports.php?msg=3&projectID=".$proj_id."&ptype=".$ptype);	
				
			}
			elseif($result==false)
			{
				header("Location:../edit_project_progress.php?msg=4&progress_id=".$proj_pro_report_id);	
			}
	break;
	




case 'deletetempbills':
	
	
	$id		=	isset( $_GET['id'])?$_GET['id']:$id;
	
		$result = ProjectsProgress :: DeleteTempBillsDetails($id);
			if($result==true)
			{				
				header("Location:../BillsDetails.php?id=id");	
			}
			elseif($result==false)
			{
				header("Location:../BillsDetails.php?id=id");	
			}
	break;
}
?>
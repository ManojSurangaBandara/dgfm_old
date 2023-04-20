<?php 
require_once('../includes/config.php');
require_once('../classes/db_con.php');
require_once('../classes/vote.class.php');

$mode	=	isset( $_GET['mode'] )?$_GET['mode']:'';
$mode	=	isset( $_POST['mode'])?$_POST['mode']:$mode;
$sfhq_id 	= $_SESSION['sfhqID'];
$user_id 	= $_SESSION['userID'];
$today 		= 	date('Y-m-d'); 
switch($mode)
{
	case 'save':
	 	
		
		$vote_number	=	isset( $_POST['vote_no'])?$_POST['vote_no']:$vote_no;
		$description 	= 	isset( $_POST['txtdescription'])?$_POST['txtdescription']:$description;
		$vttype 		= 	isset( $_POST['vttype'])?$_POST['vttype']:$vttype;		
		
		
				$result = Vote :: SaveVote($vote_number,$description,$vttype,$user_id,$today);
				if($result==true)
				{
					header("Location:../votes.php?msg=1");	
				}
				elseif($result==false)
				{
					header("Location:../new_vote.php?msg=2");	
				}
			
	break;
	
		case 'assignvote':
	 	
			
		$opcon_id		=	isset( $_POST['opcon_id'])?$_POST['opcon_id']:$opcon_id;
		$vote_number	=	isset( $_POST['vote_id1'])?$_POST['vote_id1']:$vote_id1;
		
		
				$result = Vote :: SaveAssignVote($opcon_id,$vote_number,$user_id,$today);
				if($result==true)
				{
					header("Location:../AssignVotestoOpsCon.php?msg=7");	
				}
				elseif($result==false)
				{
					header("Location:../AssignVotestoOpsCon.php?msg=8");	
				}
			
	break;
	
	
	
	
	
		
			case 'edit':
			
			$vote_id		=	isset( $_POST['vote_id'])?$_POST['vote_id']:$vote_id;
			$vote_number	=	isset( $_POST['vote_number'])?$_POST['vote_number']:$vote_number;
			$description 	= 	isset( $_POST['txtdescription'])?$_POST['txtdescription']:$description;
			$vttype 		= 	isset( $_POST['vttype'])?$_POST['vttype']:$vttype;

				$result= Vote ::Vote_Update($vote_number,$description,$vttype,$vote_id,$user_id,$today);
				if($result==true)
				{
					
					header("Location:../votes.php?msg=3");	
				}
				elseif($result==false)
				{
					header("Location:../new_vote.php?msg=4");	
				}
			
		
	break;
	
	case 'savesup':
	
		$mobile			=   isset( $_POST['mobile'])?$_POST['mobile']:$mobile;
		$contactNo 		= 	isset( $_POST['contactNo'])?$_POST['contactNo']:$contactNo;
	
	
		$isveh 	= 	isset( $_POST['isveh'])?$_POST['isveh']:$isveh;
				
		if($isveh==1){
			
			$pro 		= 	isset( $_POST['pro'])?$_POST['pro']:$pro;
			$engnum 	= 	isset( $_POST['engnum'])?$_POST['engnum']:$engnum;
			$veh_number = 	isset( $_POST['veh_number'])?$_POST['veh_number']:$veh_number;
			$nic 		= 	isset( $_POST['nic'])?$_POST['nic']:$nic;
            $vrp 		= 	isset( $_POST['vrp'])?$_POST['vrp']:0;
			
			$fin_vehno = $pro." ".$engnum." ".$veh_number;
			
		
		} else if($isveh==0){
			
			$res = Vote :: GetMaxsupid();				
			$ro=$res[0];
			
			$fin_vehno=$ro[0]+1;
			$vrp=0;
		}
		
		
		//echo $fin_vehno; die();
		
		
		
		$description 	= 	isset( $_POST['txtdescription'])?$_POST['txtdescription']:$description;
		$sfhq_id 		= $_SESSION['sfhqID'];
		$bank_id 		= 	isset( $_POST['bank_id'])?$_POST['bank_id']:$bank_id;
		$txtacctNo 		= 	isset( $_POST['txtacctNo'])?$_POST['txtacctNo']:$txtacctNo;
		$bnk_branch_id 	= 	isset( $_POST['bnk_branch_id'])?$_POST['bnk_branch_id']:$bnk_branch_id;
		$vatNo 			= 	isset( $_POST['vatNo'])?$_POST['vatNo']:$vatNo;		
		$email 			= 	isset( $_POST['email'])?$_POST['email']:$email;		
		$line1 			= 	isset( $_POST['line1'])?$_POST['line1']:$line1;
		$line2 			= 	isset( $_POST['line2'])?$_POST['line2']:$line2;
		$line3			= 	isset( $_POST['line3'])?$_POST['line3']:$line3;
		$line4 			= 	isset( $_POST['line4'])?$_POST['line4']:$line4;
		
		//echo  "55"." ".$vrp; die();
		
		//$result = Vote::GetMaxsupid();				
	//	$row=$result[0];

		
		//$user_id 	= $_SESSION['userID'];
	//	$today 		= 	date('Y-m-d'); 
		
		
		$result = Vote :: SaveSupplier($description,$sfhq_id,$bank_id ,$txtacctNo,$bnk_branch_id,$vatNo,$line1,$line2,$line3,$line4,$contactNo,$email,$user_id,$today,$fin_vehno,$isveh,$mobile,$nic,$vrp);
				if($result==true)
				{
					header("Location:../New_Supplier.php?msg=1");	
					//header("Location:../New_Supplier.php?msg=11");	
					
					
				}
				elseif($result==false)
				{
					//echo "1235465456";
					header("Location:../New_Supplier.php?msg=2");	
				}
			
	break;
	
			case 'editsup':
			
			$sup_id			=	isset( $_GET['sup_id'])?$_GET['sup_id']:$sup_id;
			$Sup_number		=	isset( $_POST['vote_number'])?$_POST['vote_number']:$Sup_number;
			$description 	= 	isset( $_POST['txtdescription'])?$_POST['txtdescription']:$description;
			
			$vehno 			= 	isset( $_POST['vehno'])?$_POST['vehno']:$vehno;
			$vrp 			= 	isset( $_POST['vrp'])?$_POST['vrp']:0;
			

			$bank_id 		= 	isset( $_POST['bank_id'])?$_POST['bank_id']:$bank_id;
			$txtacctNo 		= 	isset( $_POST['txtacctNo'])?$_POST['txtacctNo']:$txtacctNo;
			$bnk_branch_id 	= 	isset( $_POST['bnk_branch_id'])?$_POST['bnk_branch_id']:$bnk_branch_id;
			$vatNo 			= 	isset( $_POST['vatNo'])?$_POST['vatNo']:$vatNo;
			
			$email 			= 	isset( $_POST['email'])?$_POST['email']:$email;
			$mobile 		= 	isset( $_POST['mobile'])?$_POST['mobile']:$mobile;
			$nic 			= 	isset( $_POST['nic'])?$_POST['nic']:$nic;
			
			$contactNo 		= 	isset( $_POST['contactNo'])?$_POST['contactNo']:$contactNo;
			$line1 			= 	isset( $_POST['line1'])?$_POST['line1']:$line1;
			$line2 			= 	isset( $_POST['line2'])?$_POST['line2']:$line2;
			$line3			= 	isset( $_POST['line3'])?$_POST['line3']:$line3;
			$line4 			= 	isset( $_POST['line4'])?$_POST['line4']:$line4;
			
			
			$user_id 	= $_SESSION['userID'];
			$today 		= 	date('Y-m-d'); 


		$result= Vote ::Supplier_Update($Sup_number, $description, $sup_id,$bank_id ,$txtacctNo
		,$bnk_branch_id,$vatNo,$contactNo,$line1,$line2,$line3,$line4,$user_id,$today,$mobile,$nic,$email,$vehno,$vrp);
				if($result==true)
				{
					
					header("Location:../Suppliers.php?msg=7");	
				}
				elseif($result==false)
				{
					header("Location:../EditSupplier.php?msg=8");	
				}
			
		
	break;
	
	
	case 'delete':
	
		$vote_id	 	=	isset( $_GET['vote_id'])?$_GET['vote_id']:$vote_id;		
		
		
		if(Vote::Vote_Cant_Delete($vote_id))
		{
			$resultdelete = false; //should not delete if entries exist
		}else{
			$resultdelete = Vote :: Vote_Delete($vote_id);
		}

		if($resultdelete==true)
		  {
			  header("Location:../votes.php?msg=5");	
		  }
		elseif($resultdelete==false)
		  {
			  header("Location:../votes.php?msg=6");	
		  }
	
	break;
	
		case 'deleteSup':

		$sup_id	 	=	isset( $_GET['sup_id'])?$_GET['sup_id']:$sup_id;		
				
		if(Vote::Suppplier_Cant_Delete($sup_id)) //check if entries exist in other tables for this vote id
		{
			$resultdelete = false; //should not delete if entries exist
		}else{ //delete supplier if no entries
			$resultdelete = Vote :: Suppplier_Delete($sup_id);
		}

		if($resultdelete==true)
		  {
			  header("Location:../Suppliers.php?msg=9");	
		  }
		  elseif($resultdelete==false)
		  {
			  header("Location:../Suppliers.php?msg=10");	
		  }
	
	break;
	
	
}

?>
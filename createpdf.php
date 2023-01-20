<?php
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/projects.class.php');
require('fpdf16/fpdf.php');


$user_id 	= $_SESSION['userID'];
$unit_id 	= $_SESSION['unitID'];
$projType   = isset( $_GET['projType'])?$_GET['projType']:0;
				
$sfhq_id = $_SESSION['sfhqID'];
$branch_id = $_SESSION['branchID'];

class PDF extends FPDF
{
//Page header
function Header()
{
    //Logo
    //$this->Image('images/bg-header.gif',11,8,33);
    //Arial bold 15
    $this->SetFont('Arial','B',12);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(30,2,' Directorate of Finance ',0,0,'C');
    //Line break
    $this->Ln(15);
}

//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

function ImprovedTable($header,$data)
{
    //Column widths
     $w=array(20,80,20);
    //Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],5,$header[$i],1,0,'C');
    $this->Ln();
    //Data
	
	$today = date("Y-m-d");	
	$user_type_id 	= $_SESSION['userType'];
	$dte				=	isset( $_POST['cmbproject'])?$_POST['cmbproject']:$dte;
	$status				=	isset( $_POST['esr_unit'])?$_POST['esr_unit']:$status;
	$todate			    = 	isset( $_POST['txt_to_date'])?$_POST['txt_to_date']:$todate;
	$txt_as_at_date 	=	isset( $_POST['txt_as_at_date'])?$_POST['txt_as_at_date']:$today;
	
	$result2 = Projects ::Get_Branch_Id($dte);
	
    foreach ($result2 as $row) 
	{
    	$dte_id = $row['branch_id'];
		
    }

	if($dte_id ==6){
	$result = Projects ::Genarate_Daily_Bill_Summary_All_Branch($status,$todate,$txt_as_at_date,$user_type_id );
	}
	else{
	$result = Projects ::Genarate_Daily_Bill_Summary($dte_id,$status,$todate,$txt_as_at_date,$user_type_id );
	}
	
    foreach ($result as $rowm) 
	{
				
       	$this->SetFont('Times','',6);
		$this->Cell($w[0],4,$rowm[0],'LR');
        $this->Cell($w[1],4,$rowm[1],'LR');
        $this->Cell($w[2],4,number_format($rowm[2],'2','.',','),'LR',0,'R');   
        //$this->Cell($w[3],4,$rowm[3],'LR',0,'R');
		$this->Ln();
    }
    //Closure line
    $this->Cell(array_sum($w),0,'','T');
}

}
//Instanciation of inherited class
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);



$pdf->Ln();
$pdf->SetFont('Times','B',8);
$header=array('Voucher No','Supplier Name','Amount (LKR)');
//$billdata =  Projects :: GetAllBillsDGFM($unit_id,$projType,$txt,$user_id,$sfhq_id,$branch_id);
$pdf->ImprovedTable($header,$retfamilymem);
//$pdf->AddPage();
$pdf->Ln(5);

$pdf->Output();
?>
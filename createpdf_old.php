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
    $this->Image('images/engineers copy1.jpg',10,8,33);
    //Arial bold 15
    $this->SetFont('Arial','B',8);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(30,2,'Sri Lanka Army ',0,0,'C');
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
    $w=array(5,40,5,8,15,30,20);
    //Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],5,$header[$i],1,0,'C');
    $this->Ln();
    //Data
    foreach ($data as $rowm) 
	{
        $this->SetFont('Times','',6);
		$this->Cell($w[0],4,$rowm[0],'LR');
        $this->Cell($w[1],4,$rowm[1],'LR');
        $this->Cell($w[2],4,$rowm[2],'LR',0,'R');
        $this->Cell($w[3],4,$rowm[3],'LR',0,'R');
		$this->Cell($w[4],4,$rowm[4],'LR',0,'R');
		$this->Cell($w[5],4,$rowm[5],'LR',0,'R');
		$this->Cell($w[6],4,$rowm[6],'LR',0,'R');
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
$pdf->SetFont('Times','B',6);
$header=array('No','Bill Number','Bill Name','	Amount Rs :','Recieved Unit','Recieved Date','Status');
$billdata =  Projects :: GetAllBillsDGFM($unit_id,$projType,$txt,$user_id,$sfhq_id,$branch_id);
$pdf->ImprovedTable($header,$retfamilymem);
$pdf->AddPage();
$pdf->Ln(5);

$pdf->Output();
?>
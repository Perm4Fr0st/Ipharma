<?php
//error_reporting(E_ERROR);
include("connect.php");
require('fpdf/fpdf.php');


$pdf = new FPDF('L','mm','Legal');
$pdf->AddPage();

$pdf->SetFont('Arial','B',13);
$pdf->Ln();


$pdf->Cell(70,10,"Company Name",1,0,'C');
$pdf->Cell(80,10,"Company Address",1,0,'C');
$pdf->Cell(50,10,"Contact Person",1,0,'C');
$pdf->Cell(50,10,"Contact Details",1,0,'C');
$pdf->Cell(50,10,"Note",1,0,'C');
$pdf->SetFont('Arial','',11);
$a=80;
$result=$conn->query("select *from company");
while($row=$result->fetch_assoc()){

    $pdf->Ln();
    $pdf->Cell(70,10,$row["comname"],1,0,'L');
    $pdf->Cell(80,10,$row["comadd"],1,0,'L');
    $pdf->Cell(80,10,$row["conper"],1,0,'C');
    $pdf->Cell(80,10,$row["condet"],1,0,'C');
    $pdf->Cell(80,10,$row["note"],1,0,'C');

}
$pdf->Output();
?>
<?php
//error_reporting(E_ERROR);
include("connect.php");
require('fpdf/fpdf.php');



$pdf = new FPDF('L','mm','Legal');
$pdf->AddPage();

$pdf->SetFont('Arial','B',13);
$pdf->Ln();

$pdf->Cell(200,10,"Receipt",1,0,'C');
$pdf->Ln();
$pdf->Cell(50,10,"Product Name",1,0,'C');
$pdf->Cell(50,10,"Quantity",1,0,'C');
$pdf->Cell(30,10,"Date",1,0,'C');
$pdf->Cell(30,10,"Price",1,0,'C');
$pdf->Cell(40,10,"Cashier Name",1,0,'C');
$pdf->SetFont('Arial','',11);

$result=$conn->query("select * from salestoday");
while($row=$result->fetch_assoc()){
    $pdf->Ln();
    $pdf->Cell(50,10,$row["code"],1,0,'C');
    $pdf->Cell(50,10,$row["qty"],1,0,'C');
    $pdf->Cell(30,10,$row["date1"],1,0,'C');
    $pdf->Cell(30,10,$row["price"],1,0,'C');
    $pdf->Cell(40,10,$row["cashname"],1,0,'C');


}
$pdf->Output();
?>
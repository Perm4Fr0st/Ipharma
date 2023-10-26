<?php
//error_reporting(E_ERROR);
include("connect.php");
require('fpdf/fpdf.php');

$date=$_GET["txtdate"];
$date1=$_GET["txtdate1"];
$branch=$_GET["txtbranch"];
$type="Phyisical Inventory";

$pdf = new FPDF('L','mm','Legal');
$pdf->AddPage();

$pdf->SetFont('Arial','B',13);
$pdf->Ln();
$pdf->Cell(335,10,"Physical Inventory History",0,0,'C');
$pdf->Ln();
$pdf->Cell(335,10,"$date   from   $date1",0,0,'C');
$pdf->Ln();
$pdf->Cell(112,10,"Product",1,0,'C');
$pdf->Cell(112,10,"Description",1,0,'C');
$pdf->Cell(111,10,"Total",1,0,'C');
$pdf->SetFont('Arial','',11);

$result=$conn->query("select distinct(prodhis.date1) as date,prodhis.code as code,prodhis.bal as bal,product.flddesc as flddesc
from prodhis,product where prodhis.code=product.code and
type1 like '$type' and prodhis.bid like '$branch' and date1 between '$date' and '$date1'");
while($row=$result->fetch_assoc()){
    $pdf->Ln();
    $pdf->Cell(112,10,$row["code"],1,0,'C');
    $pdf->Cell(112,10,$row["flddesc"],1,0,'C');
    $pdf->Cell(111,10,$row["bal"],1,0,'C');


}
$pdf->Output();
?>
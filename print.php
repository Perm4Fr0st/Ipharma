<?php
//error_reporting(E_ERROR);
include("connect.php");
require('fpdf/fpdf.php');

$myname="";
$result=$conn->query("select code from product ");
while($row=$result->fetch_assoc()){
    $myname=$row["code"];
}

$pdf = new FPDF('L','mm','Legal');
$pdf->AddPage();

$pdf->SetFont('Arial','B',13);
$pdf->Ln();

$pdf->Cell(310,10,"Product",1,0,'C');
$pdf->Ln();
$pdf->Cell(50,10,"Product Name",1,0,'C');
$pdf->Cell(50,10,"Product Description",1,0,'C');
$pdf->Cell(30,10,"Type",1,0,'C');
$pdf->Cell(30,10,"Capital",1,0,'C');
$pdf->Cell(30,10,"Interest",1,0,'C');
$pdf->Cell(30,10,"Status",1,0,'C');
$pdf->Cell(30,10,"Price",1,0,'C');
$pdf->Cell(30,10,"Stocks",1,0,'C');
$pdf->Cell(30,10,"Branch",1,0,'C');
$pdf->SetFont('Arial','',11);

$result=$conn->query("select product.code,product.flddesc,product.type,product.capital,product.interest,product.status,product.price,stocks.pid,stocks.bid,stocks.stocks
                        from product,stocks
                        where product.code=stocks.pid and product.id=stocks.id
                        order by product.code,stocks.bid");
while($row=$result->fetch_assoc()){
    $pdf->Ln();
    $pdf->Cell(50,10,$row["code"],1,0,'L');
    $pdf->Cell(50,10,$row["flddesc"],1,0,'C');
    $pdf->Cell(30,10,$row["type"],1,0,'C');
    $pdf->Cell(30,10,$row["capital"],1,0,'C');
    $pdf->Cell(30,10,$row["interest"],1,0,'C');
    $pdf->Cell(30,10,$row["status"],1,0,'C');
    $pdf->Cell(30,10,$row["price"],1,0,'C');
    $pdf->Cell(30,10,$row["stocks"],1,0,'R');
    $pdf->Cell(30,10,$row["bid"],1,0,'R');

}
$pdf->Output();
?>
<?php
/**
 * Created by PhpStorm.
 * User: rahilasule
 * Date: 4/21/16
 * Time: 3:11 AM
 */

require 'fpdf.php';
$mysqli = mysqli_connect('localhost' , 'root', '','shoedb');

$total = 0;
$total_qty = 0;
$subtotal = 0;

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Courier','b', 14);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(80, 20, 'Report for today');
$pdf->Ln();

$pdf->Cell(60, 5, 'Product', 1, 0, 'C', 0);
$pdf->Cell(40, 5, 'Quantity', 1, 0, 'C', 0);
$pdf->Cell(60, 5, 'Price', 1, 0, 'C', 0);

$pdf->Ln(5);



$str_query="SELECT s.shoename, qty, s.price FROM items i
INNER JOIN orders o ON i.orderid = o.orderid
INNER JOIN shoes s ON i.shoeid = s.shoeid
WHERE o.date=DATE(CURDATE())";
$st= mysqli_query($mysqli, $str_query);
$count = mysqli_num_rows($st);

while($row = mysqli_fetch_row($st)) {
//echo var_dump($row);


    $pdf->Cell(60, 6, $row[0], 1, 0, 'C', 0);
    $pdf->Cell(40, 6, $row[1], 1, 0, 'C', 0);
    $pdf->Cell(60, 6, $row[2], 1, 0, 'C', 0);

    $subtotal = $row[2] * $row[1];
    $total_qty += $row[1];
    $total += $subtotal;
    $pdf->Ln(5);
//}
}

$pdf->Cell(50, 20, 'Total Quantity: ');
$pdf->Cell(120, 20, $total_qty);
$pdf->Ln(5);
$pdf->Cell(40, 20, 'Total Sales: ');
$pdf->Cell(120, 20, $total);

$pdf->Output();
    




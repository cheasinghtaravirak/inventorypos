<?php
//call the fpdf library 
require('fpdf/fpdf.php'); 

include_once'connectdb.php';

$id = $_GET['id']; 

$select = $pdo->prepare("select * from tbl_invoice where invoice_id = $id");
$select->execute(); 
$row = $select->fetch(PDO::FETCH_OBJ); 

//A4 width: 219mm 
//default margin: 10mm each side 
//writable horizontal: 219 - (10 * 2) = 199 mm 

//create pdf object 
$pdf = new FPDF('P', 'mm', 'A4'); 

//String orientation (P or L) - portrait or landscape 
//String unit (pt, mm, cm, in) - measure unit 
//Mixed format (A3, A4, A5, Letter and Legal) - format of pages 


//add new pages 
$pdf->AddPage(); 
//$pdf->SetFillColor(123, 255, 234); 
$pdf->SetFont('Arial', 'B', 16); 
//Cell(width, height, text, border, end line, align);
//align: 0->right, 1->next line, 2->below 
$pdf->Cell(80, 10, 'CYBARG Inc.', 0, 0, ''); //to right

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(112, 10, 'INVOICE', 0, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(80, 5, 'Address: Progress way, New York - USA', 0, 0, '');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(112, 5, 'Invoice: '.$row->invoice_id, 0, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(80, 5, 'Phone Number: (+855)11-725-322', 0, 0, '');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(112, 5, 'Date: '.$row->order_date, 0, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(80, 5, 'Email Adress: singhtaravirak@gmail.com', 0, 1, '');
$pdf->Cell(80, 5, 'Website: www.cybarg.com', 0, 1, '');

//Line(x1, y1, x2, y2) 
$pdf->Line(5, 45, 205, 45);
$pdf->Line(5, 46, 205, 46);

$pdf->Ln(10); //new line 

$pdf->SetFont('Arial', 'BI', 12);
$pdf->Cell(20, 10, 'Bill To: ', 0, 0, '');

$pdf->SetFont('Courier', 'BI', 14);
$pdf->Cell(50, 10, $row->customer_name, 0, 1, '');

$pdf->Cell(50, 5, '', 0, 1, ''); //for vertical space 

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(208, 208, 208);
$pdf->Cell(100, 8, 'PRODUCT', 1, 0, 'C', true); //total width = 190 
$pdf->Cell(20, 8, 'QTY', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'PRICE', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'TOTAL', 1, 1, 'C', true);

$select = $pdo->prepare("select * from tbl_invoice_details where invoice_id = $id");
$select->execute();  
while($item = $select->fetch(PDO::FETCH_OBJ)) {
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(100, 8, $item->product_name, 1, 0, 'L'); 
    $pdf->Cell(20, 8, $item->qty, 1, 0, 'C');
    $pdf->Cell(30, 8, $item->price, 1, 0, 'C');
    $pdf->Cell(40, 8, $item->qty * $item->price, 1, 1, 'C');
}


//Subtotal
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, '', 0, 0, 'L'); 
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Subtotal', 1, 0, 'C', true);
$pdf->Cell(40, 8, $row->subtotal, 1, 1, 'C');

//Tax
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, '', 0, 0, 'L');  
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Tax', 1, 0, 'C', true);
$pdf->Cell(40, 8, $row->tax, 1, 1, 'C');

//Discount
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, '', 0, 0, 'L'); 
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Discount', 1, 0, 'C', true);
$pdf->Cell(40, 8, $row->discount, 1, 1, 'C');

//Grand Total 
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(100, 8, '', 0, 0, 'L'); 
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Grand Total', 1, 0, 'C', true);
$pdf->Cell(40, 8, '$'.$row->total, 1, 1, 'C');

//Paid
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, '', 0, 0, 'L'); 
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Paid', 1, 0, 'C', true);
$pdf->Cell(40, 8, $row->paid, 1, 1, 'C');

//Payment Type
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(100, 8, '', 0, 0, 'L');  
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Payment Type', 1, 0, 'C', true);
$pdf->Cell(40, 8, $row->payment_type, 1, 1, 'C');

$pdf->Cell(50, 10, '', 0, 1, ''); //for vertical space

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(32, 10, 'Important Notice:', 0, 0, '', true);

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(148, 10, "No item will be replaced or refunded if you don't have the invoice with you. You can refund within 2 days of purchase.", 0, 0, '');

//output the result
$pdf->Output(); 

?>









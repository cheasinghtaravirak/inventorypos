<?php
include_once'connectdb.php'; 

$id = $_POST['pidd']; //from productlist.php ajax

//DELETE T1, T2 FROM T1 INNER JOIN T2 ON T1.key = T2.key WHERE condition T1.key = id; 

$sql = "delete tbl_invoice, tbl_invoice_details FROM tbl_invoice INNER JOIN tbl_invoice_details ON tbl_invoice.invoice_id = tbl_invoice_details.invoice_id WHERE tbl_invoice.invoice_id = $id"; 

$delete = $pdo->prepare($sql); 
if($delete->execute()) {
    
} else {
    echo 'Error in deleting'; 
}


?>
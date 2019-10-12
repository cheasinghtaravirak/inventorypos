<?php
include_once'connectdb.php'; 

$id = $_GET["id"]; 

$select = $pdo->prepare("select * from tbl_product where pid=:ppid");
$select->bindParam(":ppid", $id); 
$select->execute(); 

$row=$select->fetch(PDO::FETCH_ASSOC);

$response=$row; 
header('Content-Type: application/json'); //telling header to use json data

echo json_encode($response); 

?>
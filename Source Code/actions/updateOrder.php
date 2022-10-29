<?php
include './include/showErrors.php';
include './dbConnection.php';

$status="";
$orderId="";

if(isset($_POST['orderstatus'])){$status = $_POST['orderstatus'];}
if(isset($_POST['orderId'])){$orderId = $_POST['orderId'];}

$Query= "update invoice set status='".$status."' WHERE id_invoice='".$orderId."'";

$result = $conn->query($Query);

if($result===TRUE){  
    header("Location: ../orders.php?msg1=Product update Success !");die();
}else{
    header("Location: ../orders.php?msg=Product update Error:".mysqli_error($conn));die();
}

?>
<?php
include './include/showErrors.php';
include './dbConnection.php';

$deleteProductId = "";
if(isset($_GET['id'])){$deleteProductId =$_GET['id']; }

//validate


//delete

$delQuery = "delete from products where id_products = ' ".$deleteProductId."'";
$result = $conn->query($delQuery);

if($result===TRUE){  
    header("Location: ../products.php?msg=Product Delete Success !");die();
}else{
    header("Location: ../products.php?msg=Product Delete Error:".mysqli_error($conn));die();
}


<?php
include './include/showErrors.php';
 include './dbConnection.php';
$productName="";
$productDescription="";
$buyPrice ="";
$sellPrice="";
$qty="";
$Category="";
$status=""; 
$productId=""; 

if(isset($_POST['product_name'])){$productName = $_POST['product_name'];}
if(isset($_POST['product_desc'])){$productDescription = $_POST['product_desc'];}
if(isset($_POST['product_buy_price'])){$buyPrice = $_POST['product_buy_price'];}
if(isset($_POST['product_sell_price'])){$sellPrice = $_POST['product_sell_price'];}
if(isset($_POST['qty'])){$qty = $_POST['qty'];}
if(isset($_POST['category'])){$Category = $_POST['category'];}
if(isset($_POST['productstatus'])){$status = $_POST['productstatus'];} 
if(isset($_POST['productId'])){$productId = $_POST['productId'];} 
 
if($productName==""){    header("Location: ../products.php?msg=Product name Required");die();}
if($productDescription==""){    header("Location: ../products.php?msg=Product Description Required");die();}
if($buyPrice==""){    header("Location: ../products.php?msg=Product buy Price Required");die();}
if($sellPrice==""){    header("Location: ../products.php?msg=Product sell Price Required");die();}
if($qty==""){    header("Location: ../products.php?msg=Product Qty Required");die();}
if($Category==""){    header("Location: ../products.php?msg=Product Category Required");die();}
if($status==""){    header("Location: ../products.php?msg=Product Status Required");die();} 

if($productId==""){ header("Location: ../products.php?msg=Product Id Required");die();} 


$Query= "update products set product_name='".$productName."',product_description='".$productDescription."',"
        . "buy_price='".$buyPrice."',sell_price='".$sellPrice."',"
        . "avl_qty='".$qty."',product_category='".$Category."',is_active='".$status."'"
        . " WHERE id_products = '".$productId."' ";
         

$result = $conn->query($Query);

if($result===TRUE){  
    header("Location: ../products.php?msg=Product update Success !");die();
}else{
    header("Location: ../products.php?msg=Product update Error:".mysqli_error($conn));die();
}
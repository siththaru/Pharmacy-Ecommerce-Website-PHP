<?php
include './include/showErrors.php';
session_start();
$productId="";
if(isset($_POST['pid'])){$productId  = $_POST['pid'];}
if(isset($_GET['pid'])){$productId  = $_GET['pid'];}
if($productId==""){header("Location: ./index.php?msg=Wrong Feed Cart page");die();}

$qty="1";
if(isset($_POST['qty'])){$qty  = $_POST['qty'];}
 
//define cart
$cart;
//assign cart

$isInTheCart = FALSE;

if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    
    foreach ($cart as $key => $value){
    if($value[0]==$productId){
        $currentQty = $value[1];
        unset($cart[$key]);
        $cartItem = array($productId,$currentQty+$qty); 
        array_push($cart, $cartItem);
        $isInTheCart = true;
    }
} 
    
}else{
    $cart = array();
}


if(!$isInTheCart){
$cartItem = array($productId,$qty); 
array_push($cart, $cartItem);}


$_SESSION['cart'] = $cart;

header("Location: ../AdvancedSearch.php?msg=Item added to cart");
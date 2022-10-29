<?php
include './include/showErrors.php';
session_start();
include './dbConnection.php';

$pid = "";
$qty = "";
$cart = "";

$user_ID = "";
if (isset($_SESSION['userid'])) {
    $user_ID = $_SESSION['userid'];
}else{
    header("Location:../login.php?msg=Please login or get registered!");die();
}

$is_login = false;
if (isset($_SESSION['is_login'])) {
    $is_login = $_SESSION['is_login'];
}
$last_id_invoice = "";
if (isset($_SESSION['current_invoice_id'])) {
    $last_id_invoice = $_SESSION['current_invoice_id'];
}

//product data
if(isset($_POST['pid'])){$pid = $_POST['pid'];}
if(isset($_POST['qty'])){$qty = $_POST['qty'];}

//cart data
if(isset($_SESSION['cart'])){$cart = $_SESSION['cart'];}

    if($cart=='' && $pid==''){
        header("Location:../AdvancedSearch.php?msg=Products not found !");die();
    }
   

    if($last_id_invoice!=""){
        //remove previous temp carts
        $dropCartQuery = "delete from invoice_items  where id_invoice = '".$last_id_invoice."' ";

$res = $conn->query($dropCartQuery);
    }
       $totalAmu = 0.0; 

  if($last_id_invoice==""){
   $saveInvoice = "insert into "
           . "invoice(invoice_date,total_amount,invoiced_to,invoiced_checkd_by,status)  values"
           . "(now(),'".$totalAmu."','".$user_ID."',null,'2')";

//   echo $saveInvoice;
   $resultx = $conn->query($saveInvoice);
       echo "invoice Saved Successfully !";
     $last_id_invoice = $conn->insert_id;
     $_SESSION["current_invoice_id"] = $last_id_invoice;     
       echo "Invoice ID : ".$last_id_invoice; 
  }

  if($cart==''){

    $querySaveItem = "insert into invoice_items(id_product,id_invoice,line_qty,line_unit_price)"
    . " values('".$pid."', '".$last_id_invoice."', '".$qty."',(select sell_price from products where id_products ='".$pid."' ) )"; 
    $pitem = $conn->query($querySaveItem);
    if($pitem===true){
        echo $pid." saved success";
     }else{
         echo " error".mysqli_error($conn);
         } 

  }else{
       //save all the items !!!
           foreach ($cart as $cartItem){
               $querySaveItem = "insert into invoice_items(id_product,id_invoice,line_qty,line_unit_price)"
              . " values('".$cartItem[0]."', '".$last_id_invoice."', '".$cartItem[1].
                       "',(select sell_price from products where id_products ='".$cartItem[0]."' ) )"; 
              $pitem = $conn->query($querySaveItem);
              if($pitem===true){
                  echo $cartItem[0]." saved success";
               }else{
                   echo "error".mysqli_error($conn);
                   }      
   }
}
   
             $updateInvoiceTotal = "update invoice i set i.total_amount = (select sum(ii.line_unit_price*ii.line_qty) from 
invoice_items ii where ii.id_invoice = i.id_invoice) where i.id_invoice =  '".$last_id_invoice."' ";
   
              if($conn->query($updateInvoiceTotal)===true){
                  echo " invoice total updated successfully !";
               }else{
                   echo "error".mysqli_error($conn);
                   }      
    
               
               //payment Confirmation page
               header("Location: ../paymentConfirmationPage.php");
           
   ?>
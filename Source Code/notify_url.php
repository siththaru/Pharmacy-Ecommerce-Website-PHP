<?php
include './actions/dbConnection.php';
$merchant_id         = $_POST['merchant_id'];
$order_id             = $_POST['order_id'];
$payhere_amount     = $_POST['payhere_amount'];
$payhere_currency    = $_POST['payhere_currency'];
$status_code         = $_POST['status_code'];
$md5sig                = $_POST['md5sig'];

$merchant_secret = 'XXXXXXXXXXXXX'; // Replace with your Merchant Secret (Can be found on your PayHere account's Settings page)

$local_md5sig = strtoupper (md5 ( $merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret)) ) );

if (($local_md5sig === $md5sig) AND ($status_code == 2) ){
        //TODO: Update your database as payment success
   $query = "Update invoice set status = '1' where id_invoice = '".$orderID."'";
         if($conn->query($query)===TRUE){
              echo "<h2>Payment Processed Successfully !</h2>";
              if(isset($_SESSION['cart'])){
                  $_SESSION['cart'] = null;
              $_SESSION['current_invoice_id'] = null;
              }
         }
}else{
    //paym
    
    
}

<?php
include './include/showErrors.php';
session_start();
include './actions/dbConnection.php';
$orderID = ""; 
if(isset($_SESSION['current_invoice_id'])){$orderID  = $_SESSION['current_invoice_id'];}
if($orderID==""){header("Location: ./cart.php?msg=Cart Requre to process payment");die();}

$user_ID = ""; 
if(isset($_SESSION['userid'])){$user_ID  = $_SESSION['userid'];}
if($user_ID==""){header("Location: ./cart.php?msg=Please Login or Register before Continue");die();}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/headerFooter.css" type="text/css" rel="stylesheet" />
        <link href="css/payConfirm.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <?php include './include/header.php'; ?>
        
        <div style="height: 15vh;"></div>

            <div class="c-header">
            <h1>Order Confirmation</h1>
            </div>
            <br>

            
        <form method="post" action="https://sandbox.payhere.lk/pay/checkout">   
                <div class="mainForm">
            
          <input type="hidden" name="merchant_id" value="1216509"> 
          <!-- Replace your Merchant ID -->
          <input type="hidden" name="return_url" value="http://localhost:3000/return.php">
          <input type="hidden" name="cancel_url" value="http://localhost:3000/Medcure/cancel.php">
          <input type="hidden" name="notify_url" value="http://localhost:3000/Medcure/notify_url.php">  
    
          <input type="hidden" name="order_id" value="<?php echo $orderID;?>">  
     
        <div style="overflow-x:auto;">
        <h2>Order Details</h2>
   
    <table class="tb1" border="1">
    <tr>
      <th colspan="2">PRODUCT</th>
      <th>QTY</th>
      <th>PRICE</th>
    </tr>
        <?php
    $paymentItems="";
    $unitPrice="";
    $qty="";
        $items = "select * from invoice_items i join products p on i.id_product = p.id_products "
                . "where i.id_invoice = '".$orderID."'";
        $result = $conn->query($items);
        
        $total=0;
        if($result->num_rows>0){
       while($row = $result->fetch_assoc()){
       ?>
        <?php
        $total = $total + ($row['line_unit_price']*$row['line_qty']);
        $paymentItems = $paymentItems.$row['product_name'].":".$row['line_qty'];
        $unitPrice= $unitPrice.$row['line_unit_price'];
        $qty= $qty.$row['line_qty'];
        ?>
        
    <tr>
      <td><img  src="actions/productImages/<?php echo $row['product_profile_img'];?>" width="70" height="70" /></td>
      <td><?php echo $row['product_name']?></td>
      <td><?php echo $row['line_qty']?></td>
      <td>$<?php echo $row['line_unit_price']?></td>
    </tr>
    
    <?php 
       }
    }?>
    <tr>
      <td colspan="2" style="text-align: end;">Total Amount</td>
      <td colspan="2"><label>$<?php echo $total;?></label><br></td>
    </tr>

    </table>
    </div>

    
    <div style="overflow-x:auto;">
        <h2>Customer Details</h2>
        
        <?php 
            $query2 = "select * from users where id_users = '".$user_ID."'";
            $resultUser = $conn->query($query2);
           $record = $resultUser->fetch_assoc();
           ?>

    <table border="0"> 
            <tr>
                <td>Order Id</td>
                <td>:</td>
                <td><?php echo $orderID;?></td>
            </tr>
            <tr>
                <td>Customer Name</td>
                <td>:</td>
                <td><?php echo $record['fname']." ".$record['lname']?></td>
            </tr>
            <tr>
                <td>Customer Email</td>
                <td>:</td>
                <td><?php echo $record['email']?></td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>:</td>
                <td><?php echo $record['contact_no']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><?php echo $record['address']?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td>:</td>
                <td><?php echo $record['country']?></td>
            </tr>
            
        </table>
    </div>
    
    <input type="hidden" name="items" value="<?php echo $paymentItems;?>"><br> 
    <input type="hidden" name="currency" value="USD">
    <input type="hidden" name="amount"  value="<?php echo $total;?>">          
    <input type="hidden" name="first_name" value="<?php echo $record['fname']?>">
    <input type="hidden" name="last_name" value="<?php echo $record['lname']?>">
    <input type="hidden" name="email" value="<?php echo $record['email']?>">
    <input type="hidden" name="phone" value="<?php echo $record['contact_no']?>">
    <input type="hidden" name="address" value="<?php echo $record['address']?>">
    <input type="hidden" name="city" value="Colombo"><br> 
    <input type="hidden" name="country" value="<?php echo $record['country']?>"><br><br>
</div>
<br><br>
    <input type="submit" value="Confirm Order">
</form>
<br><br>
<?php include './include/footer.php'; ?>

    </body>
</html>

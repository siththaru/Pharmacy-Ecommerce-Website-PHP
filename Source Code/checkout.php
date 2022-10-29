<?php
include './include/showErrors.php';
session_start();
include './actions/dbConnection.php';

$pid = "";
$qty = "";
$cart = "";

if(isset($_POST['pid'])){$pid = $_POST['pid'];}
if(isset($_POST['qty'])){$qty = $_POST['qty'];}
if(isset($_SESSION['cart'])){$cart = $_SESSION['cart'];}

$user_ID = "";
if (isset($_SESSION['userid'])) {
    $user_ID = $_SESSION['userid'];
}

$is_login = false;
if (isset($_SESSION['is_login'])) {
    $is_login = $_SESSION['is_login'];
}

$name = "";
$address = "";
$city = "";
$contactNo = "";
$email = "";
if ($is_login) {
    $query2 = "select * from users where id_users = '" . $user_ID . "'";
    $resultUser = $conn->query($query2);
    $record = $resultUser->fetch_assoc();
    $name = $record['fname']." ".$record['lname'];
    $address = $record['address'];
    $city = $record['city'];
    $contactNo = $record['contact_no'];
    $email = $record['email'];
}else{
    header("Location: login.php?msg=Please login or get registered to proceed!");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Checkout</title>
        <link rel="shortcut icon" href="images/logo_icon.png" />
        <link href="css/headerFooter.css" type="text/css" rel="stylesheet"/>
        <link href="css/checkout.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>

<?php include './include/header.php'; ?>
<div style="height: 15vh;"></div>
        
        <div class="c-header">
            <h1>Checkout</h1>
        </div>
        <br>
        <div class="row">
  <div class="col-75">
    <div class="container">
    <form method="post" action="actions/checkoutAction.php" >
      
        <div class="row">
          <div class="col-50">
            <h3>Billing and Delivery Details</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="name" value="<?php echo $name; ?>">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>">
            <label for="adr"><i class="fas fa-address-card"></i> Address</label>
            <input type="text" id="adr" name="address" value="<?php echo $address; ?>">
            <label for="city"><i class="fas fa-city"></i> City</label>
            <input type="text" id="city" name="city" value="<?php echo $city; ?>">
            <label for="city"><i class="fas fa-phone-alt"></i> Contact Number</label>
            <input type="text" id="phone" name="contactNumber" value="<?php echo $contactNo; ?>">
        </div>
        
        </div>
        <br>
        <input type="hidden" name="pid" value="<?php echo $pid;?>">
        <input type="hidden" name="qty" value="<?php echo $qty;?>">
        <input type="submit" class="btn" value="Update Billing Details" >
      </form>
    </div>
  </div>

  <div class="col-25">
    <div class="container">
      <h4>Your Order <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i></span></h4>
      <?php
        if($cart==''){
                 $totalAmu = 0.0;
                   $productQuery = "select * from products where id_products = '".$pid."' ";
                   $result = $conn->query($productQuery);
                   if($result->num_rows>0){
                       $row = $result->fetch_assoc();
                     $rowamu =  ($row['sell_price']*$qty);
                      $totalAmu = $totalAmu + $rowamu;
                 ?>
      <div class="one-product">
      <div class="pname"><?php echo $row['product_name']?></div>
      <div>x <span><?php echo $qty?></span></div>
      <span class="price"><?php echo "$".$rowamu?></span>
      </div>
      <?php }
      }else{
                  $totalAmu = 0.0;
                     foreach ($cart as $cartItem){
                   $productQuery = "select * from products where id_products = '".$cartItem[0]."' ";
                   $result = $conn->query($productQuery);
                   if($result->num_rows>0){
                       $row = $result->fetch_assoc();
                     $rowamu =  ($row['sell_price']*$cartItem[1]);
                      $totalAmu = $totalAmu + $rowamu;
                 ?>
      <div class="one-product">
      <div class="pname"><?php echo $row['product_name']?></div>
      <div>x<span><?php echo $cartItem[1]?></span></div>
      <span class="price"><?php echo "$".$rowamu?></span>
      </div>
      <?php }}
          }?>
      
      <hr>
      <p>Total <span class="price" style="color:black"><b><?php echo "$".$totalAmu?></b></span></p>
    </div>
  </div>
</div>

<?php include './include/footer.php'; ?>
    </body>
</html>
<?php
include './include/showErrors.php';
session_start();
include './actions/dbConnection.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cart</title>
        <link href="css/headerFooter.css" type="text/css" rel="stylesheet" />
        <link href="css/cart.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <?php include './include/header.php';?>
        <div style="height: 15vh;"></div>
        
        <div align="center">
        <div class="sc-header">
            <h1>Shopping Cart</h1>
        </div>
        <?php if(isset($_GET['msg'])){ ?>
            <p style="color: red;"><?php echo $_GET['msg'];?></p>
            <?php }?>
        <br>
            <table border="1">
            <tr>
                <th colspan="2">Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Remove</th>
            </tr>
                <?php
                  $totalAmu = 0.0;
                  $isProduct = false;
                 if(isset($_SESSION['cart'])){
                     $cart = $_SESSION['cart'];
                     foreach ($cart as $cartItem){
                   $productQuery = "select * from products where id_products = '".$cartItem[0]."' ";
                   $result = $conn->query($productQuery);
                   if($result->num_rows>0){
                       $row = $result->fetch_assoc();
                     $rowamu =  ($row['sell_price']*$cartItem[1]);
                     $totalAmu = $totalAmu + $rowamu;
                     $isProduct = TRUE;
                     ?>
                    <tr>
                        <td><img  src="actions/productImages/<?php echo $row['product_profile_img'];?>" width="90" height="90" /> </td> 
                        <td>
                        <?php echo $row['product_name'];?><br>
                        </td>
                        <td>
                        <?php echo "$".$row['sell_price'];?>
                        </td> 
                        <td><?php echo $cartItem[1];?></td> 
                         <td><?php echo "$".$rowamu;?></td>
                        <td><a href="actions/removeFromCart.php?pid=<?php echo $cartItem[0];?>">
                                <i style="color: red;" class="fas fa-trash-alt"></i></td> 
                    </tr>
                <?php
                   }
                   }} 
                   ?>
            </table>
            <?php
                if(!$isProduct){echo '<h3>Cart Empty</h3>';}
            ?>
            <br>
            <label class="total">Total : <strong><?php echo "$".$totalAmu?></strong></label>
            <br><br>
            <a href="checkout.php"><input class="checkout" type="button" name="Checkout" value="Checkout"></a>
            
        </div>

        <div style="height: 5vh;"></div>
        
        <?php include './include/footer.php';?>
        </body>
</html>

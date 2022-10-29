 <?php
 include './include/showErrors.php';
 include './actions/dbConnection.php';
 $pid = "";
 if(isset($_GET['pid'])){$pid = $_GET['pid'];}
  if($pid==""){ header("Location: AdvancedSearch.php"); die();}
 
 $query = "Select * from products where id_products = '".$pid."'";
 
 $result = $conn->query($query);
 
 $name;$desc;$sellPrice;$proImage;$qty;
 
 if($result->num_rows > 0){
     $row=$result->fetch_assoc();
      $name = $row["product_name"];
      $desc = $row["product_description"];
      $sellPrice = $row["sell_price"];
      $proImage = $row["product_profile_img"];
      $qty = $row["avl_qty"];
 }else{
     header("Location: ./AdvancedSearch.php?msg=Product not Found !");
 }
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Product in Details</title>
        <link href="css/headerFooter.css" type="text/css" rel="stylesheet" />
        <link rel="shortcut icon" href="images/logo_icon.png"/>
        <link rel="stylesheet" type="text/css" href="css/products.css">
    </head>
    <body>
        <?php include './include/header.php'; ?> 
            
        <div style="height: 15vh;"></div>

  <div class="vp-main">
     
      <div class="vp-image">
      <img width="90%" src="actions/productImages/<?php echo $proImage;?>" alt="product_image">
      </div>
      
      <div class="vp-descp">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <span>20 reviews</span>
      <?php
            echo "<h2>".$name."<h2>"; echo "</a>";
            echo "<h5>".$desc."<h5>";
            echo "<h3>Price : $".$sellPrice."<h3>";
            echo "<p>".$qty." items available</p>";
            ?>
            <br>
            
            <form method="post" action="actions/addToCart.php">
            <div class="qty">
              <label>Qty:</label>
              <input type="number" name="qty" value="1" min="1" max="99">
            </div>

            <br><br>
            <div class="vp-btns">
                <input type="hidden" name="pid" value="<?php echo $pid;?>" />
                <button class="atc" type="submit"><i class="fas fa-shopping-cart">&nbsp;&nbsp;&nbsp;</i>Add to Cart</button>
                <input type="submit" class="bn" formaction="checkout.php" value="Buy Now">
            </form>

            </div>
      </div>
  </div>

        <?php include './include/footer.php'; ?>
    </body>
</html>




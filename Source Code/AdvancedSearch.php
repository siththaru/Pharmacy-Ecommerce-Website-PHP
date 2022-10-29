<?php
include './include/showErrors.php';
include './actions/dbConnection.php';
$keyword = "";
$category="";

if(isset($_GET['keyword'])){$keyword = $_GET['keyword'];}
if(isset($_GET['selectedCategory'])){$category = $_GET['selectedCategory'];}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/products.css">
  <link rel="stylesheet" href="css/headerFooter.css">
  <link rel="shortcut icon" href="images/logo_icon.png" />
  <title>Products</title>
        <?php
        if(isset($_GET['msg'])){
            echo "<script>alert('".$_GET['msg']."');</script>";
        }
        ?>
</head>

<body>

  <?php
  include './include/header.php';
  ?>

  <div style="height: 15vh;"></div>

  <div class="bar"> 
    <form method="GET" action="AdvancedSearch.php">
    <input type="text" placeholder="Search" name="keyword" value="<?php echo $keyword;?>" />
    <select name="selectedCategory"> 
                    <option value="">ALL Categories</option>
                    <?php
                    $queryCat = "select * from product_category";
                    $resultCat = $conn->query($queryCat);
                    if($resultCat->num_rows>0){
                        while ($row = $resultCat->fetch_assoc()){
                     ?>
         <option <?php if($category==$row['id_product_category']){echo "selected";}?> value="<?php echo $row['id_product_category']?>">
                        <?php echo $row['category_name']?></option>
                    <?php }}?>
                </select>
     <button type="submit" name="search"><i class="fas fa-search"></i></button>
      </form>
    </div>
  
    <br>
    <br>
    <div style="text-align: left;   background: linear-gradient(to bottom, #47f5de, #2fc4e6); color: teal;">
    <?php 
    echo "Search results for: ".$keyword; 
      ?>
      </div>
    <br>
    <br>

    <div class="all">

    <?php
      $searchProducts = "SELECT * FROM products p "
              . " join product_category c on p.product_category =  c.id_product_category "
              . " where  product_name like '%".$keyword."%' ";
                //if cat searc
                if($category!=""){$searchProducts = $searchProducts. " and  p.product_category = '".$category."'";}
       
                $result = $conn->query($searchProducts);
                if($result->num_rows>0){
                    while ($row=$result->fetch_assoc()){
                      if($row['is_active']=='1'){
                ?>

    <div class="cards">
        <a href="viewProductDetails.php?pid=<?php echo $row['id_products']?>" >
      <div class="p-image">
          <img  src="<?php echo "actions/productImages/".$row['product_profile_img'];?>" height="200px" width="250px" alt="product_image" />
      </div>
        <div class="details">
        <div class="p-name">
        <?php echo $row['product_name'];?>
        </div>
        </a>
        <h3>$<?php echo $row['sell_price'];?></h3>
        <a href="actions/addToCart.php?pid=<?php echo $row['id_products'];?>">
        <input class="addtocart" type="button" value="Add to Cart" />
        </a>
        </div>
        
    </div>
          
      <?php
        }
      }
    }else{
        ?>
      <div class="not_found">
        <?php
        echo "<h1>No Results Found</h1>"; 
      ?>
      </div>
      <?php
      }
      ?>
      
    </div>


  </div>
<br><br><br>
  <?php
 include './include/footer.php';
  ?>

</body>

</html>
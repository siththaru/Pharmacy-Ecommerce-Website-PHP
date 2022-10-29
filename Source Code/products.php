<?php
include './include/showErrors.php';
include './actions/dbConnection.php';
if (isset($_SESSION['is_login']) && $_SESSION['is_login']!==true) {
    header("Location: login.php?msg=Please Login or Register before Continue");die();
}else if(isset($_SESSION['user_type']) && $_SESSION['user_type']!==1){
    header("Location: index.php?msg=Unathorized Access");die();
}
$query = "select * from products";
$result = $conn->query($query);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Product Manager</title>
        <link rel="stylesheet" href="css/update.css">
        <link rel="stylesheet" href="css/headerFooter.css">
        <link rel="shortcut icon" href="images/logo_icon.png"/>
    </head>
    <body style="background: linear-gradient(to left, #02a3c7, #47f5de);">

    <a class="b1 back" href="admin.php">&laquo; Back</a>
<!-- <div style="height: 10vh;"></div> -->

<img class="logo" src="images/logo1.png" width="30%">

<br>
<form class="form1" action="actions/saveProduct.php" method="post" enctype="multipart/form-data">
  <h1 style="font-family: calibri; color: rgb(0, 90, 90);">Add Products</h1>

  <center>
<?php if(isset($_GET['msg'])){ ?>
            <p style="color: red;"><?php echo $_GET['msg'];?></p>
<?php }?>
</center>

    <!-- get name -->
    <input type="text" placeholder="Product Name" name="product_name" required><br><br>

    <!-- get description -->
    <input type="text" placeholder="Product Description" name="product_desc" required><br><br>
    
    <!-- get category -->
    <select name="category"> 
            <option disabled selected hidden value="">Select Category</option>
                <?php
                    $queryCat = "select * from product_category";
                    $resultCat = $conn->query($queryCat);
                    if($resultCat->num_rows>0){
                        while ($row = $resultCat->fetch_assoc()){
                     ?>
       <option value="<?php echo $row['id_product_category']?>">
                        <?php echo $row['category_name']?></option>
                <?php }}?>
    </select><br><br>

    <!-- get sell price -->
    <input type="text" placeholder="Sell Price" name="product_sell_price" required><br><br>

    <!-- get buy price -->
    <input type="text" placeholder="Buy Price" name="product_buy_price" required><br><br>

    <!-- get quantity -->
    <input type="number" placeholder="Product Quantity" name="qty" required><br><br>
    
    <!-- get activity -->
    <input type="text" placeholder="Active (1 or 0)" name="productstatus" required><br><br>
    
    <!-- Image uploader -->
    <label class="lb1">Upload Product Image Here &#8628;</label>
    <input type="file" name="product_image" id="fileToUpload">

    <br><br>

    <!-- submit button -->
    <input type="submit" name="submitButton" value="Add">
    
    <br><br>
  </form>

  <br><br><br>

        <div style="overflow-x:auto;">

            <table class="tb2" border="1">
                    <tr>
                        <th>Product Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Buy Price</th>
                        <th>Sell Price</th>
                        <th>Qty</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Is Active</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
               
                    <?php
                if($result->num_rows > 0){
                      while ($row = $result->fetch_assoc()) {
                    ?>
                <form method="post" action="actions/updateProduct.php" >
                    <tr>
                        <td><?php echo $row['id_products'];?></td>
                        <td><input type="text" name="product_name" value="<?php echo $row['product_name'];?>"></td>
                        <td><input type="text" name="product_desc" value="<?php echo $row['product_description'];?>"></td>
                        <td><input type="text" name="product_buy_price" value="<?php echo $row['buy_price'];?>"></td>
                        <td><input type="text" name="product_sell_price" value="<?php echo $row['sell_price'];?>"></td> 
                        <td><input type="text" name="qty" value="<?php echo $row['avl_qty'];?>"></td>
                        <td><select name="category">
                                <?php
                                     
$queryCat = "select * from product_category"; 
        $resultCat = $conn->query($queryCat); 
                                if($resultCat->num_rows > 0){
                                    while ($rowx = $resultCat->fetch_assoc()) {
                                ?>
  <option <?php if($row['product_category']==$rowx['id_product_category']){echo "selected";} ?> 
      value="<?php echo $rowx['id_product_category'];?>"><?php echo $rowx['category_name'];?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select></td>
                        <td><img src="<?php echo "actions/productImages/".$row['product_profile_img'];?>" width="70" height="70"></td>
                                <td><select name="productstatus">
                                        <option  <?php if($row['is_active']==1){echo "selected";}?>  value="1">Yes</option>
                                        <option  <?php if($row['is_active']==0){echo "selected";}?> value="0">No</option>
                                        <a href="actions/deleteProduct.php"></a>
                            </select></td>
                        <td>
                            <input type="hidden" name="productId" value="<?php echo $row['id_products'];?>" /> 
                            <input type="submit" value="Update" /></td>
                        <td><a href="actions/deleteProduct.php?id=<?php echo $row['id_products'];?>"><i style="color: red;" class="fas fa-trash-alt"></i></a></td>
                    </tr>
            </form>
                     <?php
                         }
                        }
                        
                        $conn->close();
                      ?>
                    
            </table>

        </div>

        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </body>
</html>

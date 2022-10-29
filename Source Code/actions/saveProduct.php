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

if(isset($_POST['product_name'])){$productName = $_POST['product_name'];}
if(isset($_POST['product_desc'])){$productDescription = $_POST['product_desc'];}
if(isset($_POST['product_buy_price'])){$buyPrice = $_POST['product_buy_price'];}
if(isset($_POST['product_sell_price'])){$sellPrice = $_POST['product_sell_price'];}
if(isset($_POST['qty'])){$qty = $_POST['qty'];}
if(isset($_POST['category'])){$Category = $_POST['category'];}
if(isset($_POST['productstatus'])){$status = $_POST['productstatus'];} 
 
if($productName==""){    header("Location: ../products.php?msg=Product name Required");die();}
if($productDescription==""){    header("Location: ../products.php?msg=Product Description Required");die();}
if($buyPrice==""){    header("Location: ../products.php?msg=Product buy Price Required");die();}
if($sellPrice==""){    header("Location: ../products.php?msg=Product sell Price Required");die();}
if($qty==""){    header("Location: ../products.php?msg=Product Qty Required");die();}
if($Category==""){    header("Location: ../products.php?msg=Product Category Required");die();}
if($status==""){    header("Location: ../products.php?msg=Product Status Required");die();}

//image uplaoder here !!!
$target_dir = "productImages/";
$target_file = $target_dir . basename($_FILES["product_image"]["name"]);
$filename = basename($_FILES["product_image"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
&& $FileType != "gif" ) {
   $uploadOk = 0;
}

if ($uploadOk == 0) {
   header("Location: ../products.php?msg=Sorry,only JPG, JPEG, PNG & GIF files are allowed."); 
  die();
} else {
  move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);
}
//image upload end

$Query= "Insert into products(product_name,product_description,buy_price,sell_price,"
        . "avl_qty,product_category,product_profile_img,is_active) "
        . "values('".$productName."','".$productDescription."','".$buyPrice."','".$sellPrice."',"
        . "'".$qty."','".$Category."','".$filename."','".$status."')";

$result = $conn->query($Query);

if($result===TRUE){  
    header("Location: ../products.php?msg=Product save Success !");die();
}else{
    header("Location: ../products.php?msg=Product Save Error:".mysqli_error($conn));die();
}
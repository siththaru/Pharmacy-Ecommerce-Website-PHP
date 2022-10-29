<?php include './include/showErrors.php';?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/admin.css">
        <link rel="stylesheet" href="css/checkout.css">
        <link rel="stylesheet" href="css/headerFooter.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Admin Panel</title>
    </head>
    <body>
        <?php include './include/header.php';
              include './include/adminAuth.php';
        ?>

<div class="main">
  <button><a href="users.php"><i class="fas fa-users fa-3x"></i>User Manager</a></button>
  <button><a href="products.php"><i class="fas fa-archive fa-3x"></i>Product Manager</a></button>
  <button><a href="orders.php"><i class="fas fa-people-carry fa-3x"></i>Order Manager</a></button>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </body>
</html>

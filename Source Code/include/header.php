<?php 
if(session_id() == '') {
    session_start();
}

 $is_login = false;
 $user_type = "";
if(isset($_SESSION['is_login'])){
    $is_login = $_SESSION['is_login'];
}

if(isset($_SESSION['user_type'])){
    $user_type = $_SESSION['user_type'];
}

?>

<div class="nav">
      <a class="logo-link" href="index.php"><img class="logo" src="images/logo1.png" alt="Logo" /></a>

      <div class="titles" id="titles">
        <a class="l1" href="index.php">Home</a>
        <?php if ($user_type==1){
          ?>
        <a class="l1" href="admin.php">Admin</a>
         <?php
            }else{?>
        <a class="l1" href="index.php#section1">About</a>
        <a class="l1" href="contactUs.php">Contact</a>
        <?php }
        if($is_login){
            ?>
        <a class="b1" id="link3" href="actions/logout.php">LogOut</a>
        <?php
        }else{ 
          ?>
        <a class="b1" href="register.php">Sign Up</a>
        <a class="b2" href="login.php">Login</a>
        <?php
        }
        ?>
        <a class="l1" href="cart.php"><i class="fas fa-cart-plus"></i></a>
      </div>

      <div class="menu">
        <div id="line1"></div>
        <div id="line2"></div>
        <div id="line3"></div>
      </div>
    </div>

  <script src="app.js"></script>
</body>

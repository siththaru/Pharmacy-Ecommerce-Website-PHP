<?php
include './include/showErrors.php';
session_start();
include './actions/dbConnection.php';
if (isset($_SESSION["is_login"]) && ($_SESSION["is_login"] == true)) {
  header("Location: index.php");
}
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo_icon.png"/>
    <link rel="stylesheet" href="css/headerFooter.css">
    <link rel="stylesheet" href="css/log.css">
    <title>Login</title>
  </head>

  <body>

      <div class="box box-top">
      
        <div class="container" style="width: 400px;">
          <div class="form">

            <h2>Login</h2>
            
            <?php if(isset($_GET['msg1'])){ ?>
            <p style="color: Green;"><?php echo $_GET['msg1'];?></p>
            <?php }?>

            <?php if(isset($_GET['msg'])){ ?>
            <p style="color: red;"><?php echo $_GET['msg'];?></p>
            <?php }?>

            <form method="post" action="actions/loginAction.php">
              <div class="inputBox">
                <input class="log-input" type="text" placeholder="Username" name="username" id="username" required>
              </div>
              <div class="inputBox">
              <input class="log-input"  type="password" placeholder="password" name="password" id="password" required>
              </div>
              <div class="inputBox">
                <input style="width: 50%;" type="submit" value="Login">
              </div>
              <p class="forget">Forgot Password ? <a href="">Click Here</a></p>
              <p class="forget">Don't have an account ? <a href="register.php">Register</a></p>
              <a class="back" href="index.php"><i class="fas fa-chevron-left"></i> Back to Home</a>
            </form>
          
          </div>
        </div>
      </div> 
  
    <div class="vid">
  <video autoplay muted loop src="images/log_bg.mp4"></video>
  </div>

  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </body>

  </html>
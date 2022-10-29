<?php include './include/showErrors.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/logo_icon.png" />
  <link href="css/headerFooter.css" type="text/css" rel="stylesheet" />
  <link rel="stylesheet" href="css/contact.css">
  <title>Contact Us</title>
</head>
<body>
<?php include './include/header.php';?>

<div class="main"></div>

<div class="container">
  <div class="row">
    <h1>Get in Touch</h1>
    <p>Leave us a message:</p>
  </div>
  <div class="row">
    <div class="column" align="center">
    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_ahMiE7.json"  background="transparent"  speed="1"  style="width: 95%;"  loop  autoplay></lottie-player>
    </div>

    <div class="column">
      <form action="/action_page.php">
        <label for="fname">Name <span style="color: red;">*</span></label>
        <input type="text" id="fname" name="firstname" placeholder="Your name..">
        <label for="lname">Email <span style="color: red;">*</span></label>
        <input type="text" id="lname" name="lastname" placeholder="Your email">
        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:170px"></textarea>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
</div>

<div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.4900397980314!2d79.87737031459274!3d6.923951994997259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTUnMjYuMiJOIDc5wrA1Mic0Ni40IkU!5e1!3m2!1sen!2snl!4v1612092995728!5m2!1sen!2snl" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>

<div class="con-details">
<div><i class="fas fa-map-marker-alt"></i> No 91, Colombo 03, SriLanka</a></div>
<div><i class="fas fa-mobile-alt"></i> 01120133444</a></div>
<div><i class="far fa-envelope"></i> info@medcure.com</a></div>
<div><i class="fas fa-globe-europe"></i> www.medcureslk.com</a></div>
</div>

<div style="height: 10vh;"></div>

<?php include './include/footer.php';?>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>
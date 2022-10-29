<?php
include './include/showErrors.php';
include './actions/dbConnection.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MedCure Pharmacy</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="shortcut icon" href="images/logo_icon.png" />
        <link href="css/headerFooter.css" type="text/css" rel="stylesheet" />
      </head>
      <body>
        <?php include './include/header.php';?>

        <div class="intro" id="top">
          <div class="div-intro">
            <div class="content">
              <h1>Healthcare you trust,</h1>
              <h1>Right where you are.</h1>
              
              <a href="AdvancedSearch.php"><button>Shop Now <i class="fas fa-angle-right"></i></button></a>
              <br><br><br>
            </div>

      <!-- carousel start -->
        
      <section class="home">
     <div class="slider">
        <div class="slide active">
            <img src="actions/productImages/wheyAd.jpg" width="100%">
          </div>
          <div class="slide">
            <img src="actions/productImages/detolAd.jpg" width="100%">
          </div>
          <div class="slide">
            <img src="actions/productImages/nangrowAd.jpg" width="100%">
        </div>
     </div>
   
    <div class="controls">
        <div class="prev">&#10094;</div>
        <div class="next">&#10095;</div>
    </div>

    <div class="indicator">
    </div>

  </section>    
      
      <!-- Carousel End -->

    </div>

    <div class="medicine">
        <img src="images/tablet2.png" />
        <img src="images/corona.png" />     
        <img src="images/tablet3.png" />
        <img src="images/bottle.png" />
        <img src="images/corona.png" />
        <img src="images/needle.png" />
        <img src="images/corona.png" />
      </div>

    <video muted autoplay>
      <source src="images/pharmacist2.mp4" type="video/mp4" />
    </video>
  </div>

<div class="categories-bar">

<div class="all-categories">
<a href="AdvancedSearch.php">MEDICINE</a>
<a href="AdvancedSearch.php">MEDICAL DEVIC</i></a>
<a href="AdvancedSearch.php">WELLNESS</a>
<a href="AdvancedSearch.php">PERSONAL CARE</a>
<a href="AdvancedSearch.php">GNC</a>
</div>

</div>

<div class="sub-categories">
  
</div>
<div class="sub-categories">

</div>
<div class="sub-categories">

</div>
<div class="sub-categories">

</div>

<div class="featured">
  <h1><u>Featured Products</u></h1>
  <div class="main-categ">
    <div class="main-in">
    <?php
      $query = "SELECT * FROM products ORDER BY RAND() LIMIT 5";
      $result = $conn->query($query);
      while ($row = $result->fetch_assoc()) {
      ?>
      <div>
        <a href="viewProductDetails.php?pid=<?php echo $row["id_products"]; ?>">
          <img width="95%" height="67%" src="actions/productImages/<?php echo $row["product_profile_img"]; ?>" alt="product_image">
        </a>
        <br><br>
        <form method="GET" action="viewProductDetails.php">
          <input type="hidden" name="pid" value="<?php echo $row["id_products"];?>">
          <a href="viewProductDetails.php?pid=<?php echo $row["id_products"]; ?>">
          <input type="button" class="featuredButton" value="View Details">
          </a>
        </form>
      </div>
      <?php } ?>
    </div>
  </div>
  </div>

  <div class="sec1" id="section1">
    <div style="z-index: 2;">
      <div class="about">
        <h1>ABOUT US</h1>
      </div>
      <h4>
        MedCure Pharmacy Limited a 100% subsidiary of Sunshine Healthcare is
        one of the 1st branded retail Pharmaceutical Chains in Sri Lanka that
        has entered the market with a view of creating a difference in the
        retail pharmaceutical trade. Headed by a team of professionals,
        MedCure has introduced an innovative concept centered on superior
        customer care, latest technology in data management, a wide product
        assortment, affordable prices and a host of value additions. <br><br>
        We did not stop there, we also offer valuable content on medicine
        and tips on healthy living via the MedCure Offical Blog which will be released soon.
      </h4>
    </div>

    <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_jcsfwbvi.json" background="transparent" speed="1" style="width: 100%; height: 700px;" loop autoplay>
    </lottie-player>
  </div>

  
  <a class="upload" href="prescriptions.php">&laquo; Upload Prescription</a>
  <a href="#top"><i class="fas fa-arrow-up up"></i></a>
  <a href="www.facebook.com"><img class="msngr" src="https://img.icons8.com/fluent/60/000000/facebook-messenger.png" /></a>

    <?php include './include/footer.php';?>
    
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="slider.js"></script>
    <script src="app.js"></script>
    </body>
</html>

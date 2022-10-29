<?php include './include/showErrors.php';?>
<html>
  <head>
  <link href="css/headerFooter.css" type="text/css" rel="stylesheet"/>
  <link href="css/prescription.css" type="text/css" rel="stylesheet"/>
  </head>

<body style="padding: 0; margin: 0;">

<?php include './include/header.php';?>
    
  <div style="height: 15vh"></div>

  <div class="column">
    <h1>Upload Your Prescription for a FREE Quote</h1>
    <form style="height: 30vh;" action="actions/uploadCheck.php" method="post"  enctype="multipart/form-data" >
        <label for="fname">Name <span style="color: red;">*</span></label>
        <input type="text" id="fname" name="firstname" placeholder="Your name.." required>
        <label for="lname">Email <span style="color: red;">*</span></label>
        <input type="text" id="lname" name="lastname" placeholder="Your email" required>
        <div style="height: 3vh;"></div>
        <input type="file" name="pres_image" id="fileToUpload" hidden>
        <label for="fileToUpload">Click here to upload your prescription</label> &nbsp;&nbsp;&nbsp;&nbsp;
        <div style="height: 4vh;"></div>
        <input type="submit" value="Upload"/>
      </form>
      <div style="height: 13vh;"></div>
  </div>


<?php include './include/footer.php';?>

</body>
</html>
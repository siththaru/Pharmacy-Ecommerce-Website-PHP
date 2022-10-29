<?php
$target_dir = "../prescriptions/";
$target_file = $target_dir . basename($_FILES["pres_image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif"){
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["pres_image"]["tmp_name"], $target_file)) {
    header("Location: ../prescriptions.php?msg=Your prescription has been succefully uploaded"); die();
  } else {
    header("Location: ../prescriptions.php?msg=Sorry,only JPG, JPEG, PNG & GIF files are allowed."); die();
  }
}

?>
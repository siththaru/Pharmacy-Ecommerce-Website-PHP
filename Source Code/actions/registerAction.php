<?php
include './include/showErrors.php';
include './dbConnection.php';

 $fname = "";
 $lname = "";
 $address = "";
 $contactNo = "";
 $email = "";
 $username = "";
 $password = "";
 $retypePassword = "";
 $country = "";
 $city = "";
 $zip = "";

 if(isset($_POST['fname'])){$fname = $_POST['fname'];}
 if(isset($_POST['lname'])){$lname = $_POST['lname'];}
 if(isset($_POST['address'])){$address = $_POST['address'];}
 if(isset($_POST['country'])){$country = $_POST['country'];}
 if(isset($_POST['city'])){$city = $_POST['city'];}
 if(isset($_POST['zip'])){$zip = $_POST['zip'];}
 if(isset($_POST['phone'])){$contactNo = $_POST['phone'];}
 if(isset($_POST['email'])){$email = $_POST['email'];}
 if(isset($_POST['username'])){$username = $_POST['username'];}
 if(isset($_POST['password'])){$password = $_POST['password'];}
 if(isset($_POST['retypePassword'])){$retypePassword = $_POST['retypePassword'];}

 if($password!=$retypePassword){  header("Location:../register.php?msg=Confirm password does not match! ");die();}

 $select = "SELECT * FROM `users`";
 $check = $conn->query($select);
 if ($check->num_rows > 0) {
    while($row = $check->fetch_assoc()){
        if($row['email']==$email){
            header("Location: ../register.php?msg=Email already exists");die();
        } else if($row['username']==$username){
            header("Location: ../register.php?msg=Username already exists");die();
        }
    }
    }

    
 $insertQuery = "INSERT INTO `users`
(`fname`,`lname`,`address`,`country`,`city`,`zipcode`,`contact_no`,`email`,`username`,`password`,`user_type`,`is_active`)
VALUES
('".$fname."','".$lname."','".$address."','".$country."','".$city."','".$zip."','".$contactNo."','".$email."','".$username."','".$password."','2','1')";
 
 $result = $conn->query($insertQuery);
 if($result===TRUE){
 header("Location: ../login.php?msg1=Registered Successfully! Please Login.");die();
 }else{
 header("Location: ../register.php?msg=Error : ".$conn->error);die();
 }
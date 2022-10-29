<?php
include './include/showErrors.php';
session_start();
include './dbConnection.php';
$username = "";
$password = "";

 if(isset($_POST['username'])){$username = $_POST['username'];}
 if(isset($_POST['password'])){$password = $_POST['password'];}

 //validation
 if($username==''){header("Location:../login.php?msg=Username not Found ! ");die();}
 if($password==''){header("Location:../login.php?msg=Password not Found ! ");die();}

 $selectUser = "Select * from users where username = '".$username."'  ";
$result = $conn->query($selectUser);

if ($result->num_rows > 0) {
   if($row = $result->fetch_assoc()){
       if($row['is_active']!='1'){
            header("Location:../login.php?msg=Inactive User !");die();
       }else if ($row['user_type']==2){
         if($password==$row['password']){
           //correct username and password
           //update session with params
           $_SESSION['userid'] = $row['id_users'];
           $_SESSION['username'] = $row['username'];   
           $_SESSION['user_type'] = $row['user_type'];
           $_SESSION['is_login'] = true;
           
           
           include '../include/loadCart.php';

           header("Location:../index.php?msg=Welcome !!!");die();
     
       }else{
           //incorrect password
            header("Location:../login.php?msg=Incorrect Password !");die();
        }
    }else if ($row['user_type']==1){
       $_SESSION['user_type'] = $row['user_type'];
       $_SESSION['userid'] = $row['id_users'];
       $_SESSION['is_login'] = true;
       header("Location:../admin.php?msg=Welcome !");die();
   }
}
} else {
 header("Location:../login.php?msg=Invalid User !");die();
}
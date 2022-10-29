<?php
include './include/showErrors.php'; 
include './dbConnection.php';

$status="";
$userId="";

if(isset($_POST['userstatus'])){$status = $_POST['userstatus'];}
if(isset($_POST['userId'])){$userId = $_POST['userId'];}

$Query= "update users set is_active='".$status."' WHERE id_users='".$userId."'";

$result = $conn->query($Query);

if($result===TRUE){  
    header("Location: ../users.php?msg1=Product update Success !");die();
}else{
    header("Location: ../users.php?msg=Product update Error:".mysqli_error($conn));die();
}

?>
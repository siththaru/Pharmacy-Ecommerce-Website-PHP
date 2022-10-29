<?php
session_start();
include './include/showErrors.php';
include './actions/dbconnection.php';

$select="SELECT * FROM `users`";

$result=$conn->query($select);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Manager</title>
        <link rel="shortcut icon" href="images/logo_icon.png" />
        <link href="css/headerFooter.css" type="text/css" rel="stylesheet"/>
        <link href="css/update.css" type="text/css" rel="stylesheet"/>
    </head>
    <body style="background: linear-gradient(to left, #02a3c7, #47f5de);">

    <a class="b1 back" href="admin.php">&laquo; Back</a>

    <img class="logo" src="images/logo1.png" width="30%">

        <div align="center">
            <h2 class="orderTitle">USERS</h2>

            <center>
            <?php if(isset($_GET['msg'])){ ?>
                        <p style="color: red;"><?php echo $_GET['msg'];?></p>
            <?php }?>
            </center>

            <center>
            <?php if(isset($_GET['msg1'])){ ?>
                        <p style="color: green;"><?php echo $_GET['msg1'];?></p>
            <?php }?>
            </center>

                <table class="tb2" border="1">
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th class="adrs">Address</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Zip Code</th>
                            <th>Status</th>
                        </tr>
                         <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                        <tr>
                            <td><?php echo $row['id_users'];?></td>
                            <td><?php echo $row['fname']." ".$row['lname'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['contact_no'];?></td>
                            <td><?php echo $row['address'];?></td>
                            <td><?php echo $row['username'];?></td>
                            <td><?php echo $row['password'];?></td>
                            <td><?php echo $row['country'];?></td>
                            <td><?php echo $row['city'];?></td>
                            <td><?php echo $row['zipcode'];?></td>
                            <td>
                                <form method="post" action="actions/updateUser.php">
                                <input type="hidden" name="userId" value="<?php echo $row['id_users'];?>">
                                <select class="sts" name="userstatus">
                                    <option <?php if($row['is_active']== 1){echo "selected";}?> value="1">YES</option>
                                    <option <?php if($row['is_active']== 0){echo "selected";}?> value="0">NO</option>
                                </select>
                                <input type="submit" value="Update">
                                </form>
                            </td>
                        </tr>
                    <?php
                    }}
                    ?>
                </table>

        </div>
        
    </body>
</html>

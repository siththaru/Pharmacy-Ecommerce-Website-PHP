<?php
include './include/showErrors.php';
include './actions/dbconnection.php';

$select="SELECT * FROM `invoice` i, `products` p,`invoice_items` ii, `users` u" 
        ." WHERE ii.`id_product`=p.`id_products` AND ii.`id_invoice`=i.`id_invoice` AND i.`invoiced_to`=u.`id_users`";

$result=$conn->query($select);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Order Manager</title>
        <link rel="shortcut icon" href="images/logo_icon.png"/>
        <link href="css/headerFooter.css" type="text/css" rel="stylesheet"/>
        <link href="css/update.css" type="text/css" rel="stylesheet"/>
    </head>
    <body style="background: linear-gradient(to left, #02a3c7, #47f5de);">

    <a class="b1 back" href="admin.php">&laquo; Back</a>

    <img class="logo" src="images/logo1.png" width="30%">

        <div align="center">
            <h2 class="orderTitle">ORDERS</h2>

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
                            <th>Order ID</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Customer Name</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Status</th>
                            
                        </tr>
                         <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                        <tr>
                            <td><?php echo $row['id_invoice'];?></td>
                            <td><?php echo $row['contact_no'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['address'];?></td>
                            <td><?php echo $row['fname']." ".$row['lname'];?></td>
                            <td><img src="<?php echo "actions/productImages/".$row['product_profile_img'];?>" width="80" height="70"/></td>
                            <td><?php echo $row['product_name'];?></td>
                            <td>
                                <form method="post" action="actions/updateOrder.php">
                                <input type="hidden" name="orderId" value="<?php echo $row['id_invoice'];?>">
                                <select class="sts" name="orderstatus">
                                    <option <?php if($row['status']== 1){echo "selected";}?> value="1">YES</option>
                                    <option <?php if($row['status']== 2){echo "selected";}?> value="2">NO</option>
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

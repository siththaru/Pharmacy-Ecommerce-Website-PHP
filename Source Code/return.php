<?php
include './include/showErrors.php';
session_start();
include './actions/dbConnection.php';
$orderID = ""; 
if(isset($_GET['order_id'])){$orderID = $_GET['order_id'];}
if($orderID==""){header("Location: ./cart.php?msg=Cart Requre to process payment");die();}
$user_ID = ""; 
if(isset($_SESSION['userid'])){$user_ID = $_SESSION['userid'];}
if($user_ID==""){header("Location: ./cart.php?msg=Please Login or Register before Continue");die();}

//have to do this part at notify_url page
   $query = "Update invoice set status = '1' where id_invoice = '".$orderID."'";
         if($conn->query($query)===TRUE){
            //   echo "<h2>Payment Processed Successfully !</h2>";
              if(isset($_SESSION['cart'])){
                  $_SESSION['cart'] = null;
              $_SESSION['current_invoice_id'] = null;
              }
         }
//notify_url page part completed

        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/headerFooter.css" type="text/css" />
        <link rel="stylesheet" href="css/return.css" type="text/css" />
    </head>
    <body> 
        <div class="noprint"><?php include './include/header.php'; ?></div>

        <div class="noprint" style="height: 13vh;"></div>

        <div align="center">

    <table class="tb0">
       <tr>
        <td>
        <i class="far fa-check-circle fa-5x" style="color: lawngreen;"></i>
        <h2 style="color: lawngreen; ">Order Successfully Placed !</h2>
        <h3 style="color: lawngreen;">Thank you for visiting us.</h3>
        <p style="padding-bottom: 25px; font-size: 15px;">Your order number is <strong>#<?php echo $orderID;?></strong></p>
        <hr style="width: 1px; height: 10%;" />
        </td>
        <td>
        
            <img class="logo img-fluid mb-3" src="images/logo1.png" style="max-height: 100px;"/>
            <br><br><br>
            No 91, Colombo 03, SriLanka<br>
            support@medcure.com<br> 
            01120133444<br>
            <strong>medcurelk.com</strong>
        
        </td>
       </tr>
    </table>
           
        <h2 class="cust-details">Your Details</h2>
    
    <?php 
            $query2 = "select * from users where id_users = '".$user_ID."'";
            $resultUser = $conn->query($query2);
           $record = $resultUser->fetch_assoc();
    ?>
    
    <table class="tb1" border="0"> 
            <tr>
                <td>Name</td>
                <td>:</td>
                <td><?php echo $record['fname']." ".$record['lname']?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $record['email']?></td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>:</td>
                <td><?php echo $record['contact_no']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><?php echo $record['address']?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td>:</td>
                <td>Sri Lanka</td>
            </tr>
           
    </table> </td> 
                <br>
                <h2 class="pro-details">Product Details</h2>
            
            
            <table class="tb2" border="1">
                <tr>
                    <th colspan="2">Product</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
                
            <?php
            $productList = "SELECT * FROM invoice i join  invoice_items ii on i.id_invoice = ii.id_invoice
 join products p on ii.id_product = p.id_products
where i.id_invoice = '".$orderID."' ";
            
            $result = $conn->query($productList);
            $total = 0;
            
                if($result->num_rows>0){
       while($row = $result->fetch_assoc()){
           $total =$total + ($row['line_unit_price']*$row['line_qty']);
            ?>
             <tr>
                <td><img  src="actions/productImages/<?php echo $row['product_profile_img'];?>" width="90" height="90" /> </td> 
                <td><?php echo $row['product_name'];?></td>
                <td><?php echo $row['product_description'];?></td> 
                <td class="td-center"><?php echo $row['line_qty'];?></td> 
                <td class="td-center">$<?php echo ($row['line_unit_price']*$row['line_qty']);?></td>
             </tr>
            <?php
                }
              }  
            ?>
             <tr>
                 <td colspan="5"><label style="float: right;">Total : $<?php echo $total?></label></td>
             </tr>   
            </table>
            
        </div>

        <input class="noprint print_btn" type="button" onclick="window.print()" value="Print Receipt" />

        <div class="noprint" style="height: 10vh;"></div>
       <div class="noprint"><?php include './include/footer.php'; ?></div>
    </body>
</html>

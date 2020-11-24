
<?php 

include("login/db_conn.php");
session_start();

     if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

        if(isset($_GET['delete'])){
            if($conn->query("DELETE FROM orders WHERE order_id='$_GET[delete]' ")){
                header('location:admin.php');
            }
            
        }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Page</title>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <style>
        .btn btn-primary btn-block{
            align-self: flex-end;
        }
        </style>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="login/style.css" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <?php

                 echo '<a class="navbar-brand" href="#">Welcome Admin' ." " . $_SESSION['username'].'</a>' ;
      
            ?>
        </nav>
        
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Your Access</div>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                View Confirmed Orders
                            </a>
                        </div>
                    </div>

                    
               <?php echo ' <ul class="navbar-nav ml-auto ml-md-0">
                <br><br><li class="nav-item dropdown">
                <a href="login/logout.php" type="submit" class="btn btn-primary btn-block" href="newshop.php" name="logout_user">Logout</a>
                </li>
                </ul>';
                ?>                  
                </nav>

            </div>
            </div>  


    <div class="table container">

        <h2 style="text-align: center">Orders</h2>

        <table class="table table-responsive text-wrap" style="word-wrap: break-word; white-space: normal !important; ">
        <tr>
            <th>Name</th>
            <th>Last Name</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>House Address</th>
            <th>Delivery Date</th>
            <th>Delete</th>
        </tr>
        <tr>
        <?php
        
        
            
            $sql = "SELECT orders.order_id, orders.user_id, orders.firstname, orders.price, orders.lastname, producttb.product_name, orders.quantity, 
            orders.phone_number, orders.email, orders.house_address, orders.delivery_date
             FROM orders inner join producttb on orders.product_id = producttb.id";    
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
            ?>

        <tr style="word-wrap: break-word;min-width: 160px;max-width: 160px;">
            <td><?php echo $row['firstname']?></td>
            <td><?php echo $row['lastname'] ?></td>
            <td> <?php echo $row['product_name']?> </td> 
            <td><?php echo $row['quantity']?></td>
            <td><?php echo $row['price']?></td>
            <td><?php echo $row['phone_number']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['house_address']?></td>
            <td><?php echo $row['delivery_date']?></td>
            <td> 
            <a href="admin.php?delete=<?php echo $row['order_id']; ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php
            }
        } else {
            echo "<tr>
            <td colspan=\"10\" class=\"text-center text-warning\">No orders received yet</td>
            </tr>";
        }

        ?>
        </table>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</body>
</html>

<?php 


}else{
     header("Location: index.php");
     exit();
}
 ?>
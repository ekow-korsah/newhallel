<?php
/**
 * Displays the Products present in the store
 * @author Wisdom Kalu
 * @author Osimpo Afua
 * @author Ewura Abena Asmah
 * @author Papa Kofi Asante
 */

//importing the a path.php file
include_once("path.php"); 
//started a session
session_start();
// html mark up from createDb.php and component.php
require_once ('php/CreateDb.php');
require_once ('./php/component.php');


// create instance of Createdb class
$database = new CreateDb("Productdb", "Producttb");

if (isset($_POST['add'])){
    
    // print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){
        // storing a product id in a cart session
        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }else{
            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akua's Mart: Shopping Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<!--offline bootstrap to be removed later-->
	<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" />

    <!-- Custom stylesheet -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
	<link rel="stylesheet" href="css/cart.css">
	<!-- <link rel="stylesheet" href="css/shop.css"> -->

    <style>
        footer{
        background-color:rgba(0,0,0,0.8);
        overflow-x: hidden;
        padding: 14vmin 18vmin;
        }

        footer p>span{
        color: #d59dba;   
        }

        footer input{
        border: none !important;
        }

        footer input::placeholder{
        color: white !important;
        }

        footer .input-group .input-group-text{
        background-color: #d59dba ;
        border: none;
        }

        footer .column i{
        color: #d59dba ;
        }

        footer .column i + i{
        padding: 0 0.5em;
    }
    </style>

</head>
<body>


<?php require_once(ROOTH_PATH . "/php/header.php"); ?>

<section class=" content-section first"  id="mess" >
        <div class="row text-center">
            <?php
                $result = $database->getData();
                while ($row = mysqli_fetch_assoc($result)){
                    component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                }
            ?>
        </div>
</section>



<footer>
      <div class="container-fluid p-0">
          <div class="row text-left">
              <div class="col-md-5 col-md-5">
                  <h1 class ="text-light">Hallel</h1>
                  <p class="pt-4 text-muted">
                      Copyright ©2020 All rights reserved | This template is made with by
                      <span>Hallel inc.</span>
                  </p>
              </div>
              <div class="col-md-5">
                  <h4 class = "text-light">Newsletter</h4>
                  <p class="text-muted">Stay updated</p>
                  <form class = "form-inline">
                      <div class="col pl-0">
                          <div class="input-group pr-5">
                              <input type = "text" class = "form-control bg-dark text-white" placeholder="Email">
                              <div class="input-group-prepend">
                                   <div class="input-group-text">
                                       <i class = "fas fa-arrow-right"></i>
                                   </div>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
              <div class="col-md-2 col-sm-12">
                  <h4 class="text-light">Follow Us</h4>
                  <p class="text-muted">Lets get social</p>
                  <div class="column">
                      <i class="fab fa-facebook-f"></i>
                      <i class="fab fa-instagram"></i>
                      <i class="fab fa-twitter"></i>
                      <i class="fab fa-pinterest"></i>
                  </div>
              </div>
          </div>
      </div>
  </footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!--offline jquery to be removed later -->
<script src="lib/jquery/jquery.min.js"></script>

<!--offline bootstrap to be removed later -->
<script src="lib/bootstrap/js/bootstrap.min.js"></script>

<!-- Custom Javascript -->
<script src="ajax/js/index.js"></script>
</body>
</html>

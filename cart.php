<?php
include_once("path.php"); 

//start session
session_start();

require_once ("php/CreateDb.php");
require_once ("php/component.php");
require_once ('ajax/ip_address/index.php');


$db = new CreateDb("Productdb", "Producttb");

// create instance of Createdb class
$database = new CreateDb("Productdb", "cart");

	//checks if the user is logged in, by looking at the session variable where his/her id is stored, if he is logged in, we use his/her id, otherwise, we use his/her ip_address
	$userID = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : $ip_address;
	
	//function to protect us from sql injection
	function protect($string){

		$string = trim(strip_tags(addslashes($string)));

		return $string;

	}

if(isset($_POST['product_id'])) {
	$product_id = protect($_POST['product_id']);
	
	//removes the given product from the cart table
	$sql = "DELETE FROM cart WHERE product_id = '".$product_id."' AND user_id_or_ip = '".$userID."'";

	mysqli_query($database->con, $sql);
	
	/*if(mysqli_query($database->con, $sql)) {
		
		//our response to the browser;
		echo json_encode('removed successfully');
		
	}else{
		//our response to the browser;
		echo json_encode('error');
	}*/
}

// checks if the order variable from the form is empty//
if(isset($_POST['order'])) {
	
	$firstName = protect($_POST['fname']);	
	$lastName = protect($_POST['lname']);
	$phonenumber = protect($_POST['number']);	
	$email = protect($_POST['email']);	
	$homeAddress = protect($_POST['house-address']);	
	$deliveryDate = protect($_POST['ddate']);

	// Used to get the number of products that were selected by the user
	$productTracker = json_decode($_POST['product-tracker']);
	//create an array
	$all = [];

	// Adding all the products selected into the an array.
	for($i = 0; $i < count($productTracker); $i++) {
		$id = $productTracker[$i]->id;
		$qty = $productTracker[$i]->qty;
		$price = $productTracker[$i]->price;
		
		$all[$i] = "('$userID', $id, $qty, $price, '$firstName', '$lastName','$phonenumber', '$email', '$homeAddress', '$deliveryDate')";
	}
	// assigns the values in to a variable.
	$our_values = implode($all, ',');

	//command to insert the oders of in the $our_values variable users into the db
	$sql = "INSERT INTO orders(user_id, product_id, quantity, price, firstname, lastname, phone_number, email, house_address, delivery_date) VALUES $our_values";
	
	// verify to see if the command was succesfull
	if($result = mysqli_query($database->con, $sql)) {
		$message = '<div class="success-sms">Thank you for shopping with us. Your Order Has Been Received. We will ship to you immediately</div>';
		
		// if command takes effect then the details in the cart table are deleted as well.
		$sql = "DELETE FROM cart WHERE user_id_or_ip = '$userID'";
		mysqli_query($database->con, $sql);
		
	}//Else there is an error in the sql command.
	else{
		$message = '<div class="alert alert-danger" role="alert">Oops! You cannot place an empty order!</div>';
	}

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<!--offline bootstrap to be removed later-->
	<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" />

	<!-- Importing the sttule sheets -->
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
<body class="bg-light">

<?php
    require_once (ROOTH_PATH . "/php/header.php");
?>

<div class="container-fluid">
	<div class="row px-5">
        <div class="col-md-7">
            <div id="cart-items-container" class="shopping-cart">
                <h6>My Cart</h6>
                <hr>

                <?php
				//checks if the user it logged in, by looking at the session variable where his/her id is stored, if he is logged in, we use his/her id, otherwise, we use his/her ip_address
				$userID = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : $ip_address;
				
				// select from db
				$sql = "SELECT producttb.*, cart.product_id, cart.user_id_or_ip FROM producttb, cart WHERE producttb.id = cart.product_id AND cart.user_id_or_ip = '$userID' ORDER BY cart.timestamp DESC";
				$result = mysqli_query($db->con, $sql);
				
				/*fetches products from database if they exist, if not informs user that cart is empty*/
				if(mysqli_num_rows($result) > 0) {
					$num_items = mysqli_num_rows($result);
					$total = 0;
					
					while($row = mysqli_fetch_assoc($result)) {
						cartElement($row['product_image'], $row['product_name'],$row['product_price'], $row['id']);
						$total += $row['product_price'];
					}
				}else{
					echo "Your cart is empty";
					$total = 0;
					$num_items = 0;
					
					if(isset($message)) {
						echo $message;
					}
				}

                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

		<!--calculating price-->
            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        
						<h6>Price (<?php echo $num_items; ?>) items</h6>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6><span id="amount-payable">₵<?php echo $total; ?></span></h6>
                        <h6 class="text-success">FLAT RATE of ₵10</h6>
                        <hr>
                        <h6><span id="flat-rate">₵<?php
                            echo $total + 10;
                        ?></span></h6>
					</div>
                            
				</div>
				<a href="javascript:void(0)" id="button" class="button" onclick="showModal()">Confirm order</a> 

                <!-- Modal Section -->
                <div id="bg-modal" class="bg-modal" style="">

				<!-- order form section -->
                    <div class="modal-contents">
                        <div class="close" onclick="document.getElementById('bg-modal').style.display = 'none';">+</div>
                        <form name="Form" action="cart.php" method="POST" onsubmit = "return validateForm()">
                            <label for ="fname">First Name</label>
                            <input id="fname" name="fname" type="text" placeholder="First Name" required>
                            <label for ="lname">Last Name</label>
                            <input id="lname" name="lname" type="text" placeholder="Last Name" required>
                            <label for ="number">Phone Number</label>
                            <input id="number" name="number" type="tel" placeholder="Phone Number" required>
                            <label for = "email">Email Address</label>
                            <input id="email" name="email" type = "email" placeholder = "email">
							<label for = "email">House Address</label>
                            <input id="house-address" name="house-address" type = "text" placeholder = "Street name, House No." required>
                            <label for = "ddate">Delivery Date</label>
                            <input id="ddate" name="ddate" type = "date" placeholder = "Delivery date" required>
							<input type="hidden" id="product-tracker" name="product-tracker" value="" />
							<input type="submit" class="order-btn" value="ORDER NOW" name="order" /> 
						</form>
                    </div>
                </div>
				
            </div>
		
        </div>
    </div>

	</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!--offline jquery to be removed later -->
<script src="lib/jquery/jquery.min.js"></script>

<!--offline bootstrap to be removed later -->
<script src="lib/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/cart.js"></script>

<script src="ajax/js/index.js"></script>

<script>
	function showModal() {

		var IdQtyPriceArray, productTracker, quantityBox, priceContainer, proId, proQty, proPrice;
			IdQtyPriceArray = [];
			productTracker = document.getElementById('product-tracker');
			quantityBox = document.getElementsByClassName('quantity-box');
			priceContainer = document.getElementsByClassName('price-container');
			
			//getting the values of the product price and quantity and id and storing into an array
			for(var i = 0; i < quantityBox.length; i++) {
				var myObj = {};
				proId = quantityBox[i].getAttribute('data-id');
				proQty = quantityBox[i].value;
				proPrice = priceContainer[i].innerHTML;
				myObj.id = proId;
				myObj.qty = proQty;
				myObj.price = proPrice;
				IdQtyPriceArray[i] = myObj;
			}
			
			//converts items returned into a JSON sting
			productTracker.value = JSON.stringify(IdQtyPriceArray);
			document.getElementById('bg-modal').style.display = 'block';
	}
</script>

</body>
</html>

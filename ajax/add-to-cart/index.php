<?php
session_start();
require_once ('../../php/CreateDb.php');
require_once ('../../php/component.php');
require_once ('../ip_address/index.php');

// create instance of Createdb class
$database = new CreateDb("Productdb", "cart");

if(isset($_POST['product_id'])) {
	$product_id = $_POST['product_id'];
	
	//checks if the user it logged in, by looking at the session variable where his/her id is stored, if he is logged in, we use his/her id, otherwise, we use his/her ip_address
	$userID = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : $ip_address;
	
	//checks if product already exists in cart table, if it does exist, don't add, tell the user
	$sql = "SElECT * FROM cart WHERE product_id = '".$product_id."' AND user_id_or_ip = '".$userID."'";
	$result = mysqli_query($database->con, $sql);

	if(mysqli_num_rows($result) > 0) {
		
		//our response to the browser;
		echo json_encode('already in cart');
		
	}else{
		
		//if the product isn't already added to cart, add it, and inform the user
		$sql = "INSERT INTO cart(product_id, user_id_or_ip, timestamp) VALUES('".$product_id."', '$ip_address', ".date('U').")";
		
		if(mysqli_query($database->con, $sql)) {
			
			//our response to the browser;
			echo json_encode('ok');
			
		}else{
			
			//our response to the browser;
			echo json_encode('error');
			
		}
	}
}
?>
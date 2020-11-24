<?php
session_start();
require_once ('../../php/CreateDb.php');
require_once ('../../php/component.php');
require_once ('../ip_address/index.php');

// create instance of Createdb class
$database = new CreateDb("Productdb", "cart");
	
//checks if the user it logged in, by looking at the session variable where his/her id is stored, if he is logged in, we use his/her id, otherwise, we use his/her ip_address
$userID = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : $ip_address;
	
//retrieve all cart products from this particular user
$sql = "SElECT * FROM cart WHERE user_id_or_ip = '".$userID."'";

if( ($result = mysqli_query($database->con, $sql)) ) {
	
	//our response to the browser;
	echo json_encode(mysqli_num_rows($result));
		
}else{
	//our response to the browser;
	echo json_encode(0);
}

?>
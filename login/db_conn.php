<?php

//creating database credentials needed to start connection

$dbserver= "localhost";
$dbuser= "root";
$dbpassword = "";
$dbname = "productdb";

//connect to database
$conn = mysqli_connect($dbserver, $dbuser, $dbpassword, $dbname);

//if condition to return message if connection failed
if (!$conn) {
	echo "Connection failed!";
}
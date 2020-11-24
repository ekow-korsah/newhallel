<?php 

//start session and connect database
session_start(); 
include "db_conn.php";

//sets if condition on username and password from form in index.php
if (isset($_POST['uname']) && isset($_POST['password'])) {

//protect database from sql injection
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$passverify = validate($_POST['password']);

	//encrypts validated password with md5
	$pass = md5($passverify);

	//validation to reject empty filled form
	if (empty($uname)) {
		header("Location: index.php?error=UserName is required");
		exit();
	} else if(empty($pass)) {
        header("Location: index.php?error=Password is required");
		exit();

	// select query in database if form was filled 
	} else{
		$sql = "SELECT * FROM admin WHERE username='$uname' AND mypassword = '$pass' ";
		$result = mysqli_query($conn, $sql);

	/* checks if query ran successfully then creates session with username and redirects to admin page. Throws an error 
		if it failed and redirects back to home page
	*/
		if($result) {
			$row = mysqli_fetch_array($result);
			if(is_array($row)) {
				$_SESSION['username'] = $row['username'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: ../admin.php");
		        exit();
			}else{
				header("Location: index.php?error=Incorect Username or password");
		        exit();
			}
		} else {
			header("Location: index.php?error=Incorect Username or password");
		        exit();
			}
		}
	}else{
		header("Location: index.php");
		exit();
	}


	
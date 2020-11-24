<?php 

//starts session
session_start();

//unsets and destoys session
session_unset();
session_destroy();

//takes back to login page
header("Location: index.php");
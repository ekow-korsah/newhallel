<?php

if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $location = $_POST['loc'];
    $item = $_POST['item'];

    $emailFrom = $email;

    $emailBody = "User Name: $name + $lastName. \n".
                "Email: $email.\n".
                "Location: $subject. \n".
                "Telephone Number: $message. \n".
                "Selected Item: $message. \n";


    $to = 'kookorsah@gmail.com';
    
    $headers = "From: $emailFrom \r\n";


    mail($to,$subject,$emailBody,$headers);

    header("Location: contact.html?mailsend");
}

?>

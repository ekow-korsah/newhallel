<?php include_once("path.php"); 
/**
 * @author Wisdom Kalu
 * @author Nana afua osimpo kessewaah Amo
 * @author Ewura Abena Asmah
 * @author Papa Kofi Asante
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/shop.css">
    <title>Document</title>
</head>
<body>
<!-- code to include the path wer header2.php is-->
<?php require_once(ROOTH_PATH . "/php/header2.php"); ?>
    <!-- styling the about.php-->
    <div class="w3-row-padding w3-padding-64 w3-container">
        <div class="w3-content">
          <div class="w3-twothird">
            <h1>About Us</h1>
            <h5 class="w3-padding-32">
                The grocery store(Akua’s Mart) is the largest in the community and always has all products that a customer wants.
                For this reason everyone wants to go there, and the place tends to get crowded which is unsafe especially during this pandemic period
                </h5>
            <!-- styling the about page -->
            <p class="w3-text-grey">
                <h1>Our Fight Against COVID-19</h1>
                <!-- Pasting a corona virus image -->
                <img src="images/coronavir.jpg" alt="Imagie" style="width:50%;"><br>
                <br>
                Corona Virus Disease is a newly identified Severe Acute Respiratory Infection (SARI) caused by a novel corona virus named SARS-CoV-2.
                The spread of the disease in humans is mainly through droplets arising from people sneezing, coughing or speaking which is then transferred to mucosal surfaces (eyes, nose and mouth) via the hands.
                <br>There is currently no cure for the virus and this puts everyone, especially our workers who are considered as frontline workers. To ensure that social distancing rules are being followed and the risk of transmission to our workers is reduced, we have launched our store online.
                <br>Safety Protocols are also being adhered in our warehouses to ensure that the risk of contamination is low and products delievered to you are safe.
                <br>
                <br>
                <!-- Adding a corona virus image-->
                <img src="images/groceries.jpeg" alt="Imagy" style="width:100%;">
            </p>
          </div>
          <!-- styling the about page -->
          <div class="w3-third w3-center">
            <i class="fa fa-anchor w3-padding-64 w3-text-red"></i>
          </div>
        </div>
      </div>
      
<?php
  // helps to link the about.php to the footer.php
  require_once (ROOTH_PATH . "/php/footer.php");
?>
    
</body>
</html>

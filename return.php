<?php
/*
 * How to show a return page to the customer.
 *
 * In this example we retrieve the order stored in the database.
 * Here, it's unnecessary to use the Mollie API Client.
 */
include_once "index.php";
include_once "connection.php";
/*
 * NOTE: The examples are using a text file as a database.
 * Please use a real database like MySQL in production code.
 */
require_once "functions.php";

$status = database_read($_GET["order_id"]);

if($status == "paid"){
    $message = "geslaagd";
} else{
    $message = "niet geslaagd probeer het afrekenen nogmaals";
} ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; border: 4px; }
        .wrapper2{ width: 350px; padding: 20px; border: 4px; border-color: black;}
    </style>
</head>
<body>
<div style="display:flex;justify-content: center;align-items: baseline;">
    <div class="wrapper2">
      <h2>Bevestiging</h2>
      <p>U betaling voor de order met order ID <?php echo $_GET['order_id']; ?> is <?php echo $message; ?> </p>
    </div>
</div>
</body>
</html>
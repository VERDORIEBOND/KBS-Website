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
$orderID=$_GET['order_id'];
$status="";
$sql1= "SELECT orderstatus FROM ordersprivate WHERE OrderID = ?";
if($stmt1=mysqli_prepare($conn,$sql1)){
    mysqli_stmt_bind_param($stmt1, "i", $orderID);
    if(mysqli_stmt_execute($stmt1)){
        mysqli_stmt_store_result($stmt1);
        if(mysqli_stmt_num_rows($stmt1) == 1) {
            mysqli_stmt_bind_result($stmt1, $status);
            while(mysqli_stmt_fetch($stmt1)){
                $status=$status;
            }
        } else{
            $status="failed";
        }
    }
}

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
    <div class="verzendenFAQ">
      <h2>Bevestiging</h2>
      <p>U betaling voor de order met order ID <?php echo $_GET['order_id']; ?> is <?php echo $message;?> </p>
    </div>
</body>
</html>
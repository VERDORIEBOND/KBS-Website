<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Product Page</title>

    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>


<?php
//error_reporting(-1);
// Including pages for connection to DB and for styling the page and getting functions
include "index.php";
include "functions.php";
include "connection.php";

?>

</head>
<body>

<?php

// FUNCTIONS ----------->
//$filterItems();
if($checkIfCategory($conn, $_GET['productGroup']))
{
    $itemsCategory($conn, $_GET['productGroup'], $imgCategory($_GET['productGroup']), 0);
}
else
{
    $itemsToProductCards($conn);
}

?>
</body>
</html>

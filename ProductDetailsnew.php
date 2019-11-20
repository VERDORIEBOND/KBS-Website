<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Wide World Importers</title>

    <link href="ProductDetails.css" rel="stylesheet" type="text/css">

</head>
<body>
<?php
include "index.php";
include "functions.php";
include "connection.php";
$numFromUrl = $_GET['productId'];
$result = mysqli_query($conn,"SELECT StockItemID, StockItemName,RecommendedRetailPrice FROM stockitems WHERE StockItemID = '$numFromUrl'");
while ($row = mysqli_fetch_assoc($result))

?>

</body>
</html>


<!doctype html>
<html lang="en">
<head>
    <title>Wide World Importers</title>
    <link rel="stylesheet" type="text/css" href="ProductDetails.css">
</head>

<body>

<?php
include "connection.php";
include "functions.php";
include "index.php";

//Print de naam van het gekozen artikel


?>
<div class="Productname">
    <?php
    //$detailprinter($conn);
    echo $detailPrinter($conn);
    ?>
</div>






<div class="Button">
    <h2>Winkelwagen</h2>


</div>



</body>
</html>
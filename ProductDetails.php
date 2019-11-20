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
<div class="Productfoto">
    <?php
    echo '<img src="images/no-product-image.png" alt="ProductImage">';
    ?>
</div>

<div class="Prijs">
    <?php
    echo $prijsgever($conn);
    ?>
</div>





<div class="Button">
    <h2>Winkelwagen</h2>
</div>

<div class="Button-twee">
    <h3>Verlanglijstje</h3>
</div>



</body>
</html>
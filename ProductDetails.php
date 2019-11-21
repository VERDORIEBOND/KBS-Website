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
    //foto printen
    echo '<img src="images/no-product-image.png" alt="ProductImage">';
    ?>
</div>

<div class="Prijs">
    <?php
    //print de prijs functie
    echo $prijsgever($conn);
    ?>
</div>

<div class="Stock">
    <?php
    //print de voorraad
    echo $stockzoeker($conn);
    ?>
</div>
<div class="productTemp">
    <?php
    //print de voorraad
    echo $tempShower($conn);
    ?>
</div>
<?php //dit zijn de knoppen en de omschrijving ?>
<div class="Button">
    <h2>Winkelwagen</h2>
</div>

<div class="Button-twee">
    <h3>Verlanglijstje</h3>
</div>

<div class="Omschrijving">
    <p>Omschrijving</p>
</div>



</body>
</html>
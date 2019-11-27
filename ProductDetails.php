<!doctype html>
<div lang="en">
<head>

    <title>Wide World Importers</title>
    <link rel="stylesheet" type="text/css" href="ProductDetails.css">
</head>




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
<div class= "ProductTemp">
    <?php
    //print de voorraad
    echo $tempShower($conn);
    ?>
</div>
<?php //dit zijn de knoppen en de omschrijving ?>
<div class="Button">
    <h2>Winkelwagen</h2>
</div>
    <div class="verlanglijstje-btn">
        <form action="winkelmandje.php" method="get">
            <input type="submit" name="V-btn" value="Verlanglijstje" href="#">

            <h3>Verlanglijstje</h3>
        </form>
    </div>



<div class="Omschrijving">
    <p>Omschrijving</p>
</div>
<div class="TempShower"
    <?php
     echo $tempShower($conn);
    ?>
</div>


</body>
</html>
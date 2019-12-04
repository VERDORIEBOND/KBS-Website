<!doctype html>
<div lang="en" xmlns="http://www.w3.org/1999/html">
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

    $numFromUrl = $_GET['productId'];
    $query = "SELECT i.StockGroupName as groupname FROM stockgroups i JOIN stockitemstockgroups g ON i.StockGroupID=g.StockGroupID WHERE g.StockItemID = '$numFromUrl' ORDER BY RAND() LIMIT 1;";
    $result= mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="foto">
                <img src="<?php echo $imgCategory($row['groupname']) ?>" class= alt="a" />
            <?php } ?>

            </div>
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
    //print de temperatuur
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
        </form>
    </div>


<div class="Omschrijving">
    <?php
        $NumberUrl = $_GET ['productId'];
        $query2 = "SELECT i.StockItemID, MarketingComments FROM stockitems i WHERE StockItemID = '$NumberUrl'";
        $result2 = mysqli_query($conn,$query2);
        if(!empty(trim($row['MarketingComments']))) {
            echo "Bij dit product zit geen beschrijving";
        }
        else{
            $row = mysqli_fetch_assoc($result2);
                echo $row['MarketingComments'];

        }
    ?>

</div>
</div>

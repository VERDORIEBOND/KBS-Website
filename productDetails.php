<!doctype html>
<html lang="en">
<head>

    <title>Wide World Importers</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>




<?php
include "connection.php";
include "functions.php";
include "index.php";




//Print de naam van het gekozen artikel


?>
<div class="container">

        <div class="ProduktNaam" style="position: relative; color: #496ebc; font-size: 200%; top: 80px;" >
            <?php
            //$detailprinter($conn);
            echo $detailPrinter($conn);
            ?>
        </div>

            <div class="Productfoto">
                <?php

                //foto printen

                $numFromUrl = $_GET['productId'];
                $query = "SELECT i.StockGroupName as groupname FROM stockgroups i JOIN stockitemstockgroups g ON i.StockGroupID=g.StockGroupID WHERE g.StockItemID = '$numFromUrl' ORDER BY RAND() LIMIT 1  ;";
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
        echo $prijsgever($conn);
        ?>
    </div>

        <div class="Prijs2">
            <?php
            //print de prijs functie
                $numFromUrl = $_GET['productId'];
                $query = "SELECT StockItemName, RecommendedRetailPrice, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID WHERE g.StockItemID = '$numFromUrl' ORDER BY RAND() LIMIT 1;";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                  if ($row['StockGroupName'] == 'Novelty Items') {
                            echo "€" . ($row['RecommendedRetailPrice']*0.85);
                        }
                        else {
                            echo "€".$row['RecommendedRetailPrice'];


                }
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
                <form method="post" action="winkelfunctie.php">
                    <input type="submit" name="add"   value="Toevoegen aan winkelmand">
                    <input type="hidden" value="<?php echo $_GET["productId"] ?>" name="Id"/>
                    <input type="hidden" value="<?php echo $_GET["StockItemName"] ?>" name="name"/>
                    <input type="hidden" value="<?php echo $_GET['Aantal'] ?>" name="Aantal"/>

                </form>

            </div>
            <div class="verlanglijstje-btn">
                <form method="post" action="verlanglijstje.php">

                    <input type="submit" name="voegtoe"  value="Toevoegen aan verlanglijst">
                    <input type="hidden" value="<?php echo $_GET["productId"] ?>" name="Id"/>
                    <input type="hidden" value="<?php echo $_GET["StockItemName"] ?>" name="name"/>

                </form>

            </div>

        <div class="Omschrijving">
            <?php
            $NumberUrl = $_GET ['productId'];
            $query2 = "SELECT i.StockItemID, MarketingComments FROM stockitems i WHERE StockItemID = '$NumberUrl'";
            $result2 = mysqli_query($conn,$query2);
            if(!empty($row['MarketingComments'])) {
                echo "Bij dit product zit geen beschrijving";
            }
            else{
                $row = mysqli_fetch_assoc($result2);
                echo $row['MarketingComments'];

            }
            ?>

        </div>



    <div class="Testvideo" style="max-width:350px;">
        <iframe width="350" height="200" src="https://www.youtube.com/embed/HluANRwPyNo"></iframe>
    </div>



</div>

</body>
</html>
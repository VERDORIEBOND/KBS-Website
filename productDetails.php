<!doctype html>
<div lang="en">
<head>

    <title>Wide World Importers</title>
    <link rel="stylesheet" type="text/css" href="productDetails.css">
</head>




<?php
include "connection.php";
include "functions.php";
include "index.php";


//Print de naam van het gekozen artikel


?>
<div class="container">
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
            <form method="post" action="winkelfunctie.php">
                <input type="submit" name="add"   value="Toevoegen aan winkelmand">
                <input type="hidden" value="<?php echo $_GET["productId"] ?>" name="Id"/>
                <input type="hidden" value="<?php echo $_GET["StockItemName"] ?>" name="name"/>

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
        <p>Omschrijving</p>
    </div>
    <div class="TempShower"
        <?php
        echo $tempShower($conn);
        ?>
    </div>
    <div class="Video" style="position:relative; left:65%; bottom: 200px"   >
        <video width="400" height="auto" controls="controls">
            <source src="/images/Videos/Testvideo.mp4" type="video/mp4">
            <source src="images/Videos/TestvideoWebM.webm" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>

        <p>
            Video courtesy  of
            <a href=https://www.youtube.com/watch?v=HluANRwPyNo target="_blank"> Jombo </a>.
        </p>
    </div>
</div>


</body>
</html>
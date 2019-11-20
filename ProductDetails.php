<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Wide World Importers</title>

    <link rel="stylesheet" type="text/css" href="Style.css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <!-- Product CSS -->
    <link rel="stylesheet" href="ProductDetails.css" type="text/css">



</head>
<body>

<nav class="navbar navbar-inverse navbar-expand-lg navbar-fixed-top">
    <div class="container-fluid">
        <img src="images/WWI.png" alt="Logo" height="50"></a>

        <div class="navbar-header">
            <a class="navbar-header">
                <a class="navbar-brand" href="#">Sale!</a>
        </div>
        <span class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categorieën

                <ul class="dropdown-menu">
                    <li><a href="#">Airline Novelties</a></li>
                    <li><a href="#">Clothing</a></li>
                    <li><a href="#">Computing Novelties</a></li>
                    <li><a href="#">Furry Footwear</a></li>
                    <li><a href="#">Mugs</a></li>
                    <li><a href="#">Novelty Items</a></li>
                    <li><a href="#">Packing Materials</a></li>
                    <li><a href="#">T-Shirts</a></li>
                    <li><a href="#">Toys</a></li>
                </ul>
            </span>
        </ul>
        <div class="Search-Bar">
            <form action="Search.php" method="get">
                <div class="search-txt">
                    <input class="search-text" type="text"  placeholder="Zoeken" name="search" value="" dir="ltr" required>
                    <input class="search-btn"  type="submit" value="Search" href="#">
                </div>

            </form>

        </div>
    </div>
</nav>

<div class="footer">
    <ul>
        <span><a href="#">Service</a> </span>
        <span><a href="#">Verzenden</a> </span>
        <span><a href="#">Betaling</a> </span>
        <span><a href="#">Over ons</a> </span>

    </ul>
</div>

<div class ="Productname">
<?php
include "connection.php";
include "functions.php";

//Print de naam van het gekozen artikel

//$detailprinter($conn);


$detailPrinter($conn);





?>
</div>
<div class="Button">
    <h2>Winkelwagen</h2>


</div>



</body>
</html>
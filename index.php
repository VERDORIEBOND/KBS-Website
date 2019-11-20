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

</head>
<body>

<nav class="navbar navbar-inverse navbar-expand-lg navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-logo">
        <a href="index.php" >
        <img src="images/WWI.png" alt="Logo" height="50"></a>
        </div>


        <div class="navbar-header">
            <a class="navbar-header">
                <a class="navbar-links-sale" href="#">Sale!</a>
                <a class="navbar-links-categorieen" href="productPage.php">Alle Producten</a>
        </div>
        <span class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categorieën</a>
                <ul class="dropdown-menu">
                    <li><a href="productPage.php?productGroup=Airline Novelties">Airline Novelties</a></li>
                    <li><a href="productPage.php?productGroup=Clothing">Clothing</a></li>
                    <li><a href="productPage.php?productGroup=Computing Novelties">Computing Novelties</a></li>
                    <li><a href="productPage.php?productGroup=Furry Footwear">Furry Footwear</a></li>
                    <li><a href="productPage.php?productGroup=Mugs">Mugs</a></li>
                    <li><a href="productPage.php?productGroup=Novelty Items">Novelty Items</a></li>
                    <li><a href="productPage.php?productGroup=Packing Materials">Packing Materials</a></li>
                    <li><a href="productPage.php?productGroup=T-Shirts">T-Shirts</a></li>
                    <li><a href="productPage.php?productGroup=Toys">Toys</a></li>
                </ul>
                    </span>
        </ul>
        <div class="Search-Bar">
            <form action="new%20search%20functie.php" method="get">
                <div class="search-txt">
                    <input class="search-text" type="text"  placeholder="Zoeken" name="search" value="" dir="ltr" required>
                    <input class="search-btn"  type="submit" value="Search" href="#">
                </div>

            </form>
            <div class="LogIn">
                <span><a href="#"><span class="glyphicon glyphicon-user" ></span> Sign Up</a></span><br>
                <span><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></span>
            </div
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


</body>
</html>
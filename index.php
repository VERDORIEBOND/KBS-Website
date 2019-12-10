<?php
error_reporting(0);
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Wide World Importers</title>

    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/dda578f1eb.js" crossorigin="anonymous"></script>

</head>
<body>
<!--- SALE NAVIGATION BAR --->
<nav class="navbar navbar-inverse navbar-expand-lg" id="sale-navbar">
    <ul class="nav navbar-nav">
        <p class="navbar-text">KERST AANBIEDINGEN</p>
        <!-- Display the countdown timer in an element -->
        <p id="demo">

        <script id="countdown-timer">
            // Set the date we're counting down to
            var countDownDate = new Date("Dec 31, 2019 24:00:00").getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
            }, 1000);
        </script>
        </p>
        <p class="navbar-text">KOOP NU</p>

    </ul>

</nav>
<!--- SALE NAVIGATION BAR --->

<div class="snowflakes" aria-hidden="true">
    <div class="snowflake">
        ❅
    </div>
    <div class="snowflake">
        ❆
    </div>
    <div class="snowflake">
        ❅
    </div>
    <div class="snowflake">
        ❆
    </div>
    <div class="snowflake">
        ❅
    </div>
    <div class="snowflake">
        ❆
    </div>
    <div class="snowflake">
        ❅
    </div>
    <div class="snowflake">
        ❆
    </div>
    <div class="snowflake">
        ❅
    </div>
    <div class="snowflake">
        ❆
    </div>
    <div class="snowflake">
        ❅
    </div>
    <div class="snowflake">
        ❆
    </div>
</div>



<nav class="navbar navbar-inverse navbar-expand-lg navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-logo">
            <a href="homePage.php" >
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
        <div class="Search-Bar">
            <form action="searchFunction.php" method="get">
                <div class="search-txt">
                    <input class="search-text" type="text"  placeholder="Zoeken" name="search" value="" dir="ltr" required>
                    <input class="search-btn"  type="submit" value="Search" href="#">
                </div>
            </form>
        </div>
        <?php if($_SESSION['loggedin'] == true){?>
            <div class="verlanglijstje1">
                <span><a href="verlanglijstje.php"><span class="far fa-heart"></span></a></span>
            </div>
            <div class="winkelmandje1">
                <span><a href="winkelfunctie.php"><span class="fas fa-shopping-cart"></span></a></span><br>
            </div>
            <span class="dropdown1">
                    <a data-toggle="dropdown" href="#" class="glyphicon glyphicon-user"></a>
                <ul class="dropdown-menu">
                    <li><a href="reset-password.php">Wachtwoord veranderen</a></li>
                    <li><a href="logout.php">Uitloggen</a></li>
                </ul>
                </span>
            <span class="Welkom">
                    <p>Welkom <?php print($_SESSION['name']); ?></p>
                </span>
        <?php } else{ ?>
            <div class="winkelmandje">
                <span><a href="winkelfunctie.php"><span class="fas fa-shopping-cart"></span></a></span><br>
            </div>
            <div class="LogIn">
            <span><a href="login.php"><span class="glyphicon glyphicon-user" ></span></a>
            </div>
        <?php } ?>
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
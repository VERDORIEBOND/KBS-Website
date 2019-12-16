<?php
session_start();

include "connection.php";
include "functions.php";
include"index.php";


if(isset($_POST['voegtoe'])) {
    if (isset($_SESSION["verlang"][$_POST["Id"]]) && $_SESSION["verlang"][$_POST["Id"]] > 0) {
        echo '<script>alert("Product is already Added to Cart")</script>';
       // echo '<script>window.location="productDetails.php?productId='.$_GET['Id'].' " </script>';

    } else {
        $_SESSION["verlang"][$_POST["Id"]] = 1;
    }

    print'<script>window.location="verlanglijstje.php"</script>';
}


if (isset($_GET["action"])&&$_GET["action"] == "delete"){
    unset($_SESSION["verlang"][$_GET["productId"]]);
    print'<script>window.location="verlanglijstje.php"</script>';
}
if (isset($_POST['Remove'])){

    $_SESSION["verlang"]="";
}

?>



<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web');
        *{
            font-family: 'Titillium Web', sans-serif;
        }
        .RemoveAll{
            color: #dc3545;
        }
        .product{
            border: 1px solid #eaeaec;
            margin: -1px 19px 3px -1px;
            padding: 10px;
            text-align: center;
            background-color: #efefef;
        }
        table, th, tr{
            text-align: center;
        }
        .title2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        h2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
        }
        .Table_Row th{
            color: #66afe9;
        }
    </style>
</head>
<body>

<div class="container" style="width: 65%">
    <h2>Verlanglijst</h2>



    <div style="clear: both"></div>

    <div style="overflow-x:auto;">

        <table class="table table-bordered">
            <tr class="Table_Row">
                <th><h5>
                        <form class="RemoveAll" method="post" action="verlanglijstje.php" onclick="return confirm('Weet u zeker dat u alle artikelen uit het verlanglijst wilt verwijderen?')">
                            <input type="submit" name="Remove"  value="Alles verwijderen">
                    </h5></th>
                <th><h5>Id</h5></th>
                <th><h5>Artikel naam</h5></th>
                <th><h5>Prijs</h5></th>



            </tr>
            <?php

            $producten = $verlanglijstdetails($conn);

            if(!empty($producten)){
            $total = 0;
            foreach ($producten as $key => $value){




            ?>
            <tr>
                <td>
                    <a href="verlanglijstje.php?action=delete&productId=<?php echo $value['ProductId'] ?>" onclick="return confirm('Are you sure want to delete this item?')">
                        <span class="text-danger"><span class="fas fa-trash"></span></a>
                </td>
                <td> <?php echo $value['ProductId'] ?></td>
                <td> <?php echo $value['Name'] ?></td>
                <td> <?php echo "€". $value['Price'] ?></td>






                <?php
                $total = $total + ($value["Aantal"] * $value["Price"]);
                }

            }




                     ?>


            </tr>
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="center">$ <?php echo number_format($total, 2); ?></td>


        </table>
    </div>



</body>
</html>



<?php
session_start();
include_once "connection.php";
include_once "functions.php";
include_once "index.php";
include_once "orderEmail.php";
//error_reporting(-1);


if(isset($_POST['add'])) {
    if (isset($_SESSION["cart"][$_POST["Id"]]) && $_SESSION["cart"][$_POST["Id"]] > 0) {
        echo '<script>alert("Product is already Added to Cart")</script>';
        echo '<script>window.location="ProductDetails.php"</script>';

    } else {
        $_SESSION["cart"][$_POST["Id"]] = 1;
    }

    print'<script>window.location="winkelfunctie.php"</script>';
}


if (isset($_GET["action"])&&$_GET["action"] == "delete"){
    unset($_SESSION["cart"][$_GET["productId"]]);
    print'<script>window.location="winkelfunctie.php"</script>';
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
    <h2>Shopping Cart</h2>



    <div style="clear: both"></div>
    <h3 class="title2">Shopping Cart Details</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr class="Table_Row">
                <th><h5>Product Name</h5></th>
                <th><h5>Price</h5></th>
                <th><h5>Id</h5></th>
                <th><h5>Quantity</h5></th>
                <th><h5>Remove Item</h5></th>
                <th><h5>Totaal</h5></th>
            </tr>

            <?php
            $producten = $winkelwagendetails($conn);

            if(!empty($producten)){
            $total = 0;
            foreach ($producten as $key => $value){




                ?>
            <tr>

                <td>stockitemname: <?php echo $value['Name'] ?></td>
                <td>price: <?php echo $value['Price'] ?></td>
                <td>stockitemid: <?php echo $value['ProductId'] ?></td>
                <td>test:<?php echo $value['Aantal'] ?></td>
                <td><a href="winkelfunctie.php?action=delete&productId=<?php echo $value['ProductId'] ?>"><span
                                class="text-danger">Remove Item</span></a>

                </td>
                <td>
                    <form id="Aantal<?= $key?>" action="winkelfunctie.php" method="get">
                        <div class="form-group">

                            <select name="aantal"  onchange="document.getElementById('Aantal<?= $key?>').submit();">
                                <?php

                                for ($i = 1; $i <= 100; $i++) {
                                    if ($i == $value){
                                        print "<span>" . "<option selected value='$i'>$i</option>" . "</span>";
                                    }else{
                                        print "<span>" . "<option value='$i'>$i</option>" . "</span>";
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" name="uantity" value="<?php echo $value['Aantal'] ?>">
                        </div>
                    </form>
                </td>


                <?php
                $total = $total + ($value["Aantal"] * $value["Price"]);
                }




                    ?>

                <td>
                    <?php
                    print($total);
                    }
                     ?>
                </td>

                </tr>

        </table>
        <form method="get" action="winkelfunctie.php">
            <input type="submit" name="button1" value="Order">
        </form>
        <?php

            if(isset($_GET['button1']))
            {
                $orderEmail();
            }

        ?>


    </div>



</body>
</html>



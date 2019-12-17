
<?php

session_start();
include_once "connection.php";
include_once "functions.php";
include_once "index.php";
//include_once "orderEmail.php";
error_reporting(0);
//$InvoiceTest = new Quickshiftin\Pdf\Invoice\InvoiceTest();


if(isset($_POST['add'])) {
    if (isset($_SESSION["cart"][$_POST["Id"]]) && $_SESSION["cart"][$_POST["Id"]] > 0) {
        $_SESSION["cart"][$_POST["Id"]] = $_SESSION["cart"][$_POST["Id"]]+1;
       // echo '<script>alert("Product is already Added to Cart")</script>';
        //echo '<script>window.location="productDetails.php"</script>';

    } else {
        $_SESSION["cart"][$_POST["Id"]] = 1;
    }


}
if (isset($_GET["action"])&&$_GET["action"] == "delete"){
    unset($_SESSION["cart"][$_GET["productId"]]);
    //($_SESSION["cart"][$_GET["productId"]]=($_SESSION["cart"][$_GET["productId"]]-1));
    print'<script>window.location="winkelfunctie.php"</script>';
}



    //unset($_SESSION["cart"][$_GET["productId"]]);


if (isset($_POST['Remove'])){

    $_SESSION["cart"]="";
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
    <h2>Winkelmand</h2>



    <div style="clear: both"></div>

    <div style="overflow-x:auto;">
        <table class="table table-bordered">
            <tr class="Table_Row">
                <th><h5>
                        <form class="RemoveAll" method="post" action="winkelfunctie.php" onclick="return confirm('Weet u zeker dat u alle artikelen uit het winkelmand wilt verwijderen?')">
                            <input type="submit" name="Remove"  value="Alles verwijderen">
                    </h5></th>
                <th><h5>Id</h5></th>
                <th><h5>Artikel naam</h5></th>
                <th><h5>Prijs</h5></th>
                <th><h5>Hoeveelheid</h5></th>

            </tr>

            <?php
            $producten = $winkelwagendetails($conn);
            $total = 0;
            if(!empty($producten)){

            foreach ($producten as $key => $value){




                ?>
            <tr>
                <td>
                    <a href="winkelfunctie.php?action=delete&productId=<?php echo $value['ProductId'] ?>" onclick="return confirm('Weet u zeker dat u dit artikel wilt verwijderen?')">
                        <span class="text-danger"><span class="fas fa-trash"></span></a>
                </td>
                <td> <?php echo $value['ProductId'] ?></td>
                <td> <?php echo $value['Name'] ?></td>
                <td> <?php echo "€". $value['Price'] ?></td>
                <td>
                    <a href="winkelfunctie.php?action=Min&productId=<?php echo $value['ProductId'] ?>">
                        <span class="text-danger"><span class="fas fa-minus"></span></a>

                    &nbsp;&nbsp;
                    <?php

                    if ((isset($_GET["action"]) && $_GET["action"] == "Min")) {
                        ($_SESSION["cart"][$_GET["productId"]] = ($_SESSION["cart"][$_GET["productId"]] - 1));
                    } elseif ((isset($_GET["action"]) && $_GET["action"] == "Plus")) {
                        ($_SESSION["cart"][$_GET["productId"]] = ($_SESSION["cart"][$_GET["productId"]] + 1));
                    }


                    echo $value['Aantal'] ?>
                    &nbsp;&nbsp;

                    <a href="winkelfunctie.php?action=Plus&productId=<?php echo $value['ProductId'] ?>">
                        <span class="text-danger"><span class="fas fa-plus"></span></a>

                </td>





                <?php
                $total = $total + ($value["Aantal"] * $value["Price"]);
                }

            }

          /*/  $cartItem =(count($producten));
            $b=$cartItem;
            echo $b;*/



                     ?>


            </tr>
            <tr>
                <td colspan="4" align="right">Total</td>
                <td align="center">€ <?php echo number_format($total, 2); ?></td>


            </tr>
            <tr><td colspan="4" align="right">Total+BTW</td>
                <td align="center">$<?php $prec =(21/100)*$total; $totalMBTW=$total+$prec; echo number_format($totalMBTW, 2); ?>
                </td>
            </tr>

        </table>
        <form method="post" action="CheckoutPage.php">
            <div class="text-center" style="width: 20%">
                <button type="submit" name="CheckOut" value="Veilig betalen" class="btn btn-success btn-block" style=" border: #66afe9; background-color: #66afe9 ">Besellen afronden</button>
            </div>

        </form>
        <?php
        if(isset($_POST['CheckOut'])){
            print'<script>window.location="CheckOutPage.php"</script>';
        }
        ?>


        <form method="post" action="winkelfunctie.php">
            <input type="submit" name="button1" value="Order">
        </form>
        <?php

            if(isset($_GET['button1']))
            {
                $orderEmail();
                //$InvoiceTest->testSomething();
            }

        ?>


    </div>



</body>
</html>





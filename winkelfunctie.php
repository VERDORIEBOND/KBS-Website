
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
    //unset($_SESSION["cart"][$_GET["productId"]]);
    ($_SESSION["cart"][$_GET["productId"]]=($_SESSION["cart"][$_GET["productId"]]-1));
    print'<script>window.location="winkelfunctie.php"</script>';
}
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
    <h2>Shopping Cart</h2>



    <div style="clear: both"></div>
    <h3 class="title2">Shopping Cart Details</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr class="Table_Row">
                <th><h5>
                        <form class="RemoveAll" method="post" action="winkelfunctie.php" onclick="return confirm('Are you sure want to clear all items?')">
                            <input type="submit" name="Remove"  value="Remove all">
                    </h5></th>
                <th><h5>Id</h5></th>
                <th><h5>Product Name</h5></th>
                <th><h5>Price</h5></th>
                <th><h5>Quantity</h5></th>

            </tr>

            <?php
            $producten = $winkelwagendetails($conn);

            if(!empty($producten)){
            $total = 0;
            foreach ($producten as $key => $value){




                ?>
            <tr>
                <td>
                    <a href="winkelfunctie.php?action=delete&productId=<?php echo $value['ProductId'] ?>" onclick="return confirm('Are you sure want to delete this item?')">
                        <span class="text-danger"><span class="fas fa-trash"></span></a>
                </td>
                <td> <?php echo $value['ProductId'] ?></td>
                <td> <?php echo $value['Name'] ?></td>
                <td> <?php echo "€". $value['Price'] ?></td>
                <td><?php echo $value['Aantal'] ?></td>
                <td>
                    <form aantal="<?= $value['Aantal']?>" action="winkelfunctie.php" method="get" >
                        <div class="form-group">

                            <select name="aantal" style="width 35%; height: 38px; border-radius: 5px" onchange="document.getElementById('<?= $value['Aantal']?>').submit();">
                                <?php

                                for ($i = 1; $i <= 100; $i++) {
                                    if ($i == $value['Aantal']){
                                        print "<span>" . "<option selected value='$i'>$i</option>" . "</span>";
                                    }else{
                                        print "<span>" . "<option value='$i'>$i</option>" . "</span>";
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" name="aantal" value="<?php echo $value['Aantal'] ?>">
                        </div>
                    </form>
                </td>
                <td>
                    <form>

                        <select id="mySelect">
                            <?php
                            for ($i = 1; $i <= 100; $i++) {
                                if ($i == $value['Aantal']){
                                    print "<span>" . "<option selected value='$i'>$i</option>" . "</span>";
                                }else{
                                    print "<span>" . "<option value='$i'>$i</option>" . "</span>";
                                }
                            }

                            ?>
                        </select>
                    </form>



                    <button type="button" onclick="myFunction()">try</button>

                    <script>
                        function myFunction() {
                            document.getElementById("mySelect").value = <?php echo ($value['Aantal'] * $value['Price']) ?> ;
                        }
                    </script>
                </td>
                <td>
                    <input type="number" class="form-control" value="<?php $value['Aantal'] ?>" style="width:35%">
                </td>




                <?php
                $total = $total + ($value["Aantal"] * $value["Price"]);
                }

            }
                     ?>


            </tr>
            <tr>
                <td colspan="4" align="right">Total</td>
                <td align="center">$ <?php echo number_format($total, 2); ?></td>

            </tr>

        </table>
        <form method="get" action="winkelfunctie.php">
            <input type="submit" name="button1" value="Order">
        </form>
        <?php

            if(isset($_GET['button1']))
            {
                //$orderEmail();
                $InvoiceTest->testSomething();
            }

        ?>


    </div>



</body>
</html>





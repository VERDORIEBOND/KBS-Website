<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Product Page</title>

    <link rel="stylesheet" type="text/css" href="Style.css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <link rel="stylesheet" href="ssearchCSS.css">
</head>
<body>

<?php
include "index.php";
include "connection.php";

$completedItems = array();


if(isset($_GET['Verlanglijstje']))//if the search button clicked and the search button must not equal emty value
{
    $search = ($_GET['Verlanglijstje']);
    $query = mysqli_query($conn, "SELECT distinct StockItemName,StockItemID,RecommendedRetailPrice FROM stockitems ");

    echo '<div class="container-fluid">';
    echo '<div class="row">';
    if (isset($_GET['Verlanglijstje'])!=0) { //if the counting does not equal to zero
        while ($row = mysqli_fetch_array($query)) //when the a result is getten then he we will continue to find other results using the "WHILE" loop
        {
            $name = $row['StockItemName'];//the name of the product
            $id = $row['StockItemID'];// ID or the artikel number
            $prijs = $row['RecommendedRetailPrice'];//getting the price as a row from the database
            if (in_array($name, $completedItems) == false) { //if the name is in the array $completedItems then he will not added it

                ?>
                    <div class="card">
                        <a href="WishList.php.php?productId=<?php echo $row["StockItemID"] ?>">
                            <img src="images/no-product-image.png" alt="ProductImage" style="width:100%">
                            <h1><?php echo $name ?></h1>
                            <p class="price"><?php echo $row["RecommendedRetailPrice"]." €"; ?></p>
                            <p><?php echo $row['StockItemName']; ?></p>
                            <span>
                </span>
                    </div>
                </div>
                <?php
            }
          array_push($completedItems,$name);// here will he get the name and the array (the corresponding information that he find about that produc)

        }

    }
    echo ('</div></div>');
    mysqli_free_result($query);//printing the result
}
mysqli_close($conn);
?>





</body>
</html>

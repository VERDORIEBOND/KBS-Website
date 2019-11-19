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
</head>
<body>

<?php

include "connection.php";
/*
// Print categorie namen
$result = mysqli_query($conn,"SELECT StockGroupName FROM StockGroups");
while($row = mysqli_fetch_assoc($result)) {
    foreach ($row as $col => $val) {
        echo $val. "<br>";
    }
}
$search = function ($connection){
    $output = '';
    if(isset($_POST['search'])) {
        $search = $_POST['search'];
        $query = mysqli_query($connection,"SELECT StockItemName FROM stockitems WHERE StockItemName LIKE '%$search%'");
        $count = mysqli_num_rows($query);

        if($count == 0){
            $output = "There were no search results!";
        }else{
            $output = '';
            }

        }
    return $output;
    };

*/


$itemsToProductCards = function ($connection)
{
    $i=0;
    $completedItems = array();
    $result = mysqli_query($connection,"SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem, RecommendedRetailPrice, MarketingComments FROM stockitems;");
    echo '<div class="row">';
    while ($row = mysqli_fetch_assoc($result))
{
// Haalt de titels van de verschillende artikelen op en zet de hoeveelheid kolomen vast (3)
$productName = $row["stockitem"];
$numOfCols = 3;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
if (in_array($productName, $completedItems) == false)
{
    // maakt voor elk artikel een losse kaart aan met de titel, prijs en beschrijving

    //echo $bootstrapColWidth;

        ?>
        <div class="col-md-<?php echo $bootstrapColWidth; ?>">
            <div class="card">
                <img src="images/no-product-image.png" alt="ProductImage" style="width:100%">

                <h1><?php echo $productName ?></h1>
                <p class="price"><?php echo $row["RecommendedRetailPrice"]; ?></p>
                <p><?php echo $row["MarketingComments"]; ?></p>
                <p>
                    <button>In winkelmandje</button>
                </p>
            </div>
        </div>
        <?php
        $rowCount++;
        if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';

    array_push($completedItems,$productName);
        }
        $i ++;
    }
    echo '</div>';

    mysqli_free_result($result);
}

?>

</body>
</html>

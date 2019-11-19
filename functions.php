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

$filterItems = function ()
{
    ?>
    <div class="container-fluid">
    </aside> <!-- col.// -->
    <aside class="col-sm-4">

        <div class="card">
            <article class="card-group-item">
                <header class="card-header">
                    <h6 class="title">Range input </h6>
                </header>
                <div class="filter-content">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Min</label>
                                <input type="number" class="form-control" id="inputEmail4" placeholder="$0">
                            </div>
                            <div class="form-group col-md-6 text-right">
                                <label>Max</label>
                                <input type="number" class="form-control" placeholder="$1,0000">
                            </div>
                        </div>
                    </div> <!-- card-body.// -->
                </div>
            </article> <!-- card-group-item.// -->
            <article class="card-group-item">
                <header class="card-header">
                    <h6 class="title">Selection </h6>
                </header>
                <div class="filter-content">
                    <div class="card-body">
                        <div class="custom-control custom-checkbox">
                            <span class="float-right badge badge-light round">52</span>
                            <input type="checkbox" class="custom-control-input" id="Check1">
                            <label class="custom-control-label" for="Check1">Samsung</label>
                        </div> <!-- form-check.// -->

                        <div class="custom-control custom-checkbox">
                            <span class="float-right badge badge-light round">132</span>
                            <input type="checkbox" class="custom-control-input" id="Check2">
                            <label class="custom-control-label" for="Check2">Black berry</label>
                        </div> <!-- form-check.// -->

                        <div class="custom-control custom-checkbox">
                            <span class="float-right badge badge-light round">17</span>
                            <input type="checkbox" class="custom-control-input" id="Check3">
                            <label class="custom-control-label" for="Check3">Samsung</label>
                        </div> <!-- form-check.// -->

                        <div class="custom-control custom-checkbox">
                            <span class="float-right badge badge-light round">7</span>
                            <input type="checkbox" class="custom-control-input" id="Check4">
                            <label class="custom-control-label" for="Check4">Other Brand</label>
                        </div> <!-- form-check.// -->
                    </div> <!-- card-body.// -->
                </div>
            </article> <!-- card-group-item.// -->
        </div> <!-- card.// -->



    </aside> <!-- col.// -->
    </div> <!-- row.// -->

    </div>
    <!--container end.//-->
    </div>

    <?php
};

$itemsToProductCards = function ($connection)
{
    $i=0;
    $completedItems = array();
    $result = mysqli_query($connection,"SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem, RecommendedRetailPrice, MarketingComments, StockItemID FROM stockitems;");
    echo '<div class="container-fluid">';
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
                <a href="ProductDetails.php?productId=<?php echo $row["StockItemID"] ?>">
                <img src="images/no-product-image.png" alt="ProductImage" style="width:100%">
                <h1><?php echo $productName ?></h1>
                <p class="price"><?php echo $row["RecommendedRetailPrice"]." €"; ?></p>
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
    echo '</div></div>';

    mysqli_free_result($result);
}

?>

</body>
</html>

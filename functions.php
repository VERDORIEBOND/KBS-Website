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


$checkIfCategory = function ($connection,$navCategory)
{
    $onceTrue = false;                                                          //this value will be returned once we have determined of the category exists in our database
    $sql = "SELECT StockGroupName FROM wideworldimporters.stockgroups";         //We select all known category's from our database
    $result = mysqli_query($connection,$sql);
    while ($row = mysqli_fetch_assoc($result))                                  //For each result from the database we check if the given category matches with the existing category's
{
    if ($row['StockGroupName'] == $navCategory)
    {
        $onceTrue = true;
    }
    if($onceTrue == true)
    {
        return $onceTrue;
    }
}
};
$itemsCategory = function ($connection, $category)                              //With this function we display all items corresponding to a specific category
{
    $completedItems = array();                                                  //We keep track of all item names we have made a product card of in an array so we dont get anny duplicate cards
    $sql = "SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem, RecommendedRetailPrice, MarketingComments, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID WHERE o.StockGroupName = '$category'";
    $result = mysqli_query($connection,$sql);
    echo '<div class="container-fluid">';                                       //All the product cards we crate will be in this container
    echo '<div class="row">';
    while ($row = mysqli_fetch_assoc($result))                                  //For each result in our SQL query we will make a product card with the product details.
    {
// Haalt de titels van de verschillende artikelen op en zet de hoeveelheid kolomen vast (3)
        $productName = $row["stockitem"];
        $numOfCols = 3;                                                         //The amount of rows we want the products to display in
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
        if (in_array($productName, $completedItems) == false)                   //Check if we didnt yet make a product card for the product
        {
                                                                                // maakt voor elk artikel een losse kaart aan met de titel, prijs en beschrijving
            ?>
            <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                <div class="card">
                    <a href="ProductDetails.php?productId=<?php echo $row["StockItemID"] ?>">
                        <img src="images/no-product-image.png" alt="ProductImage" style="width:100%">
                        <h1><?php echo $productName ?></h1>
                        <p class="price"><?php echo $row["RecommendedRetailPrice"]." €"; ?></p>
                        <p><?php echo $row["MarketingComments"]; ?></p>
                        <span>
                    <p>
                        <button>In winkelmandje</button>
                    </p>
                </span>
                </div>
            </div>
            <?php
            $rowCount++;
            if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';

            array_push($completedItems,$productName);                      //Once we made a product card we add the product to the array with products we made so it wont be made again
        }
    }
    echo '</div></div>';

    mysqli_free_result($result);
};
//Haalt de naam op van een artikel en print hem

/*
$detailprinter = function ($connection) {
    $numFromUrl = $_GET['productId'];
    $sql= "SELECT StockItemID, StockItemName From stockitems WHERE StockItemID = '$numFromUrl'";
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_array($result))   {
        echo $row['StockItemName'];

    }
};
*/




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
                    <span>
                        <p>
                            <button>In winkelmandje</button>
                        </p>
                    </span>
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
};
//Haalt de naam op van een artikel en print hem

$detailPrinter = function ($connection) {
    $numFromUrl = $_GET['productId'];
    $sql = "SELECT StockItemID, StockItemName FROM stockitems WHERE StockItemID = '$numFromUrl'";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo $row['StockItemName'];
    }
};
//deze functie kijkt wat een artikel kost en print de prijs uit de database
$prijsgever = function ($connection) {
    $numFromUrl = $_GET['productId'];
    $result = mysqli_query($connection,"SELECT StockItemID, StockItemName,RecommendedRetailPrice FROM stockitems WHERE StockItemID = '$numFromUrl'");
    while ($row = mysqli_fetch_assoc($result)){
        echo "€". $row["RecommendedRetailPrice"];
    }
};
//deze funtie kijkt hoeveel voorraad er bij het gekozen product horen
$stockzoeker = function ($connection)   {
    $numFromUrl = $_GET['productId'];
    $query = "SELECT StockItemID, QuantityOnHand FROM stockitemholdings WHERE StockItemID = '$numFromUrl'";
    $result2 = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result2)) {
        echo "Voorraad = " . $row ['QuantityOnHand'];
    }
};
$tempShower = function ($connection)   {
    $numFromUrl = $_GET['productId'];
    $query = "SELECT c.Temperature, s.StockItemID FROM coldroomtemperatures c JOIN stockitems s on c.ColdRoomSensorNumber = s.IsChillerStock where s.StockItemID = '$numFromUrl' AND s.IsChillerStock = 1;";
    $result2 = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result2)) {
        echo "Temperatuur Koeling = " . $row ['Temperature']. "°C " ;
    }
};
function PostcodeCheck($postcode)
{
    $remove = str_replace(" ","", $postcode);
    $upper = strtoupper($remove);

    if( preg_match("/^\b[1-9]\d{3}\s*[A-Z]{2}\b$/",  $upper)) {
        return $upper;
    } else {
        return false;
    }
}

$imgCategory = function ($category)
{
    if($category == 'Airline Novelties')
    {
        return "images/categories/Airline%20Novelties.png";
    }
    if($category == 'Clothing')
    {
        return "images/categories/Clothing.png";
    }
    if($category == 'Computing Novelties')
    {
        return "images/categories/Computer%20Novelties.png";
    }
    if($category == 'Furry Footwear')
    {
        return "images/categories/Furry%20Footwear.png";
    }
    if($category == 'Mugs')
    {
        return "images/categories/Mugs.png";
    }
    if($category == 'Novelty Items')
    {
        return "images/categories/Novelty%20Items.png";
    }
    if($category == 'Packaging Materials')
    {
        return "images/categories/Packing%20Materials.png";
    }
    if($category == 'T-Shirts')
    {
        return "images/categories/T-Shirts.png";
    }
    if($category == 'Toys')
    {
        return "images/categories/Toys.png";
    }
    if($category == 'USB Novelties')
    {
        return "images/categories/USB%20Novelties.png";
    }
}

?>


</body>
</html>

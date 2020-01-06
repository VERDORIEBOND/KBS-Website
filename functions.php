<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Product Page</title>

    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
</head>
<body>

<?php
include "connection.php";
error_reporting(0);
session_start();




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




$itemsCategory = function ($connection, $category, $imgDirectory, $discount)                              //With this function we display all items corresponding to a specific category
{
    // Gets pagenr from URL if nothing is returned sets pagenr to 1
    if (isset($_GET['pagenr'])){
        $pagenr = $_GET['pagenr'];
    } else {
        $pagenr = 1;
    }


    $nr_of_records_per_page = $_GET['itemspp'];             // Gets number of records per page from URL, standard numbers of records per page is set via link on Index.php
    if (isset($_POST['use_button'])) {                      // Sets numbers of records per page to a user defined number
        $nr_of_records_per_page = 25;
    }
    if (isset($_POST['use_button1'])) {
        $nr_of_records_per_page = 50;
    }
    if (isset($_POST['use_button2'])) {
        $nr_of_records_per_page = 75;
    }
    if (isset($_POST['use_button3'])) {
        $nr_of_records_per_page = 100;
    }

   // Buttons for sorting the page and setting number of records per page
    echo
    "<form action='' method='post'>          
<p1 class='Resultaten'><p1>Resultaten per pagina:</p1><p2>Sorteer op:<br></p2>
<input class='Sort' type='submit' name='use_button' value='25' />
<input type='submit' name='use_button1' value='50' />
<input type='submit' name='use_button2' value='75' />
<input type='submit' name='use_button3' value='100' />
<a class='OrderbynameASC' href='productPage.php?productGroup="; echo $category; echo"&itemspp=10&orderby=StockItemName ASC'>Naam(oplopend)</a>
<a class='OrderbynameASC' href='productPage.php?productGroup="; echo $category; echo"&itemspp=10&orderby=StockItemName DESC'>Naam(aflopend)</a>
<a class='OrderbyPrice' href='productPage.php?productGroup="; echo $category; echo"&itemspp=10&orderby=RecommendedRetailPrice ASC'>Prijs(oplopend)</a>
<a class='OrderbyPrice' href='productPage.php?productGroup="; echo $category; echo"&itemspp=10&orderby=RecommendedRetailPrice DESC'>Prijs(aflopend)</a>
</form>";

    // Pagination
    $offset = ($pagenr-1) * $nr_of_records_per_page;
    $maxitemspp = $pagenr * $nr_of_records_per_page;
    $total_rows = "SELECT COUNT(*) as aantal FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID WHERE o.StockGroupName = '$category' ";
    $result_rows = mysqli_query($connection, $total_rows);
    $row = mysqli_fetch_assoc($result_rows);
    $total_pages = ceil( $row["aantal"]/ $nr_of_records_per_page);

    // Gets the order name for URL to define the sorting function
    $ordername = $_GET['orderby'];

    $completedItems = array();                                                  //We keep track of all item names we have made a product card of in an array so we dont get anny duplicate cards
    $sql = "SELECT distinct StockItemName , RecommendedRetailPrice, MarketingComments, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID WHERE o.StockGroupName = '$category' ORDER BY $ordername LIMIT $offset, $maxitemspp";
    $result = mysqli_query($connection,$sql);
    echo '<div class="container-fluid">';                                       //All the product cards we crate will be in this container
    echo '<div class="row">';
    while ($row = mysqli_fetch_assoc($result))                                  //For each result in our SQL query we will make a product card with the product details.
    {
// Haalt de titels van de verschillende artikelen op en zet de hoeveelheid kolomen vast (3)
        $productName = $row["StockItemName"];
        $numOfCols = 3;                                                         //The amount of rows we want the products to display in
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
        if (in_array($productName, $completedItems) == false)                   //Check if we didnt yet make a product card for the product
        {
                                                                                // we make a product card for every item returned from the sql query with the corresponding title, price and description
            ?>
            <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                <div class="card">
                    <a href="productDetails.php?productId=<?php echo $row["StockItemID"] ?>">
                        <img src="<?php echo $imgDirectory ?>" alt="ProductImage" style="width:100%">

                        <h1><?php echo $productName ?></h1>
                        <p class="price">
                            <?php
                            if($discount == 0)                                  // if a product is on sale we add the old price crossed out and the new price in bold letters and another color
                            {
                                echo $row["RecommendedRetailPrice"]." €";
                            }
                            else
                            {
                                $discountPrice = round($row["RecommendedRetailPrice"] / 100 * (100 - $discount), 2);
                                echo "<p style='text-decoration: line-through; text-line-through-color: red'>" . $row["RecommendedRetailPrice"] . "€" ."</p>";
                                echo "<p style='font-weight: bold; color: red'>" . " $discountPrice €" . "</p>";
                            }

                            ?>

                        </p>
                        <p><?php echo $row["MarketingComments"]; ?></p>
                        <span>
                            <p>
                                <button>Meer Details</button>
                            </p>
                        </span>
                    </a>
                </div>
            </div>
            <?php
            $rowCount++;
            if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';

            array_push($completedItems,$productName);                      //Once we made a product card we add the product to the array with products we already made so it wont be made again
        }
    }
    echo '</div></div>';
?>
    <!-- Buttons for First, Prev, Next, Last -->
    <div class="container">
        <ul class="pagination">
            <li><a href="?productGroup=<?php echo $category; ?>&pagenr=1&itemspp=<?php echo $nr_of_records_per_page."&orderby=".$ordername; ?>">First</a></li>
            <li class="<?php if($pagenr <= 1){ echo '#'; } ?>">
            <li class="Prev-buton" >
                <a href="<?php if($pagenr <= 1){ echo '#'; } else { echo"?productGroup=".$category."&pagenr=".($pagenr - 1)."&itemspp=".$nr_of_records_per_page."&orderby=".$ordername; } ?>">Prev</a>
            </li>
            <li class="<?php if($pagenr >= $total_pages){ echo '#'; } ?>">
                <a href="<?php if($pagenr >= $total_pages){ echo '#'; } else { echo "?productGroup=".$category.'&itemspp='.$nr_of_records_per_page."&pagenr=".($pagenr + 1)."&orderby=".$ordername; } ?>">Next</a>
            </li>
            <li><a href="?productGroup=<?php echo $category; ?>&itemspp=<?php echo $nr_of_records_per_page;?>&pagenr=<?php echo $total_pages."&orderby=".$ordername; ?>">Last</a></li>
        </ul>
    </div>
<?php

    mysqli_free_result($result);                                                    // here we clear the results from the SQL query
};

$filterItems = function ()                                                          // the filter function is currently not implemented in the website
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
    // Gets pagenr from URL if nothing is returned sets pagenr to 1
    if (isset($_GET['pagenr'])){
        $pagenr = $_GET['pagenr'];
    } else {
        $pagenr = 1;
    }

    $nr_of_records_per_page = $_GET['itemspp'];     // Gets number of records per page from URL, standard numbers of records per page is set via link on Index.php

    if (isset($_POST['use_button']))                // Sets numbers of records per page to a user defined number
    {
        $nr_of_records_per_page = 25;
    }
    if (isset($_POST['use_button1']))
    {
        $nr_of_records_per_page = 50;
    }
    if (isset($_POST['use_button2']))
    {
        $nr_of_records_per_page = 75;
    }
    if (isset($_POST['use_button3']))
    {
        $nr_of_records_per_page = 100;
    }



    // Buttons for sorting the page and setting number of records per page
    echo
    "<form action='' method='post'>
<p class='Resultaten'><p1>Resultaten per pagina:</p1><p2>Sorteer op:<br></p2>
<input class='Sort25' type='submit' name='use_button' value='25' />
<input class='Sort50' type='submit' name='use_button1' value='50' />
<input class='Sort75' type='submit' name='use_button2' value='75' />
<input class='Sort100' type='submit' name='use_button3' value='100' />
<a class='OrderbynameASC' href='productPage.php?&itemspp=$nr_of_records_per_page&orderby=StockItemName ASC'>Naam(oplopend)</a>
<a class='OrderbynameASC' href='productPage.php?&itemspp=$nr_of_records_per_page&orderby=StockItemName DESC'>Naam(aflopend)</a>
<a class='OrderbyPrice' href='productPage.php?&itemspp=$nr_of_records_per_page&orderby=RecommendedRetailPrice ASC'>Prijs(oplopend)</a>
<a class='OrderbyPrice' href='productPage.php?&itemspp=$nr_of_records_per_page&orderby=RecommendedRetailPrice DESC'>Prijs(aflopend)</a>
</form>";

    // Pagination
    $offset = ($pagenr-1) * $nr_of_records_per_page;
    $maxitemspp = $pagenr * $nr_of_records_per_page;
    $total_rows = "SELECT COUNT(*) as aantal FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID";
    $result_rows = mysqli_query($connection, $total_rows);
    $row = mysqli_fetch_assoc($result_rows);
    $total_pages = ceil( $row["aantal"]/ $nr_of_records_per_page);


    // Gets the order name for URL to define the sorting function
    $ordername = $_GET['orderby'];


    $i=0;
    $completedItems = array();
    $sql = "SELECT StockItemName, RecommendedRetailPrice, MarketingComments, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID ORDER BY $ordername LIMIT $offset, $nr_of_records_per_page";
    $result = mysqli_query($connection, $sql);

    echo '<div class="container-fluid">';
    echo '<div class="row">';

    while ($row = mysqli_fetch_assoc($result))
{
// Haalt de titels van de verschillende artikelen op en zet de hoeveelheid kolomen vast (3)
$productName = $row["StockItemName"];
$numOfCols = 3;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;

// for each product we get the product group name to determine the group image corresponding to the product, as each product group has a separate image
        if($row['StockGroupName'] == 'Airline Novelties')
        {
            $imgDirectory = "images/categories/Airline%20Novelties.png";
        }
        if($row['StockGroupName'] == 'Clothing')
        {
            $imgDirectory = "images/categories/Clothing.png";
        }
        if($row['StockGroupName'] == 'Computing Novelties')
        {
            $imgDirectory = "images/categories/Computer%20Novelties.png";
        }
        if($row['StockGroupName'] == 'Furry Footwear')
        {
            $imgDirectory = "images/categories/Furry%20Footwear.png";
        }
        if($row['StockGroupName'] == 'Mugs')
        {
            $imgDirectory = "images/categories/Mugs.png";
        }
        if($row['StockGroupName'] == 'Novelty Items')
        {
            $imgDirectory = "images/categories/Novelty%20Items.png";
        }
        if($row['StockGroupName'] == 'Packaging Materials')
        {
            $imgDirectory = "images/categories/Packing%20Materials.png";
        }
        if($row['StockGroupName'] == 'T-Shirts')
        {
            $imgDirectory = "images/categories/T-Shirts.png";
        }
        if($row['StockGroupName'] == 'Toys')
        {
            $imgDirectory = "images/categories/Toys.png";
        }
        if($row['StockGroupName'] == 'USB Novelties')
        {
            $imgDirectory = "images/categories/USB%20Novelties.png";
        }

if (in_array($productName, $completedItems) == false)   // if the product is'nt in the array with completed items (items that already have a product card)
{
    // we make a product card for every item returned from the sql query with the corresponding title, price and description
        ?>
        <div class="col-md-<?php echo $bootstrapColWidth; ?>">
            <div class="card">
                <a href="productDetails.php?productId=<?php echo $row["StockItemID"] ?>">
                <img src="<?php echo $imgDirectory ?>" alt="ProductImage" style="width:100%">

                <h1><?php echo $productName ?></h1>
                <p class="price"><?php echo $row["RecommendedRetailPrice"]." €"; ?></p>
                <p><?php echo $row["MarketingComments"]; ?></p>
                    <span>
                        <p>
                            <button>Meer Details</button>
                        </p>
                    </span>
                </a>
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



    ?>
    <!--- Buttons for First,Prev,Next,Last --->
<div class="container">
        <ul class="pagination">
            <li><a href="?pagenr=1&itemspp=<?php echo $nr_of_records_per_page."&orderby=".$ordername; ?>">First</a></li>
            <li class="<?php if($pagenr <= 1){ echo 'disabled'; } ?>">
            <li class="Prev-buton" >
                <a href="<?php if($pagenr <= 1){ echo '#'; } else { echo "?pagenr=".($pagenr - 1)."&itemspp=".$nr_of_records_per_page."&orderby=".$ordername; } ?>">Prev</a>
            </li>
            <li class="<?php if($pagenr >= $total_pages){ echo 'disabled'; } ?>">
                <a href="<?php if($pagenr >= $total_pages){ echo 'disabled'; } else { echo "?pagenr=".($pagenr + 1).'&itemspp='.$nr_of_records_per_page."&orderby=".$ordername; ;} ?>">Next</a>
            </li>
            <li><a href="?pagenr=<?php echo $total_pages; ?>&itemspp=<?php echo $nr_of_records_per_page."&orderby=".$ordername;?>">Last</a></li>
        </ul>
</div>
<?php

    mysqli_free_result($result);
};

//Gets the name from the database and shows him
$detailPrinter = function ($connection) {
    $numFromUrl = $_GET['productId'];
    $sql = "SELECT StockItemID, StockItemName,RecommendedRetailPrice FROM stockitems WHERE StockItemID = '$numFromUrl'";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo $row['StockItemName'];
    }
};
//This function looks up how much a product costs and shows it
$prijsgever = function ($connection) {
    $numFromUrl = $_GET['productId'];
    $result = mysqli_query($connection,"SELECT StockItemID, StockItemName,RecommendedRetailPrice FROM stockitems WHERE StockItemID = '$numFromUrl'");
    while ($row = mysqli_fetch_assoc($result)){
        echo "€". $row["RecommendedRetailPrice"];
    }
};
//This function looks how much stock there is of a product and shows it
$stockzoeker = function ($connection)   {
    $numFromUrl = $_GET['productId'];
    $query = "SELECT StockItemID, QuantityOnHand FROM stockitemholdings WHERE StockItemID = '$numFromUrl'";
    $result2 = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result2)) {
        echo "Voorraad = " . $row ['QuantityOnHand'];
    }
};

$winkelwagendetails = function($connection) {
    $returnValue = []; ?>

    <?php
    foreach ($_SESSION["cart"] as $key => $value) {
        if ($value > 0) {
            $query = "SELECT StockItemID, StockItemName,RecommendedRetailPrice FROM stockitems WHERE StockItemID ='$key'";
            //  $query="SELECT StockItemName, RecommendedRetailPrice, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID WHERE StockItemID ='$key';";

            $results = mysqli_query($connection, $query);
            $row = mysqli_fetch_array($results, MYSQLI_BOTH);
            $productdetails = ["ProductId" => $row["StockItemID"], "Name" => $row["StockItemName"], "Price" => $row["RecommendedRetailPrice"], "Aantal" => $value];
            array_push($returnValue, $productdetails);
        }

    }
    return $returnValue;
};

$verlanglijstdetails = function($connection) {
    $returnValue = []; ?>

    <?php
    foreach ($_SESSION["verlang"] as $key => $value) {
        if ($value > 0) {
            $query = "SELECT StockItemID, StockItemName,RecommendedRetailPrice FROM stockitems WHERE StockItemID ='$key'";
            //  $query="SELECT StockItemName, RecommendedRetailPrice, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID WHERE StockItemID ='$key';";

            $results = mysqli_query($connection, $query);
            $row = mysqli_fetch_array($results, MYSQLI_BOTH);
            $wishlistdetails = ["ProductId" => $row["StockItemID"], "Name" => $row["StockItemName"], "Price" => $row["RecommendedRetailPrice"], "Aantal" => $value];
            array_push($returnValue, $wishlistdetails);
        }

    }
    return $returnValue;
};
//This function looks up if the product is a cooled product and shows it only when a product is cooled
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
};
function database_read($connection, $orderId)
{
    $sql1="SELECT orderstatus FROM ordersprivate WHERE OrderID = ?";
    if($stmt1=mysqli_prepare($connection,$sql1)){
        mysqli_stmt_bind_param($stmt1, "i", $param_orderid);
        $param_orderid=$orderId;
        if(mysqli_stmt_execute($stmt1)){
            mysqli_stmt_store_result($stmt1);
            mysqli_stmt_bind_result($stmt1, $status);
        }
    }
    return $status ? $status : "unknown order";
}

function database_write($connection,$orderId, $status, $price, $email, $firstname, $lastname, $adres, $postal, $city, $phone)
{
    $orderId = intval($orderId);
    $database = dirname(__FILE__) . "/database/order-{$orderId}.txt";

    file_put_contents($database, $status);
    $sql1 = "INSERT INTO ordersprivate (OrderID, orderstatus, price, email, first_name, last_name, adres, postal, city, phone) VALUES (?,?,?,?,?,?,?,?,?,?)";
    if($stmt1=mysqli_prepare($connection,$sql1)) {
        mysqli_stmt_bind_param($stmt1, "isssssssss", $param_OrderID, $param_status, $param_price, $param_email, $param_firstname, $param_lastname, $param_adres, $param_postal, $param_city, $param_phone);
        $param_email=$email;
        $param_OrderID=$orderId;
        $param_status=$status;
        $param_price=$price;
        $param_firstname=$firstname;
        $param_lastname=$lastname;
        $param_adres=$adres;
        $param_postal=$postal;
        $param_city=$city;
        $param_phone=$phone;
        if(mysqli_stmt_execute($stmt1)){
            return true;
        } else{
            echo "Er is een fout opgetreden in het systeem";
        }
    }
}
function database_update($connection, $orderid, $status)
{
    $sql1= "UPDATE ordersprivate SET orderstatus = ? WHERE OrderID = ?";
    if($stmt1=mysqli_prepare($connection,$sql1)){
        mysqli_stmt_bind_param($stmt1, "ss", $status, $OrderID);
        mysqli_stmt_execute($stmt1);
    }
}
?>


</body>
</html>

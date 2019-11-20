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
include "index.php";
include "connection.php";

$completedItems = array();
$output="";

if(isset($_GET['search']) && $_GET['search'] !== '')
{
    $search = $_GET['search'];
    $query = mysqli_query($conn, "SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem,StockItemID,RecommendedRetailPrice FROM stockitems WHERE StockItemName LIKE '%$search%' OR StockItemID LIKE '$search'");
    $c = mysqli_num_rows($query);
    echo '<div class="container-fluid">';
    echo '<div class="row">';
    if ($c == 0)
    {
        $output = 'Geen resultaat voor <b>"' . $search . '"</b>';
    }
    else {
        while ($row = mysqli_fetch_array($query))
        {

            $numOfCols = 3;
            $rowCount = 0;
            $bootstrapColWidth = 12 / $numOfCols;
            $name = $row['stockitem'];
            $id = $row['StockItemID'];
            $prijs = $row['RecommendedRetailPrice'];
            if (in_array($name, $completedItems) == false) {


                ?>
                <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                    <div class="card">
                        <a href="ProductDetails.php?productId=<?php echo $row["StockItemID"] ?>">
                            <img src="images/no-product-image.png" alt="ProductImage" style="width:100%">
                            <h1><?php echo $name ?></h1>
                            <p class="price"><?php echo $row["RecommendedRetailPrice"]." €"; ?></p>
                            <p><?php echo $row['stockitem']; ?></p>
                            <span>
                    <p>
                        <button>In winkelmandje</button>
                    </p>
                </span>
                    </div>
                </div>
                <?php
            }
            $rowCount++;
            if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';
            array_push($completedItems,$name);
            $output .= "$name<br>";
        }

    }
    echo ('</div></div>');
    mysqli_free_result($query);
}



mysqli_close($conn);
?>





</body>
</html>

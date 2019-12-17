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
    <link rel="stylesheet" href="ssearchCSS.css">
    <?php
    include "index.php";
    include "connection.php";
    include "functions.php";
    ?>
</head>
<body>

<?php




$completedItems = array();
$output="";

if(isset($_GET['search']) && $_GET['search'] !== '')//if the search button clicked and the search button must not equal emty value
{
    $search = trim($_GET['search']);
    $query = mysqli_query($conn, "SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem,StockItemID,RecommendedRetailPrice FROM stockitems WHERE StockItemName LIKE '%$search%' OR StockItemID LIKE '$search'");
    //here above will show the informarion from the DataBase using the database in the SQL
    $numberOfrows = mysqli_num_rows($query);// counting the result

    echo '<div class="container-fluid">';
    echo '<div class="row">';
    if ($numberOfrows == 0)//if the counting result is zero then it will print the next phrase
    {
        $output = "<h1>Geen resultaat voor <b>  '$search'</b></h1>";
        print($output);

    }
    else { //if the counting does not equal to zero
        while ($row = mysqli_fetch_array($query)) //when the a result is getten then he we will continue to find other results using the "WHILE" loop
        {

            $numOfCols = 3; //number of colums will show just as three colums
            $rowCount = 0;// here will counting the colums from the product
            $bootstrapColWidth = 12 / $numOfCols;
            $name = $row['stockitem'];//the name of the product
            $id = $row['StockItemID'];// ID or the artikel number
            $prijs = $row['RecommendedRetailPrice'];//getting the price as a row from the database
            if (in_array($name, $completedItems) == false) { //if the name is in the array $completedItems then he will not added it




                ?>
                <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                    <div class="card">
                        <a href="productDetails.php?productId=<?php echo $row["StockItemID"] ?>">
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
            $rowCount++;//here will continues to count
            if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';//if the counting for the row and the moduls of the columens number is equal 0 then print
            array_push($completedItems,$name);// here will he get the name and the array (the corresponding information that he find about that produc)
            $output .= "$name<br>";
        }

    }
    echo ('</div></div>');
    mysqli_free_result($query);//printing the result
}



mysqli_close($conn);
?>





</body>
</html>

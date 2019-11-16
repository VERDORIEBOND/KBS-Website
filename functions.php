<?php

include "connection.php";

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






$itemsToProductCards = function ($connection)
{
    $completedItems = array();
    $result = mysqli_query($connection,"SELECT StockItemName, RecommendedRetailPrice, Photo FROM stockitems;");
    while ($row = mysqli_fetch_assoc($result))
    {
        $shortItem = substr($row["StockItemName"],0,10);
        $resultString = $row["StockItemName"];
        if (strpos($resultString, '-') !== false)
        {
            $itemName = strstr($row["StockItemName"],'-',true);
        }
        elseif (strpos($resultString, '(') !== false)
        {
            $itemName = strstr($row["StockItemName"],'(',true);
        }


        if(!in_array($shortItem,$completedItems))
        {
            ?>
            <div class="card">
                <h1><?php echo $itemName ?></h1>
                <p class="price"><?php echo $row["RecommendedRetailPrice"]; ?></p>
                <p>Some text about the jeans..</p>
                <p>
                    <button>Add to Cart</button>
                </p>
            </div>
            <?php
        }
        array_push($completedItems, $shortItem);
    }
print_r($completedItems);
    mysqli_free_result($result);
}












?>
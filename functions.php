<?php

include "connection.php";

// Print categorie namen
$result = mysqli_query($conn,"SELECT StockGroupName FROM StockGroups");
while($row = mysqli_fetch_assoc($result)) {
    foreach ($row as $col => $val) {
        echo $val. "<br>";
    }
}
$search = function ($connection,$search){
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

        $image_data = $row["Photo"];
        $encoded_image = base64_encode($image_data);
        $itemName = strstr($row["StockItemName"],'-',true);
        //You dont need to decode it again.
        $Hinh = "<img src='data:image/jpeg;base64,$encoded_image' alt=\"$itemName\">";


        if(!in_array($shortItem,$completedItems))
        {
            ?>
            <div class="card">
                <?php echo $Hinh ?>
                <h1><?php echo $row["StockItemName"]; ?></h1>
                <p class="price"><?php echo $row["RecommendedRetailPrice"]; ?>></p>
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
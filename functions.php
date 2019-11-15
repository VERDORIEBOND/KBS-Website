<?php

include "connection.php";

// Print categorie namen
$result = mysqli_query($conn,"SELECT StockGroupName FROM StockGroups");
while($row = mysqli_fetch_assoc($result)) {
    foreach ($row as $col => $val) {
        echo $val. "<br>";
    }
}
function Search($search){
    if(isset($_POST['search'])) {
        $search = $_POST['search'];
        $query = mysqli_query("SELECT StockItemName FROM stockitems WHERE StockItemName LIKE '%$search%'");
        $count = mysqli_num_rows($query);

        if($count == 0){
            $output = "There was no search results!";

        }else{

            }

        }
    }
}


?>
<?php

include "connection.php";

// Print categorie namen
$result = mysqli_query($conn,"SELECT StockGroupName FROM StockGroups");
while($row = mysqli_fetch_assoc($result)) {
    foreach ($row as $col => $val) {
        echo $val. "<br>";
    }
}



?>
<?php
include "connection.php";

$output="";
if(isset($_GET['search']) && $_GET['search'] !== ' ') {
    $search = $_GET['search'];
    $query = mysqli_query($conn, "SELECT StockItemName,StockItemID FROM stockitems WHERE StockItemName LIKE '%$search%' OR StockItemID LIKE '%$search%'");
    $c = mysqli_num_rows($query);
    if ($c != 0) {
        while ($row = mysqli_fetch_array($query)) {
            $name = $row['StockItemName'];
            $id = $row['StockItemID'];
            $output += "$name<br>";
        }

    } else {
        $output = 'Geen resultaat voor <b>"' . $search . '"</b>';

    }
}
    print("$output");
    mysqli_close($conn);
?>
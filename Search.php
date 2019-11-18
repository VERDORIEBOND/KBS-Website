<?php
include "connection.php";

$completedItems = array();
$output="";

if(isset($_GET['search']) && $_GET['search'] !== ' ') {
    $search = $_GET['search'];
    $query = mysqli_query($conn, "SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem,StockItemID,RecommendedRetailPrice FROM stockitems WHERE StockItemName LIKE '%$search%' OR StockItemID LIKE '$search'");
    $c = mysqli_num_rows($query);
    if ($c == 0) {
        $output = 'Geen resultaat voor <b>"' . $search . '"</b>';
    } else {
        while ($row = mysqli_fetch_array($query)) {
            $name = $row['stockitem'];
            $id = $row['StockItemID'];
            $prijs = $row['RecommendedRetailPrice'];
            if (in_array($name, $completedItems) == false) {
            $output .= "$name<br>";
            }
            array_push($completedItems,$name);
        }
    }
}
    print("$output");
    mysqli_close($conn);
?>
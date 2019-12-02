<html>
<head>
    <title>Pagination</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php

include"connection.php";
include "functions.php";




if (isset($_GET['pagenr'])){
    $pagenr = $_GET['pagenr'];
} else {
    $pagenr = 1;
}

$nr_of_records_per_page = 25;
$offset = ($pagenr-1) * $nr_of_records_per_page;
$category = "";

if (isset($_GET['productGroup'])){
    $category = $_GET['productGroup'];
}


$total_pages_sql = "SELECT COUNT(*) as aantal FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID WHERE o.StockGroupName = '$category' LIMIT 0, 5";
$result = mysqli_query($conn,$total_pages_sql);
$row = $result->fetch_assoc();
$total_rows = $row["aantal"];
mysqli_free_result($result);
$total_pages = ceil( $total_rows/ $nr_of_records_per_page);

$itemsCategoryLimit($conn, $category, $offset, $nr_of_records_per_page);



?>
<ul class="pagination">
    <li><a href="?pagenr=1&productGroup=<?php echo $category ?>">First</a></li>
    <li class="<?php if($pagenr <= 1){ echo 'disabled'; } ?>">
    <li class="Prev-buton" >
        <a href="<?php if($pagenr <= 1){ echo '#'; } else { echo "?pagenr=".($pagenr - 1)."&productGroup=".$category; } ?>">Prev</a>
    </li>
    <li class="<?php if($pagenr >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pagenr >= $total_pages){ echo '#'; } else { echo "?pagenr=".($pagenr + 1)."&productGroup=".$category; } ?>">Next</a>
    </li>
    <li><a href="?pagenr=<?php echo $total_pages; ?>">Last</a></li>
</ul>
</body>
</html>



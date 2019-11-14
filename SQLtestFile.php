<?php

$host = "localhost";
$databasename = "wideworldimporters";
$user = "root";
$pass = "";
$port = 3306;
$connection = mysqli_connect($host, $user, $pass, $databasename, $port);

$result = mysqli_query($connection, "SELECT * FROM stockitems");

$stockitems = mysqli_fetch_all($result,MYSQLI_ASSOC);

print_r($stockitems)

mysqli_free_result($result);
mysqli_close($connection);

?>
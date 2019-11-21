<?php

$host = "localhost";
$databasename = "wideworldimporters";
$user = "root";
$password = "";
$port = 3306;

// Create connection
$conn = mysqli_connect($host,$user,$password,$databasename,$port);

// Check connection
if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}





?>
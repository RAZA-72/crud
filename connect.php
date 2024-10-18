<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "crudimg";

$conn = mysqli_connect($host,$user,$pass,$db);
mysqli_select_db($conn,$db);

$sql = mysqli_select_db($conn,$db);







?>
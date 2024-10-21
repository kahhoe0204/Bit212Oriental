<?php

// $host = getenv('DB_HOST');
// $port = getenv('DB_PORT');
// $database = getenv('DB_DATABASE');
// $username = getenv('DB_USERNAME');
// $password = getenv('DB_PASSWORD');


$host="localhost";
$port=3306;
$database="u804333930_rosshen";
$username="u804333930_rosshen";
$password="9>n0S]hWKG";

// global $conn;

$conn = new mysqli($host,$username,$password,$database);

if (mysqli_connect_errno()) {
    die("Connection failed: " . $conn->connect_error);
  }

?>
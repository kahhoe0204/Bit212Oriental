<?php

// $host = getenv('DB_HOST');
// $port = getenv('DB_PORT');
// $database = getenv('DB_DATABASE');
// $username = getenv('DB_USERNAME');
// $password = getenv('DB_PASSWORD');


$host = "demodb.c5hxytuvasqh.us-east-1.rds.amazonaws.com";  // RDS Endpoint
$port = 3306;                                                // MySQL Port
$database = "product";                                     // Database Name
$username = "wordpress";                                     // Username
$password = "wordpress-pass";                                // Password

// global $conn;

$conn = new mysqli($host,$username,$password,$database,$port);

if (mysqli_connect_errno()) {
    die("Connection failed: " . $conn->connect_error);
  }

?>
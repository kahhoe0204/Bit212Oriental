<?php
require_once  '../database/connection.php';

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    global $conn;

    // echo($conn);
    // exit();

    // SQL query to fetch products
    $sql = "SELECT * FROM product"; // Adjust the table name and fields as necessary
    $result = $conn->query($sql);

    $products = [];

    if ($result->num_rows > 0) {
        // Fetch all products and store them in an array
        while ($row = $result->fetch_assoc()) {
            $products[] = $row; // Push each product to the products array
        }
        // Return the products as JSON
        echo json_encode($products);
    } else {
        // No products found
        echo json_encode(['error' => 'No products found.']);
    }
} else {
    // Handle other request methods if necessary
    echo json_encode(['error' => 'Invalid request method.']);
}

?>

<?php
require_once  '../database/connection.php';
define('URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . '/');
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    global $conn;

    // echo($conn);
    // exit();

    // SQL query to fetch products

    if($_GET["id"] == null){
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
    }else{
        $sql = "SELECT * FROM product WHERE id = ". $_GET["id"]; // Adjust the table name and fields as necessary
        $result = $conn->query($sql);
    
        $products =[];
    
        if ($result->num_rows > 0) {
            // Fetch all products and store them in an array
            while ($row = $result->fetch_assoc()) {
                $products = $row; // Push each product to the products array
            }
            // Return the products as JSON
            echo json_encode($products);
        } else {
            // No products found
            echo json_encode(['error' => 'No products found.']);
        }
    }
    
}


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    global $conn;
    $putData = file_get_contents("php://input");
    parse_str($putData, $parsedData);

    $id = $parsedData['id'] ?? null;
    $name = $parsedData['name'] ?? null;
    $price = $parsedData['price'] ?? null;

    $sql = "UPDATE `product` SET `name`='$name',`price`='$price' WHERE `id` = $id"; // Adjust the table name and fields as necessary
    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(['success' => 'true.']);
    } else {
        echo json_encode(['error' => 'No products found.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    global $conn;
    $id = $_GET['id'] ?? null;

    $sql = "DELETE FROM `product` WHERE id = $id"; // Adjust the table name and fields as necessary
    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(['success' => 'true.']);
    } else {
        echo json_encode(['error' => 'No products found.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    global $conn;
   
    // Get form data
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);

    // Handle file upload
    $targetDir = $_SERVER["DOCUMENT_ROOT"]."/uploads/"; // Directory where the image will be stored
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $imageURL = URL . "uploads/" . $fileName; 
    
    // Check if image file is a valid image type (optional validation)
    $check = getimagesize($_FILES["image"]["tmp_name"]);


    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $check = false;
      }
      
      // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $check = false;
    }

   
    if ($check !== false) {
        // print_r($_FILES["image"]["tmp_name"]);
        // print_r($targetFilePath);
        // exit(0);
        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Insert into database
            $sql = "INSERT INTO `product`(`name`, `price`, `image_path`, `created_at`) 
                    VALUES ('$name', '$price', '$imageURL', NOW())";
   
            if ($conn->query($sql) === TRUE) {

                echo "Product added successfully";
                die(header("Location: /home.php"));
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                 die(header("Refresh:1; url=/home.php"));
            }
         
        } else {
            echo "Sorry, there was an error uploading your file.";
             die(header("Refresh:1; url=/home.php"));

        }
    } else {
        echo "File is not an image.";
         die(header("Refresh:1; url=/home.php"));

    }

}

?>


<?php
// Include config file
require_once "config.php";

// Set CORS headers to allow the React app to access this endpoint
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// Initialize an empty array to hold the products
$products = array();

// Prepare a select statement
$sql = "SELECT product_id, product_name, price, description, image FROM product";

if ($result = mysqli_query($link, $sql)) {
    // Fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
        // Add each product to the products array
        $products[] = $row;
    }
    // Free result set
    mysqli_free_result($result);
} else {
    echo json_encode(array("error" => "Failed to fetch products."));
    exit;
}

// Close connection
mysqli_close($link);

// Return the products as JSON
echo json_encode($products);
?>

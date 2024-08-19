<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Change if using a different MySQL user
$password = "";     // Change if your MySQL user has a password
$dbname = "gebeya";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all products
$sql = "SELECT product_id, product_name, price, description, image FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["product_id"] . "</td>
                <td>" . $row["product_name"] . "</td>
                <td>" . $row["price"] . "</td>
                <td>" . $row["description"] . "</td>
                <td><img src='" . $row["image"] . "' alt='" . $row["product_name"] . "' width='100'></td>
                </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

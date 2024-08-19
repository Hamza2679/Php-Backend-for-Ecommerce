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

// Check if user_id is set
if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Delete products from chart
    $sql = "DELETE FROM chart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "All items deleted from chart for user ID " . $user_id;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "User ID is required.";
}

// Close connection
$conn->close();
?>

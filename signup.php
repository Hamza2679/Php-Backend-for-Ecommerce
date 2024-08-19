<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gebeya";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$user_username = $_POST['username'];
$user_email = $_POST['email'];
$user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $user_username, $user_email, $user_password);

// Ex//ecute the statement and check for errors
if ($stmt->execute()) {
    echo "New user added successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

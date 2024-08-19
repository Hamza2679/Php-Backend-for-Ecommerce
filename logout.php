<?php
// Initialize the session
session_start();

// Set CORS headers to allow the React app to access this endpoint
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Return a JSON response to the React app
echo json_encode(["message" => "Logout successful"]);
exit;
?>

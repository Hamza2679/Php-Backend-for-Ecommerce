<?php
// Initialize the session
session_start();

// Set CORS headers to allow the React app to access this endpoint
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// Check if the user is logged in
$response = array("loggedin" => false);
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $response["loggedin"] = true;
    $response["username"] = $_SESSION["username"];
}

echo json_encode($response);
?>

<?php
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');


// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Please log in to use this feature.']);
    exit;
}

require_once 'config.php'; // Ensure this path is correct

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Get product ID from POST data
$input = json_decode(file_get_contents('php://input'), true);
$product_id = $input['product_id'];

if (!$product_id) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid product ID.']);
    exit;
}

// Prepare SQL statement
$sql = "INSERT INTO cart (user_id, product_id) VALUES (?, ?)";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ii", $user_id, $product_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Item added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add item to cart.']);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement.']);
}

$conn->close();
?>

<?php
header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharmacy_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// Get the raw POST data
$json = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($json, true);

// Check if decoding was successful
if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    die(json_encode(['success' => false, 'message' => "Invalid JSON data"]));
}

// Check if 'billData' exists in the decoded JSON
if (!isset($data['billData']) || !is_array($data['billData'])) {
    die(json_encode(['success' => false, 'message' => "Missing or invalid 'billData'"]));
}

// Start transaction
$conn->begin_transaction();

try {
    foreach ($data['billData'] as $item) {
        // Validate each item
        if (!isset($item['drug_id'], $item['quantity'])) {
            throw new Exception("Missing drug_id or quantity for an item");
        }

        $drug_id = (int)$item['drug_id'];
        $quantity = (int)$item['quantity'];

        // Prepare and execute the update statement
        $stmt = $conn->prepare("UPDATE stock SET quantity = quantity - ? WHERE id = ?");
        if ($stmt === false) {
            throw new Exception("Failed to prepare the statement: " . $conn->error);
        }

        $stmt->bind_param("ii", $quantity, $drug_id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            throw new Exception("Failed to update stock for drug ID: $drug_id");
        }

        $stmt->close();
    }

    // Truncate bill_temp table
    $truncate_result = $conn->query("TRUNCATE TABLE bill_temp");
    if (!$truncate_result) {
        throw new Exception("Failed to truncate bill_temp table: " . $conn->error);
    }

    // Commit the transaction
    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => "Stock updated and bill_temp truncated successfully.", 'redirect' => true]);

} catch (Exception $e) {
    // Rollback the transaction on error
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage(), 'redirect' => false]);
}

// Close the database connection
$conn->close();
?>

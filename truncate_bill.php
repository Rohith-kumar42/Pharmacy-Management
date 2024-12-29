<?php
$conn = new mysqli("localhost", "root", "", "pharmacy_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "TRUNCATE TABLE bill_temp";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => $conn->error]);
}

$conn->close();
?>
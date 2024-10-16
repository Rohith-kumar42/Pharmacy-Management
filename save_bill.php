<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "pharmacy_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO bill (drug_name, drug_id, quantity, expire_date, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siisd", $drugName, $drugId, $quantity, $expireDate, $price);

    // Get the JSON data from the request
    $billData = json_decode(file_get_contents('php://input'), true);

    // Loop through the received billing data
    foreach ($billData as $item) {
        $drugName = $item['drug_name'];
        $drugId = $item['drug_id'];
        $quantity = $item['quantity'];
        $expireDate = $item['expire_date'];
        $price = $item['price'];

        // Execute the statement
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
    }

    echo "Bill saved successfully";
    header("Location: ./bill_page.php");
    exit();

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

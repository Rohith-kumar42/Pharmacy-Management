<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "pharmacy_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare statements for both tables
    $stmtBill = $conn->prepare("INSERT INTO bill (drug_name, drug_id, quantity, expire_date, price) VALUES (?, ?, ?, ?, ?)");
    $stmtBillTemp = $conn->prepare("INSERT INTO bill_temp (drug_name, drug_id, quantity, expire_date, price) VALUES (?, ?, ?, ?, ?)");

    // Bind parameters for both statements
    $stmtBill->bind_param("sisds", $drugName, $drugId, $quantity, $expireDate, $price);
    $stmtBillTemp->bind_param("sisds", $drugName, $drugId, $quantity, $expireDate, $price);

    // Get the JSON data from the request
    $billData = json_decode(file_get_contents('php://input'), true);

    // Loop through the received billing data
    foreach ($billData as $item) {
        $drugName = $item['drug_name'];
        $drugId = $item['drug_id'];
        $quantity = $item['quantity'];
        $expireDate = $item['expire_date'];
        $price = $item['price'];

        // Execute statements for both tables
        if (!$stmtBill->execute()) {
            echo "Error inserting into bill table: " . $stmtBill->error;
        }
        if (!$stmtBillTemp->execute()) {
            echo "Error inserting into bill_temp table: " . $stmtBillTemp->error;
        }
    }

    // Success response
    echo "Bill saved successfully";

    // Redirect to bill_page.php
    header("Location: ./bill_page.php");
    exit();

    // Close the statements and connection
    $stmtBill->close();
    $stmtBillTemp->close();
    $conn->close();
}
?>

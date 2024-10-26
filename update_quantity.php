<?php
if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $conn = new mysqli("localhost", "root", "", "pharmacy_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $conn->real_escape_string($_POST['id']);
    $quantity = $conn->real_escape_string($_POST['quantity']);

    $sql_update = "UPDATE stock SET quantity = '$quantity' WHERE id = '$id'";

    if ($conn->query($sql_update) === TRUE) {
        echo "Stock quantity updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

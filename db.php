<?php
// db.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharmacy_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data
$sql = "SELECT drug_name, quantity FROM bill"; // Adjust this query as needed
$result = $conn->query($sql);

$merged_data = [];

// Check if there are results
if ($result->num_rows > 0) {
    // Process each row
    while ($row = $result->fetch_assoc()) {
        // Create a unique key based on drug_name
        $key = $row['drug_name'];

        if (isset($merged_data[$key])) {
            // Merge quantities
            $merged_data[$key]['quantity'] += $row['quantity'];
        } else {
            // If key does not exist, add it to the array
            $merged_data[$key] = [
                'drug_name' => $row['drug_name'],
                'quantity' => $row['quantity']
            ];
        }
    }
}

// Sort the merged data by drug_name (alphabetical order)
usort($merged_data, function($a, $b) {
    return strcmp($a['drug_name'], $b['drug_name']);
});

// Return only drug_name and quantity as JSON
header('Content-Type: application/json');
echo json_encode(array_values($merged_data)); // Ensure JSON output is a sequential array

// Close connection
$conn->close();
?>

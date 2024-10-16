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

// Check if the request is for monthly data or total data
$dataType = isset($_GET['type']) ? $_GET['type'] : 'total'; // Default to 'total'

// Prepare data array
$data = [];

if ($dataType === 'monthly') {
    // Fetch data from the `bill_temp` table, grouping by month and year
    $sql = "
        SELECT 
            DATE_FORMAT(created_at, '%Y-%m') AS month_year, 
            SUM(total_quantity) AS total_quantity 
        FROM 
            bill_temp 
        GROUP BY 
            month_year 
        ORDER BY 
            month_year
    ";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; // Append each row to the data array
        }
    }
} else {
    // Query to fetch total drug quantities
    $sql = "SELECT drug_name, total_quantity FROM bill_temp"; // Adjust this query as needed
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; // Collect data into an array
        }
    }
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);

// Close connection
$conn->close();
?>

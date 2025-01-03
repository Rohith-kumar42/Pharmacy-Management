<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pharmacy_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from the bill table
$sql = "SELECT * FROM bill";
$result = $conn->query($sql);

// HTML structure with inline CSS
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Bill Table</title>
    <style>
        .bill-table {
            width: 100%;
            border-collapse: collapse;
        }

        .bill-table th, .bill-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .bill-table th {
            background-color: #f2f2f2;
        }

        .bill-table tr:hover {
            background-color: #f1f1f1;
        }
        .download-btn {
    margin: 10px 0;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
}

.download-btn:hover {
    background-color: #45a049;
}

    </style>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body>
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-section">
            <img src="./assets/Logo.png" alt="Pharmacare">
        </div>
        <div class="sidebar-links">
            <a href="./home.php" ><i class="icon-dashboard"></i> Dashboard</a>
            <a href="./salesinventory.php"><i class="icon-sales"></i> Sales Report</a>
            <a href="./expired.php" ><i class="icon-expired"></i> Expired</a>
            <a href="./outofstock.php" class="active"><i class="icon-outofstock"></i> Out of Stock</a>
            <a href="./add_stock.php"><i class="icon-bill"></i>Add to Stock</a>
        </div>
    </div>
    <div class="main-content">
        <header>
            <div class="user-section">
                <span>Pharmacist</span>
                <img src="./assets/user.png" alt="User">
            </div>
            <button class="logout-btn">Log out</button>
        </header>
        <div class="drug-section">
            <h2>Search Items</h2>
            <input type="text" id="search-box" placeholder="Find items">
            <button class="search-btn" onclick="searchDrugs()">Search</button>
        </div>
        <div class="drug-section">
            <h2>Out of Stock Medicines</h2>
            <div class="drug-carousel">
    
</div>

<div class="drug-carousel">
<?php
$conn = new mysqli("localhost", "root", "", "pharmacy_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_out_of_stock = "SELECT * FROM stock WHERE quantity = 0";
$result_out_of_stock = $conn->query($sql_out_of_stock);

if ($result_out_of_stock->num_rows > 0) {
    while ($row = $result_out_of_stock->fetch_assoc()) {
        echo '<div class="drug-card">';
        echo '<img src="uploads/' . $row['photo'] . '" alt="' . $row['name'] . '"><br>';
        echo '<span class="id">' . $row['id'] . '</span><br>';
        echo '<h3>' . $row['name'] . '</h3>';
        echo '<p>&#8377;' . $row['price'] . '</p>';
        echo '<p>Stock Available: ' . $row['quantity'] . '</p>';
        echo '<span class="expired">Expired: ' . $row['date'] . '</span><br><br>';
        
        // Input number for updating stock quantity
        echo '<label for="quantity-' . $row['id'] . '">Update Quantity:</label><br>';
        echo '<input type="number" id="quantity-' . $row['id'] . '" value="' . $row['quantity'] . '" min="0"><br>';
        
        // Update Quantity button with AJAX call
        echo '<button class="update-quantity-btn download-btn" data-id="' . $row['id'] . '">Update Quantity</button>';
        
        echo '</div>';
    }
} else {
    echo '<p>No out of stock found.</p>';
}

// Close connection
$conn->close();
?>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // When the "Update Quantity" button is clicked
        $('.update-quantity-btn').on('click', function() {
            var drugId = $(this).data('id');
            var newQuantity = $('#quantity-' + drugId).val();
            
            // Make sure the quantity is not negative
            if (newQuantity < 0) {
                alert('Quantity cannot be negative.');
                return;
            }
            
            // AJAX call to update the quantity in the database
            $.ajax({
                url: 'update_quantity.php',
                type: 'POST',
                data: {
                    id: drugId,
                    quantity: newQuantity
                },
                success: function(response) {
                    alert('Quantity updated successfully.');
                },
                error: function() {
                    alert('An error occurred while updating quantity.');
                }
            });
        });
    });
</script>


</body>
</html>

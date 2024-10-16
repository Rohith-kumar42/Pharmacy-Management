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
            <a href="./expired.php" class="active"><i class="icon-expired"></i> Expired</a>
            <a href="./outofstock.php"><i class="icon-outofstock"></i> Out of Stock</a>
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
            <h2>Expired Medicines</h2>
            <div class="drug-carousel">
    
</div>

<div class="drug-carousel">
    <?php
       $conn = new mysqli("localhost", "root", "", "pharmacy_db");

       // Check connection
       if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       
       $today = date('Y-m-d');
       
       // Query to get expired drugs
       $sql_expired = "SELECT * FROM stock WHERE date < '$today'";
       $result_expired = $conn->query($sql_expired);
       if ($result_expired->num_rows > 0) {
        while ($row = $result_expired->fetch_assoc()) {
            echo '<div class="drug-card">';
            echo '<img src="uploads/' . $row['photo'] . '" alt="' . $row['name'] . '"><br>';
            echo '<span class="id">' . $row['id'] . '</span><br>';
            echo '<h3>' . $row['name'] . '</h3>';
            echo '<p>&#8377;' . $row['price'] . '</p>';
            echo '<p>Stock Available: ' . $row['quantity'] . '</p>';
            echo '<span class="expired">Expired: ' . $row['date'] . '</span><br><br>';
            echo '</div>';
        }
    } else {
        echo '<p>No expired drugs found.</p>';
    }

    // Close connection
    $conn->close();
    ?>
</div>

</body>
</html>

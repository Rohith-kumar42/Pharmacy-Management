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
<?php
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

// Fetch data from the `bill` table
$sql = "SELECT * FROM bill";
$result = $conn->query($sql);
$merged_data = [];

if ($result->num_rows > 0) {
    // Process each row
    while ($row = $result->fetch_assoc()) {
        // Create a unique key based only on drug_id
        $key = $row['drug_id'];

        if (isset($merged_data[$key])) {
            // Merge quantities and prices
            $merged_data[$key]['quantity'] += $row['quantity'];
            $merged_data[$key]['price'] = round($merged_data[$key]['price'] + $row['price'], 2);
        } else {
            // If key does not exist, add it to the array
            $merged_data[$key] = [
                'drug_name' => $row['drug_name'],
                'drug_id' => $row['id'],
                'quantity' => $row['quantity'],
                'expire_date' => $row['expire_date'],
                'price' => $row['price']
            ];
        }
    }
}

?>
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-section">
            <img src="./assets/Logo.png" alt="Pharmacare">
        </div>
        <div class="sidebar-links">
            <a href="./home.php"><i class="icon-dashboard"></i> Dashboard</a>
            <a href="./salesinventory.php"><i class="icon-sales"></i> Sales Report</a>
            <a href="./expired.php"><i class="icon-expired"></i> Expired</a>
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
<table class="bill-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>ID</th>
            <th>Quantity</th>
            <th>Expire Date</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
                
        // Display merged data
        if (!empty($merged_data)) {
            
            foreach ($merged_data as $data) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($data['drug_name']) . "</td>";
                echo "<td>" . htmlspecialchars($data['drug_id']) . "</td>";
                echo "<td>" . htmlspecialchars($data['quantity']) . "</td>";
                echo "<td>" . htmlspecialchars($data['expire_date']) . "</td>";
                echo "<td>" . htmlspecialchars($data['price']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
    </tbody>
</table>
<button id="download-bill" class="download-btn" onclick="printBill()">Download Bill</button>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#download-bill').click(function() {
            let billData = [];

            // Loop through the table rows and collect drug_id and quantity
            $('tbody tr').each(function() {
                let drug_id = $(this).find('td:nth-child(2)').text(); // drug_id is in the second column
                let quantity = $(this).find('td:nth-child(3)').text(); // quantity is in the third column

                billData.push({
                    'drug_id': drug_id,
                    'quantity': quantity
                });
            });

            // Send an AJAX request to update stock in the database
            $.ajax({
                url: 'update_stock.php', // This is the PHP file that will handle the stock update
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ billData: billData }),
                success: function(response) {
                    if (response.success) {
                        alert(response.message);

                        // After successful stock update, initiate the print action
                        printBill();
                    } else {
                        alert("Failed to update stock: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        });
    });

    function printBill() {
        // Select the table content to print
        const billTable = document.querySelector('.bill-table').outerHTML;

        // Create a new window to print the content
        const printWindow = window.open('', '_blank', 'width=800,height=600');

        // Build the HTML for the print window, including necessary CSS for styling
        printWindow.document.write(`
            <html>
            <head>
                <title>Print Bill</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }
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
                    img {
                        max-width: 150px;
                        margin-bottom: 20px;
                    }
                </style>
            </head>
            <body>
                <img src="./assets/Logo.png" alt="Pharmacare" style="margin-left:280px">
                ${billTable}
            </body>
            </html>
        `);

        // Trigger print
        printWindow.document.close(); // Close the document for writing
        printWindow.focus(); // Focus on the window
        printWindow.print(); // Trigger the print dialog
        printWindow.close(); // Close the window after printing
    }

    </script>
</body>
</html>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pharmacy_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
SELECT b.*, s.date AS expire_date
FROM bill_temp b
LEFT JOIN stock s ON b.drug_id = s.id
";

$result = $conn->query($sql);

$merged_data = [];
$total_price = 0;

if ($result && $result->num_rows > 0) {
    // Process each row
    while ($row = $result->fetch_assoc()) {
        $key = $row['drug_id'];

        if (isset($merged_data[$key])) {
            $merged_data[$key]['quantity'] += $row['quantity'];
            $merged_data[$key]['price'] = round($merged_data[$key]['price'] + $row['price'], 2);

            if (!empty($row['expire_date'])) {
                $merged_data[$key]['expire_date'] = $row['expire_date'];
            }
        } else {
            $merged_data[$key] = [
                'drug_name' => $row['drug_name'],
                'drug_id' => $row['drug_id'],
                'quantity' => $row['quantity'],
                'expire_date' => !empty($row['expire_date']) ? $row['expire_date'] : null,
                'price' => $row['price']
            ];
        }

        $total_price += $row['price'];
    }
}
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
        
        .payment-method input {
            margin-right: 10px;
        }

        .payment-method {
            margin-top: 20px;
            font-size: 16px;
            display: flex;
            flex-direction: column; /* Stack options vertically */
            gap: 10px; /* Add spacing between options */
        }

        .payment-method input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #4CAF50;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            margin-right: 10px;
            position: relative;
        }

        .payment-method input[type="radio"]:checked {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        .payment-method label {
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center; /* Center text vertically with the radio button */
        }

        .payment-method div {
            display: flex;
            align-items: center;
            gap: 10px; /* Space between radio button and label */
        }

        /* Add spacing below the entire section */
        .payment-method-container {
            margin-bottom: 20px;
        }


    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
<div class="container">
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
                }
                ?>
            </tbody>
        </table>
        <div class="total-price">
            <strong>Total Price: </strong><?php echo htmlspecialchars($total_price); ?>
        </div>
        <div class="payment-method-container">
            <div class="payment-method">
                <strong>Select Payment Method:</strong>
                <div>
                    <input type="radio" id="cash" name="payment_method" value="Cash" checked>
                    <label for="cash">Cash</label>
                </div>
                <div>
                    <input type="radio" id="card" name="payment_method" value="Card">
                    <label for="card">Card</label>
                </div>
                <div>
                    <input type="radio" id="upi" name="payment_method" value="UPI">
                    <label for="upi">UPI</label>
                </div>
            </div>
        </div>

        <button id="download-bill" class="download-btn" onclick="printBill()">Download Bill</button>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#download-bill').click(function() {
            let billData = [];

            $('tbody tr').each(function() {
                let drug_id = $(this).find('td:nth-child(2)').text();
                let quantity = $(this).find('td:nth-child(3)').text();

                billData.push({
                    'drug_id': drug_id,
                    'quantity': quantity
                });
            });

            $.ajax({
                url: 'update_stock.php',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ billData: billData }),
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
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
    const billTable = document.querySelector('.bill-table').outerHTML;
    const totalPrice = document.querySelector('.total-price').outerHTML;
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

    const printWindow = window.open('', '_blank', 'width=800,height=600');

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
                .total-price, .payment-method {
                    margin-top: 20px;
                    font-size: 18px;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <img src="./assets/Logo.png" alt="Pharmacare" style="margin-left:280px">
            ${billTable}
            ${totalPrice}
            <div class="payment-method"><strong>Payment Method: </strong>${paymentMethod}</div>
        </body>
        </html>
    `);

    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}
</script>
</body>
</html>

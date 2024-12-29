<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Management System</title>
    <style>
       * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    display: flex;
    height: 100vh;
    background-color: #f5f5f5;

}

.container {
    display: flex;
    width: 100%;
   
}

.sidebar {
    width: 250px;
    background-color: #333;
    padding: 20px;
    color: white;
    display: flex;
    flex-direction: column;
    height: 300lvh;
}

.logo-section img {
    width: 150px;
    margin-bottom: 30px;
}

.sidebar-links a {
    display: flex;
    align-items: center;
    padding: 10px;
    margin-bottom: 10px;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.sidebar-links a.active, 
.sidebar-links a:hover {
    background-color: #23d160;
}

.sidebar-links i {
    margin-right: 10px;
}

.main-content {
    flex-grow: 1;
    padding: 20px;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.user-section {
    display: flex;
    align-items: center;
}

.user-section img {
    margin-left: 10px;
    border-radius: 50%;
    width: 50px;
    height: 50px;
}

.search-section input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 300px;
}

.search-section button {
    padding: 10px 20px;
    background-color: #23d160;
    color: white;
    border: none;
    border-radius: 5px;
    margin-left: 10px;
    cursor: pointer;
}

.logout-btn {
    background-color: #23d160;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.drug-section {
    margin-bottom: 20px;
}

.drug-section h2 {
    margin-bottom: 10px;
}

.drug-section input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 300px;
}

.drug-section button.search-btn {
    padding: 10px 20px;
    background-color: #23d160;
    color: white;
    border: none;
    border-radius: 5px;
    margin-left: 10px;
    cursor: pointer;
}

.drug-carousel {
    display: flex;
    margin-top: 20px;
    margin-left: 50px;
}

.drug-card {
    background-color: white;
    border-radius: 5px;
    padding: 20px;
    margin-right: 20px;
    width: 180px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.drug-card img {
    width: 100px;
    height: 100px;
    margin-bottom: 10px;
}

.drug-card h3 {
    font-size: 16px;
    margin-bottom: 5px;
}

.drug-card p {
    font-size: 14px;
    margin-bottom: 10px;
}

.drug-card input {
    width: 50px;
    padding: 5px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.add-bill-btn {
    background-color: #23d160;
    color: white;
    padding: 5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.billing-section {
    margin-top: 20px;
}

.billing-section h2 {
    margin-bottom: 10px;
}

.bill-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.bill-table th, .bill-table td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: left;
}

.checkout-section {
    margin-top: 20px;
}

.checkout-section h3 {
    margin-bottom: 10px;
}

.checkout-section input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    margin-bottom: 10px;
}

.checkout-btn {
    padding: 10px 20px;
    background-color: #23d160;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.drug-carousel {
    display: flex;
    flex-wrap: wrap; /* Allows items to wrap to the next line */
    gap: 10px; /* Space between each drug-card */
    justify-content: flex-start; /* Aligns the cards to the left */
}

.drug-card {
    background-color: white;
    border-radius: 5px;
    padding: 10px;
    width: calc((100% - 10px) / 6); /* Sets the width to fit 5 cards in a row */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    /* The margin-right is not needed as we are using gap */
}

.drug-card img {
    width: 100px;
    height: 100px;
    margin-bottom: 10px;
}

.drug-card h3 {
    font-size: 16px;
    margin-bottom: 5px;
}

.drug-card p {
    font-size: 14px;
    margin-bottom: 10px;
}

.drug-card input {
    width: 50px;
    padding: 5px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.add-bill-btn {
    background-color: #23d160;
    color: white;
    padding: 5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.drug-card input[type="number"] {
    margin-bottom: 12px; /* Adds space below the quantity input */
    padding: 4px;
    width: 80px; /* Optional: Adjust the width of the input field */
}

/* Optional: Add hover effect for button */
.add-bill-btn:hover {
    background-color: #20bc56;
}
        /* Media Queries for responsiveness */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .logo-section{
                padding-left: 190px;
            }
            .sidebar {
                width: 100%;
                height: auto;
            }

            .sidebar-links a {
                justify-content: center;
            }

            .drug-carousel {
                flex-direction: column;
                margin-left: 50px;
            }

            .drug-card {
                width: 90%;
                margin-bottom: 20px;
                
            }

            .main-content {
                padding: 10px;
            }

            .search-section input {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .drug-card {
                padding: 10px;
            }
            .drug-carousel{
                margin-left: 0px;
            }
            .drug-card h3 {
                font-size: 14px;
            }

            .drug-card p {
                font-size: 12px;
            }

            .drug-card input {
                width: 90%;
            }
           
            .checkout-btn, .search-section button, .add-bill-btn {
                padding: 10px 15px;
            }
        }

    </style>
</head>
<body>
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-section">
            <img src="./assets/Logo.png" alt="Pharmacare">
        </div>
        <div class="sidebar-links">
            <a href="./home.php" class="active"><i class="icon-dashboard"></i> Dashboard</a>
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
        <div class="drug-section">
            <h2>Search Items</h2>
            <input type="text" id="search-box" placeholder="Find items">
            <button class="search-btn" onclick="searchDrugs()">Search</button>
        </div>
        <div class="drug-section">
            <h2>Available Medicines</h2>
            <div class="drug-carousel">
    
</div>


            <div class="drug-carousel">
            <?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pharmacy_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get today's date
$today = date('Y-m-d');

// Query the stock data where the expiry date is greater than today
$sql = "SELECT * FROM stock WHERE date > '$today' AND quantity > 0";
$result = $conn->query($sql);

// Generate drug cards
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="drug-card">';
        echo '<img src="uploads/' . $row['photo'] . '" alt="' . $row['name'] . '"><br>';
        echo '<span class="id">' . $row['id'] . '</span><br>'; 
        echo '<h3>' . $row['name'] . '</h3>';
        echo '<p>&#8377;' . $row['price'] . '</p>';
        echo '<p>Stock Available: <span class="quantity">' . $row['quantity'] . '</span></p>';
        echo '<input type="number" placeholder="Qty" min="1" max="' . $row['quantity'] . '"> <br>';
        echo '<span class="expiry_date" data-expiry="' . $row['date'] . '">' . $row['date'] . '</span><br><br>';
        echo '<button class="add-bill-btn" data-name="' . $row['name'] . '" data-price="' . $row['price'] . '">Add to Bill</button>';
        echo '</div>';
    }
} 

// Close connection
$conn->close();
?>
            </div>
        </div>
        <div class="billing-section">
            <h2>Bill</h2>
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
                    <!-- Bill items go here -->
                </tbody>
            </table>
            <button class="checkout-btn">Checkout</button>
    </div>
</div>
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
        $drugId = $item['id'];
        $quantity = $item['quantity'];
        $expireDate = $item['expire_date'];
        $price = $item['price'];

        // Execute the statement
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
    }

    header("Location: bill_page.php");
    exit();

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Add event listeners to all "Add to Bill" buttons
    const addBillButtons = document.querySelectorAll('.add-bill-btn');

    addBillButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const drugCard = this.closest('.drug-card');
            const drugName = drugCard.querySelector('h3').textContent;
            const drugIdText = drugCard.querySelector('.id')?.textContent;
            const drugId = parseFloat(drugIdText.replace(/[^0-9.]/g, ''));
            const drugPrice = parseFloat(drugCard.querySelector('p').textContent.replace(/[^0-9.]/g, ''));
            const drugQty = drugCard.querySelector('input[type="number"]').value;
            const expireDate = drugCard.querySelector('.expiry_date').dataset.expiry; // Use expiry date from data attribute

            if (!drugQty || drugQty < 1) {
                alert('Please enter a valid quantity');
                return;
            }

            const billTableBody = document.querySelector('.bill-table tbody');
            const existingRow = findExistingRow(drugName);

            if (existingRow) {
                // If the drug is already in the bill, merge the quantities and prices
                const currentQty = parseInt(existingRow.querySelector('.qty').textContent);
                const currentPrice = parseFloat(existingRow.querySelector('.price').textContent);

                const newQty = currentQty + parseInt(drugQty);
                const newPrice = currentPrice + (parseFloat(drugPrice) * parseInt(drugQty));

                existingRow.querySelector('.qty').textContent = newQty;
                existingRow.querySelector('.price').textContent = newPrice.toFixed(2);
            } else {
                // Create a new row in the billing table if drug not found
                const newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <td>${drugName}</td>
                    <td>${drugId}</td>
                    <td class="qty">${drugQty}</td>
                    <td class="expiry_date">${expireDate}</td>
                    <td class="price">${(drugPrice * drugQty).toFixed(2)}</td>
                `;

                billTableBody.appendChild(newRow);
            }
        });
    });

    // Function to find an existing row for the same drug in the bill table
    function findExistingRow(drugName) {
        const rows = document.querySelectorAll('.bill-table tbody tr');
        for (let row of rows) {
            if (row.querySelector('td').textContent === drugName) {
                return row;
            }
        }
        return null;
    }

    // Search functionality
    document.getElementById("search-box").addEventListener("input", function() {
        const query = this.value.toLowerCase();
        const drugCards = document.querySelectorAll(".drug-card");

        drugCards.forEach(function(card) {
            const drugName = card.querySelector("h3").innerText.toLowerCase();
            if (drugName.includes(query)) {
                card.style.display = "block"; // Show the card
            } else {
                card.style.display = "none"; // Hide the card
            }
        });
    });

    // Checkout functionality
    document.querySelector('.checkout-btn').addEventListener('click', function() {
        const billData = [];
        const billTableRows = document.querySelectorAll('.bill-table tbody tr');

        billTableRows.forEach(function(row) {
            const drugName = row.querySelector('td:nth-child(1)').textContent;
            const drugId = row.querySelector('td:nth-child(2)').textContent;
            const quantity = row.querySelector('td:nth-child(3)').textContent;
            const expireDate = row.querySelector('td:nth-child(4)').textContent;
            const price = row.querySelector('.price').textContent;

            billData.push({
                drug_name: drugName,
                drug_id: drugId.trim(),
                quantity: quantity.trim(),
                expire_date: expireDate.trim(),
                price: price.trim()
            });
        });

        // Send the bill data to the server for checkout
        fetch('./save_bill.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(billData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            console.log(data); // Handle success
            // Redirect to bill_page.php after successful checkout
            window.location.href = 'bill_page.php'; 
            // Optionally, clear the bill table after checkout
            document.querySelector('.bill-table tbody').innerHTML = '';
        })
        .catch(error => {
            console.error('Error:', error); // Handle error
            alert("Error during checkout. Please try again.");
        });
    });
});

    </script>
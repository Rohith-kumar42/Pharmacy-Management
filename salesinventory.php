<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    canvas{
                        height: 100px;
                        width: 100px;
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
            <a href="./home.php" ><i class="icon-dashboard"></i> Dashboard</a>
            <a href="./salesinventory.php" class="active"><i class="icon-sales"></i> Sales Report</a>
            <a href="./expired.php"><i class="icon-expired"></i> Expired</a>
            <a href="./outofstock.php"><i class="icon-outofstock"></i> Out of Stock</a>
            <a href="./add_stock.php"><i class="icon-bill"></i>Add to Stock</a>
        </div>
    </div>
   
    <canvas id="myPieChart" style="height: 100px; width: 100px;margin-left:300px"></canvas>

<script>
fetch('db.php') // Adjust the path if needed
    .then(response => response.json())
    .then(data => {
        if (!data || data.length === 0) {
            console.error('No data returned or data is empty');
            return;
        }

        const labels = data.map(item => item.drug_name); // Extract drug names
        const quantities = data.map(item => item.quantity); // Extract quantities

        // Check if there's data to display
        if (labels.length === 0 || quantities.length === 0) {
            console.error('No valid labels or quantities to display');
            return;
        }

        // Function to generate random RGBA colors
        function getRandomColor() {
            const r = Math.floor(Math.random() * 255);
            const g = Math.floor(Math.random() * 255);
            const b = Math.floor(Math.random() * 255);
            const a = 0.6; // Transparency
            return `rgba(${r}, ${g}, ${b}, ${a})`;
        }

        // Create arrays of random colors for each slice
        const backgroundColors = labels.map(() => getRandomColor());
        const borderColors = backgroundColors.map(color => color.replace('0.6', '1')); // Solid border color

        // Create pie chart
        const ctx = document.getElementById('myPieChart').getContext('2d');
        const myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels, // Labels for the pie slices (drug names)
                datasets: [{
                    label: 'Number of Drugs Sold',
                    data: quantities, // Quantities as values for pie slices
                    backgroundColor: backgroundColors, // Random background colors
                    borderColor: borderColors, // Random border colors
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Drugs Sold Distribution'
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));
</script>
</body>
</html>

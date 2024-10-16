<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacare Dashboard</title>
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
            height: 100vh;
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
       button{
    margin: 10px 0;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
}
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-section">
            <img src="./assets/Logo.png" alt="Pharmacare">
        </div>
        <div class="sidebar-links">
            <a href="./home.php"><i class="icon-dashboard"></i> Dashboard</a>
            <a href="./salesinventory.php"><i class="icon-sales"></i> Sales Report</a>
            <a href="./expired.php"><i class="icon-expired"></i> Expired</a>
            <a href="./outofstock.php"><i class="icon-outofstock"></i> Out of Stock</a>
            <a href="./add_stock.php"  class="active"><i class="icon-outofstock"></i> Add Stock</a>
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

        <div class="drug-section" style="margin-left:400px">  
            <h2>Add New Stock</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Drug Name" required><br><br>
                <input type="number" name="price" placeholder="Price" required><br><br>
                <input type="number" name="quantity" placeholder="Quantity" required><br><br>
                <input type="date" name="date" required><br><br>
                <input type="file" name="photo" required><br><br>
                <button type="submit">Add Stock</button>
            </form>
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

        // Handle file upload
        $photo = $_FILES['photo']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($photo);

        // Check if uploads directory exists, if not create it
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move the uploaded file
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO stock (photo, name, price, quantity, date) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssis", $photo, $name, $price, $quantity, $date);

            // Get form data
            $name = $_POST['name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $date = $_POST['date'];

            // Execute the statement
            if ($stmt->execute()) {
                echo "New stock added successfully";
                header("Location: home.php");  // Redirect to home page after success
                exit();  // Ensure the script stops after the redirect
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Error uploading file.";
        }

        // Close connection
        $conn->close();
    }
    ?>
</body>
</html>

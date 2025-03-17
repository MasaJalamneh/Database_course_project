<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgb(251, 255, 241);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .container img {
            width: 100%;
            margin-bottom: 50px;
        }
        .login-container {
            background-color: #d2d5c9;
            border-radius: 25px;
            padding: 40px;
            width: 570px;
            box-shadow: 0 4px 8px rgba(99, 100, 93, 0.72);
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .login-container img {
            width: 230px;
            margin-bottom: 10px;
        }

        .login-container input , .login-container select{
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 25px;
            font-size: 14px;
            text-align: left;
            color: #555;
        }

        .login-container button, .login-container select {
            width: 70%;
            padding: 12px;
            margin-top: 30px;
            background-color:rgb(196, 206, 183);
            color: rgb(95, 99, 85);
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(94, 97, 90, 0.29);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .login-container button:hover {
            background-color:rgba(123, 136, 95, 0.5);
            transform: scale(1.05);
        }

        .sidebar {
            background-color: #d2d5c9;
            color: black;
            width: 220px;
            position: fixed;  
            padding: 20px;
            height: 100%;
        }

        .sidebar h2 {
            text-align: center;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px;
            margin: 10px 0;
            text-align: center;
        }

        .sidebar ul li a {
            color: black;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color:rgb(103, 119, 73);
            padding: 5px;
            border-radius: 25px;
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .main-content {
            flex: 1;
            padding: 20px;
            margin-left: 300px; 
        }

        header {
            background-color:rgb(239, 253, 223);
            padding: 20px;
            border-radius: 25px;
            margin-bottom: 20px;
            color: white;
        }

        header h1 {
            margin: 0;
        }

        .overview {
            margin-bottom: 20px;
        }

        .stats {
            display: flex;
            justify-content: space-around;
        }

        .stat-card {
            background-color:rgb(114, 129, 97);
            color: white;
            padding: 20px;
            border-radius: 25px;
            text-align: center;
            width: 25%;
            height: auto;
        }

        .stat-card img {
            width: 200px;
            height: 150px;
        }

        .stat-card h3 {
            margin: 0;
            font-size: 1.2em;
        }

        .stat-card p {
            font-size: 2em;
        }

        .recent-activities {
            margin-bottom: 20px;
        }

        .recent-activities ul {
            list-style: none;
            padding: 0;
        }

        .recent-activities ul li {
            background-color:rgba(114, 129, 97, 0.34);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 25px;
        }

        .actions .action-buttons {
            display: flex;
            justify-content: space-around;
        }

        .button {
            background-color: rgb(103, 119, 73);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .button:hover {
            background-color:rgb(94, 120, 46);
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

    </style>
</head>
<body>
    <div class="container">
        
        <div class="sidebar">
            <?php
            echo '<img src="images/damanLogo.png" alt="Company Logo">';
        ?>
            <h2>Employee Dashboard</h2>
            <ul>
                <li><a href="employee.php">Home</a></li>
                <li><a href="manage_properties.php">Manage Properties</a></li>
                <li><a href="manage_propertys.php">Manage propertys</a></li>
                <li><a href="view_transactions.php">View Transactions</a></li>
                <li><a href="main.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <header style="background-color:rgb(114, 129, 97);">
                <h1>Welcome to the Employee Dashboard</h1>
                <p>Take a look at what's going on!</p>
            </header>
            <section class="overview">
            <?php
                    include 'MysqlConnection.php';
                    $sql = "SELECT P.propertyID, O.ownerName, P.propertyAddress, P.salePrice, P.marketPrice, P.propertyType, P.propertyCountry, P.city, P.costPaidBySeller, P.closingDate, P.details FROM property P, owner O where O.ownerID = P.ownerID order by P.propertyID";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    echo "<table border='1' style = 'width:100%;'>";
                    echo "<tr><th>Property ID</th><th>Owner</th><th>Address</th><th>Sale Price</th><th>Market Price</th><th>Property Type</th><th>Country</th><th>City</th><th>Cost Paid by Seller</th><th>Closing Date</th><th>Details</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['propertyID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ownerName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['propertyAddress']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['salePrice']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['marketPrice']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['propertyType']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['propertyCountry']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['city']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['costPaidBySeller']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['closingDate']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['details']) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";    
                    $stmt->close();
                ?>
            </section>    
            <section>
                <div class="action-buttons">
                    <a href="delete_property.php" class="button">Delete Property</a>
                    <a href="add_property.php" class="button">Add New Property</a>
                    <a href="edit_property.php" class="button">Edit Property</a>
                </div>
                <div class="login-container">
                    <!-- Form -->
                    <form method="POST" action="">
                        <input type="number" name="propertyID" placeholder="Enter Property ID" required>
                        <button type="submit">Submit</button>
                    </form>

                    <?php include 'MysqlConnection.php';
                    if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        $propertyID = $_POST['propertyID'];
                        $sql = "DELETE FROM property WHERE propertyID = ?";
                        $res = $conn->prepare($sql);
                        $res->bind_param("i", $propertyID); 
                        if ($res->execute()) {
                            echo "<div style='display: flex; text-align: center; color: red; font-size: 30px'>Property deleted successfully!</div><br>";
                        } else {
                            echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center; flex-direction: column; color: red; font-size: 30px'>Error deleting property: " . $res->error . "</div><br>";
                        }
                        $res->close();
                    }
                ?>
                </div>
            </section>
            
            <section>
            </section>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>

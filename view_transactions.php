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
                <li><a href="manage_clients.php">Manage Clients</a></li>
                <li><a href="view_transactions.php">View Transactions</a></li>
                <li><a href="main.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <header style="background-color:rgb(114, 129, 97);">
                <h1>Welcome to the Employee Dashboard</h1>
                <p>Take a look at what's going on!</p>
            </header>
            <section>
            <?php
            include 'MysqlConnection.php';
            $sql = "SELECT T.transactionID, P.propertyType, CN.contractType, C.clientName, O.ownerName, T.salePrice, T.transactionType, T.transactionDate, T.paymentTerms FROM contract CN, transaction T, client C, property P, owner O where P.propertyID = T.propertyID and C.clientID = T.clientID and T.ownerID = O.ownerID and CN.contractID=T.contractID";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table border='1' style = 'width:100%;'>";
                echo "<tr><th>Transaction ID</th><th>Sale Price</th><th>Payment Terms</th><th>Transaction Date</th><th>Transaction Type</th><th>Owner</th><th>Client</th><th>Property Type</th><th>Contract Type</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['transactionID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['salePrice']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['paymentTerms']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['transactionDate']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['transactionType']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ownerName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['clientName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['propertyType']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contractType']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            ?>
            </section>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>

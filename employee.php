<?php
include 'MysqlConnection.php';

$totalProperties = $conn->query("SELECT COUNT(*) FROM property")->fetch_row()[0];
$totalClients = $conn->query("SELECT COUNT(*) FROM client")->fetch_row()[0];
$totalTransactions = $conn->query("SELECT COUNT(*) FROM transaction")->fetch_row()[0];
$newContacts = $conn->query("SELECT email from contact_requests where status like 'new'  LIMIT 3");
$newContactsCount = $conn->query("SELECT Count(*) from contact_requests where status like 'new'");
$newRequest = $conn->query("SELECT email, propertyID from buy_requests where status like 'new'  LIMIT 3");
$newSellRequest = $conn->query("SELECT email from sell_requests where status like 'new'  LIMIT 3");
?>
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
                <li><a href="index.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <header style="background-color:rgb(114, 129, 97);">
                <h1>Welcome to the Employee Dashboard</h1>
                <p>Take a look at what's going on!</p>
            </header>

            <section class="overview">
                <h2>Overview</h2>
                <div class="stats">
                    <div class="stat-card">
                        <img src="images/propertyIcon.png">
                        <h3>Total Properties</h3>
                        <p><?php echo $totalProperties; ?></p>
                    </div>
                    <div class="stat-card">
                        <img src="images/clientsIcon.png">
                        <h3>Total Clients</h3>
                        <p><?php echo $totalClients; ?></p>
                    </div>
                    <div class="stat-card">
                        <img src="images/transactionIcon.png">
                        <h3>Total Transactions</h3>
                        <p><?php echo $totalTransactions; ?></p>
                    </div>
                </div>
            </section>


            <section class="recent-activities">
                <h2>Recent Activities</h2>
                <ul>
                <?php
                    if ($newContacts->num_rows > 0) {
                        while ($row = $newContacts->fetch_assoc()) {
                            echo "<li style='margin-bottom: 15px; list-style: none;'>";
                            echo "<form method='post' action='mark_reviewed.php' style='display: flex; align-items: center; gap: 10px;'>";
                            echo "<span style='flex-grow: 1;'><p><strong>Client:</strong> " . htmlspecialchars($row['email']) . " is trying to contact us!!</p></span>";
                            echo "<input type='hidden' name='email' value='" . htmlspecialchars($row['email']) . "'>";
                            echo "<button type='submit' style='padding: 5px 10px; background-color:rgb(207, 238, 122); border: none; border-radius: 3px; cursor: pointer;'>Mark as Reviewed</button>";
                            echo "</form>";
                            echo "</li>";
                        }
                    } 
                ?>
    
                    <li>New client request: 123 Oak Street, New York</li>
                    <li>Client Jane Doe contacted for a property in Los Angeles</li>
                    <li>Transaction closed: Property sold at 456 Maple Avenue</li>
                </ul>
            </section>

            
            <section class="recent-activities">
                <h2>Recent Requests</h2>
                <ul>
                <?php
                    if ($newRequest->num_rows > 0) {
                        while ($row = $newRequest->fetch_assoc()) {
                            echo "<li style='margin-bottom: 15px; list-style: none;'>";
                            echo "<form method='post' action='mark_reviewed.php' style='display: flex; align-items: center; gap: 10px;'>";
                            echo "<span style='flex-grow: 1;'><p><strong>Client:</strong> " . htmlspecialchars($row['email']) . " is requesting to buy a property with ID: " . htmlspecialchars($row['propertyID']) . "</p></span>";
                            echo "<input type='hidden' name='email' value='" . htmlspecialchars($row['email']) . "'>";
                            echo "<button type='submit' style='padding: 5px 10px; background-color:rgb(207, 238, 122); border: none; border-radius: 3px; cursor: pointer;'>Mark as Reviewed</button>";
                            echo "</form>";
                            echo "</li>";
                        }
                    } 
                ?>
    
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </section>


            <section class="recent-activities">
                <h2>Recent Selling Requests</h2>
                <ul>
                <?php
                    if ($newSellRequest->num_rows > 0) {
                        while ($row = $newSellRequest->fetch_assoc()) {
                            echo "<li style='margin-bottom: 15px; list-style: none;'>";
                            echo "<form method='post' action='mark_reviewed.php' style='display: flex; align-items: center; gap: 10px;'>";
                            echo "<span style='flex-grow: 1;'><p><strong>Client:</strong> " . htmlspecialchars($row['email']) . " is requesting to sell a property >";
                            echo "<input type='hidden' name='email' value='" . htmlspecialchars($row['email']) . "'>";
                            echo "<button type='submit' style='padding: 5px 10px; background-color:rgb(207, 238, 122); border: none; border-radius: 3px; cursor: pointer;'>Mark as Reviewed</button>";
                            echo "</form>";
                            echo "</li>";
                        }
                    } 
                ?>
    
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </section>


            <section class="actions">
                <h2>Quick Actions</h2>
                <div class="action-buttons">
                    <a href="add_property.php" class="button">Add New Property</a>
                    <a href="add_client.php" class="button">Add New Client</a>
                    <a href="create_transaction.php" class="button">Create New Transaction</a>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>

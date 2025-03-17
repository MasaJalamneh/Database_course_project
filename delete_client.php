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
            box-shadow: 0 4px 8px rgba(128, 130, 123, 0.72);
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .login-container img {
            width: 230px;
            margin-bottom: 10px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 25px;
            font-size: 14px;
            text-align: left;
            color: #555;
        }

        .login-container button {
            width: 70%;
            padding: 12px;
            margin-top: 30px;
            background-color:rgb(159, 171, 142);
            color: rgb(70, 73, 61);
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(174, 182, 160, 0.29);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .login-container button:hover {
            background-color:rgb(123, 138, 103);
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
            <section class="overview">
                <?php
                    include 'MysqlConnection.php';
                    $sql = "SELECT * FROM client";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    echo "<table border='1' style = 'width:100%;'>";
                    echo "<tr><th>Client ID</th><th>Name</th><th>Status</th><th>Address</th><th>Email</th><th>Registration Date</th><th>Company</th><th>Phone</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['clientID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['clientName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['registrationDate']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['company']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phoneNumber']) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";    
                    $stmt->close();
                ?>
            </section>    
            <section>
                <div class="action-buttons">
                    <a href="delete_client.php" class="button">Delete Client</a>
                    <a href="add_client.php" class="button">Add New Client</a>
                    <a href="edit_client.php" class="button">Edit Clients</a>
                </div>
                <div class="login-container">
                    <form method="POST" action="">
                        <input type="number" name="clientID" placeholder="Enter Client ID" required>
                        <button type="submit">Submit</button>
                    </form>

                    <?php include 'MysqlConnection.php';
                    if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        $clientID = $_POST['clientID'];
                        $sql = "DELETE FROM client WHERE clientID = ?";
                        $res = $conn->prepare($sql);
                        $res->bind_param("i", $clientID); // 'i' for integer type
                        if ($res->execute()) {
                            echo "<div style='display: flex; text-align: center; color: red; font-size: 30px'>Client deleted successfully!</div><br>";
                        } else {
                            echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center; flex-direction: column; color: red; font-size: 30px'>Error deleting client: " . $res->error . "</div><br>";
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

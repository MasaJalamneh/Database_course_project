<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Daman Group</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            background-color: #e9ecef;
            font-family: Arial, sans-serif;
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

        .logo-title {
            font-size: 22px;
            color: #333;
            font-weight: bold;
        }

        .logo-subtitle {
            font-size: 14px;
            color: #777;
            margin-bottom: 30px;
        }
    </style>
    <script>
        let countdown = 10; // 10 seconds
        function startCountdown() {
            const timerElement = document.getElementById("timer");
            const interval = setInterval(function() {
                countdown--;
                timerElement.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(interval);
                    window.location.href = "employee.php"; 
                }
            }, 1000); // Update every 1 second
        }
    </script>
</head>
<body onload="startCountdown()">
    <div class="login-container">
        <!-- Logo -->
        <?php
            echo '<img src="images/damanLogo.png" alt="Company Logo">';
        ?>
        <!-- Form -->
        <form method="POST" action="">
            <select name="ownerID" required>
                <option value="" disabled selected>Select the owner</option>
                <?php
                    include 'MysqlConnection.php';
                    $result = $conn->query("SELECT ownerID, ownerName FROM owner");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['ownerID'] . "'>" . htmlspecialchars($row['ownerName']) . "</option>";
                    }
                ?>
            </select>
            <p>Owner Not Found? <a href='add_owner.php' class='contact'>click here to add new owner</a></p>

            <input type="text" name="propertyAddress" placeholder="Property Address" required>
            <input type="number" name="salePrice" placeholder="Sale Price" step="0.01">
            <input type="number" name="marketPrice" placeholder="Market Price" step="0.01" required>
            <input type="text" name="propertyType" placeholder="Property Type" required>
            <input type="text" name="propertyCountry" placeholder="Country" required>
            <input type="text" name="city" placeholder="City" required>
            <input type="number" name="costPaidBySeller" value="0.0" placeholder="Cost Paid by Seller" step="0.01">
            <input type="text" name="details" placeholder="Details">
            <input type="text" name="imagePath" placeholder="Image Path">
            <input type="date" name="closingDate" placeholder="Closing Date" required>
            <button type="submit">Add Property</button>
        </form>


        <?php
        include 'MysqlConnection.php';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $ownerID = $_POST['ownerID'];
            $propertyAddress = htmlspecialchars(trim($_POST['propertyAddress']));
            $salePrice = $_POST['salePrice'];
            $marketPrice = $_POST['marketPrice'];
            $propertyType = htmlspecialchars(trim($_POST['propertyType']));
            $propertyCountry = htmlspecialchars(trim($_POST['propertyCountry']));
            $city = htmlspecialchars(trim($_POST['city']));
            $costPaidBySeller = $_POST['costPaidBySeller'];
            $imagePath = $_POST['imagePath'];
            $details = $_POST['details'];
            $closingDate = $_POST['closingDate'];

            // Prepare the SQL statement
            $sql = "INSERT INTO property (ownerID, propertyAddress, salePrice, marketPrice, propertyType, propertyCountry, city, costPaidBySeller, details, closingDate, imagePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isddssssdss", $ownerID, $propertyAddress, $salePrice, $marketPrice, $propertyType, $propertyCountry, $city, $costPaidBySeller, $details, $closingDate, $imagePath);

            if ($stmt->execute()) {
                echo "<p>New Property Added Successfully. Employee Dashboard in <span id='timer'>10</span> seconds.</p>";
            } else {
                echo "Error adding property: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>

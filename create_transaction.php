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
            width: 550px;
            box-shadow: 0 4px 8px rgb(145, 151, 132);
            text-align: center;
        }

        .login-container img {
            width: 200px;
            margin-bottom: 50px;
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
            background-color:rgba(156, 171, 127, 0.5);
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

        .info-box {
            background-color: #d2d5c9;
            padding: 20px;
            margin-left: 30px;
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .info-box p {
            font-size: 14px;
            color: #333;
        }

        .info-box strong {
            font-weight: bold;
        }
    </style>
    <script>
        function fetchProperties() {
            var ownerID = document.querySelector('select[name="ownerID"]').value;

            if (ownerID) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "fetch_properties.php?ownerID=" + ownerID, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var properties = JSON.parse(xhr.responseText);
                        var propertySelect = document.querySelector('select[name="propertyID"]');
                        propertySelect.innerHTML = "<option value='' disabled selected>Select the Property</option>";
                        
                        properties.forEach(function(property) {
                            var option = document.createElement("option");
                            option.value = property.propertyID;
                            option.text = property.propertyAddress;
                            propertySelect.appendChild(option);
                        });
                    }
                };
                xhr.send();
            }
        }

    </script>
</head>
<body>
    <div class="login-container">

        <?php
            echo '<img src="images/damanLogo.png" alt="Company Logo">';
        ?>

        <form method="POST" action="add_transaction.php">
            <select name="ownerID" required onchange="fetchProperties()">
                <option value="" disabled selected>Select the owner</option>
                <?php
                    include 'MysqlConnection.php';
                    $result = $conn->query("SELECT ownerID, ownerName FROM owner");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['ownerID'] . "' $isSelected>" . htmlspecialchars($row['ownerName']) . "</option>";
                    }
                ?>
            </select>
            <select name="clientID" required>
                <option value="" disabled selected>Select the client</option>
                <?php
                    include 'MysqlConnection.php';
                    $result = $conn->query("SELECT clientID, clientName FROM client");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['clientID'] . "' $isSelected>" . htmlspecialchars($row['clientName']) . "</option>";
                    }
                ?>
            </select>

            <select name="propertyID" required>
                <option value="" disabled selected>Select the property</option>
            </select>

            <input type="number" name="salePrice" placeholder="Sale Price" required>
            <input type="number" name="employeeID" placeholder="Enter your ID" required>            
            <input type="text" name="paymentTerms" placeholder="Payment Terms" required>
            <input type="date" name="transactionDate" placeholder="Transaction Date" required>
            <input type="text" name="transactionType" placeholder="Transaction Type" required>
            <input type="date" name="appointmentDate" placeholder="Appointment Date" required>
            <button type="submit">Submit</button>
        </form>
    </div>

    <div class="info-box">
        <?php
            include 'MysqlConnection.php';
            $sql = "SELECT clientID, clientName, email, phoneNumber, paymentTerms, propertyID, status FROM buy_requests LIMIT 1"; // Fetch a single record for display

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $selectedClientID = htmlspecialchars($row['clientID']);
                $selectedClientName = htmlspecialchars($row['clientName']);
                $selectedEmail = htmlspecialchars($row['email']);
                $selectedPhoneNumber = htmlspecialchars($row['phoneNumber']);
                $selectedPaymentTerms = htmlspecialchars($row['paymentTerms']);
                $selectedPropertyID = htmlspecialchars($row['propertyID']);
                $selectedStatus = htmlspecialchars($row['status']);
                
                $sql2 = $conn->prepare("SELECT ownerID from property where propertyID = ?");
                $sql2->bind_param("i", $selectedPropertyID);
                $sql2->execute();
                $sql2->bind_result($selectedOwnerID);
                $sql2->fetch();
                $sql2->close();

                $sql3 = $conn->prepare("SELECT ownerName from owner where ownerID = ?");
                $sql3->bind_param("i", $selectedOwnerID);
                $sql3->execute();
                $sql3->bind_result($selectedOwnerName);
                $sql3->fetch();
                $sql3->close();

                $sql4 = $conn->prepare("SELECT propertyAddress from property where propertyID = ?");
                $sql4->bind_param("i", $selectedPropertyID);
                $sql4->execute();
                $sql4->bind_result($selectedPropertyAddress);
                $sql4->fetch();
                $sql4->close();

                $sql5 = $conn->prepare("SELECT salePrice from property where propertyID = ?");
                $sql5->bind_param("i", $selectedPropertyID);
                $sql5->execute();
                $sql5->bind_result($selectedSalePrice);
                $sql5->fetch();
                $sql5->close();

                // Display the data
                echo "<p><strong>Client ID:</strong> $selectedClientID</p>";
                echo "<p><strong>Client Name:</strong> $selectedClientName</p>";
                echo "<p><strong>Email:</strong> $selectedEmail</p>";
                echo "<p><strong>Phone Number:</strong> $selectedPhoneNumber</p>";
                echo "<p><strong>Payment Terms:</strong> $selectedPaymentTerms</p>";
                echo "<p><strong>Property ID:</strong> $selectedPropertyID</p>";
                echo "<p><strong>Owner ID:</strong> $selectedOwnerID</p>";
                echo "<p><strong>Owner Name:</strong> $selectedOwnerName</p>";
                echo "<p><strong>Status:</strong> $selectedStatus</p>";
                echo "<p><strong>Property Address:</strong> $selectedPropertyAddress</p>";
                echo "<p><strong>Sale Price:</strong> $selectedSalePrice</p>";
            }
        ?>
    </div>
</body>
</html>

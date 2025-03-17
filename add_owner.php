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
                    window.location.href = "add_property.php"; 
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
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="date" name="registrationDate" placeholder="Registration Date" required>
            <input type="text" name="company" value="" placeholder="Company">
            <input type="number" name="phoneNumber" placeholder="Phone Number" required>
            <button type="submit">Submit</button>
        </form>

        <?php include 'MysqlConnection.php';
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $address = $_POST['address'];
            $registrationDate = $_POST['registrationDate'];
            $company = $_POST['company'];
            $phoneNumber = $_POST['phoneNumber'];

            $sql = "INSERT INTO owner (ownerName, address, email, password, registrationDate, company, phoneNumber) values (?,?,?,?,?,?,?)";
            $res = $conn->prepare($sql);
            $res->bind_param("sssssss", $name, $address, $email, $password, $registrationDate, $company, $phoneNumber);
            if ($res->execute()) {
                echo "<p>New Owner Added Successfully. Add Property page in <span id='timer'>10</span> seconds.</p>";
            } else {
                echo "Error inserting owner: " . $stmt->error . "<br>";
            }
            $res->close();
        }
    
    ?>
    </div>
</body>
</html>

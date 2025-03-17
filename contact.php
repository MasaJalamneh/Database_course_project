<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script>
        let countdown = 10; // 10 seconds
        function startCountdown() {
            const timerElement = document.getElementById("timer");
            const interval = setInterval(function() {
                countdown--;
                timerElement.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(interval);
                    window.location.href = "index.php"; 
                }
            }, 1000); // Update every 1 second
        }
    </script>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #e5e5e0;
            font-family: Arial, sans-serif;
        }

        .register-container {
            background-color: #d2d5c9;
            border-radius: 15px;
            padding: 40px;
            width: 450px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            height: 85%;
        }

        .register-container img {
            width: 200px;
        }

        .register-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 25px;
            font-size: 14px;
        }

        .register-container textarea {
            resize: none;
            width: 100%;
            height: 150px;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .register-container button {
            width: 70%;
            padding: 10px;
            margin-top: 15px;
            background-color: rgb(106, 122, 79);
            color: #fff;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .register-container button:hover {
            background-color: rgb(77, 90, 52);
            transform: scale(1.05);
        }

        .register-container a {
            color: #2c2c2c;
            font-size: 14px;
            text-decoration: none;
        }

        .register-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body onload="startCountdown()">
    <div class="register-container">
    <?php
        echo '<img src="images/damanLogo.png" alt="Company Logo">';
    ?>
    <h3>Contact Us for Registration</h3>
    <form  method="POST" action="">
        <input type="text" id="name" name="name" placeholder="Name" required>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <input type="text" id="phone" name="phone" placeholder="Phone Number" required>
        <textarea id="message" name="message" placeholder="Enter your Message for registeration..."></textarea>
        <button type="submit">Submit</button>
    </form>
    <?php
    include 'MysqlConnection.php';
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_requests (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Thank you for contacting us! We will get back to you shortly. You will be redirected to the main page in <span id='timer'>30</span> seconds.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
    ?>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer // Seller Login</title>
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

        .login-container {
            background-color: #d2d5c9;
            border-radius: 15px;
            padding: 40px;
            width: 350px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-container img {
            width: 200px;
            margin-bottom: 50px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 25px;
            font-size: 14px;
        }

        .login-container button {
            width: 70%;
            padding: 10px;
            margin-top: 25px;
            background-color: rgb(106, 122, 79);
            color: #fff;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .login-container button:hover {
            background-color: rgb(77, 90, 52);
            transform: scale(1.05);
        }

        .login-container a {
            color: #2c2c2c;
            font-size: 14px;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <?php
            echo '<img src="images/damanLogo.png" alt="Company Logo">';
        ?>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Log in</button>
        </form>
    
        <?php include 'MysqlConnection.php';
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            if (empty($email) || empty($password)) {
                echo "<p style='color: red;'>All fields are required!</p>";
            } else {
                $sql = $conn->prepare("SELECT * FROM client WHERE email = ? AND password = ?");
                $sql->bind_param("ss", $email, $password);  
                $sql->execute();
                $result = $sql->get_result();
                if ($result->num_rows > 0) {
                    setcookie("email", $email, time() + (86400 * 30), "/"); 
                    header("location: buyerProfile.php");
                } else {
                    $sql = $conn->prepare("SELECT * FROM owner WHERE email = ? AND password = ?");
                    $sql->bind_param("ss", $email, $password);  
                    $sql->execute();
                    $result = $sql->get_result();
                    if ($result->num_rows > 0) {
                        setcookie("email", $email, time() + (86400 * 30), "/"); 
                        header("location: sellerProfile.php");
                    } else {
                        echo "<p style='color: red;'>Invalid credentials!</p>";
                    }
                }
                $sql->close();
            }
        }   
        echo '<p>Don\'t have an account? <a href="contact.php">Go Back to request sign in</a></p>';
        ?>
    </div>
</body>
</html>
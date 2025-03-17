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
            height: 100vh;
            background-color: #e5e5e0;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background-color: #d2d5c9;
            border-radius: 25px;
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
            text-align: left;
            color: #555;
        }

        .login-container button {
            width: 70%;
            padding: 12px;
            margin-top: 30px;
            background-color: #6a7a4f;
            color: #fff;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .login-container button:hover {
            background-color: #4d5a34;
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
</head>
<body>
    <div class="login-container">
        <?php
            echo '<img src="images/damanLogo.png" alt="Company Logo">';
        ?>
        <form method="POST" action="">
            <input type="text" name="employee_id" placeholder="Employee ID" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Log in</button>
        </form>

        <?php
        include 'MysqlConnection.php';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $employee_id = $_POST['employee_id']; 
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($employee_id) || empty($email) || empty($password)) {
                echo "<p style='color: red;'>All fields are required!</p>";
            } else {
                $sql = $conn->prepare("SELECT * FROM employee WHERE employeeID = ? AND email = ? AND password = ?");
                $sql->bind_param("iss", $employee_id, $email, $password);  
                $sql->execute();
                $result = $sql->get_result();

                if ($result->num_rows > 0) {
                    header("Location: employee.php");
                    exit();
                } else {
                    echo "<p style='color: red;'>Invalid credentials!</p>";
                }
                $sql->close();
            }
        }
        ?>
    </div>
</body>
</html>

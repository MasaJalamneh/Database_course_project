<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            background-color:rgb(251, 255, 241);             
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            width: 80%;
            max-width: 1200px;
            height: 70%;
            background-color: rgb(228, 236, 215);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 35px;
            overflow: hidden;
        }

        .left {
            flex: 1;
            background-image: url('images/login2.png'); 
            background-size: cover;
            background-position: center;
        }

        .right {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #d2d5c9;
        }

        .right button {
            width: 100%;
            margin: 10px 0;
            padding: 20px;
            font-size: 1rem;
            color: black;
            background-color: rgb(255, 255, 255);
            border: none;
            border-radius: 35px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .right button:hover {
            background-color: rgb(95, 114, 64);
            transform: scale(1.05);
        }

        .right button.secondary {
            background-color: rgb(255, 255, 255);
        }

        .right button.secondary:hover {
            background-color: rgb(95, 114, 64);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left"></div>
        <div class="right">
        <?php
            echo '<button onclick="window.location.href=\'buyerSellerLogin.php\'">Buyer || Seller Login</button>';
            echo '<button onclick="window.location.href=\'employeeLogin.php\'">Employee Login</button>';
            echo '<button onclick="window.location.href=\'contact.php\'">Request to sign in</button>';
        ?>
</div>
    </div>
</body>
</html>
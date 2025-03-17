<?php
    session_start();
    $_SESSION['ownerID'] = $_POST['ownerID'];
    $_SESSION['clientID'] = $_POST['clientID'];
    $_SESSION['propertyID'] = $_POST['propertyID'];
    $_SESSION['transactionType'] = $_POST['transactionType'];
    $_SESSION['salePrice'] = $_POST['salePrice'];
    $_SESSION['employeeID'] = $_POST['employeeID'];
    $_SESSION['paymentTerms'] = $_POST['paymentTerms'];
    $_SESSION['transactionDate'] = $_POST['transactionDate'];
    $_SESSION['appointmentDate'] = $_POST['appointmentDate'];
?>
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
    </style>
</head>
<body>
    <div class="login-container">
        <?php
            echo '<img src="images/damanLogo.png" alt="Company Logo">';
        ?>
        <form method="POST" action="add_contract.php">            
            <input type="text" name="contractType" placeholder="Contract Type" required>
            <input type="text" name="status" placeholder="Status [pending, signed, active]" required>            
            <input type="date" name="startDate" placeholder="Start Date" required>
            <input type="text" name="termsAndConditions" placeholder="Terms and Conditions" required>
            <input type="date" name="expiryDate" placeholder="Expiry Date" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
include('MysqlConnection.php');

$propertyID = isset($_GET['propertyID']) ? $_GET['propertyID'] : '';

$query = "SELECT * FROM property WHERE propertyID = '$propertyID'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $image = $row['imagePath'];
    $propertyType = strtoupper($row['propertyType']);
    $propertyAddress = $row['propertyAddress'];
    $city = $row['city'];
    $country = $row['propertyCountry'];
    $salePrice = number_format($row['salePrice'], 2);
    $details = $row['details'];
} else {
    echo "Property not found!";
    exit;
}

$clientName = $email = $phoneNumber = $paymentTerms = $clientID = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientName = $_POST['clientName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $paymentTerms = $_POST['paymentTerms'];

    $clientName = mysqli_real_escape_string($conn, $clientName);
    $email = mysqli_real_escape_string($conn, $email);
    $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);
    $paymentTerms = mysqli_real_escape_string($conn, $paymentTerms);

    $clientQuery = "SELECT clientID FROM client WHERE email = '$email' LIMIT 1";
    $clientResult = $conn->query($clientQuery);
    if ($clientResult->num_rows > 0) {
        $clientData = $clientResult->fetch_assoc();
        $clientID = $clientData['clientID'];
    }

    $sql = "INSERT INTO buy_requests (clientID, clientName, email, phoneNumber, paymentTerms, propertyID) 
            VALUES ('$clientID', '$clientName', '$email', '$phoneNumber', '$paymentTerms', '$propertyID')";

    if ($conn->query($sql) === TRUE) {
        $message = "Thank you for contacting us! We will get back to you shortly.";
    } else {
        $message = "Error: " . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House for Sale</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(251, 255, 241); 
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            margin: 20px;
        }
        .container {
            background-color: #d2d5c9;
            padding: 20px;
            border-radius: 25px;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 1000px;
            height: 220%;
            margin-top: 40px;
            margin-bottom: 20px;
        }
        .container img {
            width: 55%;
            border-radius: 25px;
            height: 20%;
            margin-top: 60px;
            margin-bottom: 30px;
        }
        .container h1 {
            font-size: 24px;
            margin: 20px 0;
        }
        .container p {
            font-size: 16px;
            margin-top: 20px;
        }

        .container .button {
            background-color: #c0c0b0;
            color: #000;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 40px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .button:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        hr {
            border:#000;
            border-top: 3px solid rgb(23, 54, 21);
            margin: 30px 0;
            margin-top: 90px;
        }

        .message {
            font-weight: bolder;
            font-size: 24px;
            color:rgb(36, 75, 31);
        }

        .form-field {
            margin-top: 20px;
            text-align: center;
        }

        .form-field input[type="text"], .form-field select {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 25px;
            background-color:rgb(251, 255, 241);
        }

        .form-field label {
            font-size: 16px;
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <img src="<?php echo $image; ?>" alt="House Image">
        <h1><?php echo $propertyType; ?> / FOR SALE</h1>
        <p><?php echo $propertyAddress; ?></p>
        <p>Located in <?php echo $city . ', ' . $country; ?></p>
        <p>Sale Price: <?php echo $salePrice; ?> USD</p>
        <h2>More Details:</h2>
        <p><?php echo $details; ?></p>
        
        <hr>

        <p class="message">If you decided to buy this property, please fill the following fields and submit your request:</p>

        <form action="" method="POST">
            <div class="form-field">
                <input type="text" id="clientName" name="clientName" placeholder="Enter your Name" required>
            </div>
            <div class="form-field">
                <input type="text" id="email" name="email" placeholder="Enter your Email" required>
            </div>
            <div class="form-field">
                <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Enter your Phone Number" required>
            </div>
            <div class="form-field">
                <label for="paymentTerms">Payment Terms:</label>
                <select id="paymentTerms" name="paymentTerms" required>
                    <option value="Cash">Cash</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="Credit Card">Credit Card</option>
                </select>
            </div>
            <button type="submit" class="button">Request to Buy Now</button>
        </form>

        <?php
        if (isset($message)) {
            echo "<p class='message'>$message</p>";
        }
        ?>
    </div>

</body>
</html>
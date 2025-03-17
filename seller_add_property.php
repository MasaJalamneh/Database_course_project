<?php
include('MysqlConnection.php');

$ownerEmail = $propertyAddress = $salePrice = $marketPrice = $propertyType = $propertyCountry = "";
$city = $costPaidBySeller = $closingDate = $imagePath = $details = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ownerEmail = $_POST['owner_email'];
    $propertyAddress = $_POST['property_address'];
    $salePrice = $_POST['sale_price'];
    $marketPrice = $_POST['market_price'];
    $propertyType = $_POST['property_type'];
    $propertyCountry = $_POST['property_country'];
    $city = $_POST['property_city'];
    $costPaidBySeller = $_POST['cost_paid_by_you'];
    $closingDate = $_POST['closing_date'];
    $imagePath = $_POST['image_path'];
    $details = $_POST['property_details'];

    $ownerEmail = mysqli_real_escape_string($conn, $ownerEmail);
    $propertyAddress = mysqli_real_escape_string($conn, $propertyAddress);
    $salePrice = mysqli_real_escape_string($conn, $salePrice);
    $marketPrice = mysqli_real_escape_string($conn, $marketPrice);
    $propertyType = mysqli_real_escape_string($conn, $propertyType);
    $propertyCountry = mysqli_real_escape_string($conn, $propertyCountry);
    $city = mysqli_real_escape_string($conn, $city);
    $costPaidBySeller = mysqli_real_escape_string($conn, $costPaidBySeller);
    $closingDate = mysqli_real_escape_string($conn, $closingDate);
    $imagePath = mysqli_real_escape_string($conn, $imagePath);
    $details = mysqli_real_escape_string($conn, $details);

    $ownerQuery = "SELECT ownerID FROM owner WHERE email = '$ownerEmail' LIMIT 1";
    $ownerResult = $conn->query($ownerQuery);
    if ($ownerResult->num_rows > 0) {
        $ownerData = $ownerResult->fetch_assoc();
        $ownerID = $ownerData['ownerID'];
    } else {
        $message = "Owner not found! Please register as an owner first.";
        echo $message;
        exit; 
    }

    $sql = "INSERT INTO sell_requests (ownerID, email, propertyAddress, salePrice, marketPrice, propertyType, propertyCountry, city, costPaidBySeller, closingDate, imagePath, details)
            VALUES ('$ownerID', '$ownerEmail', '$propertyAddress', '$salePrice', '$marketPrice', '$propertyType', '$propertyCountry', '$city', '$costPaidBySeller', '$closingDate', '$imagePath', '$details')";

    if ($conn->query($sql) === TRUE) {
        $message = "Property added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }

    $sql = "INSERT INTO property (ownerID, propertyAddress, salePrice, marketPrice, propertyType, propertyCountry, city, costPaidBySeller, closingDate, imagePath, details)
            VALUES ('$ownerID', '$propertyAddress', '$salePrice', '$marketPrice', '$propertyType', '$propertyCountry', '$city', '$costPaidBySeller', '$closingDate', '$imagePath', '$details')";

    if ($conn->query($sql) === TRUE) {
        $message = "Property added successfully!";
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
    <title>Property Entry Form</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: rgb(251, 255, 241);
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
        }

        .form-container {
            background-color: #d2d5c9;
            border-radius: 25px;
            padding: 40px;
            width: 550px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-container img {
            width: 120px;
            margin-bottom: 20px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 25px;
            font-size: 14px;
        }

        .form-container button {
            width: 50%;
            padding: 10px;
            background-color: #94a68c;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #768d6b;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <img src="images/damanLogo.png" alt="Daman Group Logo">
        <form action="seller_add_property.php" method="POST">
            <input type="text" name="owner_email" placeholder="Enter Your Email" required>
            <input type="text" name="property_address" placeholder="Enter Property Address" required>
            <input type="number" step="0.01" name="sale_price" placeholder="Enter Sale Price" required>
            <input type="number" step="0.01" name="market_price" placeholder="Enter Market Price" required>
            <input type="text" name="property_type" placeholder="Enter Property Type" required>
            <input type="text" name="property_country" placeholder="Enter Property Country" required>
            <input type="text" name="property_city" placeholder="Enter Property City" required>
            <input type="number" step="0.01" name="cost_paid_by_you" placeholder="Enter Cost Paid By You" required>

            <label for="closing_date" style="font-size: 14px; color: #666; text-align: left; display: block; margin-bottom: 5px;">Enter Closing Date:</label>
            <input type="date" id="closing_date" name="closing_date" required>

            <input type="text" name="image_path" placeholder="Enter Property Image Path, e.g., 'images/file_name.jpg/png'" required>
            <input type="text" name="property_details" placeholder="Enter Property Details" required>
            <button type="submit">Submit</button>
        </form>

        <?php
        
        if (!empty($message)) {
            echo "<p>$message</p>";
        }
        ?>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Listings</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color:rgb(251, 255, 241);         
        }

        .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 20px;
                background-color: #d2d5c9;
                border-bottom: 2px rgb(0, 0, 0); 
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 

            }

            .header .logo {
                width: 50px;
                height: 50px;
                background-image: url('images/damanLogo.png'); 
                background-size:cover; 
                background-repeat: no-repeat; 
                background-position: center;
                background-color:rgb(155, 171, 129) ; 
                border-radius: 50%;
                padding-left: 30px;
            }

            .header .title {
                font-weight: bold;
                font-size: 25px;
            }

            .header .contact {
                font-size: 16px;
                font-weight: bold;
                color: #000;
                text-decoration: none;
            }
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            padding: 20px;
            margin-bottom: 30px;
        }

        form label {
            background-color:  #d2d5c9; 
            color: #333; 
            font-size: 16px;
            padding: 8px 12px;
            border-radius: 20px;
            text-align: center;
            min-width: 120px;
        }

        form input {
            border: none;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 16px;
            background-color:rgb(245, 243, 240); 
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
        }

        form button {
            background-color:rgb(156, 172, 148); 
            color: #333;
            border: none;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color:rgb(99, 125, 86);
        }

        form input:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        form input::placeholder {
            color: #aaa;
            font-style: italic;
        }
        
        
        /* listings Section */
        .listings-section {
            text-align: center;
        }

        .listings-section h2 {
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 50px;
            color: #333;
            background-color: #d2d5c9;
            border-radius: 25px;
            padding: 10px;
            width: 1220px;
            align-self: center;
            align-items: center;
            align-content: center;
            margin-left: 50px;
            margin-top: 80px;
        }

        .listings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 50px;
            max-width: 1230px;
            margin: 0 auto;
        }

        .listing-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #d2d5c9;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .listing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .listing-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .listing-card .details {
            padding: 15px;
        }

        .listing-card .details h3 {
            font-size: 18px;
            margin: 10px 0;
            color: #222;
        }

        .listing-card .details p {
            font-size: 14px;
            margin: 5px 0;
            color: #555;
        }

        .listing-card .details .info {
            font-weight: bold;
            color: rgb(24, 117, 63);
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class='header'>
        <div class='logo'> </div>
        <div class='title'>DAMAN GROUP</div>
        <div>
            <a href='index.php' class='contact'>Logout</a>
        </div>
    </div>
    <div class="listings-section">
        <h2>Our Listings</h2>

        <form method="GET" class="filter-form">
            <label for="salePrice">Sale Price (Max):</label>
            <input type="number" id="salePrice" name="salePrice" placeholder="Enter max sale price">

            <label for="closingDate">Closing Date (Before):</label>
            <input type="date" id="closingDate" name="closingDate">

            <label for="city">City:</label>
            <input type="text" id="city" name="city" placeholder="Enter city">

            <button type="submit">Filter</button>
        </form>

        

        <div class="listings-grid">
            <?php
            include 'MysqlConnection.php';

            $sql = "SELECT propertyID, propertyAddress, salePrice, propertyType, propertyCountry, city, closingDate, imagePath, details
                    FROM property 
                    WHERE 1=1";

            if (!empty($_GET['salePrice'])) {
                $salePrice = (float)$_GET['salePrice'];
                $sql .= " AND salePrice <= $salePrice";
            }
            if (!empty($_GET['closingDate'])) {
                $closingDate = $_GET['closingDate'];
                $sql .= " AND closingDate <= '$closingDate'";
            }
            if (!empty($_GET['city'])) {
                $city = $conn->real_escape_string($_GET['city']);
                $sql .= " AND city LIKE '%$city%'";
            }

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
              
                while ($row = $result->fetch_assoc()) {
                    $image = $row['imagePath'];
                    $propertyType = strtoupper($row['propertyType']);
                    $propertyID = $row['propertyID'];
                    $details = addslashes($row['details']);
                    
                    echo "
                    <div class='listing-card'>
                        <img src='$image' alt='Property Image'>
                        <div class='details'>
                            <p class='info'>$propertyType / FOR SALE</p>
                            <h3>{$row['propertyAddress']}</h3>
                            <p>Located in {$row['city']}, {$row['propertyCountry']}</p>
                            <p>Sale Price: " . number_format($row['salePrice'], 2) . " USD</p>
                            <a href='property_details.php?propertyID=$propertyID' class='more-details-btn'>More Details</a>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<p>No listings available.</p>";
            }

            ?>
        </div>
    </div>
    <script>
    function showDetails(propertyID, details) {
        alert("Property ID: " + propertyID + "\nDetails: " + details);
        }
    </script>
</body>
</html>
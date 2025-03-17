<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(251, 255, 241);
            color: #333;
            text-align: center;
            padding: 0;
            margin: 0;
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

            
        .head {
            background-color: rgb(251, 255, 241);
            padding: 40px 20px;
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-top: 50px;
            margin-bottom: 80px;
            text-align: center;
            padding: 50px 20px;
            animation: slideIn 1.5s ease-out; 
        }

        .button-container {
            margin-top: 30px;
            margin-bottom: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            width: 100%; 
            justify-content: center;
        }

        .button {
            background-color: #d3d3c4; 
            border: none;
            padding: 20px 40px;
            font-size: 30px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
            border-radius: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 500px; 
            height: 250px;
            margin-bottom: 50px;
        }

        .button:hover {
            background-color:rgb(155, 171, 129) ; 
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .button-policy {
            font-size: 30px;
            font-weight: bold;
            width: 1040px; 
            margin-top: 10px; 
            margin-bottom: 50px;
        }

        .button-container-horizontal {
            display: flex;
            justify-content: center;
            gap: 40px; 
        }

        footer {
            background-color: #d3d3c4;
            color: white;
            padding: 20px;
            text-align: center;
        }

        footer .social-links {
            color: white;
            margin: 0 5px;
            text-decoration: none;
        }

        .social-links img { 
                width: 30px; 
                margin: 0 10px; 
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
    <div class="head">
        <p>Welcome to your profile</p>
        <p>What are you looking to do ?!</p>
    </div>
    <div class="button-container">
        <div class="button-container-horizontal">
            <a href="property.php">
                <button class="button">Buy property</button>
            </a>
        </div>
        <a href="companyPolicy.php">
                <button class="button button-policy">Review our company policy and transactions information</button>
        </a>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 Real Estate Company | All Rights Reserved</p>
            <p>DAMAN GROUP</p>
            <div class="social-links">
                <img src='images/facebook2.png' alt='Facebook'> 
                <img src='images/instagram.png' alt='Instagram'> 
                <img src='images/XLogo.png' alt='X'> 
            </div>
        </div>
    </footer>
</body>
</html>
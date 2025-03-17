<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Daman Group</title>
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
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
                font-size: 14px;
                color: #000;
                text-decoration: none;
            }

            .content {
                text-align: center;
                padding: 50px 20px;
                animation: slideIn 1.5s ease-out; 
            }

            .content h1 {
                font-size: 36px;
                font-weight: bold;
                margin: 0;
                color: #000;
            }

            .content p {
                font-size: 18px;
                margin: 10px 0 30px;
                color: #000;
            }

            .image-container {
                width: 100%;
                height: 450px;
                overflow: hidden;
                position: relative;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); 
            }

            .image-slider {
                display: flex;
                height: 100%;
                animation: swipe 15s ; 
            }

            .image-slider img {
                width: 100%;
                height: 100%;
                flex-shrink: 0;
                object-fit: cover; 
            }

            @keyframes slideIn {
                from {
                    transform: translateX(-100%); 
                    opacity: 0; 
                }
                to {
                    transform: translateX(0); 
                    opacity: 1; 
                }
            }

            @keyframes swipe {
                0% {
                    transform: translateX(0%);
                }
                20% {
                    transform: translateX(-100%);
                }
                40% {
                    transform: translateX(-200%);
                }
                60% {
                    transform: translateX(-300%);
                }
            }

            .listings-section {
                padding: 40px 20px;
                text-align: center;
                padding-bottom: 50px;
            }

            .listings-section h2 {
                font-size: 36px;
                font-weight: bold;
                margin-bottom: 20px;
                color: #333;
            }

            .listings-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 20px;
                max-width: 1200px;
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
                color:rgb(24, 117, 63); 
                font-size: 12px;
                text-transform: uppercase;
                margin-bottom: 10px;
            }
        


            .container {
            display: flex; 
            height: 50vh; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 

            }

            .left {
                flex: 1; 
                background-image: url('images/building6.png');
                background-size: cover;
                background-position: center;
            }

            .right {
                flex: 1; 
                display: flex;
                flex-direction: column;
                justify-content: center; 
                padding: 40px;
                background-color: #d2d5c9;
                color: black;
            }

            .right h1 {
                font-size: 2.5rem;
                margin-bottom: 20px;
            }

            .right p {
                font-size: 1.2rem;
                margin: 10px 0;
                line-height: 1.5;
            }

            .container2 { 
                max-width: 1500px;
                margin: 50px auto; 
                padding: 20px; 
                background-color: #d2d5c9; 
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
                text-align: center; 
            } 

            h1 { 
                font-size: 2em; 
                margin-bottom: 20px;
            } 

            p { 
                margin: 10px 0;
            }

            .contact-info { 
                font-size: 1em; 
            }

            .social-icons img { 
                width: 30px; 
                margin: 0 10px; 
            }    
        </style>
    </head>
    <body>
        <div class='header'>
            <div class='logo'></div>
            <div class='title'>DAMAN GROUP</div>
            <div>
                <a href='login.php' class='contact'>Login</a>
            </div>
        </div>
        <div class='content'>
            <h1>Looking to buy or sell your property?</h1>
            <p>You've come to the right place.</p>
        </div>
        <div class='image-container'>
            <div class='image-slider'>
                <img src='images/b3.jpg' alt='Building 2'>
                <img src='images/room3.jpg' alt='Building 3'>
                <img src='images/land2.jpg' alt='Building 4'>
                <img src='images/b4.jpg' alt='Building 5'>
            </div>
        </div>

        <div class='listings-section'>
            <h2>Recent Listings</h2>
            <div class='listings-grid'>
                <div class='listing-card'>
                    <img src='images/building7.jpg' alt='Modern Family Home'>
                    <div class='details'>
                        <p class='info'>New / For Sale</p>
                        <h3>Modern Family Home</h3>
                    </div>
                </div>
                <div class='listing-card'>
                    <img src='images/room1.jpg' alt='Loft Style Apartment'>
                    <div class='details'>
                        <p class='info'>New / For Sale</p>
                        <h3>Loft Style Apartment</h3>
                    </div>
                </div>
                <div class='listing-card'>
                    <img src='images/building3.jpg' alt='luxury apartment'>
                    <div class='details'>
                        <p class='info'>Renovated / For Sale</p>
                        <h3>luxury apartment</h3>
                    </div>
                </div>
            </div>
            
        </div>
        <div class='container'>
            <div class='left'></div>
            <div class='right'>
                <h1>WHY CHOOSE US?</h1>
                <p>We have a strong track record of successful projects.</p>
                <p>We negotiate the best deals for our clients.</p>
                <p>We have a dedicated team with the expertise and skills.</p>
                <p>We have a solid network of resources in the industry.</p>
            </div>
        </div>

        <div class='container2'>
            <h1>GET IN TOUCH</h1>
            <div class'contact-info'> 
                <p>Main Office</p> 
                <p>123 Palestine St.</p> 
                <p>Any Ramallah, ST 12345</p> 
                <p>Tel: (123) 456-7890</p>
                <p>Email: hello@damansite.com</p> 
                <p>Social: @damansite</p> 
            </div> 
            <div class='social-icons'> 
                <img src='images/facebook2.png' alt='Facebook'> 
                <img src='images/instagram.png' alt='Instagram'> 
                <img src='images/XLogo.png' alt='X'> 
            </div> 
        </div>
    </body>
    </html>
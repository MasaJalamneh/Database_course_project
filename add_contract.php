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
    </style>
    <script>
        function fetchProperties() {
    var ownerID = document.querySelector('select[name="ownerID"]').value;

    // Make sure an owner is selected
    if (ownerID) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_properties.php?ownerID=" + ownerID, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var properties = JSON.parse(xhr.responseText);
                var propertySelect = document.querySelector('select[name="propertyID"]');
                propertySelect.innerHTML = "<option value='' disabled selected>Select the Property</option>";
                
                properties.forEach(function(property) {
                    var option = document.createElement("option");
                    option.value = property.propertyID;
                    option.text = property.propertyAddress;
                    propertySelect.appendChild(option);
                });
            }
        };
        xhr.send();
    }
}
        let countdown = 10; // 10 seconds
        function startCountdown() {
            const timerElement = document.getElementById("timer");
            const interval = setInterval(function() {
                countdown--;
                timerElement.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(interval);
                    window.location.href = "employee.php"; 
                }
            }, 1000); // Update every 1 second
        }
    </script>
</head>
<body onload="startCountdown()">
<?php
            include 'MysqlConnection.php';
            session_start();
            $ownerID = $_SESSION['ownerID'] ;
            $clientID = $_SESSION['clientID'] ;
            $propertyID = $_SESSION['propertyID'] ;
            $transactionType = $_SESSION['transactionType'] ;
            $salePrice = $_SESSION['salePrice'] ;
            $employeeID = $_SESSION['employeeID'] ;
            $paymentTerms = $_SESSION['paymentTerms'] ;
            $transactionDate = $_SESSION['transactionDate'] ;
            $appointmentDate = $_SESSION['appointmentDate'] ;
            
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $contractType = $_POST['contractType'];
                $startDate = trim($_POST['startDate']);
                $status = $_POST['status'];
                $termsAndConditions = $_POST['termsAndConditions'];
                $expiryDate = trim($_POST['expiryDate']);

                $sql1 = "INSERT INTO contract (contractType, status, startDate, termsAndConditions, expiryDate) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql1);
                $stmt->bind_param("sssss", $contractType, $status, $startDate, $termsAndConditions, $expiryDate);
                if ($stmt->execute()) {
                    $sql2 = $conn->prepare("SELECT max(contractID) from contract");
                $sql2->execute();
                $sql2->bind_result($contractID);
                $sql2->fetch();
                $sql2->close();

                $sql3 = "INSERT INTO transaction (salePrice, paymentTerms, transactionDate, transactionType, contractID, clientID, ownerID, employeeID, propertyID, appointmentDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt2 = $conn->prepare($sql3);
                $stmt2->bind_param("ssssiiiiis", $salePrice, $paymentTerms, $transactionDate, $transactionType, $contractID, $clientID, $ownerID, $employeeID, $propertyID, $appointmentDate);
                if($stmt2->execute()){
                    $sql = "DELETE from buy_requests where status like 'reviewed'";
                    $res = $conn->prepare($sql);
                    $res->execute();
                    echo "<div class='login-container'><p>New Transaction Added Successfully. Employee Dashboard in <strong><span id='timer'>10</span> seconds.</strong></p></div>";
                }

                } else {
                    echo "Error adding property: " . $stmt->error;
                }
                                
                

                $stmt->close();
            }
        ?>
        </body>
</html>


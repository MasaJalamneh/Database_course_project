<?php
include 'MysqlConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);

    // update contact_requests
    $query = $conn->prepare("UPDATE contact_requests SET status = 'reviewed' WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();

    
    if ($query->affected_rows > 0) {
        header("Location: employee.php");
        exit();
    } else {
        // update sell requests if the request is not contact
        $query = $conn->prepare("UPDATE sell_requests SET status = 'reviewed' WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
    
        if ($query->affected_rows > 0) {
            header("Location: employee.php");
            exit();
        } else {
        // if neither contact nor sell then it might be buy request, update it!
        $query = $conn->prepare("UPDATE buy_requests SET status = 'reviewed' WHERE email = ?");
        $query->bind_param("s", $email);

        if ($query->execute()) {

            $result = $conn->query("SELECT id FROM buy_requests WHERE email = '$email' AND status = 'reviewed' ORDER BY id DESC LIMIT 1");

            if ($result && $row = $result->fetch_assoc()) {
                // redirect to add new transaction
                header("Location: create_transaction.php?buyRequestID=" . $row['id']);
                exit();
            } else {
                echo "No buy request found with the reviewed status.";
            }
        } else {
            echo "Error updating status: " . $conn->error;
        }}
    } 
} else {
    echo "Invalid request.";
}

$conn->close();
?>

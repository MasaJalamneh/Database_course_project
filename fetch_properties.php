<?php
include 'MysqlConnection.php';

if (isset($_GET['ownerID'])) {
    $ownerID = $_GET['ownerID'];

    // Query to fetch properties for the selected owner
    $result = $conn->query("SELECT propertyID, propertyAddress FROM property WHERE ownerID = '$ownerID'");

    $properties = [];
    while ($row = $result->fetch_assoc()) {
        $properties[] = $row;
    }

    // Return the properties as a JSON response
    echo json_encode($properties);
}
?>

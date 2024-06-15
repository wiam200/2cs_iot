<?php
    require 'database.php';

    // Check if ID is provided in the request
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        
        // Fetch the current status from the database
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT status FROM table_the_iot_projects WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $row = $q->fetch(PDO::FETCH_ASSOC);
        $currentStatus = $row['status'];

        // Update the status
        $newStatus = $currentStatus == 1 ? 0 : 1; // Toggle the status (1 to 0 or 0 to 1)
        $sql = "UPDATE table_the_iot_projects SET status = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($newStatus, $id));
        
        Database::disconnect();

        // Redirect back to the user data page
        header("Location: user data.php");
        exit();
    } else {
        // Handle the case when ID is not provided
        // Redirect or display an error message
    }
?>

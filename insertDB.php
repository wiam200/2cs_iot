<?php
require 'database.php';

if (!empty($_POST)) {
    // Keep track of post values
    $name = $_POST['name'];
    $id = $_POST['id'];
    $pin = $_POST['pinn'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $dep = $_POST['dep']; // New department field

    // Connect to database
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if user with the given ID already exists
    $sql = "SELECT COUNT(*) FROM table_the_iot_projects WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $idExists = $q->fetchColumn();

    if ($idExists > 0) {
        $message = "User with this ID already exists. ";
        header("Location: registration.php?message=" . urlencode($message));
        exit();
    }

    // Check if user with the given PIN already exists
    $sql = "SELECT COUNT(*) FROM table_the_iot_projects WHERE pin = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pin));
    $pinExists = $q->fetchColumn();

    if ($pinExists > 0) {
        $message = "User with this PIN already exists.";
        header("Location: registration.php?message=" . urlencode($message));
        exit();
    }

    // Check if user with the given email already exists
    $sql = "SELECT COUNT(*) FROM table_the_iot_projects WHERE email = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($email));
    $emailExists = $q->fetchColumn();

    if ($emailExists > 0) {
        $message = "User with this email already exists. ";
        header("Location: registration.php?message=" . urlencode($message));
        exit();
    }

    // Check if user with the given mobile number already exists
    $sql = "SELECT COUNT(*) FROM table_the_iot_projects WHERE mobile = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($mobile));
    $mobileExists = $q->fetchColumn();

    if ($mobileExists > 0) {
        $message = "User with this mobile number already exists.";
        header("Location: registration.php?message=" . urlencode($message));
        exit();
    }

    // Insert data
    $sql = "INSERT INTO table_the_iot_projects (name, id, pin, gender, email, mobile, user_date, dep) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($name, $id, $pin, $gender, $email, $mobile, $dep));
    Database::disconnect();
    header("Location: user data.php");
    exit(); // Ensure no further code is executed
}
?>

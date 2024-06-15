<?php
session_start();

// Redirect to home page if user is already logged in
if (isset($_SESSION['Admin-name'])) {
    header("location: home.php");
    exit();
}

// Include database connection
require 'database.php';

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL statement to fetch user data from database
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM admin WHERE admin_email=:email ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists
    if ($user) {
        // Verify password
        if (password_verify($password, $user['admin_pwd'])) {
            // Password is correct, start session and store user info
            $_SESSION['Admin-name'] = $user['admin_name'];
            $_SESSION['Admin-email'] = $user['admin_email'];
            header("location: home.php");
            exit();
        } else {
            // Incorrect password
            header("location: login.php?error=wrongpassword");
            exit();
        }
    } else {
        // User does not exist
        header("location: login.php?error=nouser");
        exit();
    }
} else {
    // Redirect back to login page if accessed directly
    header("location: login.php");
    exit();
}
?>

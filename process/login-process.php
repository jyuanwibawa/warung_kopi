<?php
session_start();

// Establish database connection
$dsn = 'mysql:host=localhost;dbname=cafe';  // Update with your actual database details
$dbUsername = 'root';           // Replace with your database username
$dbPassword = '';           // Replace with your database password

try {
    $db = new PDO($dsn, $dbUsername, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = trim($_POST['form_username']);
    $inputPassword = trim($_POST['form_password']);

    // Fetch user from the database based on the username
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$inputUsername]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($inputPassword, $user['password'])) {
        // Set session to store the username
        $_SESSION['username'] = $user['username'];

        header("Location: ../profile.php");
        exit();
    } else {
        header("Location: ../login2.html");
        exit();
    }
}

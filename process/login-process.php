<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = trim($_POST['form_username']);
    $inputPassword = trim($_POST['form_password']);

    // Ambil data pengguna dari database
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$inputUsername]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($inputPassword, $user['password'])) {
        // Set session untuk menyimpan username
        $_SESSION['username'] = $user['username'];

        header("Location: ../profile.php");
        exit();
    } else {
        header("Location: ../login.html");
        exit();
    }
}

?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['form_username'];
    $password = $_POST['form_password'];
    $confirmPassword = $_POST['form_konfirmasi_password'];

    // Check if the password matches the confirmation password
    if ($password !== $confirmPassword) {
        echo "<script>alert('Password tidak cocok!'); window.location.href = 'register.html';</script>";
        exit();
    }

    // Save the data to a file (plaintext for demo purposes)
    $file = fopen("users.txt", "a");
    fwrite($file, "Username: " . $username . "\nPassword: " . $password . "\n\n");
    fclose($file);

    // Success message
    echo "<script>alert('Berhasil register!'); window.location.href = 'login.html';</script>";
}
?>

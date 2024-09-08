<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['form_username'];
    $password = $_POST['form_password'];
    $confirmPassword = $_POST['form_konfirmasi_password'];

    // Cek jika password dan konfirmasi password cocok
    if ($password !== $confirmPassword) {
        header('Location: register.html');
        exit();  // Pastikan skrip berhenti setelah pengalihan
    }

    // Simpan data ke file plaintext
    $file = fopen("users.txt", "a");
    fwrite($file, "Username: " . $username . "\nPassword: " . $password . "\n\n");
    fclose($file);

    // Redirect setelah berhasil registrasi
    header('Location: ../login.html');
    exit();  // Pastikan skrip berhenti setelah pengalihan
}
?>

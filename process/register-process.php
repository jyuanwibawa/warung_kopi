<?php
// Cek apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = $_POST["form_username"];
    $password = $_POST["form_password"];
    $konfirmasi_password = $_POST["form_konfirmasi_password"];

    // Validasi apakah password dan konfirmasi password cocok
    if ($password != $konfirmasi_password) {
        echo "Password dan konfirmasi password tidak cocok.";
    } else {
        // Jika ingin menyimpan data ke file teks (opsional)
        $data = "Username: " . $username . " | Password: " . $password . "\n";

        // Simpan data ke file register.txt
        file_put_contents("register.txt", $data, FILE_APPEND);

        // Berikan pesan keberhasilan
        echo "Registrasi berhasil!";
    }
}
?>

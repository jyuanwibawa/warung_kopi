<?php
// Contoh koneksi ke database MySQL menggunakan PDO
$dsn = 'mysql:host=localhost;dbname=cafe';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['form_fullname'];
    $username = $_POST['form_username'];
    $email = $_POST['form_email'];
    $phone = $_POST['form_phone'];
    $password = password_hash($_POST['form_password'], PASSWORD_BCRYPT); // Hash password
    $confirmPassword = $_POST['form_konfirmasi_password'];

    if (!password_verify($confirmPassword, $password)) {
        header('Location: register2.html');
        exit();
    }

    // Insert data ke tabel users
    $stmt = $db->prepare("INSERT INTO users (fullname, username, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$fullname, $username, $email, $phone, $password]);

    // Dapatkan ID pengguna yang baru saja diinsert
    $userId = $db->lastInsertId();

    // Cek apakah ada file yang diunggah
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "../img/" . $username . "/";
        $targetFile = $targetDir . "Profile.png";

        // Buat direktori jika belum ada
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $targetFile)) {
            // Insert path gambar ke tabel profile_images
            $stmt = $db->prepare("INSERT INTO profile_images (user_id, image_path) VALUES (?, ?)");
            $stmt->execute([$userId, $targetFile]);
        }
    }

    header('Location: ../login2.html');
    exit();
}

?>

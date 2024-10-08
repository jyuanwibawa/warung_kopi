<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['form_fullname']; 
    $username = $_POST['form_username'];
    $email = $_POST['form_email']; 
    $phone = $_POST['form_phone']; 
    $password = $_POST['form_password'];
    $confirmPassword = $_POST['form_konfirmasi_password'];

    // Validasi password
    if ($password !== $confirmPassword) {
        header('Location: register.html');
        exit(); 
    }

    // Simpan data pengguna ke dalam file users.txt
    $file = fopen("users.txt", "a");
    fwrite($file, "Full Name: " . $fullname . "\n");
    fwrite($file, "Username: " . $username . "\n");
    fwrite($file, "Email: " . $email . "\n");
    fwrite($file, "Phone: " . $phone . "\n");
    fwrite($file, "Password: " . $password . "\n\n"); 
    fclose($file);

    // Mengupload gambar
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] == UPLOAD_ERR_OK) {
        // Tentukan nama folder berdasarkan username
        $targetDir = "img/" . $username . "/"; // Folder tujuan untuk menyimpan gambar
        $targetFile = $targetDir . basename($_FILES['fileInput']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Cek apakah file gambar adalah gambar yang sebenarnya
        $check = getimagesize($_FILES['fileInput']['tmp_name']);
        if ($check === false) {
            die("File yang diunggah bukan gambar.");
        }

        // Cek ukuran file (misalnya maksimum 5MB)
        if ($_FILES['fileInput']['size'] > 5000000) {
            die("Maaf, ukuran file terlalu besar.");
        }

        // Hanya izinkan format file tertentu
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            die("Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.");
        }

        // Coba untuk membuat folder jika belum ada
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Buat folder berdasarkan username
        }

        // Pindahkan file yang diunggah ke folder tujuan
        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $targetFile)) {
            echo "File gambar telah diunggah ke folder " . $targetDir;
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah gambar. Kode kesalahan: " . $_FILES['fileInput']['error'];
        }
    } else {
        echo "Tidak ada gambar yang diunggah atau terjadi kesalahan. Kode kesalahan: " . $_FILES['fileInput']['error'];
    }

    header('Location: ../login.html');
    exit();  
}
?>

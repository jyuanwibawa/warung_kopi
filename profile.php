<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];

// Koneksi ke database
$dsn = 'mysql:host=localhost;dbname=cafe';  // Ganti dengan informasi database Anda
$dbUsername = 'root';  // Ganti dengan username database Anda
$dbPassword = '';  // Ganti dengan password database Anda

try {
    $db = new PDO($dsn, $dbUsername, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}

// Ambil data user dari tabel users berdasarkan username
$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$userData) {
    die("User not found.");
}

$profileImgPath = "img/" . htmlspecialchars($username) . "/";
$profileImgSrc = $profileImgPath . "Profile.png";

if (!file_exists($profileImgSrc)) {
    $profileImgSrc = "img/default-profile.png";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil dan Edit Profil</title>
    <link rel="stylesheet" href="css/profile.css" />
    <style>
        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            .profile-section, .edit-profile-section {
                padding: 20px;
            }
            .nav-links li {
                display: block;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="assets/logo.svg" alt="Logo" style="height: 50px" />
        </div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="#byMood">By Mood</a></li>
            <li><a href="#byActivity">By Activity</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <main>
            <div class="profile-section">
                <h2>Profil</h2>
                <div class="profile-picture">
                    <img src="<?php echo htmlspecialchars($profileImgSrc); ?>" alt="Foto Profil" id="profileImg" />
                    <button class="edit-button" id="editProfile">Edit Profil</button>
                </div>
                <div class="profile-details">
                    <p><strong>Nama:</strong> <?php echo htmlspecialchars($userData['fullname']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
                    <p><strong>Telepon:</strong> <?php echo htmlspecialchars($userData['phone']); ?></p>
                </div>
            </div>

            <div class="edit-profile-section" style="display: none;">
                <h2>Edit Profil</h2>
                <div class="profile-picture">
                    <img src="<?php echo htmlspecialchars($profileImgSrc); ?>" alt="Foto Profil" id="profileImgEdit" />
                    <form action="update-profile.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="profileImage" id="fileInput" accept="image/*" />
                        <label for="fileInput" class="upload-button">Ganti Foto</label>
                        <button type="submit" class="save-button">Simpan Perubahan</button>
                        <button type="button" class="cancel-button" id="cancelEdit">Batal</button>
                    </form>
                </div>

                <div class="profile-details">
                    <form action="update-profile.php" method="POST">
                        <label for="fullname">Nama</label>
                        <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($userData['fullname']); ?>" required />

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required />

                        <label for="phone">Telepon</label>
                        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($userData['phone']); ?>" required />

                        <button type="submit" class="save-button">Simpan Perubahan</button>
                        <button type="button" class="cancel-button" id="cancelEdit">Batal</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        const profileSection = document.querySelector(".profile-section");
        const editProfileSection = document.querySelector(".edit-profile-section");
        const editButton = document.getElementById("editProfile");
        const cancelButtons = document.querySelectorAll("#cancelEdit");

        editButton.addEventListener("click", () => {
            profileSection.style.display = "none";
            editProfileSection.style.display = "block";
        });

        cancelButtons.forEach(button => {
            button.addEventListener("click", () => {
                editProfileSection.style.display = "none";
                profileSection.style.display = "block";
            });
        });
    </script>
</body>
</html>

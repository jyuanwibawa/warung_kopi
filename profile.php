<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
$usersFile = "process/users.txt";
$userData = [
    'full_name' => '',
    'username' => '',
    'email' => '',
    'phone' => '',
    'password' => ''
];

function parseUsersFile($filePath) {
    $users = [];

    if (!file_exists($filePath)) {
        return $users;
    }

    $fileContent = file_get_contents($filePath);
  
    $userBlocks = preg_split("/\n\s*\n/", trim($fileContent));

    foreach ($userBlocks as $block) {
        $lines = explode("\n", trim($block));
        $user = [];
        foreach ($lines as $line) {
            $parts = explode(":", $line, 2);
            if (count($parts) == 2) {
                $key = strtolower(trim($parts[0]));
                $value = trim($parts[1]);
                $key = str_replace(' ', '_', $key);
                $user[$key] = $value;
            }
        }
        if (!empty($user)) {
            $users[] = $user;
        }
    }

    return $users;
}

$allUsers = parseUsersFile($usersFile);

foreach ($allUsers as $user) {
    if (isset($user['username']) && $user['username'] === $username) {
        $userData = $user;
        break;
    }
}

if (empty($userData['username'])) {
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
                    <p><strong>Nama:</strong> <?php echo htmlspecialchars($userData['full_name']); ?></p>
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
                        <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($userData['full_name']); ?>" required />

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

<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile and Edit Profile</title>
    <link rel="stylesheet" href="css/profile.css" />
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="assets/logo.svg" alt="" style="height: 50px" />
        </div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="#about">By Mood</a></li>
            <li><a href="#services">By Activity</a></li>
        </ul>
    </nav>
    <div class="container">
        <main>
            <!-- Profile Section -->
            <div class="profile-section">
                <h2>Profile</h2>
                <div class="profile-picture">
                    <img src="<?php echo $profileImgSrc; ?>" alt="Profile Picture" id="profileImg" />
                    <button class="edit-button" id="editProfile">Edit Profile</button>
                </div>
                <div class="profile-details">
                    <p><strong>Name:</strong> <?php echo trim($userData['fullname']); ?></p>
                    <p><strong>Email:</strong> <?php echo trim($userData['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo trim($userData['phone']); ?></p>
                </div>
            </div>

            <!-- Edit Profile Section -->
            <div class="edit-profile-section" style="display: none">
                <h2>Edit Profile</h2>
                <div class="profile-picture">
                    <img src="<?php echo $profileImgSrc; ?>" alt="Profile Picture" id="profileImgEdit" />
                    <input type="file" id="fileInput" accept="image/*" />
                    <label for="fileInput" class="upload-button">Change Photo</label>
                    <button class="delete-button" id="deletePhoto">Remove Photo</button>
                </div>

                <div class="profile-details">
                    <form id="editProfileForm">
                        <label for="name">Name</label>
                        <input type="text" id="name" value="<?php echo trim($userData['fullname']); ?>" />

                        <label for="email">Email</label>
                        <input type="email" id="email" value="<?php echo trim($userData['email']); ?>" />

                        <label for="phone">Phone</label>
                        <input type="text" id="phone" value="<?php echo trim($userData['phone']); ?>" />

                        <button type="button" class="save-button" id="saveProfile">Save</button>
                        <button type="button" class="cancel-button" id="cancelEdit">Cancel</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        const profileSection = document.querySelector(".profile-section");
        const editProfileSection = document.querySelector(".edit-profile-section");
        const editButton = document.getElementById("editProfile");
        const cancelButton = document.getElementById("cancelEdit");
        const saveButton = document.getElementById("saveProfile");
        const deleteButton = document.getElementById("deletePhoto");
        const profileImg = document.getElementById("profileImg");
        const profileImgEdit = document.getElementById("profileImgEdit");
        const fileInput = document.getElementById("fileInput");

        editButton.addEventListener("click", () => {
            profileSection.style.display = "none";
            editProfileSection.style.display = "block";
            profileImgEdit.src = profileImg.src;
        });

        cancelButton.addEventListener("click", () => {
            editProfileSection.style.display = "none";
            profileSection.style.display = "block";
        });

        saveButton.addEventListener("click", () => {
            profileImg.src = profileImgEdit.src;
            editProfileSection.style.display = "none";
            profileSection.style.display = "block";
            // Simpan perubahan ke sesi (bisa ditambahkan AJAX jika ingin menyimpan ke server)
        });

        fileInput.addEventListener("change", (event) => {
            const reader = new FileReader();
            reader.onload = function () {
                profileImgEdit.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        deleteButton.addEventListener("click", () => {
            profileImgEdit.src = "default-profile.png";
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/register.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body class="bg">
    <div class="bg_regist">
        <div class="textmid">
            Register
        </div>
        <div class="silahkan">
            Silahkan buat akun terlebih dahulu
        </div>
        <form action="register-process.php" method="post">
            <div class="form_username">
                <label class="label_usn">Username</label><br>
                <input type="text" name="form_username" required><br>
            </div>
            <div class="form_password">
                <label class="label_pw">Password</label><br>
                <input type="password" name="form_password" required><br>
            </div>
            <div class="form_konfirmasi_password">
                <label class="label_konfpw">Konfirmasi Password</label><br>
                <input type="password" name="form_konfirmasi_password" required><br>
            </div>
            <div class="form_button">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
    <div class="tanya">
        Sudah punya akun?
        <a href="login.html">Masuk</a>
    </div>
</body>

</html>

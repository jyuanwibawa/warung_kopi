<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = trim($_POST['form_username']);
    $inputPassword = trim($_POST['form_password']);
    $file = "users.txt";

    if (file_exists($file)) {
        $users = file($file);
        $isAuthenticated = false;
        $currentUser = [];

        foreach ($users as $line) {
            $line = trim($line);

            if (strpos($line, 'Username:') === 0) {
                $currentUser['username'] = trim(str_replace('Username:', '', $line));
            }

            if (strpos($line, 'Password:') === 0) {
                $currentUser['password'] = trim(str_replace('Password:', '', $line));
            }

            if (isset($currentUser['username']) && isset($currentUser['password'])) {
                if ($currentUser['username'] === $inputUsername && $currentUser['password'] === $inputPassword) {
                    $isAuthenticated = true;
                    break;
                }

                $currentUser = [];
            }
        }

        if ($isAuthenticated) {
            header("Location: ../home.html");
            exit();
        } else {
            header("Location: ../login.html");
            exit();
        }
    } else {
        // Handle the file not found case if needed
        header("Location: ../login.html");
        exit();
    }
}
?>

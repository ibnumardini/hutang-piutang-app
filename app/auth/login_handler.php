<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] === "login") {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $errors = [];

        if (empty($username)) {
            array_push($errors, "Username/email kosong!");
        }

        if (empty($password)) {
            array_push($errors, "Password kosong!");
        }

        if (!empty($password) && strlen($password) < 6) {
            array_push($errors, "Password kurang dari 6 kata!");
        }

        if (empty($errors)) {
            $query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username' OR email = '$username'");

            if (mysqli_num_rows($query) > 0) {
                $result = mysqli_fetch_assoc($query);

                if ($password === $result['password']) {
                    session_start();

                    $_SESSION['user'] = $result;

                    // remove password from session
                    unset($_SESSION['user']['password']);

                    header("Location: /app/index.php");
                    exit;
                }
            }

            array_push($errors, "Login gagal!");
        }

        $alert = ['danger', $errors];
    }
}
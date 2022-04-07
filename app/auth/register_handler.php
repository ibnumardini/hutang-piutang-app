<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] === "register") {
        $name = htmlspecialchars($_POST['name']);
        $username = htmlspecialchars($_POST['username']);
        $wa_num = htmlspecialchars($_POST['wa_num']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $errors = [];

        if (empty($username)) {
            array_push($errors, "Username kosong!");
        }

        if (empty($name)) {
            array_push($errors, "Name kosong!");
        }

        if (empty($wa_num)) {
            array_push($errors, "No Whatsapp kosong!");
        }

        if (!empty($wa_num) && !is_numeric($wa_num)) {
            array_push($errors, "No Whatsapp harus angka!");
        }

        if (empty($email)) {
            array_push($errors, "E-mail kosong!");
        }

        if (!empty($email) && strpos($email, '@') === false) {
            array_push($errors, "E-mail tidak valid!");
        }

        if (empty($password)) {
            array_push($errors, "Password kosong!");
        }

        if (!empty($password) && strlen($password) < 6) {
            array_push($errors, "Password kurang dari 6 kata!");
        }

        if (empty($errors)) {
            $insert = mysqli_query($con, "INSERT INTO `users` (`username`, `name`, `wa_num`, `email`, `password`) VALUES ('$username', '$name', '$wa_num', '$email', '$password')");

            mysqli_close($con);

            if ($insert) {
                $alert = ['success', ['Register berhasil!']];
            } else {
                $alert = ['danger', ['Register gagal!']];
            }
        } else {
            $alert = ['danger', $errors];
        }
    }
}
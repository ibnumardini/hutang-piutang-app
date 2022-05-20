<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] === "edit_profile") {
        $fullname = htmlspecialchars($_POST['fullname']);
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $wa_num = htmlspecialchars($_POST['wa_num']);
        $password = htmlspecialchars($_POST['password']);

        $errors = [];

        unset($_POST['password']);
        unset($_POST['avatar']); //* cek lagi ntar!

        foreach ($_POST as $key => $val) {
            if (empty($val)) {
                $new_key = ucfirst($key);

                array_push($errors, str_replace("_", " ", $new_key) . " kosong!");
            }
        }

        if (!empty($email) && strpos($email, '@') === false) {
            array_push($errors, "E-mail tidak valid!");
        }

        if (!empty($password) && strlen($password) < 6) {
            array_push($errors, "Password kurang dari 6!");
        }

        if (empty($errors)) {
            $query = "UPDATE users SET name='$fullname', username='$username', email='$email', wa_num='$wa_num'";

            if (!empty($password)) {
                $query .= ", password='$password'";
            }

            $query .= " WHERE id = '$session_user_id'";

            $update = mysqli_query($con, $query);

            if ($update) {
                $alert = ['success', ['Data di update!']];
            } else {
                $alert = ['danger', 'Data gagal update!'];
            }
        } else {
            $alert = ['danger', $errors];
        }
    }
}

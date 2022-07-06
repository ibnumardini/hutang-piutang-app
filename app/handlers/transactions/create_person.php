<?php

function is_person_exists($name)
{
    global $session_user_id;
    global $con;

    $person = mysqli_query($con, "SELECT * FROM persons WHERE name='$name' AND user_id='$session_user_id'");
    $row = mysqli_fetch_assoc($person);

    if (mysqli_num_rows($person) > 0) {
        return [true, $row['id']];
    }

    return [false];
}

if (isset($_POST['action'])) {
    if ($_POST['action'] === "create_person") {
        $name = htmlspecialchars($_POST['name']);
        $wa_num = htmlspecialchars($_POST['wa_num']);
        $view_page = htmlspecialchars($_GET['view']);

        $errors = [];

        if (empty($name)) {
            $errors[] = "Name is empty!";
        }

        if (empty($wa_num)) {
            $errors[] = "Whatsapp Number is empty!";
        }

        if (!empty($wa_num) && strlen($wa_num) < 10) {
            $errors[] = "Whatsapp number terlalu pendek";
        }

        if (empty($errors)) {
            [$ok, $last_id] = is_person_exists($name);
            if (!$ok) {
                $insert = mysqli_query($con, "INSERT INTO persons(name, wa_num, user_id) VALUES('$name', '$wa_num', '$session_user_id')");
                $last_id = mysqli_insert_id($con);
            }

            $origin = $_SERVER['HTTP_ORIGIN'];
            $url = sprintf("%s/app/index.php?page=transactions&view=%s&person_id=%s&action=create", $origin, $view_page, $last_id);

            header("Location: $url");
            exit;
        } else {
            $alert = ['danger', $errors];
        }
    }
}

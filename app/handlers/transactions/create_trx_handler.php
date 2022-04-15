<?php
function fmt_to_timestamp($date)
{
    $date = str_replace("T", " ", $date);
    $date = $date . ":00";

    return $date;
}

function insert_persons($con, $name)
{
    $person = is_person_exists($con, $name);
    if ($person[0]) {
        return $person[1];
    }

    $insert = mysqli_query($con, "INSERT INTO persons(name) VALUES('$name')");
    $last_insert_id = mysqli_insert_id($con);

    return $last_insert_id;
}

function is_person_exists($con, $name)
{
    $person = mysqli_query($con, "SELECT * FROM persons WHERE name='$name'");
    $row = mysqli_fetch_assoc($person);

    if (mysqli_num_rows($person) > 0) {
        return [true, $row['id']];
    }

    return [false];
}

if (isset($_POST["action"])) {
    if ($_POST["action"] === "create_trx") {
        $use_for = htmlspecialchars($_POST['use_for']);
        $fav_person = htmlspecialchars($_POST['fav_person']);
        $new_person = htmlspecialchars($_POST['new_person']);
        $nominal = htmlspecialchars($_POST['nominal']);
        $transaction_at = htmlspecialchars($_POST['transaction_at']);
        $transaction_at = fmt_to_timestamp($transaction_at);
        $due_date = htmlspecialchars($_POST['due_date']);
        $due_date = fmt_to_timestamp($due_date);
        $type = htmlspecialchars($_POST['type']);

        if (empty($fav_person)) {
            unset($_POST['fav_person']);
        } else {
            unset($_POST['new_person']);
        }

        $errors = [];

        foreach ($_POST as $key => $val) {
            if (empty($val)) {
                $new_key = ucfirst($key);

                array_push($errors, str_replace("_", " ", $new_key) . " kosong!");
            }
        }

        if (!empty($nominal) && strlen($nominal) > 11) {
            array_push($errors, "Nominal tidak boleh lebih dari 11");
        }

        if (empty($errors)) {
            if (empty($fav_person)) {
                $fav_person = insert_persons($con, $new_person);
            }

            $insert = mysqli_query($con, "INSERT INTO `transactions`(`type`, `user_for`, `person_id`, `nominal`, `transaction_at`, `due_date`) VALUES ('$type','$use_for','$fav_person','$nominal','$transaction_at','$due_date')");

            if ($insert) {
                $alert = ['success', ['Data di tambahkan!']];
            } else {
                $alert = ['danger', 'Data di gagal tambahkan!'];
            }
        } else {
            $alert = ['danger', $errors];
        }
    }
}

// to show list person
function get_all_person($con)
{
    $person = mysqli_query($con, "SELECT * FROM persons");

    $persons = [];

    while ($row = mysqli_fetch_assoc($person)) {
        array_push($persons, $row);
    }

    return $persons;
}

$persons = get_all_person($con);
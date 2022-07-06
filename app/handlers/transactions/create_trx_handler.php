<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] === "create_trx") {
        $use_for = htmlspecialchars($_POST['use_for']);
        $person_id = htmlspecialchars($_POST['person_id']);
        $nominal = htmlspecialchars($_POST['nominal']);

        $transaction_at = htmlspecialchars($_POST['transaction_at']);
        $transaction_at = fmt_to_timestamp($transaction_at);
        $transaction_at = $transaction_at . ":00";

        $due_date = htmlspecialchars($_POST['due_date']);
        $due_date = fmt_to_timestamp($due_date);
        $due_date = $due_date . ":00";

        $type = htmlspecialchars($_POST['type']);

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
            $insert = mysqli_query($con, "INSERT INTO `transactions`(`type`, `user_id`, `use_for`, `person_id`, `nominal`, `transaction_at`, `due_date`) VALUES ('$type','$session_user_id','$use_for','$person_id','$nominal','$transaction_at','$due_date')");

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
function get_all_person()
{
    global $session_user_id;
    global $con;

    $person = mysqli_query($con, "SELECT * FROM persons WHERE user_id='$session_user_id'");

    $persons = [];

    while ($row = mysqli_fetch_assoc($person)) {
        array_push($persons, $row);
    }

    return $persons;
}

function get_person_by_id($person_id)
{
    foreach (get_all_person() as $value) {
        if ($person_id === $value['id']) {
            return $value;
        }
    }
}

$persons = get_all_person();

// just call when person id exists
if (isset($_GET['person_id'])) {
    $person_id = htmlspecialchars($_GET['person_id']);

    $personById = get_person_by_id($person_id);
}

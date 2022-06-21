<?php

if (isset($_POST['action'])) {
    if ($_POST['action'] === "update_trxt") {
        $trx_id = htmlspecialchars($_POST['trx_id']);
        $use_for = htmlspecialchars($_POST['use_for']);
        $fav_person = htmlspecialchars($_POST['fav_person']);
        $new_person = htmlspecialchars($_POST['new_person']);
        $nominal = htmlspecialchars($_POST['nominal']);
        $transaction_at = htmlspecialchars($_POST['transaction_at']);
        $transaction_at = fmt_to_timestamp($transaction_at);
        $due_date = htmlspecialchars($_POST['due_date']);
        $due_date = fmt_to_timestamp($due_date);

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

            $update = mysqli_query($con, "UPDATE `transactions` SET use_for='$use_for', person_id='$fav_person', transaction_at='$transaction_at', nominal='$nominal', due_date='$due_date' WHERE id='$trx_id' AND user_id = '$session_user_id';");

            if ($update) {
                $alert = ['success', ['Berhasil di update!']];
            } else {
                $alert = ['danger', ['Gagal di update!']];
            }
        } else {
            $alert = ['danger', $errors];
        }
    }
}

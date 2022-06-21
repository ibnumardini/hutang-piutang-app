<?php

if (isset($_POST['action'])) {
    if ($_POST['action'] === "change_trx_installment") {
        $trx_id = $_POST['id'];
        $temp_nominal = $_POST['temp_nominal'];

        $select = mysqli_query($con, "SELECT * FROM `transactions` WHERE id = '$trx_id' and user_id = '$session_user_id';");
        $transaction = mysqli_fetch_assoc($select);

        $errors = [];

        if (empty($temp_nominal)) {
            array_push($errors, "Nominal tidak boleh kosong!");
        }

        if ($temp_nominal > $transaction['nominal']) {
            array_push($errors, "Inputan tidak valid, melebihi batas!");
        }

        if (empty($errors)) {
            $query = mysqli_query($con, "UPDATE `transactions` SET `temp_nominal`='$temp_nominal', `status`='installment' WHERE id = '$trx_id' AND user_id = '$session_user_id';");

            if ($query) {
                $alert = ['success', ['Berhasil di update!']];
            } else {
                $alert = ['danger', ['Gagal di update!']];
            }
        } else {
            $alert = ['danger', $errors];
        }
    }
}

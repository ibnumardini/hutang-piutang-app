<?php

if (isset($_POST['action'])) {
    if ($_POST['action'] === "change_trx_installment") {
        $trx_id = $_POST['id'];
        $temp_nominal = $_POST['temp_nominal'];

        $query = mysqli_query($con, "UPDATE `transactions` SET `temp_nominal`='$temp_nominal', `status`='installment' WHERE id = '$trx_id' AND user_id = '$session_user_id';");

        if ($query) {
            $alert = ['success', ['Berhasil di update!']];
        } else {
            $alert = ['danger', ['Gagal di update!']];
        }
    }
}

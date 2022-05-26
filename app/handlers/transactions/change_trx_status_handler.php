<?php

if (isset($_POST['action'])) {
    if ($_POST['action'] === "change_trx_status") {
        $trx_id = $_POST['id'];
        $trx_status = $_POST['trx_status'];

        $query = mysqli_query($con, "UPDATE `transactions` SET `status`='$trx_status' WHERE id = '$trx_id' AND user_id = '$session_user_id';");

        if ($query) {
            $alert = ['success', ['Berhasil di update!']];
        } else {
            $alert = ['danger', ['Gagal di update!']];
        }
    }
}

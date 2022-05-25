<?php

if (isset($_POST['action'])) {
    if ($_POST['action'] === "delete") {
        $trx_id = $_POST['id'];

        $query = mysqli_query($con, "DELETE FROM transactions WHERE id = '$trx_id' AND user_id = '$session_user_id'");

        if ($query) {
            $alert = ['success', ['Berhasil di hapus!', 'Wildan pusing!!']];
        } else {
            $alert = ['danger', ['Gagal di hapus!']];
        }
    }
}

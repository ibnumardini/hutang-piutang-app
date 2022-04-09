<?php

if (isset($_GET['view'])) {
    switch ($_GET['view']) {
        case 'debt':
            $where = 'debt';
            break;
        default:
            $where = 'receivable';
            break;
    }
} else {
    $where = 'debt';
}

$query = mysqli_query($con, "SELECT * FROM transactions WHERE type = '$where'");

$transactions = [];

while ($row = mysqli_fetch_assoc($query)) {
    array_push($transactions, $row);
}

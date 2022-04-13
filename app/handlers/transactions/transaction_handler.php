<?php

$page = "Transactions";

if (isset($_GET['view'])) {
    switch ($_GET['view']) {
        case 'debt':
            $where = 'debt';
            $title = "Hutang";
            break;
        default:
            $where = 'receivable';
            $title = "Piutang";
            break;
    }
} else {
    $where = 'debt';
    $title = "Hutang";
}

$query = mysqli_query($con, "SELECT * FROM transactions WHERE type = '$where'");

$transactions = [];

while ($row = mysqli_fetch_assoc($query)) {
    array_push($transactions, $row);
}

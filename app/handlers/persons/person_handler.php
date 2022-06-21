<?php

$page = "Person";

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

$query = "SELECT DISTINCT(p.name) FROM transactions as t LEFT JOIN persons as p ON t.person_id = p.id WHERE t.type = '$where' AND t.user_id = '$session_user_id'";

if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'za':
            $sort = "Z - A";
            $query .= " ORDER BY p.name DESC";
            break;
        default:
            $sort = "A - Z";
            $query .= " ORDER BY p.name ASC";
            break;
    }
}

$trx = mysqli_query($con, $query);

$personsTrx = [];
while ($row = mysqli_fetch_assoc($trx)) {
    array_push($personsTrx, $row);
}
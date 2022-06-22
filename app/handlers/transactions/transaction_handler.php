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

$query = "SELECT t.id, t.type, t.user_id, t.use_for, t.person_id, t.nominal, t.temp_nominal, t.status, t.transaction_at, t.due_date, t.created_at, t.updated_at, p.name FROM transactions as t LEFT JOIN persons as p ON t.person_id = p.id WHERE t.type = '$where' AND t.user_id='$session_user_id'";

// for get specific data
$mode_single = false;

if (isset($_GET['action'])) {
    if (($_GET['action'] === 'installment' || $_GET['action'] === 'edit') && isset($_GET['id'])) {
        $trx_id = $_GET['id'];

        $query .= " AND t.id = $trx_id";

        $mode_single = true;
    }
}

$is_search = false;

if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);

    $query .= " AND t.use_for like '%$search%' ";

    $is_search = true;
}

if ($is_sorted) {
    $query .= " ORDER BY use_for $orderBy";
}

if (isset($_GET['now']) && !$is_search) {
    $query .= " LIMIT $start_page, $per_page";
} else if (!$mode_single || $is_search) {
    if (isset($_GET['now']) && $is_search) {
        $query .= " LIMIT $start_page, $per_page";
    } else {
        $query .= " LIMIT 0, $per_page";
    }
}

$select = mysqli_query($con, $query);

$transactions = [];

while ($row = mysqli_fetch_assoc($select)) {
    $row['trx_status'] = [];

    switch ($row['status']) {
        case 'paid':
            $row['status_badge_color'] = [
                'success', '',
            ];

            array_push($row['trx_status'], 'unpaid');
            break;
        case 'unpaid':
            $row['status_badge_color'] = [
                'danger', '',
            ];

            array_push($row['trx_status'], 'paid');
            break;
        default:
            $row['status_badge_color'] = [
                'warning', 'text-dark',
            ];

            array_push($row['trx_status'], 'paid');
            array_push($row['trx_status'], 'unpaid');
            break;
    }

    array_push($transactions, $row);
}

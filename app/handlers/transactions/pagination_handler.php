<?php

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

$now = isset($_GET['now']) && is_numeric($_GET['now']) ? $_GET['now'] : 1;

$query = "SELECT * FROM transactions WHERE user_id = '$session_user_id' AND type='$where'";

$isset_search = isset($_GET['search']) ? $_GET['search'] : '';
if ($isset_search) {
    $query .= " AND use_for like '%$isset_search%'";
}

$all_data = mysqli_query($con, $query);
$all_data = mysqli_num_rows($all_data);

$per_page = 5;

$total_pages = ceil($all_data / $per_page);

$start_page = ($now - 1) * $per_page;

$now_get = $now ? "&now=$now" : '';

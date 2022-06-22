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

$all_data = mysqli_query($con, "SELECT * FROM transactions WHERE user_id = '$session_user_id' AND type='$where'");
$all_data = mysqli_num_rows($all_data);

$per_page = 2;

$total_pages = ceil($all_data / $per_page);

$start_page = ($now - 1) * $per_page;
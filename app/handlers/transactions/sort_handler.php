<?php

$is_sorted = false;

if (isset($_GET['sort'])) {
    $sort_mode = $_GET['sort'];
    switch ($sort_mode) {
        case 'az':
            $sort = 'A - Z';
            $orderBy = 'ASC';
            break;
        default:
            $sort = 'Z - A';
            $orderBy = 'DESC';
            break;
    }

    $is_sorted = true;
}

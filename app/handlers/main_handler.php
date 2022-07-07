<?php

// load vendor
require '../vendor/autoload.php';

// load classes
include_once './classes/autoload.php';

$session_user_id = $_SESSION['user']['id'];

$query = mysqli_query($con, "SELECT * FROM users WHERE id = '$session_user_id'");
$user = mysqli_fetch_assoc($query);

$page_now = isset($_GET['page']) ? $_GET['page'] : 'home';

function view_alert()
{
    global $alert;

    include_once './templates/alert.php';
}

function to_rupiah($number)
{
    $result = "Rp " . number_format(empty($number) ? 0 : $number, 2, ',', '.');
    return $result;
}

function dateRfc3309($datetime)
{
    return date('Y-m-d\TH:i:s', strtotime($datetime));
}

function fmt_to_timestamp($date)
{
    $date = str_replace("T", " ", $date);

    return $date;
}

function fmt_to_readable_date($datetime)
{
    return date("d F Y H:i:s", strtotime($datetime));
}

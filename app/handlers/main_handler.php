<?php

$session_user_id = $_SESSION['user']['id'];

$query = mysqli_query($con, "SELECT * FROM users WHERE id = '$session_user_id'");
$user = mysqli_fetch_assoc($query);

$page_now = isset($_GET['page']) ? $_GET['page'] : 'home';

function to_rupiah($number)
{
    $result = "Rp " . number_format(empty($number) ? 0 : $number, 2, ',', '.');
    return $result;
}

function dateRfc3309($datetime)
{
    return date('Y-m-d\TH:i:s', strtotime($datetime));
}

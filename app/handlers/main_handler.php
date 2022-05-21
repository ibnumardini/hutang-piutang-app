<?php

$session_user_id = $_SESSION['user']['id'];
$user_login = $_SESSION['user']['name'];

$page_now = isset($_GET['page']) ? $_GET['page'] : 'home';
<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
}

include_once '../configs/db.php';

include_once './handlers/main_handler.php';

switch ($_GET['page']) {
    case 'profile':
        include_once './handlers/profile/edit_handler.php';
        include_once './handlers/profile/profile_handler.php';
        break;
    case 'transactions':
        include_once './handlers/transactions/transaction_handler.php';
        include_once './handlers/transactions/create_trx_handler.php';
        break;
    default:
        include_once './handlers/home/home_handler.php';
        break;
}

include_once './templates/header.php';
include_once './templates/navbar.php';

switch ($_GET['page']) {
    case 'profile':
        switch ($_GET['action']) {
            case 'edit':
                include_once './pages/profile/edit.php';
                break;
            default:
                include_once './pages/profile/index.php';
                break;
        }
        break;
    case 'transactions':
        switch ($_GET['action']) {
            case 'create':
                include_once './pages/transactions/create.php';
                break;
            default:
                include_once './pages/transactions/index.php';
                break;
        }
        break;
    default:
        include_once './pages/dashboard.php';
        break;
}

include_once './templates/footer.php';

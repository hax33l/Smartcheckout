<?php

require_once('Database/db_connection.php');
require_once('Controllers/UserController.php');
require_once('Controllers/OrderController.php');
require_once('Controllers/NewsletterController.php');
require_once('Controllers/UserOrderController.php');

use App\Controllers\UserController;
use App\Controllers\OrderController;
use App\Controllers\NewsletterController;
use App\Controllers\UserOrderController;


$order_id = OrderController::create($_POST, $conn);

if ($_POST['create_account']) {
    $user_id = UserController::create($_POST, $conn);

    if($order_id && $user_id){
        UserOrderController::create($user_id, $order_id, $conn);
    }
}

if ($_POST['newsletter']) {
    NewsletterController::create($_POST['email'], $conn);
}

echo json_encode($order_id);

$conn->close();

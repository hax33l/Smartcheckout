<?php

require_once('Controllers/PaymentController.php');
require_once('Database/db_connection.php');

use App\Controllers\PaymentController;

$shipping_id = $_POST['shipping_id'];
$result = PaymentController::getPaymentOptionsForShipping($shipping_id, $conn);
echo json_encode($result);

?>
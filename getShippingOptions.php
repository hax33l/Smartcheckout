<?php

require_once('Controllers/ShippingController.php');
require_once('Database/db_connection.php');

use App\Controllers\ShippingController;

$result = ShippingController::getShippingOptions($conn);
echo json_encode($result);

?>
<?php

namespace App\Controllers;

require_once('Models/Payment.php');

use App\Models\Payment;

class PaymentController
{
    public static function getPaymentOptionsForShipping($shipping_id, object $mysqliConn)
    {
        $payment = [];
        $sql_query = "SELECT payment_id, name, image FROM `shipping_payment` JOIN payment ON shipping_payment.payment_id=payment.id WHERE shipping_id = $shipping_id;";
        $result = $mysqliConn->query($sql_query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $payment[] = new Payment($row["payment_id"], $row["name"], $row["image"]);
            }
        }
        return $payment;
    }
}

<?php

namespace App\Controllers;

require_once('Models/UserOrder.php');

use App\Models\UserOrder;

class UserOrderController
{
    public static function create($user_id, $order_id, object $mysqliConn)
    {
        $user_order = new UserOrder($user_id, $order_id);

        $sql_query = "INSERT INTO user_order (user_id, order_id)
                VALUES ('$user_order->user_id','$user_order->order_id')";

        if ($mysqliConn->query($sql_query) === TRUE) {
            $user_order->id = $mysqliConn->insert_id;
        }
    }
}

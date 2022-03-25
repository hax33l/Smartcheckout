<?php

namespace App\Controllers;

require_once('Models/Order.php');
require_once('Controllers/NewsletterController.php');
require_once('Controllers/OrderProductController.php');

use App\Models\Order;
use App\Controllers\OrderProductController;

class OrderController
{
    public static function create(array $orderData, object $mysqliConn)
    {
        $products = json_decode($orderData['products']);
        $order = new Order();
        $order->email = $orderData['email'];
        $order->first_name = $orderData['first_name'];
        $order->last_name = $orderData['last_name'];
        $order->phone = $orderData['phone'];
        $order->billing_country = $orderData['billing_country'];
        $order->billing_city = $orderData['billing_city'];
        $order->billing_address = $orderData['billing_address'];
        $order->billing_postal_code = $orderData['billing_postal_code'];
        $order->comment = $orderData['comment'];
        $order->shipping_id = $orderData['shipping_id'];
        $order->payment_id =  $orderData['payment_id'];

        $order->shipping_country = (empty($orderData['shipping_country'])) ? $orderData['billing_country'] : $orderData['shipping_country'];
        $order->shipping_city = (empty($orderData['shipping_city'])) ? $orderData['billing_city'] : $orderData['shipping_city'];
        $order->shipping_address = (empty($orderData['shipping_address'])) ? $orderData['billing_address'] : $orderData['shipping_address'];
        $order->shipping_postal_code = (empty($orderData['shipping_postal_code'])) ? $orderData['billing_postal_code'] : $orderData['shipping_postal_code'];

        if (!$order->isValidOrder()) {
            return false;
        }

        $sql_query = "INSERT INTO orders (email, first_name, last_name, phone, billing_country, 
        billing_city, billing_address, billing_postal_code, shipping_country, shipping_city, 
        shipping_address, shipping_postal_code, comment, shipping_id, payment_id)
        VALUES ('$order->email','$order->first_name','$order->last_name','$order->phone','$order->billing_country',
        '$order->billing_city','$order->billing_address ','$order->billing_postal_code','$order->shipping_country',
        '$order->shipping_city','$order->shipping_address','$order->shipping_postal_code ','$order->comment','$order->shipping_id','$order->payment_id ')";

        if ($mysqliConn->query($sql_query) === TRUE) {
            $order->id = $mysqliConn->insert_id;
            OrderProductController::create($products, $order->id, $mysqliConn);
            return $order->id;
        } else {
            return false;
        }
    }
}

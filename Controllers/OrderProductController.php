<?php

namespace App\Controllers;

require_once('Models/OrderProduct.php');

use App\Models\OrderProduct;

class OrderProductController
{
    public static function create(array $productData, $order_id, object $mysqliConn)
    {
        foreach ($productData as $product) {
            $order_product = new OrderProduct($order_id, $product->id, $product->quantity);

            $sql_query = "INSERT INTO order_product (order_id, product_id, quantity)
                VALUES ('$order_product->order_id','$order_product->product_id','$order_product->quantity')";

            if ($mysqliConn->query($sql_query) === TRUE) {
                return $mysqliConn->insert_id;
            }
        }
    }
}

<?php

namespace App\Controllers;

require_once('Models/Shipping.php');

use App\Models\Shipping;

class ShippingController
{
    public static function getShippingOptions(object $mysqliConn)
    {
        $shippingOptions = [];
        $sql_query = "SELECT id, name, image, price FROM shipping";
        $result = $mysqliConn->query($sql_query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $shippingOptions[] = new Shipping($row["id"], $row["name"], $row["image"], $row["price"]);
            }
        }
        return $shippingOptions;
    }
}

<?php 

namespace App\Models;

class OrderProduct
{
    public $id;
    public $order_id;
    public $product_id;
    public $quantity;
    public $created_at;
    public $modified_at;
    
    public function __construct($order_id, $product_id, $quantity)
    {
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }
}
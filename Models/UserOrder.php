<?php 

namespace App\Models;

class UserOrder
{
    public $id;
    public $user_id;
    public $order_id;
    public $created_at;
    public $modified_at;
    
    public function __construct($user_id, $order_id)
    {
        $this->user_id = $user_id;
        $this->order_id = $order_id;
    }
}
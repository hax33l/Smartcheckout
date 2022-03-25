<?php 

namespace App\Models;

class Shipping
{
    public $id;
    public $name;
    public $image;
    public $price;
    public $created_at;
    public $modified_at;

    function __construct($id, $name, $image, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->price = $price;
    }
}
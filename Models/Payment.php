<?php 

namespace App\Models;

class Payment
{
    public $id;
    public $name;
    public $image;
    public $created_at;
    public $modified_at;
    function __construct($id, $name, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
    }
}
<?php

namespace App\Models;

require_once('Validators/Validator.php');

use App\Validators\Validator;

class Order
{
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $billing_country;
    public $billing_city;
    public $billing_address;
    public $billing_postal_code;
    public $shipping_country;
    public $shipping_city;
    public $shipping_address;
    public $shipping_postal_code;
    public $comment;
    public $shipping_id;
    public $payment_id;
    public $created_at;
    public $modified_at;
    public function isValidOrder()
    {
        if (
            Validator::isValidFirstName($this->first_name) &&
            Validator::isValidLastName($this->last_name) &&
            Validator::isValidEmail($this->email) &&
            Validator::isValidCountry($this->billing_country) &&
            Validator::isValidCountry($this->shipping_country) &&
            Validator::isValidCity($this->billing_city) &&
            Validator::isValidCity($this->shipping_city) &&
            Validator::isValidAddress($this->billing_address) &&
            Validator::isValidAddress($this->shipping_address) &&
            Validator::isValidPostalCode($this->billing_postal_code) &&
            Validator::isValidPostalCode($this->shipping_postal_code) &&
            Validator::isValidPhone($this->phone)
        ) {
            return true;
        }
        return false;
    }
}

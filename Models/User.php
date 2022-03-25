<?php 

namespace App\Models;

require_once('Validators/Validator.php');

use App\Validators\Validator;

class User
{
    public $id;
    public $username;
    public $email;
    public $first_name;
    public $last_name;
    public $password_hash;
    public $country;
    public $city;
    public $address;
    public $postal_code;
    public $phone;
    public $created_at;
    public $modified_at;

    public function isValidUser(){
        if (
            Validator::isValidUsername($this->username) &&
            Validator::isValidFirstName($this->first_name) &&
            Validator::isValidLastName($this->last_name) &&
            Validator::isValidEmail($this->email) &&
            Validator::isValidCountry($this->country) &&
            Validator::isValidCity($this->city) &&
            Validator::isValidAddress($this->address) &&
            Validator::isValidPostalCode($this->postal_code) &&
            Validator::isValidPhone($this->phone)
        ) {
            return true;
        }
        return false;
    }
}
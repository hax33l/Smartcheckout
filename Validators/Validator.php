<?php

namespace App\Validators;

class Validator
{
    public static function isValidUsername(string $username)
    {
        if (empty($username)) {
            return false;
        }
        return true;
    }
    public static function isValidFirstName(string $first_name)
    {
        if (empty($first_name) || preg_match('/[^a-zA-Z]+/', $first_name)) {
            return false;
        }
        return true;
    }
    public static function isValidLastName(string $last_name)
    {
        if (empty($last_name) || preg_match('/[^a-zA-Z]+/', $last_name)) {
            return false;
        }
        return true;
    }
    public static function isValidEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
    public static function isValidCountry(string $country)
    {
        if (empty($country) || !preg_match('/[a-zA-Z]{2,}/', $country)) {
            return false;
        }
        return true;
    }
    public static function isValidCity(string $city)
    {
        if (empty($city)) {
            return false;
        }
        return true;
    }
    public static function isValidAddress(string $address)
    {
        if (empty($address)) {
            return false;
        }
        return true;
    }
    public static function isValidPostalCode(string $postal_code)
    {
        if (empty($postal_code)) {
            return false;
        }
        return true;
    }
    public static function isValidPhone(string $phone)
    {
        if (empty($phone) || preg_match('/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', $phone)) {
            return false;
        }
        return true;
    }
}

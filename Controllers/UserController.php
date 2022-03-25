<?php

namespace App\Controllers;

require_once('Models/User.php');

use App\Models\User;

class UserController
{
    public static function create(array $userData, object $mysqliConn)
    {
        $user = new User();
        $user->username = $userData['username'];
        $user->email = $userData['email'];
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->password_hash = password_hash($userData['password'], PASSWORD_BCRYPT);;
        $user->country = $userData['billing_country'];
        $user->city = $userData['billing_city'];
        $user->address = $userData['billing_address'];
        $user->postal_code = $userData['billing_postal_code'];
        $user->phone = $userData['phone'];

        if (self::checkIfUsernameExists($user->username, $mysqliConn)) {
            echo "Username $user->username already exists";
            return false;
        }

        if (self::checkIfEmailExists($user->email, $mysqliConn)) {
            echo "Email $user->email already exists";
            return false;
        }

        if (!$user->isValidUser()) {
            return false;
        }

        $sql_query = "INSERT INTO users (username, email, first_name, last_name, password_hash, country, city, address, postal_code, phone)
        VALUES ('$user->username' , '$user->email' , '$user->first_name', '$user->last_name', '$user->password_hash', 
        '$user->country', '$user->city', '$user->address', '$user->postal_code', '$user->phone')";

        if ($mysqliConn->query($sql_query) === TRUE) {
            echo "User '$user->username' created successfully\n";
            return $mysqliConn->insert_id;
        } else {
            echo "Error creating table: " . $mysqliConn->error . "\n";
            return false;
        }
    }

    private static function checkIfUsernameExists(string $username, $mysqliConn)
    {
        $sql_query = "SELECT id FROM `users` WHERE username = '$username'";
        $result = $mysqliConn->query($sql_query);

        if ($result->num_rows == 0) {
            return false;
        } else {
            return true;
        }
    }
    private static function checkIfEmailExists(string $email, $mysqliConn)
    {
        $sql_query = "SELECT id FROM `users` WHERE email = '$email'";
        $result = $mysqliConn->query($sql_query);

        if ($result->num_rows == 0) {
            return false;
        } else {
            return true;
        }
    }
}

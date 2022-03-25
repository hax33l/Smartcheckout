<?php

namespace App\Controllers;

require_once('Models/Newsletter.php');

use App\Models\Newsletter;

class NewsletterController
{
    public static function create(string $email, object $mysqliConn)
    {
        if (!self::checkIfEmailAlreadyExists($email, $mysqliConn)) {
            $newsletter = new Newsletter();
            $newsletter->email = $email;

            $sql_query = "INSERT INTO newsletter (email)
            VALUES ('$newsletter->email')";

            if ($mysqliConn->query($sql_query) === TRUE) {
                return true;
            } 
        }
    }

    private static function checkIfEmailAlreadyExists(string $email, object $mysqliConn)
    {
        $sql_query = "SELECT id FROM `newsletter` WHERE email = '$email'";
        $result = $mysqliConn->query($sql_query);

        if ($result->num_rows == 0) {
            return false;
        } else {
            return true;
        }
    }
}

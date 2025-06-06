<?php

namespace App\Utilities;

use App\Validation\Authorization;
class CloseAccount
{

    public static function deleteAcc($username, $password)
    {
        if ($password == null || $username === null || empty($password) || empty($username)) {
            echo "<script type='text/javascript'>alert('Please input');</script>";
            return;
        }
        $user = Authorization::getUserByUsername($username);
        if (!$user || $user === null) {
            echo "<script>alert('User not found.');</script>";
            return;
        }
        if (!Authorization::isLogged()) {
            echo "<script>alert('You must be logged in.');</script>";
            return;
        }
        if ($_SESSION["login"]["name"] === $user["name"] && $_SESSION["login"]["password"] == $user["password"]) {
            global $database;
            $database->delete("users", ["id" => $user["id"]]);
            unset($_SESSION["login"]);
            echo "<script>alert('Your account has been deleted :)');</script>";
            redirect();
        } else {
            echo "<script>alert('Incorrect username or password.');</script>";
            return;
        }

    }
}
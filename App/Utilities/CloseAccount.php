<?php

namespace App\Utilities;

use App\Validation\Authorization;
class CloseAccount
{

    public static function deleteAcc($username, $password)
    {
        if ($password == null || $username === null || empty($password) || empty($username)) {
            $_SESSION['alert'] = 'Username And Password Are Required !!';
            return;
        }
        $user = Authorization::getUserByUsername($username);
        if (!$user || $user === null) {
            $_SESSION['alert'] = 'User Not Found';
            return;
        }
        if (!Authorization::isLogged()) {
            $_SESSION['alert'] = 'You Must Logged in';
            return;
        }
        if ($_SESSION["login"]["name"] === $user["name"] && $_SESSION["login"]["password"] == $user["password"]) {
            global $database;
            $database->delete("users", ["id" => $user["id"]]);
            unset($_SESSION["login"]);
            $_SESSION['alert'] = 'Your Account Deleted Successfully';
            redirect();
        } else {
            $_SESSION['alert'] = 'Incorrect Password Or Username';
            return;
        }

    }
}
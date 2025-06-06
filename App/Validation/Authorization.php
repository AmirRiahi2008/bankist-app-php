<?php
namespace App\Validation;
session_start();
class Authorization
{
    private $user;
    public static function getUserByUsername($username)
    {
        global $database;

        if (empty($username))
            return null;

        $result = $database->get("users", "*", [
            "name" => $username
        ]);
        return $result ?: null;
    }

    public static function login($username, $password)
    {
        $user = self::getUserByUsername($username);
        if ($user === null)
            return "User Not Found";
        if ($user["password"] === $password) {
            $_SESSION["login"] = $user;
            return true;
        }
        return "Invalid username or password.";
    }
    public static function curUserId()
    {
        return $_SESSION["login"]["id"] ?? null;
    }
    public static function curUser()
    {
        return $_SESSION["login"] ?? null;
    }
    public static function isLogged()
    {
        return isset($_SESSION["login"]);
    }
}
<?php
namespace App\Validation;

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

    public static function register($username, $password)
    {
        global $database;
        $result = $database->insert("users", [
            "name" => $username,
            "password" => $password
        ]);
        if ($result) {
            $userRegistered = $database->get("accounts_details", "*", ["name" => $username, "password" => $password]);
            $database->insert("accounts_details", [
                "user_id" => $userRegistered["id"],
                "balance" => 0,
                "out" => 0,
                "in" => 0,
                "interest" => 0,
                "currency" => "EUR"
            ]);
        }
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
    public static function logout()
    {
        unset($_SESSION["login"]);
    }
}
<?php
namespace App\Utilities;
class Movements
{
    public static function addMovement($amount, $type, $userId)
    {
        global $database;
        return $database->insert("movements", [
            "user_id" => $userId,
            "type" => $type,
            "amount" => $amount
        ]);
    }

    public static function getMovements($userId)
    {
        global $database;
        $result = null;
        if (isset($_SESSION["login"]))
            $result = $database->select("movements", "*", [
                "user_id" => $userId,
                "ORDER" => ["id" => "DESC"]
            ]);

        return $result;
    }
}
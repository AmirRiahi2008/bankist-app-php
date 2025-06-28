<?php

namespace App\Utilities;

class Transfer
{
    public static function handleTransfer($amount, $accountName, $type)
    {
        global $accDetails;
        global $database;
        $amount = (int) $amount;
        $balance = (int) preg_replace('/[^\d.]/', '', $accDetails->getBalance());
        if (
            $amount <= 0 ||
            !is_numeric($amount) ||
            empty($accountName) ||
            $accountName === $_SESSION["login"]["name"]
        ) {
            echo "<script>alert('Invalid amount or recipient account.');</script>";
            return;
        }

        $transferToId = $database->get("users", "id", [
            "name" => $accountName
        ]);
        if (!$transferToId || $transferToId === null || empty($transferToId)) {
            echo "<script>alert('The account you want to transfer to does not exist.');</script>";
            return;
        }
        if ($amount > $balance) {
            echo "<script>alert('Your balance is not enough.');</script>";
            return false;
        }

        $database->insert("movements", [
            "user_id" => $transferToId,
            "type" => "deposit",
            "amount" => $amount
        ]);
        $database->insert("movements", [
            "user_id" => $_SESSION["login"]["id"],
            "type" => "withdrawal",
            "amount" => -1 * abs($amount)
        ]);
        $_SESSION["timer_start"] = time();
        $_SESSION["timer_duration"] = 300;
    }
}

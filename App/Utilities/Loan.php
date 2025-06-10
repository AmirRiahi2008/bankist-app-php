<?php

namespace App\Utilities;
class Loan
{
    public static function handle($amount, $type = "deposit")
    {
        $amount = (int) $amount;
        if ($amount > 0 && count(array_filter(Movements::getMovements($_SESSION["login"]["id"]), fn($mov) => $mov["amount"] >= ($amount * 0.1))) > 0) {
            $result = Movements::addMovement($amount, $type, $_SESSION["login"]["id"]);
            if (!$result)
                return false;
            return true;
        }
    }
}
<?php

namespace App\Utilities;

use NumberFormatter;

class AccDetails
{
    private $database;
    private static $accountDetails;

    private $currencySymbols = [
        'USD' => '$',
        'EUR' => '€',
        'IRR' => '﷼',
        'TRY' => '₺',
        'GBP' => '£',
        'CNY' => '¥',
        'JPY' => '¥',
        'INR' => '₹',
    ];

    public function __construct()
    {
        global $database;
        $this->database = $database;

        if (isset($_SESSION["login"])) {
            self::$accountDetails = $this->database->get("accounts_details", "*", [
                "user_id" => $_SESSION["login"]["id"]
            ]);
        } else {
            self::$accountDetails = null;
        }
    }

    public function getBalance()
    {
        if (isset($_SESSION["login"])) {
            if (self::$accountDetails === null)
                return null;
            return $this->formatCurrency(array_reduce(
                Movements::getMovements($_SESSION["login"]["id"]),
                fn($carry, $mov) =>
                $carry + (float) $mov['amount']
                ,
                0
            ), self::$accountDetails["currency"]);


        }
    }

    public function getIn()
    {
        if (isset($_SESSION["login"])) {
            $movements = Movements::getMovements($_SESSION["login"]["id"]);
            $sum = 0;
            foreach ($movements as $mov) {
                if ((float) $mov['amount'] > 0) {
                    $sum += (float) $mov['amount'];
                }
            }
            return $this->formatCurrency($sum, self::$accountDetails["currency"]);

        }
    }


    public function getOut()
    {
        if (isset($_SESSION["login"])) {
            $movements = Movements::getMovements($_SESSION["login"]["id"]);
            $sum = 0;
            foreach ($movements as $mov) {
                $amount = (float) $mov['amount'];
                if ($amount < 0) {
                    $sum += $amount;
                }
            }
            return $this->formatCurrency(abs($sum), $this->getCurrency());
        }
    }


    public function getInterest($interestRate = 1.2)
    {
        $movements = Movements::getMovements($_SESSION["login"]["id"]);
        $interest = array_reduce(
            array_filter(
                array_map(function ($mov) use ($interestRate) {
                    $amount = (float) $mov['amount'];
                    if ($amount > 0) {
                        return ($amount * $interestRate) / 100;
                    }
                    return 0;
                }, $movements),
                function ($int) {
                    return $int >= 1;
                }
            ),
            function ($carry, $int) {
                return $carry + $int;
            },
            0
        );
        return $this->formatCurrency($interest, self::$accountDetails["currency"]);
    }


    public function getCurrency()
    {
        if (self::$accountDetails === null)
            return null;
        return self::$accountDetails["currency"];
    }

    private function getCurrencySymbol(string $currency): string
    {
        return $this->currencySymbols[$currency] ?? $currency;
    }

    public function formatCurrency($amount, $currency, $locale = "en_US")
    {
        $amount = (float) $amount;


        if (class_exists('NumberFormatter')) {
            $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
            return $formatter->formatCurrency($amount, $currency);
        }


        $symbol = $this->getCurrencySymbol($currency);
        return $symbol . number_format($amount, 2);
    }

    public function getAccDetail()
    {
        return self::$accountDetails;
    }
}

<?php

namespace App\Utilities;

use NumberFormatter;

class AccDetails
{
    private $database;
    private $accountDetails;

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
            $this->accountDetails = $this->database->get("accounts_details", "*", [
                "user_id" => $_SESSION["login"]["id"]
            ]);
        } else {
            $this->accountDetails = null;
        }
    }

    public function getBalance()
    {
        if ($this->accountDetails === null)
            return null;
        return $this->formatCurrency($this->accountDetails["balance"], $this->getCurrency());
    }

    public function getIn()
    {
        if ($this->accountDetails === null)
            return null;
        return $this->formatCurrency($this->accountDetails["in"], $this->getCurrency());
    }

    public function getOut()
    {
        if ($this->accountDetails === null)
            return null;
        return $this->formatCurrency($this->accountDetails["out"], $this->getCurrency());
    }

    public function getInterest()
    {
        if ($this->accountDetails === null)
            return null;
        return $this->formatCurrency($this->accountDetails["interest"], $this->getCurrency());
    }

    public function getCurrency()
    {
        if ($this->accountDetails === null)
            return null;
        return $this->accountDetails["currency"];
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
}

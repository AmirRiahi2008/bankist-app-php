<?php
include "../bootstrap/init.php";
use App\Utilities\Loan;

if ($_SERVER["REQUEST_METHOD"] !== "POST")
    return;

$action = $_GET["action"];

switch ($action) {
    case 'loan':
        $amount = (int) $_POST["amount"];
        Loan::handle($amount);
        break;

    default:
        echo "Invalid Action";
        break;
}
header("Location:../index.php");
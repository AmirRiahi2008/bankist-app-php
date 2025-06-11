<?php
include "../bootstrap/init.php";
use App\Utilities\Loan;
use App\Utilities\Transfer;

if ($_SERVER["REQUEST_METHOD"] !== "POST")
    return;

$action = $_GET["action"];

switch ($action) {
    case 'loan':
        if (isset($_POST["loanSubmit"])) {
            $amount = (int) $_POST["amount"];
            Loan::handle($amount);
        } else
            return;
        break;
    case "transfer":
        if (isset($_POST["transferSubmit"])) {
            $amount = trim($_POST["amount"]);
            $transferTo = trim($_POST["transferTo"]);
            Transfer::handleTransfer($amount, $transferTo, "withdrawal");
        } else
            return;
        break;

    default:
        echo "Invalid Action";
        break;
}
// niceDD((int)$accDetails->getBalance());
header("Location:../index.php");
<?php
use App\Utilities\AccDetails;
use App\Utilities\Movements;
use App\Validation\Authorization;
include "./bootstrap/init.php";
if (isset($_GET["logout"]) && is_numeric($_GET["logout"]))
    Authorization::logout();
$accDetails = new AccDetails();

$movements = Movements::getMovements($_SESSION["login"]["id"]);

include BASE_PATH . "/Template/home.php";
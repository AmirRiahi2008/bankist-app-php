<?php
use App\Utilities\AccDetails;
use App\Utilities\Movements;
use App\Validation\Authorization;
include "./bootstrap/init.php";
if (isset($_GET["logout"]) && is_numeric($_GET["logout"]))
    Authorization::logout();
if (isset($_SESSION["login"])) {

    $movements = Movements::getMovements($_SESSION["login"]["id"]);
}
// niceDD($accDetails->getAccDetail());
// echo "<hr>";

include BASE_PATH . "/Template/home.php";
<?php
use App\Utilities\AccDetails;
use App\Utilities\Movements;
use App\Validation\Authorization;
include "./bootstrap/init.php";
if (isset($_GET["logout"]) && is_numeric($_GET["logout"]))
    Authorization::logout();
$accDetails = new AccDetails();
if (isset($_SESSION["login"])) {

    $movements = Movements::getMovements($_SESSION["login"]["id"]);
}
niceDD($accDetails->getAccDetail());
echo "<hr>";
// niceDD(Movements::getMovements(2));

include BASE_PATH . "/Template/home.php";
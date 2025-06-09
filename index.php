<?php
use App\Utilities\AccDetails;
use App\Validation\Authorization;
include "./bootstrap/init.php";
if (isset($_GET["logout"]) && is_numeric($_GET["logout"]))
    Authorization::logout();
$accDetails = new AccDetails();
include BASE_PATH . "/Template/home.php";
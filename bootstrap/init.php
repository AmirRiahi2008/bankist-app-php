<?php

use App\Utilities\AccDetails;
session_start();
const BASE_PATH = __DIR__ . "/../";
include BASE_PATH . "vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();
$_SESSION["timer_start"] = time();
$_SESSION["timer_duration"] = 300;
include BASE_PATH . "helper/helpers.php";
include BASE_PATH . "config/db.php";
$accDetails = new AccDetails();

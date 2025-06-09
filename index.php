<?php

use App\Validation\Authorization;
include "./bootstrap/init.php";
if (isset($_GET["logout"]) && is_numeric($_GET["logout"]))
    Authorization::logout();
include BASE_PATH . "/Template/home.php";
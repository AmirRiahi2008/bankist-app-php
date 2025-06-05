<?php
const BASE_PATH = __DIR__ . "/../";
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();
include BASE_PATH . "helper/helpers.php";
include BASE_PATH . "config/db.php";
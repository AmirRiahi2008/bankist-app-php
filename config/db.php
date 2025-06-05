<?php

use Medoo\Medoo;
$database = new Medoo([
    'type' => 'mysql',
    'host' => $_ENV["HOST"],
    'database' => $_ENV["DB"],
    'username' => $_ENV["USER"],
    'password' => $_ENV["PASS"],
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_general_ci',
    'port' => 3306,
    'logging' => true,
    'error' => PDO::ERRMODE_SILENT,
    'option' => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ],
    'command' => [
        'SET SQL_MODE=ANSI_QUOTES'
    ]
]);
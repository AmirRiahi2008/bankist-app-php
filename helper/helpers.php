<?php

function siteUri($uri = "")
{
    return $_ENV["BASE_URL"] . $uri;
}


function redirect($path = ""){
    header("Location:" . siteUri($path));
}

function niceDD($value){
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

function diePHP($input){
    die($input);
}

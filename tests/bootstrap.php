<?php

error_reporting(E_ALL | E_STRICT);


function pr($data)
{
    echo PHP_EOL;
    print_r($data);
    echo PHP_EOL;
}

require __DIR__ . '/../vendor/autoload.php';

if (defined('E_DEPRECATED')) {
    error_reporting(error_reporting() | E_DEPRECATED);
}

//Hamcrest\Util::registerGlobalFunctions();

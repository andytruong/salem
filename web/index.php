<?php

use AndyTruong\Salem\Application;

// ---------------------
// Auto class loading
// ---------------------
$locations[] = __DIR__ . "/../vendor/autoload.php";
$locations[] = __DIR__ . "/../../../autoload.php";

foreach ($locations as $location) {
    if (is_file($location)) {
        require_once $location;
    }
}

// ---------------------
// Run application
// ---------------------
$app = new Application(dirname(__DIR__));

// Sometime we just need getting the application object, do nothing else.
if (defined('ANDYTRUONG_SALEM_APPLICATION_DONT_RUN')) {
    return $app;
}

$app->getRoute()->handle();

<?php

$locations = [
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../../autoload.php'];
foreach ($locations as $location) {
    if (is_file($location)) {
        $loader = require $location;
        $loader->addPsr4('AndyTruong\\Salem\\TestCases\\', __DIR__ . '/salem');
        $loader->addPsr4('AndyTruong\\Salem\\Fixtures\\', __DIR__ . '/fixtures');
        break;
    }
}

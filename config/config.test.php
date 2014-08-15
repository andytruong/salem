<?php

$config = require_once __DIR__ . '/config.default.php';

$config['mode'] = 'test';
$config['debug'] = false;
$config['database']['default'] = [
    'driver'  => 'pdo_sqlite',
    'path'    => __DIR__ . '/../files/salemapp.test.sqlite',
    'charset' => 'UTF8',
];

return $config;

<?php

/**
 * NOTES: Do not modify this file directly, modify config.php instead.
 */
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('opcache.revalidate_freq', '1');

// -------
// Basic application config
// -------
$config = ['mode' => 'dev', 'debug' => false];

// -------
// Basic auth
// -------
$config['basic_auth'] = ['username' => 'go', 'password' => 'go'];

/**
 * Database connection
 */
if (isset($_SERVER['RDS_HOSTNAME'])) {
    $dbhost = $_SERVER['RDS_HOSTNAME'];
    $dbport = $_SERVER['RDS_PORT'];
    $dbname = $_SERVER['RDS_DB_NAME'];
    $dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname}";
    $username = $_SERVER['RDS_USERNAME'];
    $password = $_SERVER['RDS_PASSWORD'];

    $config['database']['default'] = [
        'driver'   => 'pdo_mysql',
        'host'     => $dbhost,
        'port'     => $dbport,
        'dbname'   => $dbname,
        'user'     => $username,
        'password' => $password,
        'charset'  => 'UTF8',
    ];
}
else {
    $config['database']['default'] = [
        'driver'  => 'pdo_sqlite',
        'path'    => __DIR__ . '/../files/salemapp.dev.sqlite',
        'charset' => 'UTF8',
    ];
}

return $config;

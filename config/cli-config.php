<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

define('ANDYTRUONG_SALEM_APPLICATION_DONT_RUN', true);
$app = require_once __DIR__ . '/../web/index.php';

return ConsoleRunner::createHelperSet($app->getEntitiyManager());

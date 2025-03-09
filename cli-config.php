<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ . '/vendor/autoload.php'; // ⬅️ Asegurar autoload

$entityManager = require __DIR__ . '/config/doctrine.php';

return ConsoleRunner::createHelperSet($entityManager);
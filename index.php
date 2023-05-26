<?php
session_start();

use system\Api\ApplicationEnvironmentsInterface;

require __DIR__ . '/vendor/autoload.php';

if (file_exists('.env')) {
    $dotenv = \Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
    $dotenv->load();
}

if (getenv('APP_ENV') !== ApplicationEnvironmentsInterface::PRODUCTION) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require __DIR__ . '/routes/web.php';

$application = new \bootstrap\Application();

echo $application->run();

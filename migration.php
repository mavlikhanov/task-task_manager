#!/usr/bin/env php
<?php
if (isset($argv[1])) {
    $inputString = $argv[1];
} else {
    echo "Error: migration name not passed.\n";
    exit(1);
}


require __DIR__ . '/vendor/autoload.php';

if (file_exists('.env')) {
    $dotenv = \Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
    $dotenv->load();
}

$application = new \bootstrap\Console();

$class = "\\databases\\Migrations\\{$argv[1]}";
$method = 'up';

if (class_exists($class) && method_exists($class, $method)) {
    $object = new $class();

    $object->{$method}();
} else {
    echo "Error: migration '$class' doest exist!.\n";
    exit(1);
}



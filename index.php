<?php

// Folder constants, 'q' stands for the application folder
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'q' . DIRECTORY_SEPARATOR);

// Set the application configuration and include an autoloader
require APP . 'config/config.php';
require APP . 'class/autoloader.php';

// Start new application
$app = new Application();
$app->start();

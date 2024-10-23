<?php
// Include Composer's autoloader
require_once __DIR__ . '/vendor/autoload.php';
require_once  __DIR__.'/database/connection.php';

// Use the Dotenv class from vlucas/phpdotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

header("Location: /home.php");

// echo getenv("DB_HOST");
// exit();

// Now you can access environment variables using getenv() or $_ENV[]



?>
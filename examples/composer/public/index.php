<pre>
<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load(); // Load .env file into $_ENV

print_r($_ENV);

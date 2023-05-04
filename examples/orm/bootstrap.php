<?php

require_once 'vendor/autoload.php';

session_start();

use Illuminate\Database\Capsule\Manager;

$manager = new Manager();
$manager->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'library',
    'username' => 'root',
    'password' => 'root',
]);

$manager->setAsGlobal();
$manager->bootEloquent();

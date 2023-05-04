<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

session_start();

require_once 'src/functions.php';
require_once 'libraries/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass;
$loader->register();
$loader->addNamespace('App', __DIR__ . '/src');

$PDO = (new App\PDOFactory)->create([
	'dbhost' => 'localhost',
	'dbname' => 'labs',
	'dbuser' => 'root',
	'dbpass' => 'root'
]);

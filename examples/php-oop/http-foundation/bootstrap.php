<?php

require_once 'libraries/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass;

$loader->register();

$loader->addNamespace(
	'Symfony\Component\HttpFoundation',
	__DIR__ . '/libraries/http-foundation'
);

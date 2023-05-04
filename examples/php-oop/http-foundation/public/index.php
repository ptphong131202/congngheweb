<?php

require_once '../bootstrap.php';

use Symfony\Component\HttpFoundation;

$people = [
	[
		'firstname' => 'Bao',
		'lastname' => 'Bui',
		'address' => '78 Ca Mau',
		'age' => 39,
	],
	[
		'firstname' => 'Trung',
		'lastname' => 'Nguyen',
		'address' => '62 Vinh Long',
		'age' => 32,
	],
	[
		'firstname' => 'Duc',
		'lastname' => 'Ho',
		'address' => '65 Can Tho',
		'age' => 21,
	]
];

$response = new HttpFoundation\Response;
$response->headers->set('content-type', 'application/json');
$response->setContent(json_encode($people));
$response->send();

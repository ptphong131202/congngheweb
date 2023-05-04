<?php

require_once '../bootstrap.php';

try {
	include '../db.php';

	$stmt = $dbh->query("select * from person");

	$people = $stmt->fetchAll();
} catch (PDOException $ex) {
	exit("Error: " . $ex->getMessage());
}

include VIEWS . 'person/list.php';

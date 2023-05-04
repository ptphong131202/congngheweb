<?php

require_once '../bootstrap.php';

try {
	include '../db.php';
} catch (PDOException $ex) {
	exit('Error: ' . $ex->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	try {
		$stmt = $dbh->prepare(
			'select * from person where id = ?'
		);
		$stmt->execute([$_GET['id']]);
		$person = $stmt->fetch();
	} catch (PDOException $ex) {
		exit('Error' . $ex->getMessage());
	}
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	try {
		$stmt = $dbh->prepare(
			'update person set firstname = :fn,
				lastname = :ln,
				address = :addr,
				age = :age where id = :id'
		);

		$stmt->execute([
			'id' => $_POST['id'],
			'fn' => $_POST['firstname'],
			'ln' => $_POST['lastname'],
			'addr' => $_POST['address'],
			'age' => $_POST['age']
		]);

		redirect('/');
	} catch (PDOException $ex) {
		exit('Error' . $ex->getMessage());
	}
}

$title = 'Cập nhật thông tin';
include VIEWS . 'person/form.php';

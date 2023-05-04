<?php

require_once '../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	try {
		include '../db.php';

		$stmt = $dbh->prepare(
			'insert into
				person(firstname, lastname, address, age)
				values (?, ?, ?, ?)'
		);

		$stmt->execute([
			$_POST['firstname'],
			$_POST['lastname'],
			$_POST['address'],
			$_POST['age']
		]);

		redirect('/');
	} catch (PDOException $ex) {
		exit('Error: ' . $ex->getMessage());
	}
}

$title = 'Thêm người mới';
include VIEWS . 'person/form.php';

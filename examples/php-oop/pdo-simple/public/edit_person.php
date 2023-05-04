<?php

try {
	include "../db_connect.php";
} catch (PDOException $ex) {
	exit("Khong the ket noi CSDL: " . $ex->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	try {
		$stmt = $dbh->prepare(
			"select * from person where id = ?"
		);
		$stmt->execute([$_GET['id']]);
		$person = $stmt->fetch();
	} catch (PDOException $ex) {
		exit("Da co loi xay ra: " . $ex->getMessage());
	}
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	try {
		$stmt = $dbh->prepare(
			"update person set firstname = :fn, lastname = :ln, address = :addr, age = :age where id = :id"
		);

		$stmt->execute([
			'id' => $_POST['id'],
			'fn' => $_POST['firstname'],
			'ln' => $_POST['lastname'],
			'addr' => $_POST['address'],
			'age' => $_POST['age']
		]);

		header("Location: view_person.php");
		exit();
	} catch (PDOException $ex) {
		exit("Da co loi xay ra: " . $ex->getMessage());
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cập nhật người</title>
	<style>
		form {
			display: table;
		}

		div {
			display: table-row;
		}

		label {
			display: table-cell;
		}

		input {
			display: table-cell;
			margin-top: 1rem;
		}
	</style>
</head>

<body>
	<h2>Cập nhật người</h2>
	<form action="edit_person.php" method="post">
		<input type="hidden" name="id" value="<?= !empty($person) ? $person['id'] : '' ?>">
		<div>
			<label for="firstname">Tên: </label>
			<input type="text" name="firstname" id="firstname" value="<?= !empty($person) ? $person['firstname'] : '' ?>">
		</div>
		<div>
			<label for="lastname">Họ: </label>
			<input type="text" name="lastname" id="lastname" value="<?= !empty($person) ? $person['lastname'] : '' ?>">
		</div>
		<div>
			<label for="address">Địa chỉ: </label>
			<input type="text" name="address" id="address" value="<?= !empty($person) ? $person['address'] : '' ?>">
		</div>
		<div>
			<label for="age">Tuổi: </label>
			<input type="number" name="age" id="age" min="1" max="150" value="<?= !empty($person) ? $person['age'] : '' ?>">
		</div>
		<button type="submit" style="margin-top: 1rem;">Lưu</button>
	</form>
</body>

</html>
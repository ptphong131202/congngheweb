<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	try {
		include "../db_connect.php";

		// $stmt = $dbh->prepare(
		// 	"insert into person(firstname, lastname, address, age) values (?, ?, ?, ?)"
		// );

		$stmt = $dbh->prepare(
			"insert into person(firstname, lastname, address, age) values (:fn, :ln, :addr, :age)"
		);

		$stmt->execute([
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
	<title>Thêm người mới</title>
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
	<h2>Thêm người mới</h2>
	<form action="" method="post">
		<div>
			<label for="firstname">Tên: </label>
			<input type="text" name="firstname" id="firstname">
		</div>
		<div>
			<label for="lastname">Họ: </label>
			<input type="text" name="lastname" id="lastbame">
		</div>
		<div>
			<label for="address">Địa chỉ: </label>
			<input type="text" name="address" id="address">
		</div>
		<div>
			<label for="age">Tuổi: </label>
			<input type="number" name="age" id="age" min="1" max="150">
		</div>
		<button type="submit" style="margin-top: 1rem;">Lưu</button>
	</form>
</body>

</html>
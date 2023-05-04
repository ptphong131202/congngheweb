<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?></title>
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
	<h2><?= $title ?></h2>
	<form method="post">
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
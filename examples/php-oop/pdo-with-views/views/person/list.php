<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Danh sách người</title>
</head>

<body>
	<h2>Danh sách người</h2>
	<a href='add_person.php'>Thêm mới</a>
	<table border="1" style="margin-top: 20px;">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Address</th>
			<th>Age</th>
			<th>Actions</th>
		</tr>
		<?php
		foreach ($people as $person) {
			echo "<tr>";
			echo "<td> " . $person["firstname"] . " </td>";
			echo "<td> " . $person["lastname"] . " </td>";
			echo "<td> " . $person["address"] . " </td>";
			echo "<td> " . $person["age"] . " </td>";
			echo "<td><a href=edit_person.php?id=" . $person['id'] . ">Hiệu chỉnh</a></td>";
			echo "</tr>";
		}
		?>
	</table>
</body>

</html>
<?php
session_start();

if (
	$_SERVER['REQUEST_METHOD'] === 'POST' &&
	isset($_POST['username'])
) {
	$_SESSION['username'] = $_POST['username'];
	header('Location: protected.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Session</title>
</head>

<body>
	<form action="login.php" method="POST">
		Username: <input type="text" name="username"><br />
		Password: <input type="password" name="password">
		<input type="submit" value="Login">
	</form>
</body>

</html>
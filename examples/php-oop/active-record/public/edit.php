<?php
require_once '../bootstrap.php';

use App\Models\Book;

$book = new Book($PDO);

if (
	isset($_REQUEST['id']) &&
	($book->findById($_REQUEST['id']))
) {
	$title = 'Cập nhật sách';
} else {
	$title = 'Thêm mới sách';
}

if (
	$_SERVER['REQUEST_METHOD'] === 'POST' &&
	$book->fill($_POST)->save()
) {
	redirect('/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Books</title>
	<style>
		input {
			display: block;
			margin-top: 5px;
		}

		button {
			margin-top: 5px;
		}
	</style>
</head>

<body>
	<a href="/">Trang chủ</a>
	<h2><?= $title ?></h2>
	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
		<input type="hidden" name="id" value="<?= $book->id ?? '' ?>">
		Tên sách: <input type="text" name="title" value="<?= $book->title ?? '' ?>">
		Miêu tả: <input type="text" name="description" value="<?= $book->description ?? '' ?>">
		Số trang: <input type="number" name="pages" value="<?= ($book->pages ?? '') ?>">
		Giá: <input type="number" name="price" value="<?= ($book->price ?? '') ?>">
		<button>Lưu</button>
	</form>
</body>

</html>
<?php
require_once '../bootstrap.php';

use App\Models\Book;

$book = new Book($PDO);

$books = $book->all();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Books</title>
</head>

<body>
	<h1>Danh mục sách</h1>
	<a href="/edit.php">Thêm mới</a>
	<table class="table">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên sách</th>
				<th>Miêu tả</th>
				<th>Số trang</th>
				<th>Giá</th>
				<th>Thao tác</th>
			</tr>
		</thead>
		<tbody>
			<?php $stt = 1;
			foreach ($books as $book) : ?>
				<tr id="<?= $book->id ?>">
					<td><?= $stt ?></td>
					<td><?= $book->title ?></td>
					<td><?= $book->description ?></td>
					<td><?= $book->pages ?></td>
					<td><?= $book->price ?></td>
					<td>
						<a href="/edit.php?id=<?= $book->id ?>">Sửa</a>
						<a class="delete" href="#">Xóa</a>
					</td>
				</tr>
			<?php $stt++;
			endforeach ?>
		</tbody>
	</table>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(() => {
			$('.delete').click((event) => {
				const trBook = $(event.target).parents('tr');
				const id = trBook.prop('id');
				const title = trBook.children('td:eq(1)').html();
				const question = `Bạn muốn xóa sách "${title}"?`;
				const ok = confirm(question);
				if (ok) {
					location.href = `/delete.php?id=${id}`;
				}
				return ok;
			});
		});
	</script>
</body>

</html>
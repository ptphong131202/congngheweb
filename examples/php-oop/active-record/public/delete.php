<?php
require_once '../bootstrap.php';

use App\Models\Book;

$book = new Book($PDO);

if (
	isset($_REQUEST['id']) &&
	($book->findById($_REQUEST['id']))
) {
	$book->delete();
}
redirect('/');

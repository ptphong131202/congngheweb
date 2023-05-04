<pre>
<?php

require_once __DIR__ . '/../bootstrap.php';

// use App\Models\Book;
use App\Models\User;

$alice = User::where('name', 'alice')->first();
$aliceBooks = $alice->books;
foreach ($aliceBooks as $book) {
    echo "$book->title ({$book->borrow->borrowed_at}) " . "\n";
}

// $books = Book::all();
// foreach ($books as $book) {
//     echo $book->title . "\n";
// }

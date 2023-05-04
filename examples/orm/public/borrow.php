<pre>
<?php

require __DIR__ . '/../bootstrap.php';

use App\Models\User;
use App\Models\Book;

$alice = User::where('name', 'alice')->first();
$phpInAction = Book::where('title', 'like', '%Php in Action%')->first();

// Alice có mượn sách này chưa?
$borrowed = $alice->books->find($phpInAction->id);

// PHP in Action còn trong thư viện hay không?
$outOfStock = $phpInAction->outOfStock();

// Nếu sách còn trong thư viện, và chưa được mượn, thì mượn cho Alice
if (!$outOfStock && !$borrowed) {
    // Alice mượn sách này
    $alice->books()->attach($phpInAction->id, [
        'borrowed_at' => date('Y-m-d')
    ]);

    // In ra thông tin mượn sách
    $alice->refresh();
    $borrowed = $alice->books->find($phpInAction->id);
    echo "Alice has borrowed $borrowed->title ({$borrowed->borrow->borrowed_at})", "\n";
} elseif ($borrowed) {
    // Alice đã mượn sách này rồi, trả lại sách
    echo "$borrowed->title is already borrowed by alice ({$borrowed->borrow->borrowed_at})", "\n";
    echo "Alice now returns it", "\n";
    $alice->books()->detach($phpInAction->id);
} else {
    // Sách đã hết, không thể mượn
    echo "$phpInAction->title out of stock", "\n";
}

// Cập nhật trường dữ liệu trong bảng trung gian
// $alice->books()->updateExistingPivot($phpInAction->id, [
// 	'borrowed_at' => date('Y-m-d'),
// ]);

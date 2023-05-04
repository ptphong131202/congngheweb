<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    public $timestamps = false;

    public function books()
    {
        return $this
            ->belongsToMany(Book::class, 'borrow')
            ->as('borrow')
            ->withPivot('borrowed_at');
    }

    public function borrow($bookId)
    {
        // Tim thong tin sach
        $book = Book::find($bookId);

        // User có mượn sách này chưa?
        $borrowed = $this->books->find($book->id);

        // Nếu sách còn trong thư viện, và chưa được mượn, thì mượn cho user
        if (!$book->outOfStock() && !$borrowed) {
            // User mượn sách này
            $this->books()->attach($book->id, [
                'borrowed_at' => date('Y-m-d')
            ]);
        }
    }

    public function return($bookId)
    {
        $book = Book::find($bookId);

        $borrowed = $this->books->find($book->id);

        if ($borrowed) {
            $this->books()->detach($book->id);
        }
    }
}

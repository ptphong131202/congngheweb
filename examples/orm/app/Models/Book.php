<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    public $timestamps = false;

    public function users()
    {
        return $this
            ->belongsToMany(User::class, 'borrow')
            ->as('borrow')
            ->withPivot('borrowed_at');
    }

    public function outOfStock()
    {
        return $this->users()->count() >= $this->quantity;
    }
}
